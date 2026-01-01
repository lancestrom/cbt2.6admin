<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-uppercase font-weight-bolder">ID : <?= $ujian['id_jadwal'] ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-uppercase font-weight-bolder text-center">NAMA MAPEL :
                                    <?= $ujian['nama_mapel'] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md mt-3">
        <div class="card">
            <div class="card-header">
                <h5>PILIH SOAL</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center text-uppercase font-weight-bold">
                                <th scope="col">#</th>
                                <th scope="col">NAMA BANK SOAL</th>
                                <th scope="col">Kelompok Banksoal</th>
                                <th scope="col">Jumlah Soal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($bank_soal as $row) {
                                ?>
                                    <td><?php echo $no++; ?></td>
                                    <td class="text-center"><?= $row['nama_bank_soal'] ?></td>
                                    <td class="text-center"><?= $row['jurusan'] ?></td>
                                    <td class="text-center"><?= $row['jumlah_soal'] ?> Soal</td>
                                    <td>
                                        <h5>
                                            <form action="<?= base_url() ?>Dashboard/simpan_pilih_soal" method="post">
                                                <input type="text" value="<?= $ujian['id_jadwal'] ?>" name="id_jadwal"
                                                    hidden>
                                                <input type="text" value="<?= $row['id_bank_soal'] ?>" name="id_bank_soal"
                                                    hidden>
                                                <div class="row">
                                                    <div class="col-md">
                                                        <h5 class="text-center">
                                                            <button type="submit"
                                                                class="btn btn-primary btn-sm">PILIH</button>
                                                        </h5>
                                                    </div>
                                                </div>

                                            </form>
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