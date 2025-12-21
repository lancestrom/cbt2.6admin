<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body bg-info text-white">
                <h5 class="text-uppercase">
                    ID : <?= $header['id_bank_soal'] ?>
                </h5>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body bg-secondary text-white">
                <h5 class="text-uppercase">
                    Bank Soal : <?= $header['nama_bank_soal'] ?>
                </h5>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md mt-2">
        <div class="card">
            <div class="card-header">
                <h6 class="text-uppercase font-weight-bolder">Upload Soal</h6>
            </div>
            <div class="card-body">
                <?= form_open_multipart('Dashboard/upload_bank_soal'); ?>
                <div class="form-group">
                    <input type="file" name="excel" class="form-control-file" name="file" required accept=".xlsx">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" value="upload" class="btn btn-primary">Upload</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>