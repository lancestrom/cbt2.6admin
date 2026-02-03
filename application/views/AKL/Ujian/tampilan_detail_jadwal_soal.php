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
                    <div class="mb-2 text-center">
                        <?php
                                $filename = isset($row['gambar']) ? $row['gambar'] : '';
                                $full_path = FCPATH . 'assets/images/gambar/' . $filename;
                                $url = base_url('assets/images/gambar/' . $filename);
                                ?>
                        <?php if (!empty($filename) && file_exists($full_path)): ?>
                        <img src="<?= $url ?>" class="img-fluid d-block mx-auto"
                            style="max-width:100%; max-height:400px; object-fit:contain;"
                            alt="Gambar soal <?= ($i + 1) ?>" loading="lazy">
                        <?php else: ?>
                        <div class="text-muted small">File: <?= htmlspecialchars($filename ?: 'Tidak ada file') ?></div>
                        <?php endif; ?>
                    </div>
                    <ul class="list-group list-group-flush mb-2">
                        <li class="list-group-item p-2"><strong>A.</strong> <?= $row['pilA'] ?></li>
                        <li class="list-group-item p-2"><strong>B.</strong> <?= $row['pilB'] ?></li>
                        <li class="list-group-item p-2"><strong>C.</strong> <?= $row['pilC'] ?></li>
                        <li class="list-group-item p-2"><strong>D.</strong> <?= $row['pilD'] ?></li>
                        <li class="list-group-item p-2"><strong>E.</strong> <?= $row['pilE'] ?></li>
                        <li class="list-group-item p-2"><strong>Kunci Jawaban:</strong> <span
                                class="badge badge-success ml-2"><?= htmlspecialchars($row['kunci']) ?></span></li>
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