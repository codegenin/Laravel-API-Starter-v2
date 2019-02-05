@extends('adminlte::page')

@section('content_header')
    <h1>
        &nbsp;
        {{--{{trans('label.categories')}}
        <small>Lists</small>--}}
    </h1>
    {{--<ol class="breadcrumb">
        <li>
            <button type="button" data-toggle="modal"
                    class="btn btn-success" data-target="#modal-new-report"> {{__('label.new_report')}}
            </button>
        </li>
    </ol>--}}
@endsection

@section('content')
    @include('admin.common.alerts')
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-title">{{trans('label.reports')}}</div>
            <div class="box-tools">
                <div class="box-tools">
                    {{$reports->links('vendor.pagination.small-default')}}
                </div>
            </div>
        </div>
        <div class="box-body">
            @include('admin.report.reports')
        </div>
    </div>

    <!-- Modals -->
    @include('admin.report.modals')
@endsection