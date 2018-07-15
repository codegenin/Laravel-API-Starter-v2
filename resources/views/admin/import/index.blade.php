@extends('adminlte::page')

@section('content_header')
    <h1>
        Import Media File
        <small>Data Import</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <button type="button" data-toggle="modal" title="Upload Image"
                    class="btn btn-success" data-target="#modal-file-import">
                {{trans('label.import_file')}}
            </button>
        </li>
    </ol>
@endsection

@section('content')
    @include('admin.common.alerts')
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-title">{{trans('label.imported')}}</div>
            <div class="box-tools">
                {{$imports->links('vendor.pagination.small-default')}}
            </div>
        </div>
        <div class="box-body">
            @include('admin.import.imports')
        </div>
    </div>

    @include('admin.common.delete')
    @include('admin.import.modals')
@endsection

@section('js')
    <script>
        $(function () {

        });
    </script>
@endsection