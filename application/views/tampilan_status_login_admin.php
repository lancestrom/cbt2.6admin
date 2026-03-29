<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold text-uppercase ">status login admin</h4>
</div>

<div class="row mt-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-uppercase text-center">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">username</th>
                                <th scope="col">nama admin</th>
                                <th scope="col">IP</th>
                                <th scope="col">Waktu Login</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($login_admin as $row) {
                                ?>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?= $row['username'] ?></td>
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