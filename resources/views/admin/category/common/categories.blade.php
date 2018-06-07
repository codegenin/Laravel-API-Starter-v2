<table class="table table-bordered">
    <tbody>
    <tr>
        <td style="width: 10px;">Name</td>
        <td style="width: 10px;">Slug</td>
        <td style="width: 20px;">Description</td>
        <td style="width: 5px;">isPublic</td>
        <td style="width: 20px;">Action</td>
    </tr>
    @foreach($categories as $category)
        <tr>
            <td>{{$category['name']}}</td>
            <td>{{$category['slug']}}</td>
            <td>{{$category['description']}}</td>
            <td>{{($category['is_public'] == 1) ? 'YES' : 'NO'}}</td>
            <td>
                <a class="btn btn-primary"><i class="fa fa-pencil"></i>
                </a>
                <a href="{{route('admin.category.move.up', $category['id'])}}" class="btn btn-primary"><i
                        class="fa fa-arrow-up"></i>
                </a>
                <a href="{{route('admin.category.move.down', $category['id'])}}" class="btn btn-primary"><i
                        class="fa fa-arrow-down"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>