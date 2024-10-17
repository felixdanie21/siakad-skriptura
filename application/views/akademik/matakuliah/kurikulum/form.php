<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA KURIKULUM</h1>
                <a href="<?= base_url() ?>Akademik/Matakuliah/kurikulum"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <form action="<?= base_url() ?>Akademik/Matakuliah/Kurikulum/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">ID KURIKULUM</label>
                                <div class="col-sm-3">
                                    <input onchange="ajax_cekIdMkurikulim()" type="text" class="form-control" name="idkuri" id="idkuri" maxlength="10" <?php if($jenis == 'TAMBAH'):?>required<?php else:?>value="<?= $mkurikulum->idkuri ?>" readonly<?php endif;?>>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">NAMA KURIKULUM</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="namakuri" id="namakuri" maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?= $mkurikulum->namakuri ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                            <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">STATUS AKTIF</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="statusaktifkuri" id="statusaktifkuri" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="A" <?php if($jenis == 'EDIT' && $mkurikulum->statusaktifkuri == 'A'): ?>selected<?php endif; ?>>Aktif</option>
                                        <option value="N" <?php if($jenis == 'EDIT' && $mkurikulum->statusaktifkuri == 'N'): ?>selected<?php endif; ?>>Non-aktif</option>
                                    </select>      
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">KETERANGAN KURIKULUM</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="ketkuri" id="ketkuri" maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?= $mkurikulum->statusaktifkuri ?>"<?php endif;?> required>
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
    function ajax_cekIdMkurikulim()
    {
        var idkuri = document.getElementById('idkuri');
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var response = ajax.responseText;
                console.log(response);
                if(response == '201'){
                    toastr.error('Id Kurikulum sudah digunakan');
                    idkuri.setAttribute('placeholder',idkuri.value);
                    idkuri.value = '';
                }
            }
        }
        ajax.open('POST','<?= base_url() ?>Akademik/Matakuliah/Kurikulum/ajax_cekIdMkurikulim',true);
        ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
        ajax.send('idkuri='+idkuri.value);
    }
</script>