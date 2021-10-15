<!DOCTYPE html>
<html>
    <head>
        <style>
            .text-center{
                text-align: center;
            }

            table tr td{
                border: solid gray 1px;
                vertical-align: top;
            }
        </style>
    </head>
    <?php
    $DateCheck = "2021-10-14";
    ?>
    <body style="width: 14in; padding: 1in">
        <table style="border: solid gray 1px" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sector</th>
                    <th>Picture</th>
                    <th>Personal Details</th>
                    <th>Contribution</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $Sl = 0;
                foreach ($Data as $value) {
                    $Sl++;
                    $User = $value->getUser;
                    $Age = \Carbon\Carbon::parse($User->date_of_birth)->diff(\Carbon\Carbon::parse($DateCheck))->format('%y year, %m month, %d day');
                    ?>
                    <tr style=" vertical-align: top">
                        <td>{{$Sl}}</td>
                        <td>{{$value->getSector->sector_name}}</td>
                        <td><img src="{{$value->getUser->picture}}" style="width: 1.5in"/></td>
                        <td>
                            Name: {{$User->name}}<br/>
                            Date of Birth: {{date("d-m-Y",strtotime($User->date_of_birth))}} ({{$Age}} till 14-10-2021)<br/>
                            Gender: {{$User->gender}}<br/>
                            Class: {{$User->class}}<br/>
                            Special Child: {{$User->special_child}}<br/>
                            Application Email: {{$User->email}}<br/>
                            Father Name: {{$User->father_name}}<br/>
                            Mother Name: {{$User->mother_name}}<br/>
                            Guardian: {{$User->guardian_name}}<br/>
                            Guardian Mobile: {{$User->guardian_mobile_no}}<br/>
                            Guardian Email: {{$User->guardian_email}}
                            Present Address: {{$User->address}}, District: {{$User->getDistrict->name}}, Division: {{$User->getDistrict->getDivision->name}}<br/>
                            Permanent Address: {{$User->permanent_address}}

                        </td>
                        <td>
                            <strong>Contribution:</strong><br/> {{$value->heading}}<br/><br/>
                            <strong>Contribution Details:</strong><br/> {{$value->details}}
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </body>
</html>