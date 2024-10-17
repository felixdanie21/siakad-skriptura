<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA KOMPONEN PENILAIAAN</h1>
                <a href="<?= base_url() ?>Akademik/Matakuliah/Komponenpnl"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <form action="<?= base_url() ?>Akademik/Matakuliah/Komponenpnl/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">KODE PENILAIAAN</label>
                                <div class="col-sm-3">
                                    <input onchange="cekIDJnsmtk()" type="text" class="form-control" name="kodepenilaian" id="kodepenilaian" maxlength="10" <?php if($jenis == 'TAMBAH'):?>required<?php else:?>value="<?= $mkomnil->kodepenilaian  ?>" readonly<?php endif;?>>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">NAMA NAMA PENILAIAAN</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="namapenilaian" id="namapenilaian" maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?= $mkomnil->namapenilaian ?>"<?php endif;?> required>
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
        var idjenis = document.getElementById('kodepenilaian');
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var response = ajax.responseText;
                console.log(response);
                if(response == '201'){
                    toastr.error('Kode Penilaiaan digunakan');
                    kodepenilaian.setAttribute('placeholder',kodepenilaian.value);
                    kodepenilaian.value = '';
                }
            }
        }
        ajax.open('POST','<?= base_url() ?>Akademik/Matakuliah/Komponenpnl/ajax_cekIdJnsmtk',true);
        ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
        ajax.send('kodepenilaian='+kodepenilaian.value);
    }
</script>