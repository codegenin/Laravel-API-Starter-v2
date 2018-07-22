@extends('adminlte::page')

@section('content_header')
    <h1>
        {{trans('label.users')}}
        <small>Lists</small>
    </h1>
    <ol class="breadcrumb">
        {{--<li>
            <button type="button" data-toggle="modal"
                    class="btn btn-success" data-target="#modal-new-user"> {{__('label.new_user')}}
            </button>
        </li>--}}
    </ol>
@endsection

@section('content')
    @include('admin.common.alerts')
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-title">{{trans('label.users')}}</div>
            <div class="box-tools">
                {{$users->links('vendor.pagination.small-default')}}
            </div>
        </div>
        <div class="box-body">
            @include('admin.user.users')
        </div>
    </div>

    <!-- Modals -->
    @include('admin.user.modals')
@endsection