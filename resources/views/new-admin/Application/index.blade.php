@extends("new-admin-template")

@section("content")
<div class="row">
    <div class="col-12">
        <form>
            <div class="row">
                <div class="col-md-4">
                    <b>Sector</b>
                    <select name="sector_id" class="form-control">
                        <option value="">(select)</option>
                        <?php
                        foreach (\App\Sector::orderBy('sector_name', 'asc')->get() as $value) {
                            echo "<option value='{$value->id}'";
                            echo (request()->input('sector_id') == $value->id) ? "selected" : "";
                            echo ">{$value->sector_name}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <b>Status</b>
                    <select name="status" class="form-control">
                        <option value="">(select)</option>
                        <?php
                        foreach (['Processing', 'Accepted', 'Rejected'] as $value) {
                            echo "<option value='{$value}'";
                            echo (request()->input('status') == $value) ? "selected" : "";
                            echo ">{$value}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 text-center">
                    <input type="submit" value="Search" class="btn btn-primary"/>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12">
        <?php
        if (!empty(request()->input('sector_id'))) {
            ?>
            <a href="{{route('Application.print_all')."?sector_id=".request()->input('sector_id')}}" class="btn btn-primary" target="_blank">Print</a>
            <?php
        }
        ?>
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
                        <th>Status</th>
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
                                <a href="{{route('Application.individual',['id'=>$Data->id])}}" target="_blank"><i class="fas fa-eye"></i></a>&nbsp; &nbsp;
                                <a href="{{route('Application.individualprint',['id'=>$Data->id])}}" target="_blank"><i class="fas fa-print"></i></a>
                            </td>
                            <td>{{$Sl}}</td>
                            <td>
                                {{$Data->getSector->sector_name}}
                            </td>
                            <td>{{$Data->getUser->name}}</td>
                            <td>{{$Data->heading}}</td>
                            <td>{{$Data->details}}</td>
                            <td>
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
                                        <a href="{{$value}}" target="_blank">File {{$key+1}}</a><br/>
                                        <?php
                                    }
                                }
                                ?>
                            </td>
                            <td>{{$Data->status}}</td>


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
        {{$SearchData->withQueryString()->links()}}
    </div>

</div>
@endsection