@extends('adminlte::page')

@section('content_header')
    <h1>
         {{$category->name}} Category
        <small>Collections</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin.category.index')}}"
               class="btn btn-warning">
                {{trans('label.return_to_categories')}}
            </a>
        </li>
        <li>
            <button type="button" data-toggle="modal" title="Upload Image"
                    class="btn btn-success" data-target="#modal-new-collection">
                {{trans('label.new_collection')}}
            </button>
        </li>
    </ol>
@endsection

@section('content')
    @include('admin.common.alerts')
    <div class="card card-widget card-primary">
        <div class="card-body">
            @include('admin.collection.collections')
        </div>
    </div>

    <!-- Modals -->
    @include('admin.collection.modals')
@endsection

@section('js')
    <script>
        $(function () {

        });
    </script>
@endsection