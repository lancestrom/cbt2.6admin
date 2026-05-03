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