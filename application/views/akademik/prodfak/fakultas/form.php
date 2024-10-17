<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA FAKULTAS</h1>
                <a href="<?= base_url() ?>Akademik/Prodfak/Fakultas"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <form action="<?= base_url() ?>Akademik/Prodfak/Fakultas/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">ID FAKULTAS</label>
                                <div class="col-sm-5">
                                    <input onchange="cekIdFakultas()" type="text" class="form-control" name="idfak" id="idfak" maxlength="10" <?php if($jenis == 'TAMBAH'):?>required<?php else:?>value="<?= $mfakul->idfak ?>" readonly<?php endif;?>>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NAMA FAKULTAS</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="namafak" id="namafak" maxlength="50" <?php if($jenis == 'EDIT'):?>value="<?= $mfakul->namafak ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NOMOR URUT</label>
                                <div class="col-sm-2">
                                    <input onchange="cekUrutFakultas()" type="number" class="form-control" min="1" name="urutfak" id="urutfak" <?php if($jenis == 'EDIT'):?>value="<?= $mfakul->urutfak ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">DEKAN FAKULTAS</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="iddosendekan" id="iddosendekan" <?php if(count($mdosen)>0):?>required<?php endif;?>>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <?php foreach($mdosen as $d):?>
                                            <?php if($jenis == 'EDIT'):?>
                                                <option value="<?= $d['iddosen'] ?>" <?php if($d['iddosen'] == $mfakul->iddosendekan):?>selected<?php endif; ?>><?= $d['namalengkap'] ?></option>
                                            <?php else:?>
                                                <option value="<?= $d['iddosen'] ?>"><?= $d['namalengkap'] ?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
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
    function cekIdFakultas()
    {
        var idfak = document.getElementById('idfak');
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var response = ajax.responseText;
                console.log(response);
                if(response == '201'){
                    toastr.error('Id fakultas sudah digunakan');
                    idfak.setAttribute('placeholder',idfak.value);
                    idfak.value = '';
                }
            }
        }
        ajax.open('POST','<?= base_url() ?>Akademik/Prodfak/Fakultas/ajax_cekIdFakultas',true);
        ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
        ajax.send('idfak='+idfak.value);
    }

    function cekUrutFakultas()
    {
        var urutfak = document.getElementById('urutfak');
        <?php if($jenis == 'EDIT'):?>
            if(urutfak.value == '<?= $mfakul->urutfak ?>'){
                return false;
            }
        <?php endif;?>
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var response = ajax.responseText;
                console.log(response);
                if(response == '201'){
                    toastr.error('Nomor urut sudah digunakan');
                    urutfak.setAttribute('placeholder',urutfak.value);
                    urutfak.value = '';
                }
            }
        }
        ajax.open('POST','<?= base_url() ?>Akademik/Prodfak/Fakultas/ajax_cekUrutFakultas',true);
        ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
        ajax.send('urutfak='+urutfak.value);
    }
</script>