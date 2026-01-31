<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold">Bank Soal</h4>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary btn-sm text-uppercase font-weight-bolder"
                    data-toggle="modal" data-target="#exampleModal">
                    Tambah bank soal
                </button>
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
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-uppercase">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">ID BANK SOAL </th>
                                <th scope="col">NAMa BANK SOAL</th>
                                <th scope="col">KeLOMPOK BANK SOAL</th>
                                <th scope="col">jumlah soal</th>
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
                                    <td class="text-center"><?= $row['id_bank_soal'] ?></td>
                                    <td class="text-center"><?= $row['nama_bank_soal'] ?></td>
                                    <td class="text-center"><?= $row['jurusan'] ?></td>
                                    <td class="text-center"><?= $row['jumlah_soal'] ?> Soal</td>
                                    <td>
                                        <h5 class="text-center">
                                            <a class="btn btn-primary btn-sm text-uppercase font-weight-bolder"
                                                href="<?= base_url() ?>Dashboard_pm/upload_banksoal/<?= $row['id_bank_soal'] ?>">UPLOAD</a>
                                            <a class="btn btn-success btn-sm text-uppercase font-weight-bolder"
                                                href="<?= base_url() ?>Dashboard_pm/detail_banksoal/<?= $row['id_bank_soal'] ?>">DETAIL</a>
                                            <a class="btn btn-danger btn-sm text-uppercase font-weight-bolder"
                                                href="<?= base_url() ?>Dashboard_pm/hapus_banksoal/<?= $row['id_bank_soal'] ?>">HAPUS</a>
                                        </h5>
                                    </td>≈
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
                <h5 class="modal-title text-uppercase" id="exampleModalLabel">Upload Bank soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>Dashboard_pm/simpan_bank_soal" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md text-center">
                                <label for="exampleInputEmail1" class="text-uppercase font-weight-bolder text-dark">Nama
                                    BankSoal</label>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="nama_bank_soal" aria-describedby="emailHelp">
                    </div>
                    <div class="row mb-3 text-center">
                        <div class="col-md">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jurusan" value="PM">
                                <label
                                    class="form-check-label text-uppercase font-weight-bolder text-dark text-text-uppercase font-weight-bolder text-dark">PM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jurusan" value="DKV">
                                <label
                                    class="form-check-label text-uppercase font-weight-bolder text-dark text-text-uppercase font-weight-bolder text-dark">DKV</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jurusan" value="UMUM">
                                <label class="form-check-label text-uppercase font-weight-bolder text-dark"
                                    for="inlineRadio1">UMUM</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>