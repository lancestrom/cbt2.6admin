<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold text-uppercase">Akun Peserta Ujian</h4>
</div>

<div class="row mt-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">ID Kelas</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Jumlah Kelas</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($akun as $row) {
                                ?>
                                    <td><?php echo $no++; ?></td>
                                    <td class="text-center"><?= $row['id'] ?></td>
                                    <td class="text-center"><?= $row['kelas'] ?></td>
                                    <td class="text-center"><?= $row['jurusan'] ?></td>
                                    <td class="text-center"><?= $row['jumlah_siswa'] ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-sm font-weight-bolder text-uppercase"
                                            href="<?= base_url() ?>Dashboard/akun_peserta_id/<?= $row['id'] ?>"
                                            target="_blank">Detail
                                            Peserta Ujian
                                        </a>
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