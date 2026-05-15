<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold">Mata Pelajaran</h4>
</div>



<div class="row mt-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center" id="dataTable" width="100%"
                        cellspacing="0">
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
                                            <a class="btn btn-primary btn-sm"
                                                href="<?= base_url() ?>Dashboard_pm/buat_mapel_jadwal/<?= $row['id_mapel'] ?>">Buat
                                                jadwal</a>
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