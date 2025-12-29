<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>CBT SMK TUNAS HARAPAN</title>
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/images/logo.png" />
</head>

<body>

    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <!-- <img src="https://smkth-jakbar.com/assets/images/logo.png" style="width: 150px;height: 150px;"> -->
            <div class="col-md mt-4">
                <td class="font-weight-bold text-uppercase">: Sumatif Akhir Semester GANJIL 2023/2024</td>
                <h5>Mata Pelajaran : <?= $header['fullname'] ?></h5>
                <h5>Jadwal Awal : <?= $header['hari_awal']; ?>, <?= $header['tanggal_awal']; ?> <?= $header['bulan_awal']; ?> <?= $header['tahun_awal']; ?></h5>
                <h5>Sekolah : SMK TUNAS HARAPAN JAKARTA BARAT</h5>
            </div>
        </div><br>
        <hr style="border-top: 2px dashed black;">

        <div class="row">
            <div class="col-md">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama </th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Nilai PG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($rekap as $row) {
                            ?>
                                <td><?php echo $no++; ?></td>
                                <td><?= $row['firstname'] ?></td>
                                <td><?= $row['kelas'] ?></td>
                                <td><?= round($row['nilai'], 2); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>

</html>