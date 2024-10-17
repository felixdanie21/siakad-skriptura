<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">DATA PERGURUAN TINGGI</h1>
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
                    <form action="<?= base_url() ?>Konfigurasi/datapt/simpan" method="post" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="logolama" value="<?= $midenpt->ptlogo ?>">
                        <div class="card-body">
                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="font-weight-normal">JENIS</label>
                                <select onchange="setJenisPimpinan()" class="form-control" name="ptjenis" id="ptjenis" required>
                                    <option value="" disabled selected>-- PILIH JENIS PERGURUAN TINGGI --</option>
                                    <option value="U" <?php if($midenpt->ptjenis == 'U'):?>selected<?php endif;?>>UNIVERSITAS</option>
                                    <option value="S" <?php if($midenpt->ptjenis == 'S'):?>selected<?php endif;?>>SEKOLAH TINGGI</option>
                                    <option value="I" <?php if($midenpt->ptjenis == 'I'):?>selected<?php endif;?>>INSTITUS</option>
                                </select>
                            </div>
                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="font-weight-normal">NAMA</label>
                                <input type="text" class="form-control" name="ptnama" value="<?= $midenpt->ptnama ?>"  maxlength="50" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="font-weight-normal">ALAMAT</label>
                                <input type="text" class="form-control" name="ptalamat" value="<?= $midenpt->ptalamat ?>"  maxlength="100" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="exampleInputEmail1" class="font-weight-normal">NAMA <span id="jenispimpinan"><?php if($midenpt->ptjbtpim != ''):?>REKTOR<?php else:?>PIMPINAN<?php endif;?></span></label>
                                <input type="text" class="form-control" name="ptpimpinan" value="<?= $midenpt->ptpimpinan ?>"  maxlength="40" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="exampleInputFile" class="font-weight-normal">LOGO PERGURUAN TINGGI</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input onchange="return checkFile(this);" type="file" class="custom-file-input" id="ptlogo" name="ptlogo">
                                        <label class="custom-file-label" for="exampleInputFile">UPLOAD GAMBAR</label>
                                    </div>
                                </div>
                                <img style="width:100%;" class="mt-2" id="previewimg" src="<?= base_url() ?>assets/img/<?= $midenpt->ptlogo ?>">
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
    const inputFile = document.getElementById('ptlogo');
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

    function setJenisPimpinan()
    {
        var ptjenis = document.getElementById('ptjenis');
        var jenispimpinan = document.getElementById('jenispimpinan');

        if(ptjenis.value == 'U'){
            jenispimpinan.innerHTML = 'REKTOR';
        } else if(ptjenis.value == 'S'){
            jenispimpinan.innerHTML = 'KETUA';
        } else if(ptjenis.value == "I"){
            jenispimpinan.innerHTML = 'DIREKTUR';
        }
    }
</script>