<!-- Category Modal -->
<div class="modal fade" id="modal-new-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="category-modal-title">Add New Category</h4>
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
                        <label for="media_id">Cover Image</label>
                        <div class="input-group">
                            <input type="file" name="file" class="form-control" aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2">Browse</span>
                        </div>
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

<!-- Edit Category Modal -->
<div class="modal fade" id="modal-edit-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.category.update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="category-modal-title">Update Category</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <!-- Name: Form Input -->
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="edit-name"
                               class="form-control" value="{{ old('name') }}">
                    </div>
                    <!-- Description: Form Input -->
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" name="description" id="edit-description"
                               class="form-control" value="{{ old('description') }}">
                    </div>

                    <!-- Parent Category: Form Input -->
                    <div class="form-group">
                        <label for="parent">Parent Category:</label>
                        <select name="parent_id" id="edit-parent-id" class="form-control">
                            <option value="0">-- This is a parent category --</option>
                            @foreach($categoriesDropDown as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Set as public? Form Input -->
                    <div class="form-group">
                        <label for="is_public">Set As Public?</label>
                        <select name="is_public" id="edit-is-public" class="form-control">
                            <option value="0">NO</option>
                            <option value="1">YES</option>
                        </select>
                    </div>

                    <!-- Image URL: Form Input -->
                    <div class="form-group">
                        <label for="media_id">Cover Image</label>
                        <div class="input-group">
                            <input type="file" name="file" class="form-control" aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2">Browse</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <img src="" id="cover-image" alt="">
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