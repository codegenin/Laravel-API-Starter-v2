<table class="table table-responsive table-striped">
    <tbody>
    <tr class="text-bold">
        <td style="width: 10px;">{{trans('label.id')}}</td>
        <td style="width: 10px;">{{trans('label.name')}}</td>
        <td style="width: 10px;">{{trans('label.email')}}</td>
        <td style="width: 10px;">{{trans('label.points')}}</td>
        <td style="width: 10px;">{{trans('label.provider')}}</td>
        <td style="width: 10px;">{{trans('label.verified')}}</td>
        <td style="width: 10px;">{{trans('label.actions')}}</td>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->points}}</td>
            <td>{{$user->provider}}</td>
            <td>{{($user->verified == 1) ? 'YES' : 'NO'}}</td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-warning edit" data-id="{{$user->id}}" title="{{trans('label.edit')}}">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" data-id="{{$user->id}}" title="{{trans('label.delete')}}"
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
                $('#deleteForm').attr('action', "{{route('admin.user.destroy')}}");
                $('#deleteModal').modal('show');
            });

            // Open modal for editing a record
            $('.wrapper').on('click', '.edit', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let edit = $(this);

                $.ajax({
                    url: "users/" + id + "/get",
                    beforeSend: function (xhr) {
                        $('#cover-image').attr('src', '');
                        edit.html('<i class="fa fa-refresh fa-spin"></i>');
                    }
                }).done(function (data) {
                    edit.html('<i class="fa fa-pencil"></i>');
                    $('#edit-id').val(data.user.id);
                    $('#edit-name').val(data.user.name);
                    $('#edit-email').val(data.user.email);
                    $('#edit-verified').val(data.user.verified);
                    $('#edit-points').val(data.user.points);
                    $('#modal-edit-user').modal('show');
                });

            });

        });
    </script>

@endsection