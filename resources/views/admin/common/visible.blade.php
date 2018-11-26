<div class="modal modal-primary fade" id="publicModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" id="publicForm">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="publicId">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Continue with changing visibility option?</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to toggle this record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline">Proceed</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>