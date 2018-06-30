<table class="table table-responsive table-striped">
    <tbody>
    <tr class="text-bold">
        <td style="width: 10px;">{{trans('label.id')}}</td>
        <td style="width: 10px;">{{trans('label.name')}}</td>
        <td style="width: 10px;">{{trans('label.order_column')}}</td>
        <td style="width: 10px;">{{trans('label.created_at')}}</td>
        <td style="width: 10px;">{{trans('label.actions')}}</td>
    </tr>
    @foreach($tags as $tag)
        <tr>
            <td>{{$tag->id}}</td>
            <td>{{$tag->name}}</td>
            <td>{{$tag->order_column}}</td>
            <td>{{$tag->created_at}}</td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-warning edit" data-id="{{$tag->id}}" title="{{trans('label.edit')}}">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" data-id="{{$tag->id}}" title="{{trans('label.delete')}}"
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
                $('#deleteForm').attr('action', "{{route('admin.tag.destroy')}}");
                $('#deleteModal').modal('show');
            });

            // Open modal for editing a record
            $('.wrapper').on('click', '.edit', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let edit = $(this);

                $.ajax({
                    url: "tags/" + id + "/get",
                    beforeSend: function (xhr) {
                        $('#cover-image').attr('src', '');
                        edit.html('<i class="fa fa-refresh fa-spin"></i>');
                    }
                }).done(function (data) {
                    edit.html('<i class="fa fa-pencil"></i>');
                    $('#edit-id').val(data.tag.id);
                    $('#edit-name').val(data.tag.en_name);
                    $('#edit-fr_name').val(data.tag.fr_name);
                    $('#modal-edit-tag').modal('show');
                });

            });

        });
    </script>

@endsection