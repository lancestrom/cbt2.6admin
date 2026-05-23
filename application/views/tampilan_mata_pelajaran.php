<div class="alert alert-success" role="alert">
    <h4 class="text-center font-weight-bold">Mata Pelajaran</h4>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <!-- <a class="btn btn-success btn-sm" href="<?= base_url() ?>Dashboard/tambah_jurusan"><i class="fas fa-plus-square"></i> Tambah Jurusan</a> -->
                <button type="button" class="btn btn-success btn-sm text-uppercase font-weight-bold" data-toggle="modal"
                    data-target="#exampleModal">
                    <i class="fas fa-plus-square"></i> Upload Mapel
                </button>
                <a class="btn btn-danger btn-sm text-uppercase font-weight-bold"
                    href="<?= base_url() ?>Dashboard/hapus_all_mata_pelajaran"><i class="fas fa-trash"></i> Hapus
                    Mapel</a>
            </div>
        </div>
    </div>
</div>

<?= $this->session->flashdata('pesan') ?>

<div class="row mt-4">
    <!-- TJKT Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TJKT</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mapel_tjkt ?> Mapel</div>
                        <div class="small text-muted">Teknik Jaringan Komputer</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-network-wired fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AKL Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">AKL</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mapel_akl ?> Mapel</div>
                        <div class="small text-muted">Akuntansi</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MPLB Card -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">MPLB</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mapel_mplb ?> Mapel</div>
                        <div class="small text-muted">Manajemen Perkantoran</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-building fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PM Card -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pemasaran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mapel_pm ?> Mapel</div>
                        <div class="small text-muted">Bisnis Digital</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DKV Card -->
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">DKV</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mapel_dkv ?> Mapel</div>
                        <div class="small text-muted">Desain Komunikasi Visual</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paint-brush fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Upload Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('Dashboard/upload_mata_peajaran'); ?>
                <div class="form-group">
                    <input type="file" name="excel" class="form-control-file" name="file" required accept=".xlsx">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" value="upload" class="btn btn-primary">Upload</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>