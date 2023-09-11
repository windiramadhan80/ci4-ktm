<nav class="navbar navbar-expand-lg navbar-dark bg-primary" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">KARTU TANDA MAHASISWA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto fw-bold">
                <a class="nav-link <?= uri_string() == "" ? 'active' : ''; ?>" href="/">Home</a>
                <a class="nav-link <?= uri_string() == "pendaftaran" ? 'active' : ''; ?>" href="/pendaftaran">Pendaftaran</a>
                <?php if (logged_in()) : ?>
                    <a href="/dashboard" class="nav-link" target="_blank">Dashboard</a>
                <?php else : ?>
                    <a href="/login" class="nav-link" target="_blank">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>