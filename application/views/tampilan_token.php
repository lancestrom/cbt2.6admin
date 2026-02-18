<div class="row">
    <div class="col-md">
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
                                            <h6 class="font-weight-bold" style="text-transform: uppercase;">ID TOKEN
                                            </h6>
                                        </th>
                                        <th scope="col">
                                            <h6 class="font-weight-bold" style="text-transform: uppercase;">TOEKN KELUAR
                                            </h6>
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
                                                <div class="row">
                                                    <div class="col-md">
                                                        <form action="<?= base_url() ?>Dashboard/refresh_token"
                                                            method="post">
                                                            <input type="text" value="<?= $row['id']; ?>" name="id" hidden>
                                                            <input type="text" value="<?= $row['token_keluar']; ?>"
                                                                name="token_keluar" hidden>
                                                            <h5 class="text-center">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm text-uppercase font-weight-bolder">refresh
                                                                </button>
                                                            </h5>
                                                        </form>
                                                    </div>
                                                    <div class="col-md">
                                                        <form action="<?= base_url() ?>Dashboard/hapus_token_keluar"
                                                            method="post">
                                                            <input type="text" value="<?= $row['id']; ?>" name="id" hidden>
                                                            <input type="text" value="<?= $row['token_keluar']; ?>"
                                                                name="token_keluar" hidden>
                                                            <h5 class="text-center">
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm text-uppercase font-weight-bolder">hapus
                                                                </button>
                                                            </h5>
                                                        </form>
                                                    </div>
                                                </div>
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
    </div>
    <div class="col-md">
        <div class="alert alert-success" role="alert">
            <h4 class="text-center font-weight-bold">TOKEN MASUK</h4>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mb-2">
                                <button id="btn-reload-page" class="btn btn-secondary btn-sm" hidden>Reload Page
                                    (F5)</button>
                            </div>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">
                                            <h6 class="font-weight-bold" style="text-transform: uppercase;">#</h6>
                                        </th>
                                        <th scope="col">
                                            <h6 class="font-weight-bold" style="text-transform: uppercase;">ID TOKEN
                                            </h6>
                                        </th>
                                        <th scope="col">
                                            <h6 class="font-weight-bold" style="text-transform: uppercase;">TOEKN KELUAR
                                            </h6>
                                        </th>
                                        <th scope="col">
                                            <h6 class="font-weight-bold" style="text-transform: uppercase;">AKSI
                                            </h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $no = 1;
                                        foreach ($token_masuk as $row) {
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
                                                    <?= $row['token_masuk']; ?>
                                                </h6>
                                            </td>
                                            <td>
                                                <form class="form-refresh-token"
                                                    action="<?= base_url() ?>Dashboard/refresh_token_masuk" method="post">
                                                    <input type="text" value="<?= $row['id']; ?>" name="id" hidden>
                                                    <input type="text" value="<?= $row['token_masuk']; ?>"
                                                        name="token_masuk" hidden>
                                                    <h5 class="text-center">
                                                        <button type="submit"
                                                            class="btn btn-primary btn-sm text-uppercase font-weight-bolder btn-refresh-token"
                                                            hidden>refresh
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
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.querySelector('.form-refresh-token');
                        const reloadBtn = document.getElementById('btn-reload-page');

                        if (reloadBtn) {
                            reloadBtn.addEventListener('click', function() {
                                location.reload();
                            });
                        }

                        if (!form) return;

                        function refreshTokenOnce() {
                            const url = form.action;
                            const data = new FormData(form);
                            fetch(url, {
                                method: 'POST',
                                body: data,
                                credentials: 'same-origin'
                            }).then(function(response) {
                                return response.text();
                            }).then(function() {
                                console.log('Token refreshed, reloading page...');
                                location.reload();
                            }).catch(function(err) {
                                console.error('Refresh failed', err);
                            });
                        }

                        // Auto-run every 3000 ms (3 seconds)
                        setInterval(refreshTokenOnce, 3000);
                    });
                </script>
            </div>
        </div>
    </div>
</div>