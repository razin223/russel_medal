@extends("new-admin-template")

@section("content")
<div class="row">
    <div class="col-12">
        <?php
        $Data = \App\Application::find($id);
        $User = $Data->getUser;
        $Sector = $Data->getSector;
        $DateCheck = "2021-10-14";

        $Age = \Carbon\Carbon::parse($User->date_of_birth)->diff(\Carbon\Carbon::parse($DateCheck))->format('%y year, %m month, %d day');

        if ($Data != null) {
            ?>
            <h4 class="text-center">{{$Sector->sector_name}}</h4>
            <table class="table table-bordered">
                <tr>
                    <td colspan="5" class="text-right"><strong class=" float-left">{{$Data->status}}</strong>Application ID: {{$Data->id}}, Apply Date: {{date("d-m-Y h:i:sA",strtotime($Data->created_at))}}</td>
                </tr>
                <tbody>
                    <tr>
                        <td style="width: 150px">Name: </td>
                        <td colspan="3">{{$User->name}}</td>
                        <td rowspan="5">
                            <img src="{{$User->picture}}" style="max-width: 150px; max-height: 150px; "/>
                        </td>
                    </tr>

                    <tr>
                        <td>Date of Birth: </td>
                        <td style="width: 350px">{{date("d-m-Y",strtotime($User->date_of_birth))}}<br/> ({{$Age}} till 14-10-2021)</td>
                        <td style="width: 150px">Gender: </td>
                        <td>{{$User->gender}}</td>
                    <tr/>
                    <tr>
                        <td style="width: 150px">Class: </td>
                        <td>{{$User->class}}</td>
                        <td style="width: 150px">Special Child: </td>
                        <td>{{$User->special_child}}</td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td colspan="3">{{$User->email}}</td>
                    </tr>
                    <tr>
                        <td>Father: </td>
                        <td  colspan="4">{{$User->father_name}}</td>
                    </tr>
                    <tr>
                        <td>Mother: </td>
                        <td  colspan="4">{{$User->mother_name}}</td>
                    </tr>
                    <tr>
                        <td>Guardian: </td>
                        <td  colspan="4">{{$User->guardian_name}}</td>
                    </tr>
                    <tr>
                        <td>Guardian Mobile: </td>
                        <td>{{$User->guardian_mobile_no}}</td>
                        <td>Guardian Email: </td>
                        <td colspan="2">{{$User->guardian_email}}</td>
                    </tr>

                    <tr>
                        <td>Present Address: </td>
                        <td  colspan="4">{{$User->address}}, District: {{$User->getDistrict->name}}, Division: {{$User->getDistrict->getDivision->name}}</td>
                    </tr>
                    <tr>
                        <td>Permanent Address: </td>
                        <td  colspan="4">{{$User->permanent_address}}</td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <h4 class="text-center">Application</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>Contribution: </td>
                        <td  colspan="4">{{$Data->heading}}</td>
                    </tr>
                    <tr>
                        <td>Contribution Details: </td>
                        <td  colspan="4">{{$Data->details}}</td>
                    </tr>
                    <tr>
                        <td>Attachments: </td>
                        <td colspan="4">
                            <?php
                            $Array = json_decode($Data->attachments, true);
                            if (count($Array['link'])) {
                                foreach ($Array['link'] as $key => $value) {
                                    ?>
                                    <a href="{{$value}}" target="_blank">Link {{$key+1}}</a><br/>
                                    <?php
                                }
                            }
                            if (count($Array['file'])) {
                                foreach ($Array['file'] as $key => $value) {
                                    ?>
                                    <a href="{{$value}}" target="_blank">File {{$key+1}}</a> &nbsp; &nbsp; &nbsp;
                                    <?php
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><h4>{{$Data->status}}</h4></td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center">
                            <?php
                            if ($Data->status == 'Processing' || $Data->status == 'Rejected') {
                                ?>
                                <a href="javascript:;" class="btn btn-success modify" data-id="{{$Data->id}}" data-type="Accepet">Accept</a> 
                                <?php
                            }
                            ?>
                            &nbsp;&nbsp;
                            <?php
                            if ($Data->status == 'Processing' || $Data->status == 'Accepeted') {
                                ?>

                                <a href="javascript:;"  data-id="{{$Data->id}}" data-type="Reject" class="btn btn-danger modify">Reject</a
                                <?php
                            }
                            ?>

                            <a href="javascript:;" class="btn btn-default" id="save" style="display: none"  >Saving</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
        } else {
            ?>
            <h4 class="text-center text-danger">No data found.</h4>
            <?php
        }
        ?>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.modify').click(function () {

            var ID = $(this).data('id');
            var Type = $(this).data('type');

            if (confirm("Do you really want to " + Type + " this application?")) {
                $('.modify').hide();
                $("#save").show();
                $.ajax({
                    url: "{{route('Application.modify')}}",
                    method: "GET",
                    data: {'id': ID, 'type': Type},
                    success: function (data) {
                        $('.modify').show();
                        $("#save").hide();
                        if (data.status) {
                            alert("Application has been " + Type + "ed successfully.");
                            window.location = window.location.href;
                        }
                    },
                    error: function (error, b) {
                        $('.modify').show();
                        $("#save").hide();

                        var message = JSON.parse(error.responseText);

                        var Error = "";

                        if (typeof error.status == 500) {
                            Error += "System error";
                        }

                        if (typeof message.message != 'undefined') {
                            Error += message.message;
                        }

                        if (typeof message.errors != 'undefined') {
                            var ErrorMessages = message.errors;
                            for (var i in ErrorMessages) {
                                Error += "\n" + ErrorMessages[i][0];
                            }
                        }
                        alert("Error\n" + Error);
                    }
                });
            }
        });
    });
</script>
@endsection