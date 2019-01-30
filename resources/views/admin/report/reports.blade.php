<table class="table table-responsive table-striped">
    <tbody>
    <tr class="text-bold">
        <td style="width: 10px;">{{trans('label.type')}}</td>
        <td style="width: 10px;">{{trans('label.image')}}</td>
        <td style="width: 10px;">{{trans('label.reported_by')}}</td>
        <td style="width: 10px;">{{trans('label.created_at')}}</td>
        <td style="width: 10px;">{{trans('label.actions')}}</td>
    </tr>
    @if($reports)
        @foreach($reports as $report)
            <tr>
                <td>{{$report->reportable_type}}</td>
                <td>
                    <a href="{{$report->reportable->getUrl('small')}}" target="_blank">
                        <img src="{{$report->reportable->getUrl('small')}}" alt="" width="100" height="100">
                    </a>
                </td>
                <td>{{!empty($report->user) ? $report->user->email : ''}}</td>
                <td>{{$report->created_at}}</td>
                <td>
                    <div class="btn-group">
                        {{--<a class="btn btn-warning edit" data-id="{{$report->id}}" title="{{trans('label.edit')}}">
                            <i class="fa fa-pencil"></i>
                        </a>--}}
                        <a href="#" data-id="{{$report->reportable_id}}" title="{{trans('label.delete')}}"
                           class="btn btn-danger delete"><i class="fa fa-remove"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
@include('admin.common.delete')
@section('scripts')
    <script>
        $(function () {
            // Open modal for deleting a record
            $('.wrapper').on('click', '.delete', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#deleteId').val(id);
                $('#deleteForm').attr('action', "{{route('admin.report.destroy')}}");
                $('#deleteModal').modal('show');
            });

            // Open modal for editing a record
            $('.wrapper').on('click', '.edit', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let edit = $(this);

                $.ajax({
                    url: "reports/" + id + "/get",
                    beforeSend: function (xhr) {
                        $('#cover-image').attr('src', '');
                        edit.html('<i class="fa fa-refresh fa-spin"></i>');
                    }
                }).done(function (data) {
                    edit.html('<i class="fa fa-pencil"></i>');
                    $('#edit-id').val(data.report.id);
                    $('#edit-name').val(data.report.en_name);
                    $('#edit-fr_name').val(data.report.fr_name);
                    $('#modal-edit-report').modal('show');
                });

            });

        });
    </script>

@endsection