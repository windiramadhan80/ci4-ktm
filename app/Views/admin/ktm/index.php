<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Kartu Tanda Mahasiswa</h1>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <?= view('Myth\Auth\Views\_message_block') ?>
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="search input-group mt-4" style="width: 40%;">
                <input type="search" class="form-control text-center" placeholder="Search" aria-label="Search" name="search_text" id="search_text">
            </div>
        </div>
        <a href="<?= base_url('ktm/create'); ?>" class="btn btn-primary my-3">Tambah KTM</a>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Program Studi</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Image</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="alldata ">
                <?php $i = 1; ?>
                <?php foreach ($ktm as $k) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= esc($k->name); ?></td>
                        <td><?= esc($k->program_studi); ?></td>
                        <td>
                            <?= $k->nim == null ? 'Kosong' : esc($k->nim); ?>
                        </td>
                        <td><img style="width: 30px;" src="<?= base_url('img/' . $k->image); ?>"></td>
                        <td>
                            <a href="<?= base_url('ktm/detail/' . $k->id); ?>" class="badge bg-primary"><i class="fa-solid fa-eye"></i></a>
                            <a href="<?= base_url('ktm/edit/' . $k->id); ?>" class="badge bg-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form action="<?= base_url('ktm/delete/' . $k->id); ?>" method="POST" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="badge bg-danger border-0" onclick="return confirm('Apakah yakin ingin dihapus?')"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
            <tbody class="bg-white searchdata " id="content">

            </tbody>
        </table>
    </div>
</main>

<script type="text/javascript">
        $(document).ready(function(){

            load_data();

            function load_data(query)
            {
                $.ajax({
                    url:"<?php echo base_url(); ?>ktm/fetch",
                    method:"POST",
                    data:{query:query},
                    success:function(data){
                        $('#content').html(data);
                    }
                })
            }
            
            var search = $(this).val();
            if(search == '') {
                $('.searchdata').hide();
            }

            $('#search_text').keyup(function(){
                $('.alldata').hide();
                $('.searchdata').show();
                var search = $(this).val();

                if(search != '')
                {
                    load_data(search);
                }
                else
                {
                    load_data();
                }
            });

            
        });
</script>
<?= $this->endSection(); ?>