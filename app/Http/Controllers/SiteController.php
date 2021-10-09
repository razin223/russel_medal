<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller {

    private $exam_time = 10;
    private $question = 20;
    private $final_exam_time = 60;
    private $final_question = 100;

    //public function __construct() {
        //$this->middleware('auth');
        //$this->middleware('profile_update');
        //dd(\Auth::user());
//        if(->name == null){
//            return redirect('quiz_profile');
//        }
 //   }

    public function category() {
        return view('quiz.category');
    }

    public function en_category() {
        return view('quiz.en.category');
    }

    public function sub_category_list($id) {
        return view('quiz.sub_category', compact('id'));
    }

    public function en_sub_category_list($id) {
        return view('quiz.en.sub_category', compact('id'));
    }

    public function content_list($id) {
        $Data = \App\Content::where('category_id', $id)->where('display', 'Yes')->where('language', 'Bn')->orderBy('display_order', 'asc')->paginate(20);
        return view('quiz.content_list', compact('Data', 'id'));
    }

    public function en_content_list($id) {
        $Data = \App\Content::where('category_id', $id)->where('display', 'Yes')->where('language', 'En')->orderBy('display_order', 'asc')->paginate(20);
        return view('quiz.en.content_list', compact('Data', 'id'));
    }

    public function content($id) {
        return view('quiz.content', compact('id'));
    }

    public function en_content($id) {
        return view('quiz.en.content', compact('id'));
    }

    public function quiz() {
        if (session()->has('questions') && session()->has('exam_end')) {
            if (time() < session('exam_end')) {
                return view('quiz.quiz', ['type' => 'exam']);
            } else {
                $Data = \App\Exam::where('user_id', auth()->id())->first();

                $Time = date("Y-m-d H:i:s");
                $MicroTime = microtime(true);

                $QuestionIds = explode(",", $Data->questions);
                $QuestionList = \App\Question::whereIn('id', $QuestionIds)->get();
                $Questions = [];
                foreach ($QuestionList as $value) {
                    $Questions[$value->id] = $value;
                }

                $Mark = 0;
                $Answer = json_decode($Data->answer_submitted, true);
                if (!empty($Answer) && count($Answer)) {
                    foreach ($Answer as $key => $value) {
                        if ($Questions[$key]->answer == (int) $value) {
                            $Mark++;
                        }
                    }
                }

                $Data->submitted = $Time;
                $Data->submitted_micro = $MicroTime;
                $Data->time_taken = $MicroTime - $Data->started_micro;
                $Data->mark_obtained = $Mark;
                $Data->save();

                session()->forget(['exam_start']);
                session()->forget(['start_time_micro']);
                session()->forget(['exam_end']);
                session()->forget(['questions']);
                session()->forget(['id']);

                return view('quiz.quiz', ['type' => 'list']);
            }
        } else {
            $Data = \App\Exam::where('user_id', auth()->id())->first();
            if ($Data != null) {
                if (time() < strtotime($Data->exam_end_at)) {
                    if (empty($Data->submitted)) {
                        session(['exam_start' => strtotime($Data->started)]);
                        session(['start_time_micro' => $Data->started_micro]);
                        session(['exam_end' => strtotime($Data->exam_end_at)]);
                        session(['questions' => $Data->questions]);
                        session(['id' => $Data->id]);
                        return view('quiz.quiz', ['type' => 'exam']);
                    }
                }
            }
            return view('quiz.quiz', ['type' => 'list']);
        }
    }

    public function quiz_start(Request $request) {
        if (time() < strtotime("2021-06-25 15:00:00+06:00")) {
            return response(['status' => false, 'message' => "কুইজের সময় শুরু হয় নাই। কুইজ ২৫ জুন বিকাল ৩টা থেকে শুরু হবে"]);
        }
        if (time() > strtotime("2021-06-25 23:59:59+06:00")) {
            return response(['status' => false, 'message' => "কুইজের সময় শেষ হয়েছে। আর কুইজ দেওয়া যাবে না।"]);
        }
        $Data = \App\Exam::where('user_id', auth()->id())->first();
        if ($Data != null) {
            return response(['status' => false, 'message' => "আপনি ইতিমধ‌্যে একবার অংশগ্রহণ করেছেন। আর অংশগ্রহণ করতে পারবেন না।"]);
        }

        if (empty($request->question_language)) {
            return response(['status' => false, 'message' => "প্রশ্নের ভাষা সিলেক্ট করুন।"]);
        }
        if (!in_array($request->question_language, ['En', 'Bn'])) {
            return response(['status' => false, 'message' => "প্রশ্নের ভাষা ভুল দেওয়া হয়েছে। সঠিক ভাষা সিলেক্ট করুন।"]);
        }


        $Question = \App\Question::where('language', $request->question_language)->where('id', '>', 60)->inRandomOrder()->limit($this->final_question)->get();

        if ($Question->count() == $this->final_question) {
            $QuestionList = [];

            foreach ($Question as $value) {
                $QuestionList[] = $value->id;
            }
            $Time = date("Y-m-d H:i:s");
            $StartTimeMicrotime = microtime(true);
            $End = strtotime($Time . " +" . $this->final_exam_time . " minutes");


            $Data = new \App\Exam;
            $Data->user_id = auth()->id();
            $Data->question_language = $request->question_language;
            $Data->questions = implode(",", $QuestionList);
            $Data->started = $Time;
            $Data->started_micro = $StartTimeMicrotime;
            $Data->exam_time = $this->final_exam_time;
            $Data->exam_end_at = date("Y-m-d H:i:s", $End);
            $Data->save();

            $ID = $Data->id;

            session(['exam_start' => strtotime($Time)]);
            session(['start_time_micro' => $StartTimeMicrotime]);
            session(['exam_end' => $End]);
            session(['questions' => implode(",", $QuestionList)]);
            session(['id' => $Data->id]);

            return response(['status' => true]);
        }
    }

    public function quiz_save(Request $request) {
        $Data = \App\Exam::where('user_id', auth()->id())->first();
        if ($Data != null) {
            if (time() < strtotime($Data->exam_end_at)) {
                if ($request->has('answer')) {
                    $Data->answer_submitted = json_encode($request->answer);
                    $Data->save();
                    return response(['status' => true]);
                } else {
                    return response(['status' => false, 'message' => "কোন উত্তর দাগানো হয় নাই।"]);
                }
            } else {
                return response(['status' => false, 'message' => "পরীক্ষার সময় শেষ। দয়া করে সাবমিট করুন।"]);
            }
        } else {
            return response(['status' => false, 'message' => "কোন পরীক্ষা পাওয়া যায় নাই।"]);
        }
    }

    public function quiz_submit(Request $request) {
        $Data = \App\Exam::where('user_id', auth()->id())->first();
        if ($Data != null) {
            if ($request->has('answer')) {
                $Time = date("Y-m-d H:i:s");
                $MicroTime = microtime(true);

                $QuestionIds = explode(",", $Data->questions);
                $QuestionList = \App\Question::whereIn('id', $QuestionIds)->get();
                $Questions = [];
                foreach ($QuestionList as $value) {
                    $Questions[$value->id] = $value;
                }

                $Mark = 0;
                if ($request->has('answer')) {
                    foreach ($request->answer as $key => $value) {
                        if ($Questions[$key]->answer == (int) $value) {
                            $Mark++;
                        }
                    }
                }

                $Data->submitted = $Time;
                $Data->submitted_micro = $MicroTime;
                $Data->time_taken = $MicroTime - $Data->started_micro;
                $Data->mark_obtained = $Mark;
                $Data->answer_submitted = json_encode($request->answer);
                $Data->save();

                session()->forget(['exam_start']);
                session()->forget(['start_time_micro']);
                session()->forget(['exam_end']);
                session()->forget(['questions']);
                session()->forget(['id']);

                return response(['status' => true]);
            } else {
                return response(['status' => false, 'message' => "কোন উত্তর পাওয়া যায় নাই।"]);
            }
        } else {
            return response(['status' => false, 'message' => "কোন পরীক্ষা পাওয়া যায় নাই।"]);
        }
    }

    public function practice() {
        if (time() < strtotime("2021-06-25 15:00:00+06:00") || time() > strtotime("2021-06-26 00:00:00+06:00")) {
            return view('quiz.practice');
        } else {
            return redirect(route('quiz'));
        }
    }

    public function practice_new() {

        if (session()->has('questions')) {
            if (time() > session()->get('exam_end')) {
                session()->forget(['exam_start']);
                session()->forget(['exam_end']);
                session()->forget(['questions']);
                session()->forget(['id']);
                session()->forget(['saved_answer']);
                session()->forget(['start_time_micro']);
                return view('quiz.practice_new', ['type' => 'list']);
            } else {
                return view('quiz.practice_new', ['type' => 'exam']);
            }
        } else {
            return view('quiz.practice_new', ['type' => 'list']);
        }
    }

    public function answer_submit(Request $request) {

        if (session()->has('exam_start') && session()->has('exam_end') && session()->has('questions') &&
                session()->has('id') && session()->has('saved_answer') && session()->has('start_time_micro')) {
            $QuestionIds = explode(",", session('questions'));
            $QuestionList = \App\Question::whereIn('id', $QuestionIds)->get();
            $Questions = [];
            foreach ($QuestionList as $value) {
                $Questions[$value->id] = $value;
            }

            $Mark = 0;
            if ($request->has('answer')) {
                foreach ($request->answer as $key => $value) {
                    if ($Questions[$key]->answer == (int) $value) {
                        $Mark++;
                    }
                }
            }

            $TimeTaken = microtime(true) - session('start_time_micro');
            $Time = date("Y-m-d H:i:s");
            $Answers = $request->except(['_token']);

            $Data = \App\TemporaryExam::find(session('id'));

            $Data->submitted = $Time;
            $Data->time_taken = $TimeTaken;
            $Data->answer_submitted = json_encode($Answers);
            $Data->mark_obtained = $Mark;
            $Data->save();

            session()->forget(['exam_start']);
            session()->forget(['exam_end']);
            session()->forget(['questions']);
            session()->forget(['id']);
            session()->forget(['saved_answer']);
            session()->forget(['start_time_micro']);

            return response(['status' => true]);
        } else {
            session()->forget(['exam_start']);
            session()->forget(['exam_end']);
            session()->forget(['questions']);
            session()->forget(['id']);
            session()->forget(['saved_answer']);
            session()->forget(['start_time_micro']);
            return response(["অসংগতিপূর্ণ ডাটা দেওয়া হয়েছে। পরীক্ষা বাতিল হয়েছে। আবার চেষ্টা করুন।"], 422);
        }
    }

    public function practice_new_set(Request $request) {


        $Question = \App\Question::where('language', 'Bn')->where('id', '<=', 60)->inRandomOrder()->limit($this->question)->get();

        if ($Question->count() == $this->question) {

            $QuestionId = [];

            foreach ($Question as $value) {
                $QuestionId[] = (int) $value->id;
            }

            $Data = new \App\TemporaryExam();

            $Time = date("Y-m-d H:i:s");
            $StartTimeMicrotime = microtime(true);

            $Data->user_id = auth()->id();
            $Data->started = $Time;
            $Data->exam_time = $this->exam_time;
            $Data->questions = implode(",", $QuestionId);

            $Data->save();

            $End = strtotime($Time . " +" . $this->exam_time . " minutes");

            session(['exam_start' => strtotime($Time)]);
            session(['start_time_micro' => $StartTimeMicrotime]);
            session(['exam_end' => $End]);
            session(['questions' => implode(",", $QuestionId)]);
            session(['id' => $Data->id]);
            session(['saved_answer' => ""]);

            return ['status' => true];
        } else {
            return response("পর্যাপ্ত প্রশ্ন পাওয়া যায় নাই। পরে আবার চেষ্টা করুন।", 422);
        }
    }

    public function answer_sheet($id) {
        return view('quiz.answer_sheet', compact('id'));
    }

    public function en_practice() {
        return view('quiz.en.practice');
    }

    public function en_practice_new() {
        return view('quiz.en.practice_new');
    }

    public function profile() {
        return view('quiz.profile');
    }

    public function en_profile() {
        return view('quiz.en.profile');
    }

    public function logout() {
        \Auth::logout();
        return redirect(route('landing'));
    }

    public function en_logout() {
        \Auth::logout();
        return redirect(route('en.landing'));
    }

    public function video_gallery() {
        return view('quiz.video_gallery');
    }

    public function en_video_gallery() {
        return view('quiz.en.video_gallery');
    }

    public function photo_gallery() {
        return view('quiz.photo_gallery');
    }

    public function en_photo_gallery() {
        return view('quiz.en.photo_gallery');
    }

}
