@extends('adminlte::page')

@section('content_header')
    <h1>
        Failed Import
        <small>Records</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.import.index') }}" class="btn btn-warning"> Back To Imports</a>
        </li>
    </ol>
@endsection

@section('content')
    @include('admin.common.alerts')
    <div class="box box-primary">
        <div class="box-header">
            <div class="box-title">Imports</div>
            <div class="box-tools">
                {{$imports->links('vendor.pagination.small-default')}}
            </div>
        </div>
        <div class="box-body">
            @include('admin.import.records.failed')
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