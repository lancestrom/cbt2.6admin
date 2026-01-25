<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold">REKAP NILAI</h4>
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
                                <th scope="col">ID Mapel</th>
                                <th scope="col">Nama Mapel</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($rekap as $row) {
                                ?>
                                <td><?php echo $no++; ?></td>
                                <td class="text-center"><?= $row['id_mapel'] ?></td>
                                <td class="text-center"><?= $row['nama_mapel'] ?></td>
                                <td>
                                    <h5 class="text-center">
                                        <a class="btn btn-danger text-white btn-sm text-uppercase font-weight-bolder"
                                            href="<?= base_url()  ?>Dashboard/print_nilai/<?= $row['id_jadwal'] ?>"
                                            target="_blank">Print
                                        </a>
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