<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA KOMPONEN PENILAIAAN</h1>
                <a href="<?= base_url() ?>Dosen/Komponenpnl/Komponenpnl"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 mx-auto">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= base_url() ?>Dosen/Komponenpnl/Komponenpnl/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                    <div class="form-group row mb-1">
                        <label for="inputPassword" class="col-sm-5 col-form-label text-sm-right font-weight-normal">KODE KELAS</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="idkelasnil" id="idkelasnil" maxlength="20" value="<?=$tkelas->idkelas?>" required readonly>
                                </div>
                            </div>
                        <div class="form-group row mb-1">
                            <label for="inputPassword" class="col-sm-5 col-form-label text-sm-right font-weight-normal">NAMA DOSEN</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="namadosen" id="namadosen" maxlength="20" value="<?=$mdosen->namadosen?>" required readonly>
                                    </div>
                                </div>
                        <div class="form-group row mb-1">
                            <label for="inputPassword" class="col-sm-5 col-form-label text-sm-right font-weight-normal">NAMA MATAKULIAH</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="namamtk" id="namamtk" maxlength="20" value="<?=$tkelas->namamtk?>" required readonly>
                                    </div>
                                </div>
                        <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-5 col-form-label text-sm-right font-weight-normal">NAMA PENILAIAAN</label>
                                    <div class="col-sm-5">
                                        <select class="form-control" name="kodepenilaian" id="kodepenilaian">
                                        <option class="text-center" value="" disabled selected>-- PILIH PENILAIAAN --</option>
                                            <?php foreach ($mkomnil as $mk):?>
                                            <option value="<?= $mk['kodepenilaian']?>" <?php if($jenis == 'EDIT'):?><?php if($mk['kodepenilaian'] == $tkomnilbot->kodepenilaian):?>selected<?php endif;?><?php endif;?>><?= $mk['namapenilaian'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            <div class="form-group row mb-1">
                            <label for="inputPassword" class="col-sm-5 col-form-label text-sm-right font-weight-normal">BOBOT PRESENTASE</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="bobotprosen" id="bobotprosen" maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?= $tkomnilbot->bobotprosen ?>"<?php endif;?> required>
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