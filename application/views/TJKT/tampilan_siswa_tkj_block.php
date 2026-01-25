<div class="alert alert-danger" role="alert">
    <h4 class="text-center font-weight-bold">Siswa Block</h4>
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
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Password</th>
                                <th class="text-center">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($data_siswa as $row) {
                                ?>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td><?= $row['nama_siswa']; ?></td>
                                    <td class="text-center"><?= $row['kelas']; ?></td>
                                    <td class="text-center"><?= $row['username'] ?></td>
                                    <td class="text-center"><?= $row['password'] ?></td>
                                    <td class="text-center">
                                        <h5 class="text-center">
                                            <form action="<?= base_url() ?>Dashboard_tkj/siswa_buka_block" method="post">
                                                <input type="text" value="<?= $row['id']; ?>" name="id" hidden>
                                                <input type="text" value="<?= $row['no_peserta']; ?>" name="no_peserta"
                                                    hidden>
                                                <input type="text" value="<?= $row['nama_siswa']; ?>" name="nama_siswa"
                                                    hidden>
                                                <input type="text" value="<?= $row['kelas']; ?>" name="kelas" hidden>
                                                <input type="text" value="<?= $row['jurusan']; ?>" name="jurusan" hidden>
                                                <input type="text" value="<?= $row['username']; ?>" name="username" hidden>
                                                <input type="text" value="<?= $row['password']; ?>" name="password" hidden>
                                                <input type="text" value="<?= $row['level']; ?>" name="level" hidden>
                                                <input type="text" value="<?= $row['status']; ?>" name="status" hidden>
                                                <button type="submit" class="btn btn-danger btn-sm">Block</button>
                                            </form>
                                        </h5>
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