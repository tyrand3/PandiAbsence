<div class="modal" id="modal-exim" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  method="post" action="{{ route ('absence.import') }}" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Import data kehadiran baru</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <p style="text-align: center;">Pilih dokumen Excel (ekstensi <b>.xls</b>) untuk memperbarui database.</p>
                        <!-- <label for="file-import" class="col-form-label"></label> -->
                        <label for="file" class="col-md-3 control-label">Import</label>
                        <div class="col-md-6">
                            <input type="file" id="file-import" name="file" class="form-control" autofocus required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-save">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
    </div>
</div>
