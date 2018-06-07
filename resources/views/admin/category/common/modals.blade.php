<!-- New Category Model -->
<div class="modal fade" id="modal-new-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.category.store')}}" method="post">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Category</h4>
                </div>
                <div class="modal-body">
                    <!-- Name: Form Input -->
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name"
                               class="form-control" value="{{ old('name') }}">
                    </div>
                    <!-- Description: Form Input -->
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" name="description" id="description"
                               class="form-control" value="{{ old('description') }}">
                    </div>

                    <!-- Parent Category: Form Input -->
                    <div class="form-group">
                        <label for="parent">Parent Category:</label>
                        <select name="parent_id" id="parent-id" class="form-control">
                            <option value="0">-- This is a parent category --</option>
                            @foreach($categoriesDropDown as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Set as public? Form Input -->
                    <div class="form-group">
                        <label for="is_public">Set As Public?</label>
                        <select name="is_public" id="is-public" class="form-control">
                            <option value="0">NO</option>
                            <option value="1">YES</option>
                        </select>
                    </div>

                    <!-- Image URL: Form Input -->
                    <div class="form-group">
                        <label for="image_path">Image URL:</label>
                        <input type="text" name="image_path" id="image_path" class="form-control"
                               value="{{ old('image_path') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->