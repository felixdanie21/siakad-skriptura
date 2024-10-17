<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA PROGRAM STUDI</h1>
                <a href="<?= base_url() ?>Akademik/Prodfak/Prodi"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-7 mx-auto">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= base_url() ?>Akademik/Prodfak/Prodi/simpan/<?= $jenis ?>" method="post" enctype="multipart/form-data">
                        <?php if($jenis == 'EDIT'):?>
                            <input type="hidden" name="gambarakrelama" id="gambarakrelama" value="<?= $mprodi->gambarakre ?>">
                        <?php endif;?>
                        <div class="card-body">
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">ID PRODI</label>
                                <div class="col-sm-5">
                                    <input onchange="cekIdProdi()" type="text" class="form-control" name="idprodi" id="idprodi" maxlength="15" <?php if($jenis == 'TAMBAH'):?>required<?php else:?>value="<?= $mprodi->idprodi ?>" readonly<?php endif;?>>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NAMA PRODI</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="namaprodi" id="namaprodi" maxlength="50" <?php if($jenis == 'EDIT'):?>value="<?= $mprodi->namaprodi ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NOMOR URUT</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" min="1" max="99" name="urutprodi" id="urutprodi" <?php if($jenis == 'EDIT'):?>value="<?= $mprodi->urutprodi ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">FAKULTAS</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="idfak" id="idfak" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <?php foreach($mfakul as $f):?>
                                            <?php if($jenis == 'EDIT'):?>
                                                <option value="<?= $f['idfak'] ?>" <?php if($f['idfak'] == $mprodi->idfak):?>selected<?php endif; ?>><?= $f['namafak'] ?></option>
                                            <?php else:?>
                                                <option value="<?= $f['idfak'] ?>"><?= $f['namafak'] ?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">KETUA PROGRAM STUDI</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="iddosenprodi" id="iddosenprodi" <?php if(count($mdosen)>0):?>required<?php endif;?>>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <?php foreach($mdosen as $d):?>
                                            <?php if($jenis == 'EDIT'):?>
                                                <option value="<?= $d['iddosen'] ?>" <?php if($d['iddosen'] == $mprodi->iddosenprodi):?>selected<?php endif; ?>><?= $d['namalengkap'] ?></option>
                                            <?php else:?>
                                                <option value="<?= $d['iddosen'] ?>"><?= $d['namalengkap'] ?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">STATUS AKREDITASI</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="statakreprodi" maxlength="15" id="statakreprodi" <?php if($jenis == 'EDIT'):?>value="<?= $mprodi->statakreprodi ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">JENJANG STUDI</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="jenjangstudi" id="jenjangstudi" maxlength="10" <?php if($jenis == 'EDIT'):?>value="<?= $mprodi->jenjangstudi ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group  row mb-1">
                                <label for="exampleInputFile"  class="col-sm-3 col-form-label font-weight-normal text-sm-right">GAMBAR AKREDITASI</label>
                                <div class="col-sm-9 input-group">
                                    <div class="custom-file">
                                        <input onchange="return checkFile(this);" type="file" class="custom-file-input" id="gambarakre" name="gambarakre">
                                        <label class="custom-file-label" for="exampleInputFile">UPLOAD GAMBAR</label>
                                    </div>
                                </div>
                                <img style="width:100%;" class="mt-2" id="previewimg" src="<?php if($jenis == 'EDIT'):?><?= base_url() ?>assets/img/prodi/<?= $mprodi->gambarakre ?><?php endif;?>">
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
    function cekIdProdi()
    {
        var idprodi = document.getElementById('idprodi');
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var response = ajax.responseText;
                console.log(response);
                if(response == '201'){
                    toastr.error('Id prodi sudah digunakan');
                    idprodi.setAttribute('placeholder',idprodi.value);
                    idprodi.value = '';
                }
            }
        }
        ajax.open('POST','<?= base_url() ?>Akademik/Prodfak/Prodi/ajax_cekIdProdi',true);
        ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
        ajax.send('idprodi='+idprodi.value);
    }

    const inputFile = document.getElementById('gambarakre');
    const previewImage = document.getElementById('previewimg');
    
    inputFile.addEventListener('change', function() {
    const file = inputFile.files[0];
    const reader = new FileReader();
    
    reader.addEventListener('load', function() {
        previewImage.src = reader.result;
    }, false);
    
    if (file) {
        reader.readAsDataURL(file);
    }
    }, false);

    function checkFile(fileInput) {
        const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // jenis file yang diizinkan
        if (!allowedExtensions.exec(fileInput.value)) {
            alert('File yang diunggah harus dalam format JPG, JPEG, atau PNG.'); // pesan error jika file tidak sesuai
            fileInput.value = ''; // membersihkan inputan file
            return false;
        }
        // jika file sesuai dengan jenis yang diizinkan
        return true;
    }

    inputFile.addEventListener('change', (event) => {
        const file = event.target.files[0];
        const fileSize = file.size; // ukuran file dalam byte
        const maxSize = 3 * 1024 * 1024; // ukuran maksimum file dalam byte (contoh: 2MB)

        if (fileSize > maxSize) {
            alert(`Ukuran file terlalu besar. Maksimum ukuran file adalah 3MB`);
            inputFile.value = ''; // reset nilai elemen input file
        }
    });
</script>