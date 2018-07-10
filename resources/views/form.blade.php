<div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="form-contact" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                    </button>
                    <h3 class="modal-title"></h3>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="Name" class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" id="Name" name="Name" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="Date" class="col-md-3 control-label">Date</label>
                      <div class="col-md-6">
                          <input type="Date" id="Date" name="Date" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

              <div class="form-group">
                      <label for="ATT_Time" class="col-md-3 control-label">ATT_Time</label>
                      <div class="col-md-6">
                          <input type="text" id="ATT_Time" name="ATT_Time" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

            <div class="form-group">
                      <label for="absent" class="col-md-3 control-label">Absent</label>
                      <div class="col-md-6">
                          <input type="text" id="absent" name="absent" class="form-control" required>
                          <span class="help-block with-errors"></span>
                      </div>
                    </div>

           




</div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
