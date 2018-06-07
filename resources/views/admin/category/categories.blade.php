<table class="table table-responsive table-striped">
    <tbody>
    <tr style="background: #cccccc;color: #000;font-weight: bold;">
        <td style="width: 10px;">Order</td>
        <td style="width: 10px;">Name</td>
        <td style="width: 10px;">Slug</td>
        <td style="width: 20px;">Description</td>
        <td style="width: 5px;">isPublic</td>
        <td style="width: 20px;">Action</td>
    </tr>
    @foreach($categories as $category)
        <tr>
            <td>{{$category['seq']}}</td>
            <td>{{$category['name']}}</td>
            <td>{{$category['slug']}}</td>
            <td>{{$category['description']}}</td>
            <td>{{($category['is_public'] == 1) ? 'YES' : 'NO'}}</td>
            <td>
                <a class="btn btn-warning edit" data-id="{{$category['id']}}">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="{{route('admin.category.move.up', $category['id'])}}"
                   class="btn btn-primary"><i
                        class="fa fa-arrow-up" title="MOVE UP"></i>
                </a>
                <a href="{{route('admin.category.move.down', $category['id'])}}"
                   class="btn btn-primary"><i
                        class="fa fa-arrow-down" title="MOVE DOWN"></i>
                </a>
                <a href="#" data-id="{{$category['id']}}"
                   class="btn btn-danger delete"><i class="fa fa-remove"></i></a>
            </td>
        </tr>
        @if(!empty($category['child']))
            <tr>
                <td colspan="6">
                    <h5 style="font-weight: bold;">Sub {{str_plural('Category', count($category['child']))}}
                        of {{$category['name']}}</h5>
                    <table class="table">
                        <tr style="background: #cccccc;color: #000;font-weight: bold;">
                            <td style="width: 10px;">Order</td>
                            <td style="width: 10px;">Name</td>
                            <td style="width: 10px;">Slug</td>
                            <td style="width: 20px;">Description</td>
                            <td style="width: 5px;">isPublic</td>
                            <td style="width: 20px;">Action</td>
                        </tr>
                        @foreach($category['child'] as $category)
                            <tr>
                                <td>{{$category['seq']}}</td>
                                <td>{{$category['name']}}</td>
                                <td>{{$category['slug']}}</td>
                                <td>{{$category['description']}}</td>
                                <td>{{($category['is_public'] == 1) ? 'YES' : 'NO'}}</td>
                                <td>
                                    <a class="btn btn-warning edit" data-id="{{$category['id']}}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="{{route('admin.category.move.up', $category['id'])}}"
                                       class="btn btn-primary"><i
                                            class="fa fa-arrow-up" title="MOVE UP"></i>
                                    </a>
                                    <a href="{{route('admin.category.move.down', $category['id'])}}"
                                       class="btn btn-primary"><i
                                            class="fa fa-arrow-down" title="MOVE DOWN"></i>
                                    </a>
                                    <a href="#" data-id="{{$category['id']}}"
                                       class="btn btn-danger delete"><i class="fa fa-remove"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
        @endif
    @endforeach
    </tbody>
</table>
@include('admin.common.delete')
@section('scripts')
    <script>
        $(function () {
            // Open modal for deleting a record
            $('.wrapper').on('click', '.delete', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#deleteId').val(id);
                $('#deleteForm').attr('action', "{{route('admin.category.destroy')}}");
                $('#deleteModal').modal('show');
            });

            // Open modal for editing a record
            $('.wrapper').on('click', '.edit', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let edit = $(this);

                $.ajax({
                    url: "categories/"+id+"/get",
                    beforeSend: function (xhr) {
                        edit.html('<i class="fa fa-refresh fa-spin"></i>');
                    }
                }).done(function (data) {
                    edit.html('<i class="fa fa-pencil"></i>');
                    $('#edit-id').val(data.category.id);
                    $('#edit-name').val(data.category.name);
                    $('#edit-description').val(data.category.description);
                    $('#edit-parent-id').val(data.category.parent_id);
                    $('#edit-is-public').val(data.category.is_public);
                    $('#edit-image_path').val(data.category.image_path);
                    $('#modal-edit-category').modal('show');
                });

                //$('#deleteId').val(id);
                //$('#deleteForm').attr('action', "{{route('admin.category.destroy')}}");
                //$('#deleteModal').modal('show');
            });

        });
    </script>

@endsection