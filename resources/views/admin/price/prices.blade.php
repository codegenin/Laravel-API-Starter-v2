<table class="table table-responsive table-striped">
    <tbody>
    <tr class="text-bold">
        <td style="width: 10px;">{{trans('label.id')}}</td>
        <td style="width: 10px;">{{trans('label.points')}}</td>
        <td style="width: 10px;">{{trans('label.price')}}</td>
        <td style="width: 10px;">{{trans('label.google_id')}}</td>
        <td style="width: 10px;">{{trans('label.created_at')}}</td>
        <td style="width: 10px;">{{trans('label.actions')}}</td>
    </tr>
    @foreach($prices as $price)
        <tr>
            <td>{{$price->id}}</td>
            <td>{{$price->points}}</td>
            <td>{{$price->price}}</td>
            <td>{{$price->google_id}}</td>
            <td>{{$price->created_at}}</td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-warning edit" data-id="{{$price->id}}" title="{{trans('label.edit')}}">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" data-id="{{$price->id}}" title="{{trans('label.delete')}}"
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
                $('#deleteForm').attr('action', "{{route('admin.price.destroy')}}");
                $('#deleteModal').modal('show');
            });

            // Open modal for editing a record
            $('.wrapper').on('click', '.edit', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let edit = $(this);

                $.ajax({
                    url: "prices/" + id + "/get",
                    beforeSend: function (xhr) {
                        $('#cover-image').attr('src', '');
                        edit.html('<i class="fa fa-refresh fa-spin"></i>');
                    }
                }).done(function (data) {
                    edit.html('<i class="fa fa-pencil"></i>');
                    $('#edit-id').val(data.price.id);
                    $('#edit-points').val(data.price.points);
                    $('#edit-price').val(data.price.price);
                    $('#edit-google-id').val(data.price.google_id);
                    $('#modal-edit-price').modal('show');
                });

            });

        });
    </script>

@endsection