<table class="table table-responsive table-striped">
    <tbody>
    <tr class="text-bold">
        <td style="width: 10px;">{{trans('label.id')}}</td>
        <td style="width: 10px;">{{trans('label.name')}}</td>
        <td style="width: 10px;">{{trans('label.value')}}</td>
        <td style="width: 10px;">{{trans('label.created_at')}}</td>
        <td style="width: 10px;">{{trans('label.actions')}}</td>
    </tr>
    @foreach($settings as $setting)
        <tr>
            <td>{{$setting->id}}</td>
            <td>{{$setting->setting_name}}</td>
            <td>{{$setting->setting_value}}</td>
            <td>{{$setting->created_at}}</td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-warning edit" data-id="{{$setting->id}}" title="{{trans('label.edit')}}">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" data-id="{{$setting->id}}" title="{{trans('label.delete')}}"
                       class="btn btn-danger delete"><i class="fa fa-remove"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
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
                $('#deleteForm').attr('action', "{{route('admin.setting.destroy')}}");
                $('#deleteModal').modal('show');
            });

            // Open modal for editing a record
            $('.wrapper').on('click', '.edit', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let edit = $(this);

                $.ajax({
                    url: "settings/" + id + "/get",
                    beforeSend: function (xhr) {
                        $('#cover-image').attr('src', '');
                        edit.html('<i class="fa fa-refresh fa-spin"></i>');
                    }
                }).done(function (data) {
                    edit.html('<i class="fa fa-pencil"></i>');
                    $('#edit-id').val(data.setting.id);
                    $('#edit-setting-name').val(data.setting.setting_name);
                    $('#edit-setting-value').val(data.setting.setting_value);
                    $('#modal-edit-setting').modal('show');
                });

            });

        });
    </script>

@endsection