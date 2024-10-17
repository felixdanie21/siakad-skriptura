<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> MATAKULIAH DOSEN</h1>
                <a href="<?= base_url() ?>Akademik/Dosen/Matkuldosen/?iddosenmtk=<?= $mdosen->iddosen ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <form action="<?= base_url() ?>Akademik/Dosen/Matkuldosen/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                        <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">NAMA DOSEN</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="iddosenmtk" id="iddosenmtk">
                                        <option value="<?= $mdosen->iddosen?>"><?= $mdosen->namadosen?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">MATAKULIAH DOSEN</label>
                                <div class="col-sm-8">
                                    <select class="form-control " id="idmtkdsn" name="idmtkdsn">
                                        <option value="" disabled selected>--PILIH--</option>
                                        <?php foreach ($matkul as $mb): ?>
                                            <option value="<?= $mb['idmtk']?>" <?php if($jenis == 'EDIT'):?><?php if($mdsnmtk->idmtkdsn == $mb['idmtk']):?>selected<?php endif;?><?php endif;?>><?=$mb['namamtk']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="old_idmtkdsn" value="<?= $jenis == 'EDIT' ? $mdsnmtk->idmtkdsn : '' ?>">
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
    function cekIdMtksyarat()
    {
        var idmtksyarat = document.getElementById('idmtkdsn');
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var response = ajax.responseText;
                console.log(response);
                if(response == '201'){
                    toastr.error('Id Matakuliah sudah digunakan');
                    idmtkdsn.setAttribute('placeholder',idmtkdsn.value);
                    idmtkdsn.value = '';
                }
            }
        }
        ajax.open('POST','<?= base_url() ?>Akademik/Dosen/Matkuldosen/ajax_cekIdMtksyr',true);
        ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
        ajax.send('idmtkdsn='+idmtkdsn.value);
    }

</script>