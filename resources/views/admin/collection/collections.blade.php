<table class="table table-responsive table-striped">
    <tbody>
    <tr class="text-bold">
        <td style="width: 10px;">{{trans('label.id')}}</td>
        <td style="width: 10px;">{{trans('label.points')}}</td>
        <td style="width: 10px;">{{trans('label.cover')}}</td>
        {{--<td style="width: 10px;">{{trans('label.category')}}</td>--}}
        <td style="width: 10px;">{{trans('label.title')}}</td>
        <td style="width: 10px;">{{trans('label.description')}}</td>
        <td style="width: 10px;">{{trans('label.public')}}</td>
        <td style="width: 10px;">{{trans('label.images')}}</td>
        <td style="width: 20px;">{{trans('label.actions')}}</td>
    </tr>
    @foreach($collections as $collection)
        <tr>
            <td>{{$collection->id}}</td>
            <td>{{$collection->points}}</td>
            <td><img src="{{$collection->getFirstMediaUrl('collection', 'small')}}" alt=""></td>
            {{--<td>{{$collection->category->name}}</td>--}}
            <td>{{$collection->title}}</td>
            <td>{{str_limit($collection->description, 100)}}</td>
            <td>@if($collection->is_public) YES @else NO @endif</td>
            <td>{{$collection->getMedia($collection->slug)->count()}}</td>
            <td style="width: 100px;">
                <div class="btn-group">
                    <a class="btn btn-success" href="{{route('admin.collection.images', $collection->id)}}" title="IMAGES">
                        <i class="fa fa-picture-o"></i>
                    </a>
                    <a class="btn btn-warning edit" data-id="{{$collection->id}}" data-target="#modal-edit-collection" data-toggle="modal"  title="EDIT">
                        EDIT
                    </a>
                    <a href="#" data-id="{{$collection->id}}" class="btn btn-danger delete" data-target="#deleteModal" data-toggle="modal"
                        title="DELETE">
                        <i class="fa fa-remove"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div id="paginate" class="pull-right">
    {{$collections->links()}}
</div>

@section('scripts')
    <script>
        $(function () {

            // Open modal for deleting a record
            $('.delete').on('click', function (e) {
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
                    edit.html('EDIT');
                    $('#edit-id').val(data.collection.id);
                    $('#edit-title').val(data.collection.en_title);
                    $('#edit-fr_title').val(data.collection.fr_title);
                    $('#edit-description').val(data.collection.en_description);
                    $('#edit-fr_description').val(data.collection.fr_description);
                    $('#edit-category-id').val(data.collection.category_id);
                    $('#edit-points').val(data.collection.points);
                    $('#edit-artist').val(data.collection.artist);
                    $('#edit-time-period').val(data.collection.time_period);
                    $('#edit-fr-time-period').val(data.collection.fr_time_period);
                    $('#edit-is-public').val(data.collection.is_public);
                    $('#edit-image_path').val(data.collection.image_path);
                    $('#modal-edit-collection').modal('show');
                    $('#cover-image').attr('src', data.covers.large);
                });

            });

        });
    </script>

@endsection

