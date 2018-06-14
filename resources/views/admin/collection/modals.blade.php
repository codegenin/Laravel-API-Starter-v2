<!-- Category Modal -->
<div class="modal fade" id="modal-new-collection">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.collection.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="collection-modal-title">Add New Category</h4>
                </div>
                <div class="modal-body">

                    <!-- Category: Form Input -->
                    <div class="form-group">
                        <label for="parent">Category:</label>
                        <select name="category_id" id="category-id" class="form-control">
                            @foreach($categories as $collection)
                                <option value="{{$collection->id}}">{{$collection->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Title: Form Input -->
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title"
                               class="form-control" value="{{ old('title') }}">
                    </div>

                    <!-- Description: Form Input -->
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" name="description" id="description"
                               class="form-control" value="{{ old('description') }}">
                    </div>

                    <!-- Time Period: Form Input -->
                    <div class="form-group">
                        <label for="time-period">Time Period:</label>
                        <input type="text" name="time_period" id="time-period"
                               class="form-control" value="{{ old('time-period') }}">
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

<!-- Edit Collection Modal -->
<div class="modal fade" id="modal-edit-collection">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.collection.update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="collection-modal-title">Update Category</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">

                    <!-- Category: Form Input -->
                    <div class="form-group">
                        <label for="parent">Category:</label>
                        <select name="category_id" id="edit-category-id" class="form-control">
                            @foreach($categories as $collection)
                                <option value="{{$collection->id}}">{{$collection->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Title: Form Input -->
                    <div class="form-group">
                        <label for="edit-title">Title:</label>
                        <input type="text" name="title" id="edit-title"
                               class="form-control" value="{{ old('title') }}">
                    </div>

                    <!-- Description: Form Input -->
                    <div class="form-group">
                        <label for="edit-description">Description:</label>
                        <input type="text" name="description" id="edit-description"
                               class="form-control" value="{{ old('description') }}">
                    </div>

                    <!-- Time Period: Form Input -->
                    <div class="form-group">
                        <label for="edit-time-period">Time Period:</label>
                        <input type="text" name="time_period" id="edit-time-period"
                               class="form-control" value="{{ old('time-period') }}">
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