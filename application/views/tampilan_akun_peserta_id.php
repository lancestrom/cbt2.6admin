<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>CBT 2.6 - PRINT AKUN PESERTA UJIAN</title>
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/images/logo.png" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md mt-4">
                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <td>
                                <h5 class="text-uppercase text-center font-weight-bolder">computer based test</h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 class="text-uppercase text-center font-weight-bolder">smk tunas harapan jakarta
                                    barat
                                </h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 class="text-uppercase text-center font-weight-bolder">nama kelas :
                                    <?= $header['kelas'] ?></h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center" id="dataTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">username</th>
                                <th scope="col">password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $no = 1;
                                foreach ($siswa as $row) {
                                ?>
                                    <td><?php echo $no++; ?></td>
                                    <td class="text-center"><?= $row['nama_siswa'] ?></td>
                                    <td class="text-center"><?= $row['username'] ?></td>
                                    <td class="text-center"><?= $row['password'] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>

</body>

</html>