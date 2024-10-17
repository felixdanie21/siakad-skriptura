<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA JENIS MATAKULIAH</h1>
                <a href="<?= base_url() ?>Akademik/Matakuliah/Jenis"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 mx-auto">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= base_url() ?>Akademik/Matakuliah/Jenis/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">ID JENIS MATAKULIAH</label>
                                <div class="col-sm-3">
                                    <input onchange="cekIDJnsmtk()" type="text" class="form-control" name="idjenis" id="idjenis" maxlength="10" <?php if($jenis == 'TAMBAH'):?>required<?php else:?>value="<?= $mjnsmtk->idjenis ?>" readonly<?php endif;?>>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">NAMA JENIS MATAKULIAH</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="namajenis" id="namajenis" maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?= $mjnsmtk->namajenis ?>"<?php endif;?> required>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-primary">SIMPAN</button>
                        </div>
                    </form>
                </div>
            <!-- /.card -->
            </div>
        </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    function cekIDJnsmtk()
    {
        var idjenis = document.getElementById('idjenis');
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var response = ajax.responseText;
                console.log(response);
                if(response == '201'){
                    toastr.error('Id Jenis Matakuliah sudah digunakan');
                    idjenis.setAttribute('placeholder',idjenis.value);
                    idjenis.value = '';
                }
            }
        }
        ajax.open('POST','<?= base_url() ?>Akademik/Matakuliah/Jenis/ajax_cekIdJnsmtk',true);
        ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
        ajax.send('idjenis='+idjenis.value);
    }
</script>