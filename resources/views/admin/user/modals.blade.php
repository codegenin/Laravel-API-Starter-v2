<!-- Category Modal -->
<div class="modal fade" id="modal-new-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="user-modal-title">{{__('label.new_user')}}</h4>
                </div>
                <div class="modal-body">
                   <!-- Name: Form Input -->
                   <div class="form-group">
                       <label for="name">Name:</label>
                       <input type="text" name="name" id="name" placeholder="Name:" class="form-control" value="{{ old('name') }}">
                   </div>

                    <!-- Email: Form Input -->
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email"
                               id="email" placeholder="Email:" class="form-control" value="{{ old('email') }}" disabled="disabled">
                    </div>

                    <!-- Points: Form Input -->
                    <div class="form-group">
                        <label for="points">Points:</label>
                        <input type="text" name="points" id="points" placeholder="Points:" class="form-control" value="{{ old('points') }}">
                    </div>

                    <!-- Verified: Form Input -->
                    <div class="form-group">
                        <label for="verified">Verified:</label>
                        <input type="text" name="verified" id="verified" placeholder="Verified:" class="form-control" value="{{ old('verified') }}">
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
<div class="modal fade" id="modal-edit-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.user.update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="user-modal-title">{{__('label.update_user')}}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <!-- Name: Form Input -->
                    <div class="form-group">
                        <label for="name">{{__('label.name')}}:</label>
                        <input type="text" name="name" id="edit-name"
                               class="form-control" value="{{ old('name') }}">
                    </div>

                    <!-- Email: Form Input -->
                    <div class="form-group">
                        <label for="edit-email">Email:</label>
                        <input type="text" name="email" id="edit-email" placeholder="Email:"
                               class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <!-- Verified: Form Input -->
                            <div class="form-group">
                                <label for="edit-verified">Verified:</label>
                                <select name="verified" id="edit-verified" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <!-- Points: Form Input -->
                            <div class="form-group">
                                <label for="edit-points">Points:</label>
                                <input type="text" name="points" id="edit-points" placeholder="Points:"
                                       class="form-control" value="{{ old('points') }}">
                            </div>
                        </div>
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