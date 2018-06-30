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
                    class="btn btn-success" data-target="#modal-new-tag"> {{__('label.new_tag')}}
            </button>
        </li>
    </ol>
@endsection

@section('content')
    @include('admin.common.alerts')
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-title">{{trans('label.tags')}}</div>
            <div class="box-tools">

            </div>
        </div>
        <div class="box-body">
            @include('admin.tag.tags')
        </div>
    </div>

    <!-- Modals -->
    @include('admin.tag.modals')
@endsection