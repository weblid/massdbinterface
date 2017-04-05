<!-- Dynamic Table Full Pagination -->
<div class="block">

    <div class="block-content">
        <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality initialized in js/pages/base_tables_datatables.js -->
        <table class="table table-bordered table-striped js-dataTable-full-pagination">
            <thead>
                <tr>
                    <th class="font-w600" style="width: 25%;">Action</th>
                    <th class="hidden-xs" style="width: 30%;">Model</th>
                    <th class="hidden-xs" style="width: 30%;">Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rowsProcessed as $row)
                <tr>
                    <td class="font-w600">{{$row['action']}}</td>
                    <td class="hidden-xs">{{$row['model']}}</td>
                    <td class="hidden-xs">
                    
                        <small class="green">NEW: {{$row['data']}}</small>
                        @if(isset($row['old_data']))
                            <small class="red"><br/><br/>OLD: {{$row['old_data'] or ''}}</small>
                        @endif
                    </td>
          
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- END Dynamic Table Full Pagination -->

