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
                <i class="fa fa-upload"></i>
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
                        <button type="button" data-toggle="modal"
                                class="btn btn-box-tool" data-target="#modal-new-collection-image">
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
                            <label for="tags">Tags:</label>
                            <input type="text" name="tags" id="tags"
                                   class="form-control" value="{{ old('tags') }}">
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

@endsection