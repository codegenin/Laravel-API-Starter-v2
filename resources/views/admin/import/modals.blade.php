<!-- Import Modal -->
<div class="modal fade" id="modal-file-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{route('admin.import.file')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="collection-modal-title">{{trans('label.import')}}</h4>
                </div>
                <div class="modal-body">
                    <!-- Excel File: Form Input -->
                    <div class="form-group">
                        <label for="file">Excel File:</label>
                        <input type="file" name="file" id="file" placeholder="Excel File:" class="form-control"
                               value="{{ old('file') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left"
                            data-dismiss="modal">{{trans('label.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('label.save_changes')}}</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>