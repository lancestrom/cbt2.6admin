<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold">Status Ujian</h4>
</div>





<div class="row mt-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-uppercase text-center" id="dataTable"
                        width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">ID Mapel</th>
                                <th scope="col">Nama Mapel</th>
                                <th scope="col">Tanggal Mulai</th>
                                <th scope="col">Jumlah Siswa</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($status_ujian as $row) {
                                ?>
                                    <td><?php echo $no++; ?></td>
                                    <td class="text-center"><?= $row['id_mapel'] ?></td>
                                    <td class="text-center"><?= $row['nama_mapel'] ?></td>
                                    <td class="text-center"><?= $row['tanggal_mulai'] ?></td>
                                    <td><?= $row['jumlah_siswa'] ?> Siswa</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>