<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Kartu Tanda Mahasiswa</h1>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <?= view('Myth\Auth\Views\_message_block') ?>
                        </div>
                    </div>

                    <div class="d-inline">
                        <a href="/ktm" class="btn btn-warning mb-2">Kembali</a>
                    </div>

                    <form action="/ktm/delete/<?= $ktm['id']; ?>" class="d-inline" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-outline-danger mb-2" onclick="return confirm('Yakin Hapus Data?')">Hapus</button>
                    </form>

                    <div class="d-inline">
                        <a href="/ktm/edit/<?= $ktm['id']; ?>" class="btn btn-outline-warning mb-2">Edit</a>
                    </div>

                    <div class="d-inline">
                        <button id="download" class="btn btn-outline-primary mb-2">Download PNG</button>
                    </div>
                    <div class="card text-bg-light shadow-sm" style="max-width: 690px" id="ktm">
                        <img src="/img/background-ktm.jpg" class="card-img" alt="...">
                        <div class="card-img-overlay">
                            <div class="row mt-4">
                                <div class="col-3 text-end mb-4">
                                    <img src="/img/logocwe.png" alt="" width="130px">
                                </div>
                                <div class="col">
                                    <h5 class="card-title text-uppercase fw-bold fs-3">politeknik kelapa sawit <br> citra
                                        widya
                                        edukasi</h5>
                                    <p class="card-text">Jl. Gapura No. 8 Cibuntu Cibitung Bekasi Jawa Barat</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-9">
                                    <table class="table table-sm table-borderless fw-bold ms-3">
                                        <tbody>
                                            <tr>
                                                <td class="pe-0">Nama Lengkap</td>
                                                <td>:</td>
                                                <td id="downloadName"><?= $ktm['name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="pe-0">Tempat & Tgl. Lahir</td>
                                                <td>:</td>
                                                <td><?= $ktm['tempat_lahir'] . ', ' . $ktm['tanggal_lahir'] . ' ' . $ktm['bulan_lahir'] . ' ' . $ktm['tahun_lahir']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pe-0">Jenis Kelamin</td>
                                                <td>:</td>
                                                <td><?= $ktm['jenis_kelamin']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="pe-0">Program Studi</td>
                                                <td>:</td>
                                                <td id="downloadProdi"><?= $ktm['program_studi']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col">
                                    <img src="<?= base_url('img/' . $ktm['image']); ?>" class="rounded d-block mx-auto " width="100px" alt="...">
                                    <p class="text-center mt-1 fw-bold">NIM. <?= $ktm['nim']; ?></p>
                                </div>
                                <div class="">
                                    <input id="nomorMahasiswa" type="hidden" value="<?= $ktm['nim']; ?>">
                                    <svg id="barcode"></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- html canvas -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js"></script>

        <!-- generate barcode -->
        <script src="/js/JsBarcode.all.min.js"></script>

        <!-- {{-- html2canvas fitur download file image --}} -->
        <script type="text/javascript">
            const download = document.querySelector('#download');
            const downloadProdi = document.getElementById('downloadProdi');
            const downloadName = document.getElementById('downloadName');
            download.addEventListener("click", function() {
                screenshot();
            })

            function screenshot() {
                html2canvas(document.getElementById("ktm")).then(function(canvas) {
                    downloadImage(canvas.toDataURL(), downloadName.textContent + "_" + downloadProdi.textContent +
                        " 2023" + ".png");
                });
            }

            function downloadImage(uri, filename) {
                const link = document.createElement('a');
                if (typeof link.download !== 'string') {
                    window.open(uri);
                } else {
                    link.href = uri;
                    link.download = filename;
                    accountForFirefox(clickLink, link);
                }
            }

            function clickLink(link) {
                link.click();
            }

            function accountForFirefox(click) {
                const link = arguments[1];
                document.body.appendChild(link);
                click(link);
                document.body.removeChild(link);
            }

            // Generate Barcode Start
            let nomorMahasiswa = document.getElementById("nomorMahasiswa").value;
            let barcode = document.getElementById("barcode");
            JsBarcode(barcode, nomorMahasiswa, {
                width: 1.6,
                height: 40,
                fontSize: 14,
                displayValue: false,
            });
            // Generate Barcode End
        </script>
    </div>
</main>
<?= $this->endSection(); ?>