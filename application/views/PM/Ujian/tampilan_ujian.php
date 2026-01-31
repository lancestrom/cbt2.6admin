<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold">Jadwal Ujian</h4>
</div>


<?= $this->session->flashdata('pesan') ?>



<div class="row mt-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-uppercase font-weight-bolder" id="dataTable"
                        width="100%" cellspacing="0">
                        <thead class="text-uppercase text-center">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Mapel</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Waktu Mulai</th>
                                <th scope="col">Waktu AKir</th>
                                <th scope="col">Durasi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($ujian as $row) {
                                ?>
                                    <td><?php echo $no++; ?></td>
                                    <td>
                                        <h4 class="badge badge-info text-uppercase"><?= $row['nama_mapel']; ?></h4>
                                    </td>
                                    <td>
                                        <h4 class="badge badge-info"><?= $row['tanggal_mulai']; ?></h4>
                                    </td>
                                    <td>
                                        <h4 class="badge badge-success"><?= $row['waktu_mulai']; ?></h4>
                                    </td>
                                    <td>
                                        <h4 class="badge badge-danger"><?= $row['waktu_selesai']; ?></h4>
                                    </td>
                                    <td>
                                        <h4 class="badge badge-secondary"><?= number_format($row['waktu']); ?> Menit</h4>
                                    </td>
                                    <td>
                                        <h5 class="text-center">
                                            <a class="btn btn-primary btn-sm"
                                                href="<?= base_url() ?>Dashboard_pm/pilih_soal/<?= $row['id_jadwal']; ?>">TAMBAH</a>
                                            <a class=" btn btn-danger btn-sm"
                                                href="<?= base_url() ?>Dashboard_pm/edit_jadwal/<?= $row['id_jadwal']; ?>">EDIT</a>
                                            <a class="btn btn-success btn-sm"
                                                href="<?= base_url() ?>Dashboard_pm/detail_jadwal_soal/<?= $row['id_jadwal']; ?>">DETAIL</a>
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