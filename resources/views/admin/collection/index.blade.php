@extends('adminlte::page')

@section('content_header')
    <h1>
         {{$category->name}}
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
    @include('admin.collection.modals')
    @include('admin.common.delete')

    <div class="box box-primary">
        <div class="box-header">
            <div class="box-title">{{trans('label.collections')}}</div>
            <div class="box-tools">
                {{$collections->links('vendor.pagination.small-default')}}
            </div>
        </div>
        <div class="box-body">
            @include('admin.collection.collections')
        </div>
    </div>


@endsection

