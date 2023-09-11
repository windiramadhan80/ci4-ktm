<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">ADMIN</div>
                    <a class="nav-link <?= $title == 'Dashboard' ? 'active' : ''; ?>" href="<?= base_url('dashboard'); ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gauge-high"></i></div>
                        Dashboard
                    </a>

                    <div class="sb-sidenav-menu-heading" style="margin-top: -15px;">FITUR</div>
                    <a class="nav-link <?= uri_string() == "ktm" ? 'active' : ''; ?>" href="/ktm">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-image"></i></div>
                        Kartu Tanda mahasiswa
                    </a>
                </div>
            </div>
        </nav>
    </div>