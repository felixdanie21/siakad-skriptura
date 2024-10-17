<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA JENIS RUANGAN</h1>
                <a href="<?= base_url() ?>Akademik/Aturkelas/Ruangkuliah"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5 mx-auto">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= base_url() ?>Akademik/Aturkelas/Ruangkuliah/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">KODE RUANG</label>
                                <div class="col-sm-5">
                                    <input onchange="cekKoderuang()" type="text" class="form-control" name="koderuang" id="koderuang" maxlength="10" <?php if($jenis == 'TAMBAH'):?>required<?php else:?>value="<?= $mruang->koderuang ?>" readonly<?php endif;?>>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NAMA RUANG</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="namaruang" id="namaruang" maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?= $mruang->namaruang ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">KAPASITAS RUANG</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kapasitasruang" id="kapasitasruang" maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?= $mruang->kapasitasruang ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                            <label for="jenisruang" class="col-sm-3 col-form-label font-weight-normal text-sm-right">JENIS RUANG</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="jenisruang" id="jenisruang" required>
                                    <option value="" disabled>-- PILIH --</option>
                                    <option value="L" <?php if($jenis == 'EDIT' && $mruang->jenisruang == 'L'): ?>selected<?php endif; ?>>LAB</option>
                                    <option value="P" <?php if($jenis == 'EDIT' && $mruang->jenisruang == 'P'): ?>selected<?php endif; ?>>PRAKTIKUM</option>
                                    <option value="K" <?php if($jenis == 'EDIT' && $mruang->jenisruang == 'K'): ?>selected<?php endif; ?>>KULIAH</option>
                                </select>
                            </div>
                        </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">STATUS RUANG</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="statusruang" id="statusruang" maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?= $mruang->statusruang ?>"<?php endif;?> required>
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
    function cekKoderuang()
    {
        var koderuang = document.getElementById('koderuang');
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var response = ajax.responseText;
                console.log(response);
                if(response == '201'){
                    toastr.error('Kode Ruang sudah digunakan');
                    koderuang.setAttribute('placeholder',koderuang.value);
                    koderuang.value = '';
                }
            }
        }
        ajax.open('POST','<?= base_url() ?>BE/Ruang/ajax_cekKodeRuang',true);
        ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
        ajax.send('koderuang='+koderuang.value);
    }
</script>