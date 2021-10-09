@extends("quiz_template")

@section("content")

<style>



    .btn-learn-more {
        font-family: 'Hind Siliguri', sans-serif;
        font-weight: 600;
        font-size: 14px;
        letter-spacing: 1px;
        display: inline-block;
        padding: 12px 32px;
        border-radius: 5px;
        transition: 0.3s;
        line-height: 1;
        color: rgb(68, 68, 68);
        -webkit-animation-delay: 0.8s;
        animation-delay: 0.8s;
        margin-top: 6px;
        border: 2px solid rgb(68, 68, 68);
    }

    .btn-learn-more:hover {
        background: rgb(68, 68, 68);
        color: #fff;
        text-decoration: none;
    }

    .question span{
        margin-right: 10px;
    }
    .hidden{
        display: none;
    }



</style>

<section class="breadcrumbs">
    <h2 class="text-center">প্রোফাইল</h2>
</section>
<!-- ======= Cta Section ======= -->
<section class="services" style="background-color: #fff">
    <div class="container">
        <?php
        $Data = \App\User::find(auth()->id());
        $CountryId = $DivisionId = $DistrictId = null;
        if (!empty($Data->district_id)) {
            $DistrictId = $Data->district_id;
            $DivisionId = $Data->getDistrict->division_id;
        }

        if (!empty($Data->permanent_address_district_id)) {
            $PermanentDistrictId = $Data->permanent_address_district_id;
            $PermanentDivisionId = $Data->getPermanentDistrict->division_id;
        }
        ?>
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 hidden" id="profile_edit">
                <h6 class="w-100 text-center font-weight-bold"> <span class="text-danger">*</span> চিহ্নিত ঘরগুলো অবশ‌্যই পূরণ করতে হবে।</h6>
                <?php
                if (\Session::has('error')) {
                    ?>
                    <p class="w-100 text-center text-danger">{{\Session::get('error')}}</p>
                    <?php
                }
                ?>
                <div class="card card-info">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12" id="message_zone"></div>
                        </div>
                        <form id="form" onsubmit="return false;" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> নাম: </label>
                                <div class="col-12">
                                    <input type="text" name="name" value="{{$Data->name}}" class="form-control" placeholder="আপনার পূর্ণ নাম লিখুন"/>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> শ্রেণী: </label>
                                <div class="col-12">
                                    <select name="class" class="form-control">
                                        <option value=""></option>
                                        <?php
                                        $Class = [
                                            '3' => "৩য়",
                                            "4" => "৪র্থ",
                                            "5" => "৫ম",
                                            "6" => "৬ষ্ঠ",
                                            "7" => "৭ম",
                                            "8" => "৮ম",
                                            "9" => "৯ম",
                                            "10" => "১০ম",
                                            "11" => "১১তম",
                                            "12" => "১২তম",
                                        ];
                                        foreach ($Class as $key => $value) {
                                            echo "<option value='{$key}'";
                                            echo ($Data->class == $key) ? "selected" : "";
                                            echo ">{$value} শ্রেণী</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> বিশেষ চাহিদা সম্পন্ন শিশু: </label>
                                <div class="col-12">
                                    <select name="special_child" class="form-control">
                                        <option value=""></option>
                                        <?php
                                        foreach (['No' => "না", 'Yes' => "হ্যাঁ",] as $key => $value) {
                                            echo "<option value='{$key}'";
                                            echo ($Data->special_child == $key) ? "selected" : "";
                                            echo ">{$value}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> লিঙ্গ: </label>
                                <div class="col-12">
                                    <select name="gender" class="form-control">
                                        <option value=""></option>
                                        <?php
                                        $Gender = ['Male' => 'ছেলে', 'Female' => 'মেয়ে', 'Others' => 'অন‌্যান‌্য'];
                                        foreach ($Gender as $key => $value) {
                                            echo "<option value='{$key}'";
                                            echo ($Data->gender == $key) ? "selected" : "";
                                            echo ">{$value}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> পিতার নাম: </label>
                                <div class="col-12">
                                    <input type="text" name="father_name" value="{{$Data->father_name}}" class="form-control" placeholder="আপনার পিতার নাম লিখুন"/>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> মাতার নাম: </label>
                                <div class="col-12">
                                    <input type="text" name="mother_name" value="{{$Data->mother_name}}" class="form-control" placeholder="আপনার মাতরা নাম লিখুন"/>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> অভিভাবকের নাম: </label>
                                <div class="col-12">
                                    <input type="text" name="guardian_name" value="{{$Data->guardian_name}}" class="form-control" placeholder="আপনার অভিভাবকের নাম লিখুন"/>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> অভিভাবকের মোবাইল নম্বর: </label>
                                <div class="col-12">
                                    <input type="text" name="guardian_mobile_no" value="{{$Data->guardian_mobile_no}}" class="form-control" placeholder="আপনার অভিভাবকের মোবাইল নম্বর লিখুন"/>
                                    <span class="text-info">(১১ ডিজিট মোবাইল নম্বর ইংরেজিতে লিখুন)</span>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-12"> অভিভাবকের ইমেইল ঠিকানা: </label>
                                <div class="col-12">
                                    <input type="email" name="guardian_email" value="{{$Data->guardian_email}}" class="form-control" placeholder="আপনার অভিভাবকের ইমেইল ঠিকানা লিখুন"/>
                                </div>
                            </div>

                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> বর্তমান ঠিকানা: </label>
                                <div class="col-12">
                                    <input type="text" name="address" value="{{$Data->address}}" class="form-control" placeholder="আপনার ঠিকানা (বাড়ি নং, রোড নং, থানা ইত‌্যাদি) লিখুন"/>
                                </div>
                            </div>


                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> বিভাগ: </label>
                                <div class="col-12">
                                    <select name="division_id" id="division_id" class="form-control">

                                        <option value=""></option>
                                        <?php
                                        foreach (\App\Division::orderBy('bn', 'asc')->get() as $value) {
                                            echo "<option value='{$value->id}'";
                                            echo ($DivisionId == $value->id) ? "selected" : "";
                                            echo ">{$value->bn}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> জেলা/শহর: </label>
                                <div class="col-12">
                                    <select name="district_id" id="district_id" class="form-control">
                                        <?php
                                        if (!empty($DivisionId)) {
                                            ?>
                                            <option value=""></option>
                                            <?php
                                            foreach (\App\District::where('division_id', $DivisionId)->orderBy('bn', 'asc')->get() as $value) {
                                                echo "<option value='{$value->id}'";
                                                echo ($DistrictId == $value->id) ? "selected" : "";
                                                echo ">{$value->bn}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> স্থায়ী ঠিকানা: </label>
                                <div class="col-12">
                                    <input type="text" name="permanent_address" value="{{$Data->permanent_address}}" class="form-control" placeholder="আপনার পূর্ণ স্থায়ী ঠিকানা (বাড়ি নং, রোড নং, থানা, জেলা ইত‌্যাদি) লিখুন"/>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> জন্ম তারিখ: </label>
                                <div class="col-12">
                                    {{date("d-m-Y",strtotime($Data->date_of_birth))}} <span class="text-danger">&nbsp;&nbsp;&nbsp;(পরিবর্তন করা সম্ভব নয়)</span>
                                </div>
                            </div>

                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> ছবি: </label>
                                <div class="col-12">
                                    <input type="file" name="file" value="" class="form-control" placeholder="আপনার ছবি দিন" accept="image/png, image/jpeg"/>
                                    <span class="text-info">ছবি অবশ‌্যই jpg/jpeg/png হতে হবে এবং 512KB এর নিচে হতে হবে। পাসপোর্ট সাইজ হতে হবে।</span><br/>
                                    <?php
                                    if (!empty($Data->picture)) {
                                        ?>
                                        <img src="{{$Data->picture}}" style="width: 200px"/>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <div class="col-12 text-center">
                                    <input type="submit" value="আপডেট করুন" class="btn btn-info"/>
                                    <a class="btn btn-outline-dark close-button"  href="javascript:;" data-target="profile_edit">বন্ধ করুন</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8 offset-md-2 mt-5 hidden" id="password_change">
                <div class="card">
                    <div class="card-body">
                        <form id="form_password">
                            @csrf
                            <h4 class="w-100 text-center font-weight-bold">পাসওয়ার্ড পরিবর্তন</h4>
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> বর্তমান পাসওয়ার্ড: </label>
                                <div class="col-12">
                                    <input type="password" name="current_password"  class="form-control reset-password" placeholder="আপনার বর্তমান পাসওয়ার্ড লিখুন"/>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> নতুন পাসওয়ার্ড: </label>
                                <div class="col-12">
                                    <input type="password" name="new_password"  class="form-control reset-password" placeholder="আপনার নতুন পাসওয়ার্ড লিখুন"/>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <label class="col-12"><span class="text-danger">*</span> পুনরায় নতুন পাসওয়ার্ড দিন: </label>
                                <div class="col-12">
                                    <input type="password" name="new_password_confirmation" class="form-control reset-password" placeholder=" পুনরায় আপনার নতুন পাসওয়ার্ড লিখুন"/>
                                </div>
                            </div>
                            <div class="form-group row p-1">
                                <div class="col-12 text-center">
                                    <input type="submit" value="পরিবর্তন করুন" class="btn btn-info"/>
                                    <a class="btn btn-outline-dark close-button"  href="javascript:;" data-target="password_change">বন্ধ করুন</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




            <div class="col-12 col-md-8 offset-md-2 mt-5">
                <h6 class="bg-warning text-center text-danger w-100 p-2 m-2 mb-5">প্রোফাইলের সকল তথ‌্য আপডেট না করা থাকলে দয়া করে আপডেট করুন। অন‌্যথায় পদক এর জন‌্য আবেদন করতে পারবেন না।</h6>

                <?php
                $Data = \App\User::find(auth()->id());

                if ($Data->picture != null) {
                    ?>
                    <div class="text-center">
                        <a href="{{route('apply')}}" class="btn btn-info">আবেদন করুন</a><br/><br/>
                    </div>
                    <?php
                }
                ?>
                <table class="table" style="border: solid lightgray 1px">
                    <tbody>
                        <tr>
                            <td rowspan="3" style="border: solid lightgray 1px; width: 200px;" class="text-center" >
                                <?php
                                if ($Data->picture != null) {
                                    ?>
                                    <img src="{{$Data->picture}}" style="max-width: 150px; max-height: 150px"/>
                                    <?php
                                } else {
                                    ?>
                                    <h6>ছবি দেওয়া হয় নাই</h6>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>নাম: {{($Data->name != null)? $Data->name:"দেওয়া হয় নাই"}}</td>
                        </tr>

                        <tr>
                            <td>ইমেইল: {{$Data->email}}</td>
                        </tr>
                        <tr>
                            <td>শ্রেণী: {{$Data->class != null? $Class[$Data->class]." শ্রেণী": "দেওয়া হয় নাই"}}</td>
                        </tr>
                        <tr>
                            <td>লিঙ্গ: </td>
                            <td>{{$Data->gender != null ? $Gender[$Data->gender]:"দেওয়া হয় নাই"}}</td>
                        </tr>
                        <tr>
                            <td>বিশেষ চাহিদা সম্পন্ন শিশু: </td>
                            <td>
                                <?php
                                if ($Data->special_child != null) {
                                    ?>
                                    {{$Data->special_child != 'No' ? "হ্যাঁ":"না"}}
                                    <?php
                                } else {
                                    ?>
                                    দেওয়া হয় নাই
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>পিতার নাম: </td>
                            <td>{{$Data->father_name != null? $Data->father_name: "দেওয়া হয় নাই"}}</td>
                        </tr>
                        <tr>
                            <td>মাতার নাম: </td>
                            <td>{{$Data->mother_name != null? $Data->mother_name: "দেওয়া হয় নাই"}}</td>
                        </tr>
                        <tr>
                            <td>অভিভাবকের নাম: </td>
                            <td>{{$Data->guardian_name != null? $Data->guardian_name: "দেওয়া হয় নাই"}}</td>
                        </tr>
                        <tr>
                            <td>অভিভাবকের মোবাইল নম্বর: </td>
                            <td>{{$Data->guardian_mobile_no != null? $Data->guardian_mobile_no: "দেওয়া হয় নাই"}}</td>
                        </tr>
                        <tr>
                            <td>অভিভাবকের ইমেইল: </td>
                            <td>{{$Data->guardian_email != null? $Data->guardian_email: "দেওয়া হয় নাই"}}</td>
                        </tr>
                        <tr>
                            <td>বর্তমান ঠিকানা: </td>
                            <td>
                                <?php
                                if ($Data->address != null) {
                                    ?>
                                    {{$Data->address}},
                                    <?php
                                }
                                if ($Data->district_id != null) {
                                    ?>
                                    {{$Data->getDistrict->bn}}, {{$Data->getDistrict->getDivision->bn}}, {{$Data->getDistrict->getDivision->getCountry->bn}}
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>স্থায়ী ঠিকানা: </td>
                            <td>
                                <?php
                                if ($Data->permanent_address != null) {
                                    ?>
                                    {{$Data->address}},
                                    <?php
                                }
                                if ($Data->permanent_address_district_id != null) {
                                    ?>
                                    {{$Data->getPermanentDistrict->bn}}, {{$Data->getPermanentDistrict->getDivision->bn}}, {{$Data->getPermanentDistrict->getDivision->getCountry->bn}}
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td>জন্ম তারিখ: </td>
                            <td>{{$Data->date_of_birth != null ? date("d-M-Y",strtotime($Data->date_of_birth)):"দেওয়া হয় নাই"}}</td>
                        </tr>

                        <tr class="text-center">

                            <td colspan="2">
                                <button class="btn btn-primary edit" data-target="profile_edit">প্রোফাইল পরিবর্তন করুন</button> &nbsp; &nbsp;
                                <button class="btn btn-info edit" data-target="password_change">পাসওয়ার্ড পরিবর্তন করুন</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
                <h5 class="text-center">আবেদনসমূহ</h5>
                <?php
                $Applications = \App\Application::where('user_id', auth()->id())->get();
                if ($Applications->count()) {
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ক্ষেত্র</th>
                                <th>আবেদনের তারিখ</th>
                                <th>অবস্থা</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $Sl = 0;
                            foreach ($Applications as $value) {
                                $Sl++;
                                ?>
                                <tr>
                                    <td>{{$Sl}}</td>
                                    <td>{{$value->getSector->sector_name}}</td>
                                    <td>{{date("d-M-Y h:i:sA",strtotime($value->created_at))}}</td>
                                    <td>{{$value->status}}</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    ?>
                    <p class="text-center">কোন আবেদন পাওয়া যায় নাই।</p>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
</section><!-- End Cta Section -->

<script type="text/javascript">
    $(document).ready(function () {


        $(".edit").click(function () {
            var ID = $(this).data('target');

            $("#" + ID).show();

            $('html, body').animate({
                scrollTop: $("#" + ID).offset().top - 120
            }, 1000);
        });

        $(".close-button").click(function () {
            var ID = $(this).data('target');

            $("#" + ID).hide();
        });


        $('#date_of_birth').attr('readonly', true).datepicker({format: 'yyyy-mm-dd', uiLibrary: 'bootstrap4'});

        $("#country_id").change(function () {
            $("#division_id,#district_id").html("");
            if ($(this).val() != "") {
                $("#division_id").html("<option value=''>(লোড হচ্ছে)</option>");
                $.ajax({
                    url: "{{route('division_get')}}",
                    data: {'country_id': $(this).val(), 'order_by': 'bn'},
                    success: function (data) {
                        if (data.length) {
                            var HTML = "<option value=''>(বিভাগ/স্টেট)</option>";
                            for (var i in data) {
                                HTML += "<option value='" + data[i].id + "'>" + data[i].bn + "</option>";
                            }
                            $("#division_id").html(HTML);
                        }
                    },
                    error: function (error) {
                        alert("Error occured." + error.responseText);
                    }
                });
            }
        });




        $("#division_id").change(function () {
            $("#district_id").html("");
            if ($(this).val() != "") {
                $("#district_id").html("<option value=''>(লোড হচ্ছে)</option>");
                $.ajax({
                    url: "{{route('district_get')}}",
                    data: {'division_id': $(this).val(), 'order_by': 'bn'},
                    success: function (data) {
                        if (data.length) {
                            var HTML = "<option value=''>(জেলা/শহর)</option>";
                            for (var i in data) {
                                HTML += "<option value='" + data[i].id + "'>" + data[i].bn + "</option>";
                            }
                            $("#district_id").html(HTML);
                        }
                    },
                    error: function (error) {
                        alert("Error occured." + error.responseText);
                    }
                });
            }
        });

        $("#form").submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{route('profile_update')}}",
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status) {
                        alert('আপনার প্রোফাইল আপডেট হয়েছে।');
                        window.location = window.location.href;
                    }
                },
                error: function (error) {
                    var message = JSON.parse(error.responseText);

                    var Error = message.message;

                    if (typeof message.errors != 'undefined') {
                        var ErrorMessages = message.errors;
                        for (var i in ErrorMessages) {
                            Error += "\n" + ErrorMessages[i][0];
                        }
                    }

                    alert("প্রোফাইল আপডেট করা সম্ভব হয় নাই।\n" + Error);
                }
            });
        });



        $("#form_password").submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{route('profile_password_update')}}",
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status) {
                        alert('আপনার পাসওয়ার্ড আপডেট হয়েছে।');
                        $(".reset-password").val("");
                    }
                },
                error: function (error) {
                    var message = JSON.parse(error.responseText);

                    var Error = message.message;

                    if (typeof message.errors != 'undefined') {
                        var ErrorMessages = message.errors;
                        for (var i in ErrorMessages) {
                            Error += "\n" + ErrorMessages[i][0];
                        }
                    }

                    alert("পাসওয়ার্ড আপডেট করা সম্ভব হয় নাই।\n" + Error);
                }
            });
        });

    });
</script>




@endsection