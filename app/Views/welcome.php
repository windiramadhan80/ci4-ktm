<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<div class="container mt-5">
    <div class="container d-flex justify-content-center">
        <div class="search input-group mb-3" style="width: 40%;">
            <input type="search" class="form-control text-center" placeholder="Search" aria-label="Search" name="search_text" id="search_text">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <?= view('Myth\Auth\Views\_message_block') ?>
        </div>
    </div>
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th scope="col" style="width: 5px;">No</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Action</th>
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
                        <a href="<?= base_url('home/detail/' . $k->id); ?>" class="badge bg-primary"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tbody class="bg-white searchdata " id="content">

        </tbody>
    </table>
</div>

<script type="text/javascript">
        $(document).ready(function(){

            load_data();

            function load_data(query)
            {
                $.ajax({
                    url:"<?php echo base_url(); ?>home/fetch",
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