<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold text-uppercase ">status login admin</h4>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <a class="btn btn-danger btn-sm text-uppercase font-weight-bolder"
                    href="<?= base_url() ?>Dashboard/hapus_all_status_login">Hapus
                    Status Login Siswa
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-uppercase text-center">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">username</th>
                                <th scope="col">nama Siswa</th>
                                <th scope="col">kelas</th>
                                <th scope="col">IP</th>
                                <th scope="col">Waktu Login</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($login_peserta as $row) {
                                ?>
                                    <td><?php echo $no++; ?></td>
                                    <td class="text-center"><?= $row['username'] ?></td>
                                    <td class="text-center"><?= $row['nama_siswa'] ?></td>
                                    <td class="text-center"><?= $row['kelas'] ?></td>
                                    <td class="text-center"><?= $row['ipaddress'] ?></td>
                                    <td class="text-center"><?= $row['timestamp'] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>