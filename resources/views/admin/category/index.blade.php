@extends('adminlte::page')

@section('content')
    @include('admin.common.alerts')
    <div class="card card-widget card-primary">
        <div class="card-header">
            <h3 class="card-title pull-left">{{__('category.label.categories')}}</h3>
            <div class="card-tools pull-right">
                <button type="button" data-toggle="modal"
                        class="btn btn-success" data-target="#modal-new-category"> {{__('category.label.new_category')}}
                </button>
            </div>
        </div>
        <div class="card-body">
            @include('admin.category.categories')
        </div>
    </div>

    <!-- Modals -->
    @include('admin.category.modals')
@endsection