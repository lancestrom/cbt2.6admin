<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="row ">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-uppercase font-weight-bolder">ID : <?= $ujian['id_jadwal'] ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="text-uppercase font-weight-bolder text-center">NAMA MAPEL :
                                    <?= $ujian['nama_mapel'] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
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
                <?php if (!empty($jadwal_soal)): ?>
                <?php foreach ($jadwal_soal as $i => $row): ?>
                <div class="mb-4">
                    <div class="mb-2"><strong><?= ($i + 1) ?>.</strong> <?= $row['soal'] ?></div>
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