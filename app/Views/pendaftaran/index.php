<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <h1 class="mb-3 text-center">Biodata Kartu Tanda Mahasiswa</h1>
    <div class="row justify-content-center mb-5">
        <div class="col-lg-6 shadow-sm p-3 mb-5 bg-body-tertiary rounded">
            <form action="/pendaftaran/save" method="POST">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control <?= (session('errors.name')) ? 'is-invalid' : '' ?>" id="name" name="name" placeholder="Nama Lengkap" value="<?= old('name'); ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.name'); ?>
                    </div>
                </div>

                <div class="mb-3">
                    <h6 class="">Jenis Kelamin</h6>
                    <select class="form-select <?= (session('errors.jenis_kelamin')) ? 'is-invalid' : '' ?>" id="jenis_kelamin" name="jenis_kelamin" aria-label="Default select example">
                        <option value="">Jenis Kelamin</option>
                        <option value="Laki-Laki" <?= old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : ''; ?>>Laki-Laki</option>
                        <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.jenis_kelamin'); ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control <?= (session('errors.tempat_lahir')) ? 'is-invalid' : '' ?>" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= old('tempat_lahir'); ?>">
                    <div class="invalid-feedback">
                        <?= session('errors.tempat_lahir'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <h6 class="">Tanggal, Bulan, dan Tahun Lahir</h6>
                    <div class="row">
                        <div class="col-lg">
                            <select class="form-select <?= (session('errors.tanggal_lahir')) ? 'is-invalid' : '' ?>" name="tanggal_lahir" id="tanggal_lahir">
                                <option value="">Tanggal</option>
                                <?php for ($h = 1; $h <= 31; $h++) : ?>
                                    <option value="<?= $h; ?>" <?= old('tanggal_lahir') == $h ? 'selected' : ''; ?>><?= $h; ?></option>
                                <?php endfor; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors.tanggal_lahir'); ?>
                            </div>
                        </div>
                        <div class="col-lg">
                            <select class="form-select <?= (session('errors.bulan_lahir')) ? 'is-invalid' : '' ?>" name="bulan_lahir" id="bulan_lahir">
                                <option value="">Bulan</option>
                                <?php for ($b = 0; $b < 12; $b++) : ?> <?php $nama_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']; ?>
                                    <option value="<?= $nama_bulan[$b]; ?>" <?= old('bulan_lahir') == $nama_bulan[$b] ? 'selected' : ''; ?>>
                                        <?= $nama_bulan[$b]; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors.bulan_lahir'); ?>
                            </div>
                        </div>
                        <div class="col-lg">
                            <select class="form-select <?= (session('errors.tahun_lahir')) ? 'is-invalid' : '' ?>" name="tahun_lahir" id="tahun_lahir">
                                <option value="">Tahun</option>
                                <?php for ($t = 2023; $t >= 1980; $t--) : ?>
                                    <option value="<?= $t; ?>" <?= old('tahun_lahir') == $t ? 'selected' : ''; ?>><?= $t; ?></option>
                                <?php endfor; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors.tahun_lahir'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <h6 class="">Pilihan Program Studi</h6>
                    <select class="form-select <?= (session('errors.program_studi')) ? 'is-invalid' : '' ?>" name="program_studi" id="program_studi">
                        <option value="">Program Studi</option>
                        <?php for ($p = 0; $p < 5; $p++) : ?> <?php $prodi = ['Teknologi Rekayasa Perangkat Lunak', 'Teknologi Produksi Tanaman Perkebunan', 'Teknologi Pengolahan Hasil Kelapa Sawit', 'Budidaya Perkebunan Kelapa Sawit', 'Manajemen Logistik']; ?>
                            <option value="<?= $prodi[$p]; ?>" <?= old('program_studi') == $prodi[$p] ? 'selected' : ''; ?>>
                                <?= $prodi[$p]; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= session('errors.program_studi'); ?>
                    </div>
                </div>

                <div class="my-3 text-end">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>