@extends('adminlte::page')

@section('content')
    <div class="card card-widget card-primary">
        <div class="card-header">
            <h3 class="card-title pull-left">Categories</h3>
            <div class="card-tools pull-right">
                <button type="button"
                        class="btn btn-success"> NEW CATEGORY
                </button>
            </div>
        </div>
        <div class="card-body">
            @include('admin.category.common.categories')
        </div>
    </div>
@endsection