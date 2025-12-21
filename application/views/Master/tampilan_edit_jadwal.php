<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <h5><?= $mapel['nama_mapel'] ?></h5>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md mt-3">
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?= base_url() ?>Dashboard/simpan_edit_jadwal">
                    <div class="form-group">
                        <input type="text" value="<?= $mapel['id_jadwal'] ?>" name="id_jadwal" class="form-control" hidden>
                        <input type="text" value="<?= $mapel['id_mapel'] ?>" name="id_mapel" class="form-control" hidden>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Tanggal Ujian</label>
                                <input type="date" value="<?= $mapel['tanggal_mulai'] ?>" class=" form-control" name="tanggal_mulai">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>Waktu Mulai</label>
                                <input type="time" value="<?= $mapel['waktu_mulai'] ?>" class=" form-control" name="waktu_mulai">
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label>Waktu akhir</label>
                                <input type="time" value="<?= $mapel['waktu_selesai'] ?>" class="form-control" name="waktu_selesai">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">EDIT</button>
                </form>
            </div>
        </div>
    </div>
</div>