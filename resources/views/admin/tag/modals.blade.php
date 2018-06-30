<!-- Category Modal -->
<div class="modal fade" id="modal-new-tag">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.tag.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="tag-modal-title">{{__('label.new_tag')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- Name: Form Input -->
                    <div class="form-group">
                        <label for="name">{{__('label.name')}}:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="english">
                        </span>
                            <input type="text" name="name" id="name"
                                   class="form-control" value="{{ old('name') }}">
                        </div>
                        <!-- Translation -->
                        <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                            <input type="text" name="fr_name" id="fr_name"
                                   class="form-control" value="{{ old('name') }}">
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

<!-- Edit Category Modal -->
<div class="modal fade" id="modal-edit-tag">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.tag.update')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="tag-modal-title">{{__('label.update_tag')}}</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <!-- Name: Form Input -->
                    <div class="form-group">
                        <label for="name">{{__('label.name')}}:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/en.png')}}" alt="english">
                        </span>
                            <input type="text" name="name" id="edit-name"
                                   class="form-control" value="{{ old('name') }}">
                        </div>
                        <!-- Translation -->
                        <div class="input-group">
                            <span class="input-group-addon">
                            <img src="{{asset('images/fr.png')}}" alt="french">
                        </span>
                            <input type="text" name="fr_name" id="edit-fr_name"
                                   class="form-control" value="{{ old('name') }}">
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