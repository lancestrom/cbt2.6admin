<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold">Siswa</h4>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <!-- <a class="btn btn-success btn-sm" href="<?= base_url() ?>Dashboard/tambah_jurusan"><i class="fas fa-plus-square"></i> Tambah Jurusan</a> -->
                <button type="button" class="btn btn-sm btn-primary  text-uppercase text-white font-weight-bolder"
                    data-toggle="modal" data-target="#uploadSiswa">
                    <i class="fas fa-upload"></i> Upload Siswa
                </button>
                <button type="button" class="btn btn-sm btn-success text-uppercase text-white font-weight-bolder"
                    data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-search"></i> Detail Siswa
                </button>
                <a class="btn btn-sm btn-danger text-uppercase text-white font-weight-bolder"
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
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Password</th>
                                <th class="text-center">Aksi</th>

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
                                    <h5 class="text-center">
                                        <form action="<?= base_url() ?>Dashboard/siswa_block" method="post">
                                            <input type="text" value="<?= $row['id']; ?>" name="id" hidden>
                                            <input type="text" value="<?= $row['no_peserta']; ?>" name="no_peserta"
                                                hidden>
                                            <input type="text" value="<?= $row['nama_siswa']; ?>" name="nama_siswa"
                                                hidden>
                                            <input type="text" value="<?= $row['kelas']; ?>" name="kelas" hidden>
                                            <input type="text" value="<?= $row['jurusan']; ?>" name="jurusan" hidden>
                                            <input type="text" value="<?= $row['username']; ?>" name="username" hidden>
                                            <input type="text" value="<?= $row['password']; ?>" name="password" hidden>
                                            <input type="text" value="<?= $row['level']; ?>" name="level" hidden>
                                            <input type="text" value="<?= $row['status']; ?>" name="status" hidden>
                                            <button type="submit" class="btn btn-danger btn-sm">Block</button>
                                        </form>
                                    </h5>
                                    </h5>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="exampleModalLabel">Detail Peserta Ujian</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md mb-3">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="text-uppercase text-center font-weight-bolder">
                                    kelas x <br>
                                    <?= $jumlah_kelas_x['jumlah_siswa'] ?> Siswa
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Jumlah Siswa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $no = 1;
                                                foreach ($x as $row) {
                                                ?>
                                                <td class="text-center"><?= $row['kelas'] ?></td>
                                                <td class="text-center"><?= $row['jumlah_siswa'] ?> Siswa</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md mb-3">
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                <h5 class="text-uppercase text-center font-weight-bolder">
                                    kelas xi <br>
                                    <?= $jumlah_kelas_xi['jumlah_siswa'] ?> Siswa
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Jumlah Siswa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $no = 1;
                                                foreach ($xi as $row) {
                                                ?>
                                                <td class="text-center"><?= $row['kelas'] ?></td>
                                                <td class="text-center"><?= $row['jumlah_siswa'] ?> Siswa</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md mb-3">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 class="text-uppercase text-center font-weight-bolder">
                                    kelas xii <br>
                                    <?= $jumlah_kelas_xii['jumlah_siswa'] ?> Siswa
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Jumlah Siswa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $no = 1;
                                                foreach ($xii as $row) {
                                                ?>
                                                <td class="text-center"><?= $row['kelas'] ?></td>
                                                <td class="text-center"><?= $row['jumlah_siswa'] ?> Siswa</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>