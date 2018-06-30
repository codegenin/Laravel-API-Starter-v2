<table class="table table-responsive table-striped">
    <tbody>
    <tr class="text-bold">
        <td style="width: 10px;">{{__('label.id')}}</td>
        <td style="width: 10px;">{{__('label.cover')}}</td>
        <td style="width: 10px;">{{__('label.name')}}</td>
        {{--<td style="width: 10px;">{{__('label.slug')}}</td>--}}
        <td style="width: 20px;">{{__('label.description')}}</td>
        <td style="width: 10px;">{{__('label.collections')}}</td>
        <td style="width: 5px;">{{__('label.public')}}</td>
        <td style="width: 5px;">{{__('label.images')}}</td>
        <td style="width: 5px;">{{trans('label.seq')}}</td>
        <td style="width: 20px;">{{__('label.actions')}}</td>
    </tr>
    @foreach($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td><img src="{{$category->getFirstMediaUrl('category', 'small')}}" alt=""></td>
            <td>{{$category->name}}</td>
            {{--<td>{{$category->slug}}</td>--}}
            <td>{{$category->description}}</td>
            <td>{{$category->collections->count()}}</td>
            <td>{{($category->is_public == 1) ? 'YES' : 'NO'}}</td>
            <td>{{$category->images->count()}}</td>
            <td>{{$category->seq}}</td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-success" href="{{route('admin.category.collections', $category->id)}}" title="{{trans('label.collections')}}">
                        <i class="fa fa-folder-o"></i>
                    </a>
                    <a class="btn btn-success" href="{{route('admin.category.images', $category->id)}}" title="{{trans('label.images')}}">
                        <i class="fa fa-picture-o"></i>
                    </a>
                    <a class="btn btn-warning edit" data-id="{{$category->id}}" title="{{trans('label.edit')}}">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" data-id="{{$category->id}}" title="{{trans('label.delete')}}"
                       class="btn btn-danger delete"><i class="fa fa-remove"></i></a>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            {{trans('label.move')}}
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('admin.category.move.to.start', $category->id)}}">
                                    {{trans('label.move_to_start')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.category.move.up', $category->id)}}">
                                    {{trans('label.move_up')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.category.move.down', $category->id)}}">
                                    {{trans('label.move_down')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.category.move.to.end', $category->id)}}">
                                    {{trans('label.move_to_end')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        @if(!empty($category->child))
            <tr>
                <td colspan="6">
                    <h5 style="font-weight: bold;">Sub {{str_plural('Category', count($category['child']))}}
                        of {{$category['name']}}</h5>
                    <table class="table">
                        <tr style="background: #cccccc;color: #000;font-weight: bold;">
                            <td style="width: 10px;">Order</td>
                            <td style="width: 10px;">Name</td>
                            <td style="width: 10px;">Slug</td>
                            <td style="width: 20px;">Description</td>
                            <td style="width: 5px;">isPublic</td>
                            <td style="width: 20px;">Action</td>
                        </tr>
                        @foreach($category->child as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->description}}</td>
                                <td>{{($category->is_public == 1) ? 'YES' : 'NO'}}</td>
                                <td>{{$category->getMedia($category->slug)->count()}}</td>
                                <td>
                                    <a class="btn btn-warning edit" data-id="{{$category->id}}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{route('admin.category.move.up', $category->id)}}"
                                       class="btn btn-primary"><i
                                            class="fa fa-arrow-up" title="MOVE UP"></i>
                                    </a>
                                    <a href="{{route('admin.category.move.down', $category->id)}}"
                                       class="btn btn-primary"><i
                                            class="fa fa-arrow-down" title="MOVE DOWN"></i>
                                    </a>
                                    <a href="#" data-id="{{$category->id}}"
                                       class="btn btn-danger delete"><i class="fa fa-remove"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
        @endif
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
                $('#deleteForm').attr('action', "{{route('admin.category.destroy')}}");
                $('#deleteModal').modal('show');
            });

            // Open modal for editing a record
            $('.wrapper').on('click', '.edit', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let edit = $(this);

                $.ajax({
                    url: "categories/" + id + "/get",
                    beforeSend: function (xhr) {
                        $('#cover-image').attr('src', '');
                        edit.html('<i class="fa fa-refresh fa-spin"></i>');
                    }
                }).done(function (data) {
                    edit.html('<i class="fa fa-pencil"></i>');
                    $('#edit-id').val(data.category.id);
                    $('#edit-name').val(data.category.en_name);
                    $('#edit-fr_name').val(data.category.fr_name);
                    $('#edit-description').val(data.category.en_description);
                    $('#edit-fr_description').val(data.category.fr_description);
                    $('#edit-parent-id').val(data.category.parent_id);
                    $('#edit-is-public').val(data.category.is_public);
                    $('#edit-image_path').val(data.category.image_path);
                    $('#modal-edit-category').modal('show');
                    $('#cover-image').attr('src', data.category.covers.large);
                });

                //$('#deleteId').val(id);
                //$('#deleteForm').attr('action', "{{route('admin.category.destroy')}}");
                //$('#deleteModal').modal('show');
            });

        });
    </script>

@endsection