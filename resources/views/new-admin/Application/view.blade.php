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
                    <td colspan="5" class="text-right">Application ID: {{$Data->id}}, Apply Date: {{date("d-m-Y h:i:sA",strtotime($Data->created_at))}}</td>
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
                            <a href="javascript:;" class="btn btn-success">Accept</a> &nbsp;&nbsp;
                            <a href="javascript:;" class="btn btn-danger">Reject</a>
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
@endsection