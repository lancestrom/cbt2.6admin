<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body bg-info text-white">
                <h5 class="text-uppercase">ID : <?= $header['id_bank_soal'] ?></h5>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body bg-secondary text-white">
                <h5 class="text-uppercase">Bank Soal : <?= $header['nama_bank_soal'] ?></h5>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md mt-3">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center font-weight-bolder text-uppercase">Soal</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($soal)): ?>
                    <?php foreach ($soal as $i => $row): ?>
                        <div class="mb-4">
                            <div class="mb-2"><strong><?= ($i + 1) ?>.</strong> <?= $row['soal'] ?></div>
                            <?php if (!empty($row['gambar']) && file_exists(FCPATH . 'assets/images/gambar/' . $row['gambar'])): ?>
                                <div class="mb-2 text-center">
                                    <img src="<?= base_url('assets/images/gambar/' . $row['gambar']) ?>"
                                        class="img-fluid d-block mx-auto" style="max-height:400px; object-fit:contain;"
                                        alt="Gambar soal <?= ($i + 1) ?>" loading="lazy">
                                </div>
                            <?php endif; ?>
                            <ul class="list-unstyled mb-2">
                                <li><strong>A.</strong> <?= $row['pilA'] ?></li>
                                <li><strong>B.</strong> <?= $row['pilB'] ?></li>
                                <li><strong>C.</strong> <?= $row['pilC'] ?></li>
                                <li><strong>D.</strong> <?= $row['pilD'] ?></li>
                                <li><strong>E.</strong> <?= $row['pilE'] ?></li>
                                <li><strong>Kunci Jawaban : </strong> <?= $row['kunci'] ?></li>
                            </ul>
                            <hr>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Tidak ada soal.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>