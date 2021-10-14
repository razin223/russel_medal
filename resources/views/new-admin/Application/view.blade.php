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
            <table class="table">
                <tbody>
                    <tr>
                        <td style="width: 150px">Name: </td>
                        <td>{{$User->name}}</td>
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