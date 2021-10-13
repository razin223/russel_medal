@extends("new-admin-template")

@section("content")
<div class="row">
    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>#</th>
                        <th>Sector</th>
                        <th>Name</th>
                        <th>Heading</th>
                        <th>Details</th>
                        <th>Attachments</th>
                        <th>Modification</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $Sl = ($SearchData->currentPage() - 1) * $SearchData->perPage();
                    foreach ($SearchData as $Data) {
                        $Sl++;
                        ?>
                        <tr>
                            <td>
                                <a href="{{route('Application.individual',['id'=>$Data->id])}}"><i class="fas fa-eye"></i></a>&nbsp; &nbsp;
                                <a href="{{route('Application.individualprint',['id'=>$Data->id])}}"><i class="fas fa-print"></i></a>
                            </td>
                            <td>{{$Sl}}</td>
                            <td>
                                {{$Data->getSector->sector_name}}
                            </td>
                            <td>{{$Data->getUser->name}}</td>
                            <td>{{$Data->heading}}</td>
                            <td>{$Data->details}</td>
                            <td>
                                Created: {{date("d-M-Y h:i:sA",strtotime($Data->created_at))}}<br/>
                                Updated: {{date("d-M-Y h:i:sA",strtotime($Data->updated_at))}}<br/>
                            </td>
                        </tr>


                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection