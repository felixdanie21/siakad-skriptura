<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA MATAKULIAH</h1>
                <a href="<?= base_url() ?>Akademik/Matakuliah/Data?idkurmtk=<?= $mkurikulum->idkuri?>&idprodimtk=<?= $mprodi->idprodi?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <form action="<?= base_url() ?>Akademik/Matakuliah/Data/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">PRODI</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="idprodimtk" id="idprodimtk">
                                        <option value="<?= $mprodi->idprodi?>"><?= $mprodi->namaprodi?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">KURIKULUM</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="idkurmtk" id="idkurmtk">
                                        <option value="<?= $mkurikulum->idkuri?>"><?= $mkurikulum->namakuri?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">KODE MATAKULIAH</label>
                                <div class="col-sm-7">
                                <input onchange="cekIdMatkul()" type="text" class="form-control" name="idmtk" id="idmtk" maxlength="15" <?php if($jenis == 'TAMBAH'):?>required<?php else:?>value="<?= $matkul->idmtk ?>" readonly<?php endif;?>>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NAMA MATAKULIAH</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="namamtk" id="namamtk" maxlength="50" <?php if($jenis == 'EDIT'):?>value="<?= $matkul->namamtk ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">SEMESTER</label>
                                <div class="col-sm-2">
                                    <input  type="text" class="form-control" name="smsmtk" id="smsmtk" maxlength="1" <?php if($jenis == 'EDIT'):?>value="<?= $matkul->smsmtk ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">SKS</label>
                                <div class="col-sm-2">
                                    <input  type="text" class="form-control" name="sksmtk" id="sksmtk" maxlength="1" <?php if($jenis == 'EDIT'):?>value="<?= $matkul->sksmtk ?>"<?php endif;?> required>
                                </div>
                            </div>
                    
                            <div class="form-group row mb-">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">JENIS MATAKULIAH</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="jnsmtk" id="jnsmtk">
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <?php foreach ($mjenis as $jns): ?>
                                            <option value="<?= $jns['idjenis'] ?>" <?php if($jenis == 'EDIT'):?><?php if($jns['idjenis'] == $matkul->jnsmtk):?>selected<?php endif;?><?php endif;?>><?= $jns['namajenis'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">JENIS SEMESTER</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="jnssms" id="jnssms" required>
                                            <option value="" disabled selected>-- PILIH --</option>
                                            <option value="1" <?php if($jenis == 'EDIT' && $matkul->jnssms == '1'): ?>selected<?php endif; ?>>Gasal</option>
                                            <option value="2" <?php if($jenis == 'EDIT' && $matkul->jnssms == '2'): ?>selected<?php endif; ?>>Genap</option>
                                    </select>      
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">TIPE MATAKULIAH</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="tipemtk" id="tipemtk" required>
                                            <option value="" disabled selected>-- PILIH --</option>
                                            <option value="W" <?php if($jenis == 'EDIT' && $matkul->tipemtk == 'W'): ?>selected<?php endif; ?>>Wajib</option>
                                            <option value="P" <?php if($jenis == 'EDIT' && $matkul->tipemtk == 'P'): ?>selected<?php endif; ?>>Pilihan</option>
                                    </select>      
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NILAI LULUS</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="nilailulus" id="nilailulus" required>
                                            <option value="" disabled selected>-- PILIH --</option>
                                            <option value="A" <?php if($jenis == 'EDIT' && $matkul->nilailulus == 'A'): ?>selected<?php endif; ?>>A</option>
                                            <option value="A-" <?php if($jenis == 'EDIT' && $matkul->nilailulus == 'A-'): ?>selected<?php endif; ?>>A-</option>
                                            <option value="B+" <?php if($jenis == 'EDIT' && $matkul->nilailulus == 'B+'): ?>selected<?php endif; ?>>B+</option>
                                            <option value="B" <?php if($jenis == 'EDIT' && $matkul->nilailulus == 'B'): ?>selected<?php endif; ?>>B</option>
                                            <option value="B-" <?php if($jenis == 'EDIT' && $matkul->nilailulus == 'B-'): ?>selected<?php endif; ?>>B-</option>
                                            <option value="C+" <?php if($jenis == 'EDIT' && $matkul->nilailulus == 'C+'): ?>selected<?php endif; ?>>C+</option>
                                            <option value="C+" <?php if($jenis == 'EDIT' && $matkul->nilailulus == 'C+'): ?>selected<?php endif; ?>>C+</option>
                                            <option value="C" <?php if($jenis == 'EDIT' && $matkul->nilailulus == 'C'): ?>selected<?php endif; ?>>C</option>
                                            <option value="C-" <?php if($jenis == 'EDIT' && $matkul->nilailulus == 'C-'): ?>selected<?php endif; ?>>C-</option>
                                            <option value="D+" <?php if($jenis == 'EDIT' && $matkul->nilailulus == 'D+'): ?>selected<?php endif; ?>>D+</option>
                                            <option value="D" <?php if($jenis == 'EDIT' && $matkul->nilailulus == 'D'): ?>selected<?php endif; ?>>D</option>
                                            <option value="E" <?php if($jenis == 'EDIT' && $matkul->nilailulus == 'E'): ?>selected<?php endif; ?>>E</option>
                                    </select>      
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">KODE MATAKULIAH PDDIKTI</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="kodemtkpddikti" id="kodemtkpddikti" maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?= $matkul->kodemtkpddikti ?>"<?php endif;?> required>
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
    function cekIdMatkul()
    {
        var idmtk = document.getElementById('idmtk');
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var response = ajax.responseText;
                console.log(response);
                if(response == '201'){
                    toastr.error('Id Matakuliah sudah digunakan');
                    idmtk.setAttribute('placeholder',idmtk.value);
                    idmtk.value = '';
                }
            }
        }
        ajax.open('POST','<?= base_url() ?>Akademik/Matakuliah/Data/ajax_cekIdMatkul',true);
        ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
        ajax.send('idmtk='+idmtk.value);
    }

</script>