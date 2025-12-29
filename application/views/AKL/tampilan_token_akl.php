<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="card-header alert alert-success">
                    <h4 class="text-center font-weight-bold">Ujian Terdaftar Hari Ini</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">X AKL</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NAMA MAPEL</th>
                            <th scope="col">TOKEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($token_x_akl as $row) {
                            ?>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class=""><?= $row['fullname'] ?></td>
                                <td class=""><?= $row['password'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">XI AKL</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NAMA MAPEL</th>
                            <th scope="col">TOKEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($token_xi_akl as $row) {
                            ?>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class=""><?= $row['fullname'] ?></td>
                                <td class=""><?= $row['password'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">XII AKL</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NAMA MAPEL</th>
                            <th scope="col">TOKEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($token_xii_akl as $row) {
                            ?>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class=""><?= $row['fullname'] ?></td>
                                <td class=""><?= $row['password'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>