<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA MAHASISWA</h1>
                <a href="<?= base_url() ?>Akademik/Mahasiswa/Data?idprodimhs=<?= $mprodi->idprodi?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <form action="<?= base_url() ?>Akademik/Mahasiswa/Data/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                        <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">PRODI</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="idprodimhs" id="idprodimhs">
                                        <option value="<?= $mprodi->idprodi?>"><?= $mprodi->namaprodi?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NIM</label>
                                <div class="col-sm-4">
                                    <input onchange="cekIdMahasiswa()" type="text" class="form-control" name="idnim" id="idnim" maxlength="15" <?php if($jenis == 'TAMBAH'):?>required<?php else:?>value="<?= $mhsbio->idnim ?>" readonly<?php endif;?>>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NAMA MAHASISWA</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="namamhs" id="namamhs" maxlength="50" <?php if($jenis == 'EDIT'):?>value="<?= $mhsbio->namamhs ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">TANGGAL LAHIR</label>
                                <div class="col-sm-3">
                                    <input  type="date" class="form-control" name="tgllhrmhs" id="tgllhrmhs" <?php if($jenis == 'EDIT'):?>value="<?= $mhsbio->tgllhrmhs ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">TEMPAT LAHIR MAHASISWA</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="tptlhrmhs" id="tptlhrmhs" maxlength="50"  <?php if($jenis == 'EDIT'):?>value="<?= $mhsbio->tptlhrmhs ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">AGAMA MAHASISWA</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="agamamhs" id="agamamhs" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="I" <?php if($jenis == 'EDIT' && $mhsbio->agamamhs == 'I'): ?>selected<?php endif; ?>>ISLAM</option>
                                        <option value="P" <?php if($jenis == 'EDIT' && $mhsbio->agamamhs == 'P'): ?>selected<?php endif; ?>>PROTESTAN</option>
                                        <option value="C" <?php if($jenis == 'EDIT' && $mhsbio->agamamhs == 'C'): ?>selected<?php endif; ?>>CHATOLIK</option>
                                        <option value="H" <?php if($jenis == 'EDIT' && $mhsbio->agamamhs == 'H'): ?>selected<?php endif; ?>>HINDU</option>
                                        <option value="B" <?php if($jenis == 'EDIT' && $mhsbio->agamamhs == 'B'): ?>selected<?php endif; ?>>BUDHA</option>
                                        <option value="K" <?php if($jenis == 'EDIT' && $mhsbio->agamamhs == 'K'): ?>selected<?php endif; ?>>KONGHUCU</option>
                                    </select>      
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">JENIS KELAMIN</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="jnsklm" id="jnsklm" required>
                                            <option value="" disabled selected>-- PILIH --</option>
                                            <option value="L" <?php if($jenis == 'EDIT' && $mhsbio->jnsklm == 'L'): ?>selected<?php endif; ?>>LAKI-LAKI</option>
                                            <option value="P" <?php if($jenis == 'EDIT' && $mhsbio->jnsklm == 'P'): ?>selected<?php endif; ?>>PEREMPUAN</option>
                                    </select>      
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NO WHATSAPP</label>
                                <div class="col-sm-5">
                                    <input  type="number" class="form-control" name="nomorhpwa" id="nomorhpwa" maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?= $mhsbio->nomorhpwa ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">EMAIL STUDI</label>
                                <div class="col-sm-7">
                                    <input  type="email" class="form-control" name="emailstudi" id="emailstudi" maxlength="40" <?php if($jenis == 'EDIT'):?>value="<?= $mhsbio->emailstudi ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">EMAIL PRIBADI</label>
                                <div class="col-sm-7">
                                    <input  type="email" class="form-control" name="emailpribadi" id="emailpribadi" maxlength="40" <?php if($jenis == 'EDIT'):?>value="<?= $mhsbio->emailpribadi ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">ALAMAT SAAT STUDI</label>
                                <div class="col-sm-9">
                                    <input  type="text" class="form-control" name="alamatakhir" id="alamatakhir" maxlength="100" <?php if($jenis == 'EDIT'):?>value="<?= $mhsbio->alamatakhir ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">ALAMAT ASAL</label>
                                <div class="col-sm-9">
                                    <input  type="text" class="form-control" name="alamatasal" id="alamatasal" maxlength="100" <?php if($jenis == 'EDIT'):?>value="<?= $mhsbio->alamatasal ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">STATUS AKTIF</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="stataktif" id="stataktif" required>
                                            <option value="" disabled selected>-- PILIH --</option>
                                            <option value="A" <?php if($jenis == 'EDIT' && $mhsbio->stataktif == 'A'): ?>selected<?php endif; ?>>AKTIF</option>
                                            <option value="N" <?php if($jenis == 'EDIT' && $mhsbio->stataktif == 'N'): ?>selected<?php endif; ?>>NON-AKTIF</option>
                                            <option value="C" <?php if($jenis == 'EDIT' && $mhsbio->stataktif == 'C'): ?>selected<?php endif; ?>>CUTI</option>
                                            <option value="L" <?php if($jenis == 'EDIT' && $mhsbio->stataktif == 'L'): ?>selected<?php endif; ?>>LULUS</option>
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
    function cekIdMahasiswa()
    {
        var idnim = document.getElementById('idnim');
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var response = ajax.responseText;
                console.log(response);
                if(response == '201'){
                    toastr.error('Id Mahasiswa sudah digunakan');
                    idnim.setAttribute('placeholder',idnim.value);
                    idnim.value = '';
                }
            }
        }
        ajax.open('POST','<?= base_url() ?>Akademik/Mahasiswa/Data/ajax_cekIdMahasiswa',true);
        ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
        ajax.send('idnim='+idnim.value);
    }

</script>