<!-- Category Modal -->
<div class="modal fade" id="modal-new-tag">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.price.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="tag-modal-title">{{__('label.new_price')}}</h4>
                </div>
                <div class="modal-body">

                    <!-- Points: Form Input -->
                    <div class="form-group">
                        <label for="points">Points:</label>
                        <input type="number" name="points" id="points" placeholder="Points:" class="form-control" value="{{ old('points') }}">
                    </div>

                    <!-- Price: Form Input -->
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" name="price" id="price" placeholder="Price:" class="form-control" value="{{ old('price') }}">
                    </div>

                    <!-- Google Id: Form Input -->
                    <div class="form-group">
                        <label for="google-id">Google Id:</label>
                        <input type="text" name="google_id" id="google-id"
                               placeholder="Google Id:" class="form-control" value="{{ old('google_id') }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left"
                            data-dismiss="modal">{{__('label.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('label.save_changes')}}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Edit Category Modal -->
<div class="modal fade" id="modal-edit-price">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.price.update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="price-modal-title">{{__('label.update_price')}}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <!-- Points: Form Input -->
                    <div class="form-group">
                        <label for="points">Points:</label>
                        <input type="text" name="points" id="edit-points" placeholder="Points:" class="form-control" value="{{ old('points') }}">
                    </div>

                    <!-- Price: Form Input -->
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" name="price" id="edit-price" placeholder="Price:"
                               class="form-control" value="{{ old('price') }}">
                    </div>

                    <!-- Google Id: Form Input -->
                    <div class="form-group">
                        <label for="edit-google-id">Google Id:</label>
                        <input type="text" name="google_id" id="edit-google-id"
                               placeholder="Google Id:" class="form-control" value="{{ old('google_id') }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left"
                            data-dismiss="modal">{{__('label.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('label.save_changes')}}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->