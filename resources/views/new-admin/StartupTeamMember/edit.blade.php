@extends("new-admin-template")

@section("content")
<?php
$Address = [
    'city_id' => null,
    'state_id' => null,
    'country_id' => null
];
if ($UserData->city_id != NULL) {
    $City = \App\City::find($UserData->city_id);
    $Address['city_id'] = $City->id;
    $State = $City->getState;
    $Address['state_id'] = $State->id;
    $Country = $State->getCountry;
    $Address['country_id'] = $Country->id;
}
?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#form").submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: "{{route('startupteammember_edit', $UserData->id)}}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $("#loading-Modal").modal('hide');
                    toastr.success("Team member information updated successfully.", "Success");
                },
                error: function (error, b) {
                    $("#loading-Modal").modal('hide');

                    var message = JSON.parse(error.responseText);

                    var Error = "";

                    if (typeof error.status == 500) {
                        Error += "<strong>System error</strong>";
                    }

                    if (typeof message.message != 'undefined') {
                        Error += message.message;
                    }

                    if (typeof message.errors != 'undefined') {
                        var ErrorMessages = message.errors;
                        for (var i in ErrorMessages) {
                            Error += "<br/>" + ErrorMessages[i][0];
                        }
                    }




                    toastr.error(Error, "Error");

                }
            });
        });
    });</script>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form id="form" onsubmit="return false;" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-12 text-center text-info">All fields with <span class="text-danger">*</span> marks are mandatory.</div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3  col-md-2 col-form-label">Startup <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="startup_id" class="form-control">
                                <?php
                                foreach (\App\Startup::where('created_by', auth()->id())->get() as $value) {
                                    ?>
                                    <option value="{{$value->id}}">{{$value->startup_name}}</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3  col-md-2 col-form-label">Position <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="position_name" value="{{$UserData->position_name}}"  class="form-control" id="exampleInputEmail2" placeholder="CEO, CTO, CFO etc.">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-md-2 col-form-label">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="first_name" value="{{$UserData->first_name}}" class="form-control" id="exampleInputUsername2" placeholder="First Name">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="last_name" value="{{$UserData->last_name}}" class="form-control" id="exampleInputEmail2" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3  col-md-2 col-form-label">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="email" value="{{$UserData->email}}"  class="form-control" id="exampleInputEmail2" placeholder="Email address">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3  col-md-2 col-form-label">Mobile <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="mobile" value="{{$UserData->mobile}}"  class="form-control" id="exampleInputEmail2" placeholder="Mobile Number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3  col-md-2 col-form-label">Gender <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="gender" class="form-control">
                                <option value="">(select)</option>
                                <?php
                                foreach (['Male', 'Female', 'Others'] as $value) {
                                    echo "<option value='$value'";

                                    echo ($value == $UserData->gender) ? "selected" : "";

                                    echo ">$value</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3  col-md-2 col-form-label">Education <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="education_level_id" class="form-control">
                                <option value="">(select)</option>
                                <?php
                                foreach (\App\EducationLevel::orderBy('education_level_name')->get() as $value) {
                                    echo "<option value='{$value->id}'";
                                    echo ($UserData->education_level_id == $value->id) ? "selected" : "";
                                    echo ">{$value->education_level_name}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3  col-md-2 col-form-label">Last Degree Name <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="last_degree_name" value="{{$UserData->last_degree_name}}" class="form-control" id="exampleInputEmail2" placeholder="B.Sc, M.Sc, BBA etc.">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3  col-md-2 col-form-label">Last Degree Achieved in <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="last_degree_passing_year" class="form-control select2">
                                <option value="">(select)</option>
                                <?php
                                foreach (array_reverse(range(1950, (int) date("Y"), true)) as $value) {
                                    echo "<option value='$value'";
                                    echo ($UserData->last_degree_passing_year == $value) ? 'selected' : "";
                                    echo ">$value</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3  col-md-2 col-form-label">Address <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="address" value="{{$UserData->address}}" class="form-control" id="exampleInputEmail2" placeholder="House No, Road No, Village, Post etc" maxlength="255">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3  col-md-2 col-form-label">Country <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="country_id" id="country_id" class="form-control select2">
                                <option value="">(select)</option>
                                <?php
                                foreach (\App\Country::orderBy('name', 'asc')->get() as $value) {
                                    echo "<option value='{$value->id}'";
                                    echo ($Address['country_id'] == $value->id) ? 'selected' : "";
                                    echo ">{$value->name}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3  col-md-2 col-form-label">State <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="state_id" id="state_id" class="form-control ">
                                <?php
                                if (!empty($Address['country_id'])) {
                                    echo "<option value=''>(select)</option>";
                                    foreach (\App\State::where('country_id', $Address['country_id'])->orderBy('name', 'asc')->get() as $value) {
                                        echo "<option value='{$value->id}'";
                                        echo ($Address['state_id'] == $value->id) ? 'selected' : "";
                                        echo ">{$value->name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3  col-md-2 col-form-label">City <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="city_id" id="city_id" class="form-control ">
                                <?php
                                if (!empty($Address['state_id'])) {
                                    echo "<option value=''>(select)</option>";
                                    foreach (\App\City::where('state_id', $Address['state_id'])->orderBy('name', 'asc')->get() as $value) {
                                        echo "<option value='{$value->id}'";
                                        echo ($Address['city_id'] == $value->id) ? "selected" : "";
                                        echo ">{$value->name}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3  col-md-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-9">
                            <input type="text" name="date_of_birth" value="{{$UserData->date_of_birth}}" class="form-control date" id="exampleInputEmail2" placeholder="DD-MM-YYYY">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3  col-md-2 col-form-label">Picture <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="file" name="picture" class="form-control" id="exampleInputEmail2" accept="image/jpeg" >
                            <p class="text-info">Use Square size image with minimum 300X300 pixel size.</p>
                            <?php
                            if ($UserData->picture != NULL) {
                                ?>
                                <img src="{{asset("/profile_pictures/".$UserData->picture)}}" style="width: 100px" class="rounded"/>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3  col-md-2 col-form-label">Tell us your experience being this position <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <textarea name="about_yourself" class="form-control" maxlength="1000" rows="4" placeholder="Write something about you">{{$UserData->about_yourself}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 text-center">

                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection