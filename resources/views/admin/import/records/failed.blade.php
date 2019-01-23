<table class="table table-responsive table-striped">
    <tbody>
    <tr class="text-bold">
        <td style="width: 10px;">{{__('label.id')}}</td>
        <td style="width: 10px;">{{__('label.title')}}</td>
        <td style="width: 10px;">{{__('label.artist')}}</td>
        <td style="width: 10px;">{{__('label.collection')}}</td>
        <td style="width: 10px;">{{__('label.import_error')}}</td>
        <td style="width: 10px;">{{__('label.import_image')}}</td>
        <td style="width: 10px;">{{__('label.created_at')}}</td>
    </tr>
    @foreach($imports as $import)
        <tr>
            <td>{{$import->id}}</td>
            <td>{{$import->en_title}}</td>
            <td>{{$import->artist}}</td>
            <td>{{$import->en_collection}}</td>
            <td>{{$import->import_error}}</td>
            <td>{{$import->image_url}}</td>
            <td>
                {{$import->created_at}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@section('scripts')
    <script>
        $(function () {
            // Open modal for deleting a record
            $('.wrapper').on('click', '.delete', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#deleteId').val(id);
                $('#deleteForm').attr('action', "{{route('admin.import.destroy')}}");
                $('#deleteModal').modal('show');
            });
        });
    </script>

@endsection