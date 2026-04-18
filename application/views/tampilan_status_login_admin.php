<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold text-uppercase ">status login admin</h4>
</div>
<div class="row mt-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-uppercase">#</th>
                                <th scope="col" class="text-uppercase">NAMA ADMIN</th>
                                <th scope="col" class="text-uppercase">IP ADDRESS</th>
                                <th scope="col" class="text-uppercase">WAKTU LOGIN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($login_admin as $row) {
                                ?>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center"><?= $row['nama'] ?></td>
                                    <td class="text-center"><?= $row['ipaddress'] ?></td>
                                    <td class="text-center"><?= $row['timestamp'] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>