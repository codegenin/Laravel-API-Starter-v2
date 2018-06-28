<table class="table table-responsive table-striped">
    <tbody>
    <tr style="background: #cccccc;color: #000;font-weight: bold;">
        <td style="width: 10px;">{{trans('label.id')}}</td>
        <td style="width: 10px;">{{trans('label.cover')}}</td>
        {{--<td style="width: 10px;">{{trans('label.category')}}</td>--}}
        <td style="width: 10px;">{{trans('label.title')}}</td>
        <td style="width: 10px;">{{trans('label.description')}}</td>
        <td style="width: 10px;">{{trans('label.time_period')}}</td>
        <td style="width: 10px;">{{trans('label.images')}}</td>
        <td style="width: 20px;">{{trans('label.actions')}}</td>
    </tr>
    @foreach($collections as $collection)
        <tr>
            <td>{{$collection->id}}</td>
            <td><img src="{{$collection->getFirstMediaUrl('collection', 'small')}}" alt=""></td>
            {{--<td>{{$collection->category->name}}</td>--}}
            <td>{{$collection->title}}</td>
            <td>{{$collection->description}}</td>
            <td>{{$collection->time_period}}</td>
            <td>{{$collection->getMedia($collection->slug)->count()}}</td>
            <td style="width: 100px;">
                <a class="btn btn-success" href="{{route('admin.collection.images', $collection->id)}}" title="IMAGES">
                    <i class="fa fa-picture-o"></i>
                </a>
                <a class="btn btn-warning edit" data-id="{{$collection->id}}" title="EDIT">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="#" data-id="{{$collection->id}}"
                   class="btn btn-danger delete" title="DELETE"><i class="fa fa-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div id="paginate" class="pull-right">
    {{$collections->links()}}
</div>
@include('admin.common.delete')
@section('scripts')
    <script>
        $(function () {

            // Open modal for deleting a record
            $('.wrapper').on('click', '.delete', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#deleteId').val(id);
                $('#deleteForm').attr('action', "{{route('admin.collection.destroy')}}");
                $('#deleteModal').modal('show');
            });

            // Open modal for editing a record
            $('.wrapper').on('click', '.edit', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let edit = $(this);

                $.ajax({
                    url: "/admin/collections/" + id + "/get",
                    beforeSend: function (xhr) {
                        $('#cover-image').attr('src', '');
                        edit.html('<i class="fa fa-refresh fa-spin"></i>');
                    }
                }).done(function (data) {
                    edit.html('<i class="fa fa-pencil"></i>');
                    $('#edit-id').val(data.collection.id);
                    $('#edit-title').val(data.collection.en_title);
                    $('#edit-fr_title').val(data.collection.fr_title);
                    $('#edit-description').val(data.collection.en_description);
                    $('#edit-fr_description').val(data.collection.fr_description);
                    $('#edit-category-id').val(data.collection.category_id);
                    $('#edit-points').val(data.collection.points);
                    $('#edit-time-period').val(data.collection.time_period);
                    $('#edit-image_path').val(data.collection.image_path);
                    $('#modal-edit-collection').modal('show');
                    $('#cover-image').attr('src', data.covers.large);
                });

            });

        });
    </script>

@endsection