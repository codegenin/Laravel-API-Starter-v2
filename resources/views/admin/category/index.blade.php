@extends('adminlte::page')

@section('content_header')
    <h1>
        &nbsp;
        {{--{{trans('label.categories')}}
        <small>Lists</small>--}}
    </h1>
    <ol class="breadcrumb">
        <li>
            <button type="button" data-toggle="modal"
                    class="btn btn-success" data-target="#modal-new-category"> {{__('label.new_category')}}
            </button>
        </li>
    </ol>
@endsection

@section('content')
    @include('admin.common.alerts')
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-title">{{trans('label.categories')}}</div>
            <div class="box-tools">
                {{$categories->links('vendor.pagination.small-default')}}
            </div>
        </div>
        <div class="box-body">
            @include('admin.category.categories')
        </div>
    </div>

    <!-- Modals -->
    @include('admin.category.modals')
@endsection