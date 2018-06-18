@extends('adminlte::page')

@section('content_header')
    <h1>
        {{title_case($collection->title)}}
        <small>Images</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <button type="button" data-toggle="modal" title="Upload Image"
                    class="btn btn-success" data-target="#modal-new-collection-image">
                <i class="fa fa-upload"></i> UPLOAD IMAGE
            </button>
        </li>
    </ol>
@endsection

@section('content')
    @include('admin.common.alerts')

    @foreach($images as $image)
        <div class="col-sm-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$image->title}}</h3>
                    <div class="box-tools pull-right">

                        <button type="button" data-toggle="modal" title="EDIT"
                                class="btn btn-box-tool edit" data-id="{{$image->id}}">
                            <i class="fa fa-pencil"></i>
                        </button>

                        <button type="button" data-toggle="modal" title="DELETE"
                                class="btn btn-box-tool delete" data-id="{{$image->id}}">
                            <i class="fa fa-remove"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body text-center">
                    <img src="{{$image->getUrl('medium')}}" alt="">
                    <p>
                        {{$image->description}}
                    </p>
                </div>
                <div class="box-footer">
                    <strong>Location:</strong> {{$image->location}}
                    <strong class="pull-right">Score: {{$image->score}}</strong>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Collection Upload Image Modal -->
    <div class="modal fade" id="modal-new-collection-image">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.collection.upload')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$collection->id}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="collection-modal-title">Upload Image</h4>
                    </div>
                    <div class="modal-body">

                        <!-- Title: Form Input -->
                        <div class="form-group">
                            <label for="title">Image Title:</label>
                            <input type="text" name="title" id="title"
                                   class="form-control" value="{{ old('title') }}">
                        </div>

                        <!-- Description: Form Input -->
                        <div class="form-group">
                            <label for="description">Image Description:</label>
                            <input type="text" name="description" id="description"
                                   class="form-control" value="{{ old('description') }}">
                        </div>

                        <!-- Time Period: Form Input -->
                        <div class="form-group">
                            <label for="location">Image Location:</label>
                            <input type="text" name="location" id="location"
                                   class="form-control" value="{{ old('location') }}">
                        </div>

                        <!-- Tags: Form Input -->
                        <div class="form-group">
                            <label>Tags:</label>
                            <select class="form-control select2" multiple="multiple"
                                    name="tags[]" style="width: 100%;" id="tags">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->name}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Image URL: Form Input -->
                        <div class="form-group">
                            <label for="media_id">Image File:</label>
                            <div class="input-group">
                                <input type="file" name="file" class="form-control" aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">Browse</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Collection Edit Image Modal -->
    <div class="modal fade" id="modal-edit-collection-image">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('admin.media.update')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" id="media-id">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="collection-modal-title">Edit Image</h4>
                    </div>
                    <div class="modal-body">

                        <!-- Title: Form Input -->
                        <div class="form-group">
                            <label for="title">Image Title:</label>
                            <input type="text" name="title" id="media-title"
                                   class="form-control" value="{{ old('title') }}">
                        </div>

                        <!-- Description: Form Input -->
                        <div class="form-group">
                            <label for="description">Image Description:</label>
                            <input type="text" name="description" id="media-description"
                                   class="form-control" value="{{ old('description') }}">
                        </div>

                        <!-- Time Period: Form Input -->
                        <div class="form-group">
                            <label for="location">Image Location:</label>
                            <input type="text" name="location" id="media-location"
                                   class="form-control" value="{{ old('location') }}">
                        </div>

                        <!-- Tags: Form Input -->
                        <div class="form-group">
                            <label>Tags:</label>
                            <select class="form-control select2" multiple="multiple"
                                    name="tags[]" style="width: 100%;" id="edit-tags">
                            </select>
                        </div>


                        {{--<!-- Image URL: Form Input -->
                        <div class="form-group">
                            <label for="media_id">Image File:</label>
                            <div class="input-group">
                                <input type="file" name="file" class="form-control" aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">Browse</span>
                            </div>
                        </div>--}}

                        <div class="form-group">
                            <img src="" id="cover-image" alt="">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    @include('admin.common.delete')

@endsection

@section('js')
    <script>
        $(function () {

            $('.select2').select2({tags: true});

            // Open modal for deleting a record
            $('.wrapper').on('click', '.delete', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#deleteId').val(id);
                $('#deleteForm').attr('action', "{{route('admin.media.destroy')}}");
                $('#deleteModal').modal('show');
            });

            // Open modal for editing a record
            $('.wrapper').on('click', '.edit', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let edit = $(this);
                $('#edit-tags').val('');
                $.ajax({
                    url: "/admin/media/" + id + "/get",
                    beforeSend: function (xhr) {
                        $('#cover-image').attr('src', '');
                        $('#edit-tags').empty();
                        edit.html('<i class="fa fa-refresh fa-spin"></i>');
                    }
                }).done(function (data) {
                    edit.html('<i class="fa fa-pencil"></i>');
                    $('#media-id').val(data.media.id);
                    $('#media-title').val(data.media.title);
                    $('#media-description').val(data.media.description);
                    $('#media-location').val(data.media.location);
                    $('#modal-edit-collection-image').modal('show');
                    $('#cover-image').attr('src', data.media.images.large);
                    $.each(data.tags, function (i, item) {
                        $('#edit-tags').append($("<option />").val(item.text).text(item.text).attr('selected', item.selected));
                    });
                });
            });

        });
    </script>
@endsection