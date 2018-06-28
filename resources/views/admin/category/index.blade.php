@extends('adminlte::page')

@section('content_header')
    <h1>
        {{trans('label.categories')}}
        <small>Lists</small>
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
    <div class="card card-widget card-primary">
        <div class="card-body">
            @include('admin.category.categories')
        </div>
    </div>

    <!-- Modals -->
    @include('admin.category.modals')
@endsection