<div class="alert alert-success" role="alert">
    <h2 class="text-center text-uppercase font-weight-bold">CBT Tunas Harapan <br>Admin utama</h2>
</div>

<div class="row mb-3">
    <div class="col-sm mt-2">
        <div class="card rounded">
            <div class="card-body bg-success">
                <div class="row">
                    <div class="col">
                        <h3 class="text-white  font-italic font-weight-bold"><?= $siswa ?></h3>
                        <h4 class=" text-white font-italic font-weight-bold">Peserta Ujian</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm mt-2">
        <div class="card">
            <div class="card-body bg-primary">
                <div class="row">
                    <div class="col">
                        <h3 class="text-white  font-italic font-weight-bold"><?= $kelas ?></h3>
                        <h4 class=" text-white font-italic font-weight-bold">Kelas</h4>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-sm mt-2">
        <div class="card">
            <div class="card-body bg-success">
                <div class="row">
                    <div class="col">
                        <h3 class="text-white  font-italic font-weight-bold "><?= $ujian ?></h3>
                        <h4 class="text-white  font-italic font-weight-bold">Jadwal Ujian</h4>
                    </div>

                </div>
            </div>
        </div>
    </div> -->
    <div class="col-sm mt-2">
        <div class="card">
            <div class="card-body bg-primary">
                <div class="row">
                    <div class="col">
                        <h3 class="text-white  font-italic font-weight-bold"><?= $mapel ?></h3>
                        <h4 class="text-white  font-italic font-weight-bold">Mapel</h4>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="text-uppercase text-center font-weight-bolder">
                    kelas x
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Kelas</th>
                                <th scope="col">Jumlah Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($x as $row) {
                                ?>
                                    <td class="text-center"><?= $row['kelas'] ?></td>
                                    <td class="text-center"><?= $row['jumlah_siswa'] ?> Siswa</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5 class="text-uppercase text-center font-weight-bolder">
                    kelas xi
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Kelas</th>
                                <th scope="col">Jumlah Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($xi as $row) {
                                ?>
                                    <td class="text-center"><?= $row['kelas'] ?></td>
                                    <td class="text-center"><?= $row['jumlah_siswa'] ?> Siswa</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="text-uppercase text-center font-weight-bolder">
                    kelas xii
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Kelas</th>
                                <th scope="col">Jumlah Siswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($xii as $row) {
                                ?>
                                    <td class="text-center"><?= $row['kelas'] ?></td>
                                    <td class="text-center"><?= $row['jumlah_siswa'] ?> Siswa</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>