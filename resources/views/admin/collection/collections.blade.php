<table class="table table-responsive table-striped">
    <tbody>
    <tr style="background: #cccccc;color: #000;font-weight: bold;">
        <td style="width: 10px;">Id</td>
        <td style="width: 10px;">Category</td>
        <td style="width: 10px;">Title</td>
        <td style="width: 10px;">Description</td>
        <td style="width: 10px;">Time Period</td>
        <td style="width: 10px;">Image Count</td>
        <td style="width: 20px;">Action</td>
    </tr>
    @foreach($collections as $collection)
        <tr>
            <td>{{$collection->id}}</td>
            <td>{{$collection->category->name}}</td>
            <td>{{$collection->title}}</td>
            <td>{{$collection->description}}</td>
            <td>{{$collection->time_period}}</td>
            <td>{{$collection->getMedia($collection->slug)->count()}}</td>
            <td>
                <a class="btn btn-warning edit" data-id="{{$collection->id}}">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="#" data-id="{{$collection->id}}"
                   class="btn btn-danger delete"><i class="fa fa-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@include('admin.common.delete')
@section('scripts')
    <script>
        $(function () {

            // Open modal for editing a record
            $('.wrapper').on('click', '.edit', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let edit = $(this);

                $.ajax({
                    url: "collections/" + id + "/get",
                    beforeSend: function (xhr) {
                        $('#cover-image').attr('src', '');
                        edit.html('<i class="fa fa-refresh fa-spin"></i>');
                    }
                }).done(function (data) {
                    edit.html('<i class="fa fa-pencil"></i>');
                    $('#edit-id').val(data.collection.id);
                    $('#edit-title').val(data.collection.title);
                    $('#edit-description').val(data.collection.description);
                    $('#edit-category-id').val(data.collection.category_id);
                    $('#edit-time-period').val(data.collection.time_period);
                    $('#edit-image_path').val(data.collection.image_path);
                    $('#modal-edit-collection').modal('show');
                    $('#cover-image').attr('src', data.covers.large);
                });

            });

        });
    </script>

@endsection