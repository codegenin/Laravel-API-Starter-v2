@extends('adminlte::page')

@section('content_header')
    <h1>
        {{title_case($collection->title)}}
        <small>{{trans('label.images')}}</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin.category.collections', $collection->category_id)}}"
               class="btn btn-warning">
                {{trans('label.return_to_collections')}}
            </a>
        </li>
        <li>
            <button type="button" data-toggle="modal" title="Upload Image"
                    class="btn btn-success" data-target="#modal-new-collection-image">
                {{trans('label.upload_image')}}
            </button>
        </li>
    </ol>
@endsection

@section('content')
    @include('admin.common.alerts')

    <div class="row">
        @foreach($images as $image)
            <div class="col-sm-3">
                <div class="box @if($image->visible == 1) box-primary @else box-danger @endif">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{str_limit($image->title, 30)}}</h3>
                        <div class="box-tools pull-right">

                            <button type="button" data-toggle="modal" title="SHOW or HIDE"
                                    class="btn btn-box-tool public" data-id="{{$image->id}}">
                                <i class="fa fa-eye"></i>
                            </button>

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
                        <img src="{{$image->getUrl('medium')}}" alt="" height="300" width="300">
                        {{--<p>
                            {{$image->description}}
                        </p>--}}
                    </div>
                    <div class="box-footer">
                        <strong>Location:</strong> {{$image->location}}
                        <strong class="pull-right">Score: {{$image->score}}</strong>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

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
                        <h4 class="modal-title" id="collection-modal-title">{{trans('label.upload_image')}}</h4>
                    </div>
                    <div class="modal-body">

                        <!-- Title: Form Input -->
                        <div class="form-group">
                            <label for="name">{{__('label.title')}}:</label>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="english">
                        </span>
                                <input type="text" name="title" id="title" placeholder="Title in english"
                                       class="form-control" value="{{ old('title') }}">
                            </div>
                            <!-- Translation -->
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                                <input type="text" name="fr_title" id="fr_title" placeholder="Title in french"
                                       class="form-control" value="{{ old('title') }}">
                            </div>
                        </div>

                        <!-- Description: Form Input -->
                        <div class="form-group">
                            <label for="description">{{__('label.description')}}:</label>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="french">
                        </span>
                                <input type="text" name="description" id="description"
                                       placeholder="Description in english"
                                       class="form-control" value="{{ old('description') }}">
                            </div>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                                <input type="text" name="fr_description" id="fr_description"
                                       placeholder="Description in french"
                                       class="form-control" value="{{ old('description') }}">
                            </div>
                        </div>

                        <!-- Location: Form Input -->
                        <div class="form-group">
                            <label for="location">{{__('label.location')}}:</label>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="french">
                        </span>
                                <input type="text" name="location" id="location" placeholder="Location in english"
                                       class="form-control" value="{{ old('location') }}">
                            </div>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                                <input type="text" name="fr_location" id="fr_location"
                                       placeholder="Location in french"
                                       class="form-control" value="{{ old('fr_location') }}">
                            </div>
                        </div>

                        <!-- Medium: Form Input -->
                        <div class="form-group">
                            <label for="medium">{{__('label.medium')}}:</label>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="french">
                        </span>
                                <input type="text" name="medium" id="medium" placeholder="Location in english"
                                       class="form-control" value="{{ old('medium') }}">
                            </div>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                                <input type="text" name="fr_medium" id="fr_medium"
                                       placeholder="Location in french"
                                       class="form-control" value="{{ old('fr_medium') }}">
                            </div>
                        </div>

                        <!-- Time Period: Form Input -->
                        <div class="form-group">
                            <label for="en_time_period">{{__('label.time_period')}}:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <img src="{{asset('images/en.png')}}" alt="french">
                                </span>
                                <input type="text" name="en_time_period" id="en_time_period"
                                       placeholder="Time period in english"
                                       class="form-control" value="{{ old('en_time_period') }}">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <img src="{{asset('images/fr.png')}}" alt="french">
                                </span>
                                <input type="text" name="fr_time_period" id="fr_time_period"
                                       placeholder="Time Period in french"
                                       class="form-control" value="{{ old('fr_time_period') }}">
                            </div>
                        </div>

                        <!-- Artist -->
                        <div class="form-group">
                            <label for="artist">{{trans('label.artist')}}:</label>
                            <input type="text" name="artist" id="artist"
                                   placeholder="Artist name" class="form-control"
                                   value="{{ old('artist') }}">
                        </div>

                        <!-- Tags: Form Input -->
                        <div class="form-group">
                            <label>{{trans('label.tags')}}:</label>
                            <select class="form-control select2" multiple="multiple"
                                    name="tags[]" style="width: 100%;" id="tags">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->name}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Image URL: Form Input -->
                        <div class="form-group">
                            <label for="media_id">{{trans('label.image_file')}}:</label>
                            <div class="input-group">
                                <input type="file" name="file" class="form-control" aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">{{trans('label.browse')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left"
                                data-dismiss="modal">{{trans('label.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{trans('label.upload')}}</button>
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
                            <label for="edit-media-title">{{__('label.title')}}:</label>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="english">
                        </span>
                                <input type="text" name="title" id="edit-media-title" placeholder="Title in english"
                                       class="form-control" value="{{ old('title') }}">
                            </div>
                            <!-- Translation -->
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                                <input type="text" name="fr_title" id="edit-media-fr_title"
                                       placeholder="Title in french"
                                       class="form-control" value="{{ old('title') }}">
                            </div>
                        </div>

                        <!-- Description: Form Input -->
                        <div class="form-group">
                            <label for="media-description">{{__('label.description')}}:</label>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="french">
                        </span>
                                <input type="text" name="description" id="edit-media-description"
                                       placeholder="Description in english"
                                       class="form-control" value="{{ old('description') }}">
                            </div>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                                <input type="text" name="fr_description" id="edit-media-fr_description"
                                       placeholder="Description in french"
                                       class="form-control" value="{{ old('description') }}">
                            </div>
                        </div>

                        <!-- Location: Form Input -->
                        <div class="form-group">
                            <label for="edit-media-location">{{__('label.location')}}:</label>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="french">
                        </span>
                                <input type="text" name="location" id="edit-media-location"
                                       placeholder="Location in english"
                                       class="form-control" value="{{ old('location') }}">
                            </div>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                                <input type="text" name="fr_location" id="edit-media-fr-location"
                                       placeholder="Location in french"
                                       class="form-control" value="{{ old('fr_location') }}">
                            </div>
                        </div>

                        <!-- Medium: Form Input -->
                        <div class="form-group">
                            <label for="edit-media-medium">{{__('label.medium')}}:</label>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="french">
                        </span>
                                <input type="text" name="medium" id="edit-media-medium"
                                       placeholder="Location in english"
                                       class="form-control" value="{{ old('medium') }}">
                            </div>
                            <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                                <input type="text" name="fr_medium" id="edit-media-fr-medium"
                                       placeholder="Location in french"
                                       class="form-control" value="{{ old('fr_medium') }}">
                            </div>
                        </div>

                        <!-- Time Period: Form Input -->
                        <div class="form-group">
                            <label for="en_time_period">{{__('label.time_period')}}:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <img src="{{asset('images/en.png')}}" alt="french">
                                </span>
                                <input type="text" name="en_time_period" id="edit-en-time-period"
                                       placeholder="Time period in english"
                                       class="form-control" value="{{ old('en_time_period') }}">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <img src="{{asset('images/fr.png')}}" alt="french">
                                </span>
                                <input type="text" name="fr_time_period" id="edit-fr-time-period"
                                       placeholder="Time Period in french"
                                       class="form-control" value="{{ old('fr_time_period') }}">
                            </div>
                        </div>

                        <!-- Artist -->
                        <div class="form-group">
                            <label for="artist">{{trans('label.artist')}}:</label>
                            <input type="text" name="artist" id="edit-artist"
                                   placeholder="Artist name" class="form-control"
                                   value="{{ old('artist') }}">
                        </div>

                        <!-- Tags: Form Input -->
                        <div class="form-group">
                            <label>Tags:</label>
                            <select class="form-control select2" multiple="multiple"
                                    name="tags[]" style="width: 100%;" id="edit-tags">
                            </select>
                        </div>

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
    @include('admin.common.visible')

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

            // Open visible toogle popup
            $('.wrapper').on('click', '.public', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#publicId').val(id);
                $('#publicForm').attr('action', "{{route('admin.media.visible')}}");
                $('#publicModal').modal('show');
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
                    $('#edit-media-title').val(data.media.en_title);
                    $('#edit-media-fr_title').val(data.media.fr_title);
                    $('#edit-media-description').val(data.media.en_description);
                    $('#edit-media-fr_description').val(data.media.fr_description);
                    $('#edit-media-location').val(data.media.location);
                    $('#edit-media-fr-location').val(data.media.fr_location);
                    $('#edit-media-medium').val(data.media.medium);
                    $('#edit-media-fr-medium').val(data.media.fr_medium);
                    $('#edit-en-time-period').val(data.media.en_time_period);
                    $('#edit-fr-time-period').val(data.media.fr_time_period);
                    $('#edit-artist').val(data.media.artist);
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