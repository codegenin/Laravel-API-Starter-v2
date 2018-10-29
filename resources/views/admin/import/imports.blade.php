<table class="table table-responsive table-striped">
    <tbody>
    <tr class="text-bold">
        <td style="width: 10px;">{{__('label.id')}}</td>
        <td style="width: 10px;">{{__('label.file')}}</td>
        <td style="width: 10px;">{{__('label.file')}}</td>
        <td style="width: 10px;">{{__('label.total_rows')}}</td>
        <td style="width: 10px;">{{__('label.import_count')}}</td>
        <td style="width: 10px;">{{__('label.status')}}</td>
        <td style="width: 20px;">{{__('label.actions')}}</td>
    </tr>
    @foreach($imports as $import)
        <tr>
            <td>{{$import->id}}</td>
            <td>{{$import->file}}</td>
            <td>{{$import->total_rows}}</td>
            <td>{{$import->imported_count}}</td>
            <td>
                @if($import->status == '0')<span class="label label-primary">Standby</span>@endif
                @if($import->status == '1')<span class="label label-warning">In Progress</span>@endif
                @if($import->status == '2')<span class="label label-success">Completed</span>@endif
                @if($import->status == '3')<span class="label label-danger">Error</span>@endif
            </td>
            <td>
                <div class="btn-group">
                    <a href="{{$import->getFirstMediaUrl('imports')}}" class="btn btn-success">
                        <i class="fa fa-download"></i>
                    </a>
                    <a href="#" data-id="{{$import->id}}" title="{{trans('label.delete')}}"
                       class="btn btn-danger delete"><i class="fa fa-remove"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@section('scripts')
    <script>
        $(function () {
            // Open modal for deleting a record
            $('.wrapper').on('click', '.delete', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#deleteId').val(id);
                $('#deleteForm').attr('action', "{{route('admin.import.destroy')}}");
                $('#deleteModal').modal('show');
            });
        });
    </script>

@endsection