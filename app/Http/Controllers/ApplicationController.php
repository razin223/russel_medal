<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Traits\ImageResizeTrait;

class ApplicationController extends Controller {

    //use ImageResizeTrait;

    public function __construct() {
        $this->middleware('auth');
    }

    public function list(Request $request) {
        $Data = \App\Application::with('getSector', 'getUser');
        if (!empty($request->sector_id)) {
            $Data = $Data->where('sector_id', $request->sector_id);
        }
        $Data = $Data->paginate(100);
        return view('new-admin.Application.index', ['SearchData' => $Data, 'title' => "Application List"]);
    }

    public function individual(Request $request, $id) {
        return view('new-admin.Application.view', ['id' => $id, 'title' => 'Individual Application']);
    }

    public function index(Request $request) {


        $Data = \App\User::find(auth()->id());

        if ($Data->picture == null) {
            return redirect(route('quiz_profile'))->with('error', 'আপনার প্রোফাইল আপডেট করুন। তারপর আবেদন করতে পারবেন।');
        }

        if (time() < strtotime('2021-10-15 00:00:00+06:00')) {

            return view('quiz.application');
        } else {
            return redirect(route('quiz_profile'))->with('error', 'আবেদনের সময় শেষ।');
        }
    }

    public function create(Request $request) {
        return view('new-admin.' . $request->route()->getName(), ['title' => "Category Create"]);
    }

    public function store(Request $request) {

        $Required = [
            'sector_id' => 'required',
            'heading' => 'required|max:1000',
            'details' => 'required',
            'file.*' => 'mimes:jpg,jpeg,png,JPG,JPEG,PNG,pdf,PDF,mp4,mkv,doc,docx|max:20480',
        ];


        $Message = [
            'sector_id.required' => 'অবদানের ক্ষেত্র নির্বাচন করুন।',
            'heading.required' => 'অবদানের শিরোনাম লিখুন।',
            'heading.max' => 'অবদানের শিরোনাম সর্বোচ্চ ১০০০ অক্ষর হতে পারবে।',
            'details.required' => 'অবদানের বিস্তারিত লিখুন।',
            'file.*.mimes' => 'ভুল ফাইল নির্বাচন করেছেন। সমর্থিত ফাইল ফরম‌্যাট: jpg,jpeg,png,pdf,mp4,mkv,doc,docx',
            'file.*.max' => 'ফাইল সর্বোচ্চ ২০ মেগাবাইট হতে পারবে।',
        ];

        $request->validate($Required, $Message);

        $Data = \App\Application::where('sector_id', $request->sector_id)
                ->where('user_id', auth()->id())
                ->first();
        if ($Data != null) {
            return back()->with('error', 'আপনি ইতিমধ‌্যে এই ক্ষেত্রে আবেদন করেছেন। নতুন করে আর আবেদন এই ক্ষেত্রে আবেদন করতে পারবেন না।');
        }

        $Files = [];
        if ($request->file != null) {
            foreach ($request->file as $File) {
                if ($File->getSize()) {
                    $path = \Storage::disk('s3')->put("attachments", $File, 'public');
                    $url = \Storage::disk('s3')->url($path);
                    $Files[] = $url;
                }
            }
        }

        $Links = [];
        if ($request->link != null) {
            foreach ($request->link as $link) {
                if (!empty($Link)) {
                    $Links[] = $link;
                }
            }
        }



        $Data = new \App\Application();
        $Data->sector_id = $request->sector_id;
        $Data->heading = $request->heading;
        $Data->details = $request->details;
        $Data->attachments = json_encode(['link' => $Links, 'file' => $Files]);
        $Data->status = 'Processing';
        $Data->user_id = auth()->id();

        $Data->save();

        //$request->session()->flash('Category created successfully. Category name: ' . $request->category_name . " and display order:" . $request->category_order);

        return redirect(route('quiz_profile'))->with('success', 'আপনার আবেদন সফল ভাবে সংগৃহীত হয়েছে।');
    }

    public function edit(Request $request, $Category) {
        $Data = \App\Category::find($Category);
        if ($Data != null) {
            return view('new-admin.' . $request->route()->getName(), ['title' => "Category Edit", 'Data' => $Data]);
        } else {
            return back()->with('error', 'Invalid category data given to delete.');
        }
    }

    public function update(Request $request, $Category) {
        $Required = [
            'category_name' => 'required|max:255',
            'category_name_en' => 'max:255',
            'category_order' => 'required|numeric',
            'file' => 'image|mimes:jpg,jpeg,png,JPG,JPEG,PNG|max:1024',
            'display' => 'required',
        ];


        $Message = [
            'category_name.required' => 'You must enter category name.',
            'category_name.max' => 'Category name cannot be more than 255 character.',
            'category_name_en.max' => 'Category name in English cannot be more than 255 character.',
            'category_order.required' => 'You must enter category display order.',
            'category_order.numeric' => 'Category display order must be number.',
            'file.required' => 'You must enter category image.',
            'file.file' => 'Category image file did not upload to server.',
            'file.image' => 'Category image is not a valid image file.',
            'file.mimes' => 'Category image file must be jpg,jpeg or png.',
            'file.dimensions' => 'Category image must be 1200x675 px size.',
            'file.max' => 'Category image cannot be more than 1024KB.',
            'display.required' => 'You must select display status.',
        ];

        $request->validate($Required, $Message);

        $File = $Resized = null;

        if ($request->hasFile('file')) {
            $File = $request->file->store('public');
            $Resized = $this->resizeImage($File);
        }

        $Data = \App\Category::find($Category);
        if ($Data != null) {
            $Data->category_name = $request->category_name;
            $Data->category_name_en = $request->category_name_en;
            $Data->category_order = $request->category_order;
            if ($File != null) {
                $Data->category_image = $File;
                $Data->category_image_resized = $Resized;
            }
            $Data->display = $request->display;
            $Data->updated_by = auth()->id();

            $Data->save();

            $request->session()->flash('success', 'Data updated successfully.');

            return response(['status' => true]);
        } else {
            return response(['message' => "Invalid data given to edit."], 422);
        }
    }

    public function destroy(Request $request, $Category) {
        $Data = \App\Category::find($Category);

        if ($Data != null) {
            $Data->deleted_by = auth()->id();
            $Data->save();
            $Data->delete();

            return ['status' => true];
        } else {
            return response("Invalid data given.", 422);
        }
    }

}
