<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-uppercase font-weight-bolder">ID : <?= $ujian['id_jadwal'] ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-uppercase font-weight-bolder text-center">NAMA MAPEL : <?= $ujian['nama_mapel'] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
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
                <?= form_open_multipart('Dashboard/upload_soal_jadwal'); ?>
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