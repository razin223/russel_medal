@extends("new-admin-template")

@section("content")
<div class="row">
    <div class="col-12">
        <?php
        $Data = \App\Application::find($id);
        $User = $Data->getUser;
        $Sector = $Data->getSector;

        if ($Data != null) {
            ?>
            <h4 class="text-center">{{$Sector->sector_name}}</h4>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 150px">Name: </td>
                        <td>{{$User->name}}</td>
                    </tr>
                    <tr>
                        <td>Date of Birth: </td>
                        <td>{{date("d-m-Y",strtotime($User->date_of_birth))}}</td>
                        <td style="width: 150px">Gender: </td>
                        <td>{{$User->gender}}</td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td>{{$User->email}}</td>
                    </tr>
                    <tr>
                        <td>Father: </td>
                        <td>{{$User->father_name}}</td>
                    </tr>
                    <tr>
                        <td>Mother: </td>
                        <td>{{$User->mother_name}}</td>
                    </tr>
                    <tr>
                        <td>Guardian: </td>
                        <td>{{$User->guardian_name}}</td>
                    </tr>
                    <tr>
                        <td>Guardian Mobile: </td>
                        <td>{{$User->guardian_mobile_no}}</td>
                    </tr>
                    <tr>
                        <td>Guardian Email: </td>
                        <td>{{$User->guardian_email}}</td>
                    </tr>
                    <tr>
                        <td>Present Address: </td>
                        <td>{{$User->address}}, District: {{$User->getDistrict->name}}, Division: {{$User->getDistrict->getDivision->name}}</td>
                    </tr>
                    <tr>
                        <td>Permanent Address: </td>
                        <td>{{$User->permanent_address}}</td>
                    </tr>
                    <tr>
                        <td>Guardian Email: </td>
                        <td>{{$User->guardian_email}}</td>
                    </tr>
                    <tr>
                        <td>Guardian Email: </td>
                        <td>{{$User->guardian_email}}</td>
                    </tr>
                    <tr>
                        <td>Guardian Email: </td>
                        <td>{{$User->guardian_email}}</td>
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