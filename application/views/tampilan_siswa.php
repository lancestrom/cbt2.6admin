<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold">Siswa</h4>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <!-- <a class="btn btn-success btn-sm" href="<?= base_url() ?>Dashboard/tambah_jurusan"><i class="fas fa-plus-square"></i> Tambah Jurusan</a> -->
                <button type="button" class="btn btn-primary btn-sm text-uppercase" data-toggle="modal"
                    data-target="#uploadSiswa">
                    <i class="fas fa-upload"></i> Upload Siswa
                </button>
                <a class="btn btn-danger btn-sm text-uppercase"
                    href="<?= base_url() ?>Dashboard/hapus_all_peserta_ujian"><i class="fas fa-trash-alt"></i> Hapus
                    Semua Siswa</a>

            </div>
        </div>
    </div>
</div>

<?= $this->session->flashdata('info') ?>

<div class="row mb-2 mt-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-uppercase">
                            <tr>
                                <th>#</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($siswa as $row) {
                                ?>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td><?= $row['nama_siswa']; ?></td>
                                    <td class="text-center"><?= $row['kelas']; ?></td>
                                    <td class="text-center"><?= $row['username'] ?></td>
                                    <td class="text-center"><?= $row['password'] ?></td>
                                    <td class="text-center">
                                        <p class="font-weight-bold text-success"> <?= $row['keterangan'] ?></p>

                                    </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadSiswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Upload Peserta Ujian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('Dashboard/upload_peserta_ujian'); ?>
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