<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold">Mata Pelajaran</h4>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <!-- <a class="btn btn-success btn-sm" href="<?= base_url() ?>Dashboard/tambah_jurusan"><i class="fas fa-plus-square"></i> Tambah Jurusan</a> -->
                <button type="button" class="btn btn-success btn-sm text-uppercase font-weight-bold" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus-square"></i> Upload Mapel
                </button>
                <a class="btn btn-danger btn-sm text-uppercase font-weight-bold" href="<?= base_url() ?>Dashboard/hapus_all_mata_pelajaran"><i class="fas fa-trash"></i> Hapus Mapel</a>
            </div>
        </div>
    </div>
</div>

<?= $this->session->flashdata('pesan') ?>

<div class="row mt-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-uppercase">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">ID </th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Mapel</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($mapel as $row) {
                                ?>
                                    <td><?php echo $no++; ?></td>
                                    <td class="text-center"><?= $row['id_mapel'] ?></td>
                                    <td class="text-center"><?= $row['kelas'] ?></td>
                                    <td class="text-center"><?= $row['nama_mapel'] ?></td>
                                    <td class="text-center">
                                        <h5>
                                            <a class="btn btn-primary btn-sm" href="<?= base_url() ?>Dashboard/buat_mapel_jadwal/<?= $row['id_mapel'] ?>">Buat jadwal</a>
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


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Upload Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('Dashboard/upload_mata_peajaran'); ?>
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