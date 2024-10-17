<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> PENAWARAN MATAKULIAH</h1>
                <a href="<?= base_url() ?>Akademik/Aturkelas/Tawarmatkul?idthnkls=<?= $mthnak->idthn?>&idprodikls=<?= $mprodi->idprodi?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <form action="<?= base_url() ?>Akademik/Aturkelas/Tawarmatkul/simpan/<?= $jenis ?>" method="post">
                        <input type="hidden" name="idkelas" value="<?= $jenis == 'EDIT' ? $tkelas->idkelas : '' ?>">
                        <div class="card-body">
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right"> PRODI</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="idprodikls" id="idprodikls">
                                        <option value="<?= $mprodi->idprodi?>"><?= $mprodi->namaprodi?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">TAHUN AKADEMIK</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="idthnkls" id="idthnkls">
                                        <option value="<?= $mthnak->idthn?>"><?= $mthnak->tahunakad?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">MATAKULIAH</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="idmtkkls" id="idmtkkls">
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <?php foreach ($matkul as $mtk): ?>
                                            <option value="<?= $mtk['idmtk'] ?>" <?php if($jenis == 'EDIT'):?><?php if($mtk['idmtk'] == $tkelas->idmtkkls):?>selected<?php endif;?><?php endif;?>><?= $mtk['namamtk'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">DOSEN</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="namadosen" id="namadosen">
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <?php foreach ($mdosen as $mdsn): ?>
                                            <option value="<?= $mdsn['iddosen'] ?>" <?php if($jenis == 'EDIT'):?><?php if($mdsn['iddosen'] == $tkelas->iddosenkelas):?>selected<?php endif;?><?php endif;?>><?= $mdsn['namadosen'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">KAPASITAS KELAS</label>
                                <div class="col-sm-2">
                                    <input  type="number" class="form-control" name="kapasitaskelas" id="kapasitaskelas" maxlength="3" <?php if($jenis == 'EDIT'):?>value="<?= $tkelas->kapasitaskelas ?>"<?php endif;?> required>
                                </div>
                            </div>       
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">JUMLAH PESERTA</label>
                                <div class="col-sm-2">
                                    <input  type="number" class="form-control" name="jumpeserta" id="jumpeserta" maxlength="3" <?php if($jenis == 'EDIT'):?>value="<?= $tkelas->jumpeserta ?>"<?php endif;?> required>
                                </div>
                            </div>    
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">RUANG</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="ruang" id="ruang">
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <?php foreach ($mruang as $ruang): ?>
                                            <option value="<?= $ruang['koderuang'] ?>" <?php if($jenis == 'EDIT'):?><?php if($ruang['koderuang'] == $tkelas->koderuangkelas):?>selected<?php endif;?><?php endif;?>><?= $ruang['namaruang'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">HARI</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="harikelas" id="harikelas">
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="SENIN" <?php if($jenis == 'EDIT'):?><?php if("SENIN" == $tkelas->harikelas):?>selected<?php endif;?><?php endif;?>>SENIN</option>
                                        <option value="SELASA" <?php if($jenis == 'EDIT'):?><?php if("SELASA" == $tkelas->harikelas):?>selected<?php endif;?><?php endif;?>>SELASA</option>
                                        <option value="RABU" <?php if($jenis == 'EDIT'):?><?php if("RABU" == $tkelas->harikelas):?>selected<?php endif;?><?php endif;?>>RABU</option>
                                        <option value="KAMIS" <?php if($jenis == 'EDIT'):?><?php if("KAMIS" == $tkelas->harikelas):?>selected<?php endif;?><?php endif;?>>KAMIS</option>
                                        <option value="JUMAT" <?php if($jenis == 'EDIT'):?><?php if("JUMAT" == $tkelas->harikelas):?>selected<?php endif;?><?php endif;?>>JUMAT</option>
                                        <option value="SABTU" <?php if($jenis == 'EDIT'):?><?php if("SABTU" == $tkelas->harikelas):?>selected<?php endif;?><?php endif;?>>SABTU</option>
                                        <option value="MINGGU" <?php if($jenis == 'EDIT'):?><?php if("MINGGU" == $tkelas->harikelas):?>selected<?php endif;?><?php endif;?>>MINGGU</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">JAM MULAI</label>
                                <div class="col-sm-2">
                                    <input  type="time" class="form-control" name="jammulai" id="jammulai" maxlength="1" <?php if($jenis == 'EDIT'):?>value="<?= $tkelas->jammulaikelas ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">JAM SELESAI</label>
                                <div class="col-sm-2">
                                    <input  type="time" class="form-control" name="jamselesai" id="jamselesai" maxlength="1" <?php if($jenis == 'EDIT'):?>value="<?= $tkelas->jamselesaikelas ?>"<?php endif;?> required>
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
    function cekIdkelas()
    {
        var idkelas = document.getElementById('idkelas');
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var response = ajax.responseText;
                console.log(response);
                if(response == '201'){
                    toastr.error('Id Kelas sudah digunakan');
                    idkelas.setAttribute('placeholder',idkelas.value);
                    idkelas.value = '';
                }
            }
        }
        ajax.open('POST','<?= base_url() ?>BE/Kelas/ajax_cekIdKelas',true);
        ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
        ajax.send('idkelas='+idkelas.value);
    }

</script>