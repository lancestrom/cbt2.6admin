<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold text-uppercase ">status login siswa</h4>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <a class="btn btn-danger btn-sm text-uppercase font-weight-bolder"
                    href="<?= base_url() ?>Dashboard/hapus_all_status_login">Hapus
                    Status Login Siswa
                </a>
                <button type="button" class="btn btn-primary btn-sm text-uppercase font-weight-bolder"
                    data-toggle="modal" data-target="#exampleModal">
                    status login siswa per kelas
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-uppercase">#</th>
                                <th scope="col" class="text-uppercase">username</th>
                                <th scope="col" class="text-uppercase">nama siswa</th>
                                <th scope="col" class="text-uppercase">kelas</th>
                                <th scope="col" class="text-uppercase">ip</th>
                                <th scope="col" class="text-uppercase">waktu login</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($login_peserta as $row) {
                                ?>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center"><?= $row['username'] ?></td>
                                    <td class="text-center"><?= $row['nama_siswa'] ?></td>
                                    <td class="text-center"><?= $row['kelas'] ?></td>
                                    <td class="text-center"><?= $row['ipaddress'] ?></td>
                                    <td><?= $row['timestamp'] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white text-uppercase font-weight-bolder text-center">
                <h5 class="modal-title" id="exampleModalLabel">status login siswa per kelas</h5>

            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-uppercase">#</th>
                            <th scope="col" class="text-uppercase">ID KELAS</th>
                            <th scope="col" class="text-uppercase">Kelas</th>
                            <th scope="col" class="text-uppercase">Jumlah Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($tabel_login_peserta as $row) {
                            ?>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?= $row['id'] ?></td>
                                <td class="text-center"><?= $row['kelas'] ?></td>
                                <td class="text-center text-uppercase"><?= $row['jumlah_login'] ?> Siswa</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>