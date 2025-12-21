<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <h6>ID : <?= $header['id_jadwal'] ?></h6>
            </div>
        </div>
    </div>
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <h6>MAPEL : <?= $header['nama_mapel'] ?></h6>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md mt-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="text-center text-uppercase font-weight-bolder">Soal</h6>
            </div>
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">#</th>
                                                <th scope="col">SOAL</th>
                                                <th scope="col">OPSI A</th>
                                                <th scope="col">OPSI B</th>
                                                <th scope="col">OPSI C</th>
                                                <th scope="col">OPSI D</th>
                                                <th scope="col">OPSI E</th>
                                                <th scope="col">kunci</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $no = 1;
                                                foreach ($soal as $row) {
                                                ?>
                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                    <td><?= $row['soal'] ?></td>
                                                    <td><?= $row['pilA'] ?></td>
                                                    <td><?= $row['pilB'] ?></td>
                                                    <td><?= $row['pilC'] ?></td>
                                                    <td><?= $row['pilD'] ?></td>
                                                    <td><?= $row['pilE'] ?></td>
                                                    <td><?= $row['kunci'] ?></td>

                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>