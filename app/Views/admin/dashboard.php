<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Selamat Datang <?= (user()->name == null) ? esc(user()->username) : esc(user()->name); ?></h1>
    </div>
</main>
<?= $this->endSection(); ?>
