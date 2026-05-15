<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold text-uppercase"> filter Status Peserta</h4>
</div>

<div class="row">
    <div class="col-md">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong class="text-uppercase">Filter Peserta Akan Muncul Saat Ujian Dimulai</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Mapel</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Selesai</th>
                                <th scope="col">Mengerjakan</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($status as $row) {
                                ?>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="text-center"><?= $row['name'] ?></td>
                                    <td class="text-center"><?= $row['nama_kelas'] ?></td>
                                    <td class="text-center"><?= $row['selesai'] ?> Siswa</td>
                                    <td class="text-center"><?= $row['masih_mengerjakan'] ?> Siswa</td>
                                    <td class="text-center"><?= $row['jumlah_mengerjakan'] ?> Siswa</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>