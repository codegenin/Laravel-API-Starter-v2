@extends('adminlte::page')

@section('content')
    @include('admin.common.alerts')
    <div class="card card-widget card-primary">
        <div class="card-header">
            <h3 class="card-title pull-left">Images for {{title_case($collection->title)}}</h3>
        </div>
        <div class="card-body">

        </div>
    </div>

@endsection