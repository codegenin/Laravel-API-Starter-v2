@extends('adminlte::page')

@section('content')
    @include('admin.common.alerts')
    <div class="card card-widget card-primary">
        <div class="card-header">
            <h3 class="card-title pull-left">Collections</h3>
            <div class="card-tools pull-right">
                <button type="button" data-toggle="modal"
                        class="btn btn-success" data-target="#modal-new-collection"> NEW COLLECTION
                </button>
            </div>
        </div>
        <div class="card-body">
            @include('admin.collection.collections')
        </div>
    </div>

    <!-- Modals -->
    @include('admin.collection.modals')
@endsection

@section('js')
    <script>
        $(function () {

        });
    </script>
@endsection