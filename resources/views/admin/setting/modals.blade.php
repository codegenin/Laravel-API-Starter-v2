<!-- Category Modal -->
<div class="modal fade" id="modal-new-setting">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.setting.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="setting-modal-title">{{__('label.new_setting')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- Name: Form Input -->
                    <div class="form-group">
                        <label for="name">{{__('label.setting_name')}}:</label>
                        <input type="text" name="name" id="name"
                               class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="name">{{__('label.setting_value')}}:</label>
                        <input type="text" name="value" id="value"
                               class="form-control" value="{{ old('value') }}">
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
<div class="modal fade" id="modal-edit-setting">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.setting.update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="setting-modal-title">{{__('label.update_setting')}}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <!-- Name: Form Input -->
                    <div class="form-group">
                        <label for="name">{{__('label.setting_name')}}:</label>
                        <input type="text" name="name" id="edit-setting-name"
                               class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="name">{{__('label.setting_value')}}:</label>
                        <input type="text" name="value" id="edit-setting-value"
                               class="form-control" value="{{ old('name') }}">
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