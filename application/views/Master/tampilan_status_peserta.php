<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold">Status Peserta</h4>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <a class="btn btn-danger btn-sm text-uppercase font-weight-bolder"
                    href="<?= base_url('Dashboard/hapus_all_status_peserta') ?>">Hapus All Status
                    Peserta</a>
            </div>
        </div>
    </div>
</div>

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
                                <th class="text-center">mapel</th>
                                <th class="text-center">Status</th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($rekap as $row) {
                                ?>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?= $row['nama_siswa']; ?></td>
                                <td class="text-center"><?= $row['nama_mapel']; ?></td>
                                <td class="text-center"><?= $row['status'] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>