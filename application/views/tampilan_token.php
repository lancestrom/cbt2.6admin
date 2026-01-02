<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold">TOKEN</h4>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">
                                    <h6 class="font-weight-bold" style="text-transform: uppercase;">#</h6>
                                </th>
                                <th scope="col">
                                    <h6 class="font-weight-bold" style="text-transform: uppercase;">ID TOKEN</h6>
                                </th>
                                <th scope="col">
                                    <h6 class="font-weight-bold" style="text-transform: uppercase;">TOEKN KELUAR</h6>
                                </th>
                                <th scope="col">
                                    <h6 class="font-weight-bold" style="text-transform: uppercase;">AKSI</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($token as $row) {
                                ?>
                                    <td class="text-centers">
                                        <h6><?php echo $no++; ?></h6>
                                    </td>
                                    <td>
                                        <h6 class="text-uppercase text-center">
                                            <?= $row['id']; ?>
                                        </h6>
                                    </td>
                                    <td>
                                        <h6 class="text-uppercase text-center">
                                            <?= $row['token_keluar']; ?>
                                        </h6>
                                    </td>
                                    <td>
                                        <form action="<?= base_url() ?>Dashboard/refresh_token" method="post">
                                            <input type="text" value="<?= $row['id']; ?>" name="id" hidden>
                                            <input type="text" value="<?= $row['token_keluar']; ?>" name="token_keluar"
                                                hidden>
                                            <h5 class="text-center">
                                                <button type="submit"
                                                    class="btn btn-primary btn-sm text-uppercase font-weight-bolder">refresh
                                                    token</button>
                                            </h5>

                                        </form>
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