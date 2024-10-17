<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA DOSEN</h1>
                <a href="<?= base_url() ?>Akademik/Dosen/Data?idprodidosen=<?= $mprodi->idprodi?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <form action="<?= base_url() ?>Akademik/Dosen/Data/simpan/<?= $jenis ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                        <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">PRODI</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="idprodidosen" id="idprodidosen">
                                        <option value="<?= $mprodi->idprodi?>"><?= $mprodi->namaprodi?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">KODE DOSEN</label>
                                <div class="col-sm-7">
                                <input onchange="cekIdDosen()" type="text" class="form-control" name="iddosen" id="iddosen" maxlength="10" <?php if($jenis == 'TAMBAH'):?>required<?php else:?>value="<?= $mdosen->iddosen ?>" readonly<?php endif;?>>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">NIDN</label>
                                <div class="col-sm-5">
                                    <input  type="text" class="form-control" name="nomornidn" id="nomornidn" maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?= $mdosen->nomornidn ?>"<?php endif;?> required>
                                </div>
                                    </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">NAMA DOSEN</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="namadosen" id="namadosen" maxlength="50" <?php if($jenis == 'EDIT'):?>value="<?= $mdosen->namadosen ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">GELAR DEPAN</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="gelardepan" id="gelardepan" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="Ir." <?php if($jenis == 'EDIT' && $mdosen->gelardepan == 'Ir.'): ?>selected<?php endif; ?>>Ir.</option>
                                        <option value="Pdt." <?php if($jenis == 'EDIT' && $mdosen->gelardepan == 'Pdt.'): ?>selected<?php endif; ?>>Pdt.</option>
                                        <option value="mpd" <?php if($jenis == 'EDIT' && $mdosen->gelardepan == 'mpd'): ?>selected<?php endif; ?>>mpd</option>
                                    </select>      
                                </div>
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">GELAR BELAKANG</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="gelarbelakang" id="gelarbelakang" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="S.Th." <?php if($jenis == 'EDIT' && $mdosen->gelarbelakang == 'S.Th.'): ?>selected<?php endif; ?>>S.Th.</option>
                                        <option value="M.Th." <?php if($jenis == 'EDIT' && $mdosen->gelarbelakang == 'M.Th.'): ?>selected<?php endif; ?>>M.Th.</option>
                                        <option value="M.Si." <?php if($jenis == 'EDIT' && $mdosen->gelarbelakang == 'M.Si.'): ?>selected<?php endif; ?>>M.Si.</option>
                                    </select>      
                                </div>
                            </div>   
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">NAMA LENGKAP DOSEN</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="namalengkap" id="namalengkap" maxlength="50" <?php if($jenis == 'EDIT'):?>value="<?= $mdosen->namalengkap ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">TANGGAL LAHIR DOSEN</label>
                                <div class="col-sm-3">
                                    <input  type="date" class="form-control" name="tgllhrdosen" id="tgllhrdosen" maxlength="50" <?php if($jenis == 'EDIT'):?>value="<?= $mdosen->tgllhrdosen ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">TEMPAT LAHIR</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="tptlhrdosen" id="tptlhrdosen" maxlength="50" <?php if($jenis == 'EDIT'):?>value="<?= $mdosen->tptlhrdosen ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">NO WHATSAPP</label>
                                <div class="col-sm-5">
                                    <input  type="text" class="form-control" name="nomorwa" id="nomorwa" maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?= $mdosen->nomorwa ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">EMAIL PT</label>
                                <div class="col-sm-7">
                                    <input  type="email" class="form-control" name="emailpt" id="emailpt" maxlength="40" <?php if($jenis == 'EDIT'):?>value="<?= $mdosen->emailpt ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">EMAIL PRIBADI</label>
                                <div class="col-sm-7">
                                    <input  type="email" class="form-control" name="emailpribadi" id="emailpribadi" maxlength="40" <?php if($jenis == 'EDIT'):?>value="<?= $mdosen->emailpribadi ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">ALAMAT TINGGAL</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="alamattinggal" id="alamattinggal" maxlength="40" <?php if($jenis == 'EDIT'):?>value="<?= $mdosen->alamattinggal ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">NIK DOSEN</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="nikdosen" id="nikdosen" maxlength="40" <?php if($jenis == 'EDIT'):?>value="<?= $mdosen->nikdosen ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">IKATAN KERJA</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="ikatankerja" id="ikatankerja" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="Dosen Honore" <?php if($jenis == 'EDIT' && $mdosen->ikatankerja == 'Dosen Honore'): ?>selected<?php endif; ?>>Dosen Honore</option>
                                        <option value="Dosen Tetap" <?php if($jenis == 'EDIT' && $mdosen->ikatankerja == 'Dosen Tetap'): ?>selected<?php endif; ?>>Dosen Tetap</option>
                                    </select>      
                                </div>
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">JENIS KELAMIN</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="jnsklmdsn" id="jnsklmdsn" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="L" <?php if($jenis == 'EDIT' && $mdosen->jnsklmdsn == 'L'): ?>selected<?php endif; ?>>Laki-laki</option>
                                        <option value="P" <?php if($jenis == 'EDIT' && $mdosen->jnsklmdsn == 'P'): ?>selected<?php endif; ?>>Perempuan</option>
                                    </select>      
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">JABATAN AKADEMIK</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="jbtakad" id="jbtakad" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="Tenaga Pengajar" <?php if($jenis == 'EDIT' && $mdosen->jbtakad == 'Tenaga Pengajar'): ?>selected<?php endif; ?>>Tenaga Pengajar</option>
                                        <option value="Asisten Ahli" <?php if($jenis == 'EDIT' && $mdosen->jbtakad == 'Asisten Ahli'): ?>selected<?php endif; ?>>Asisten Ahli</option>
                                    </select>      
                                </div>
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">AKTA MENGAJAR</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="gelartinggi" id="gelartinggi" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="S1" <?php if($jenis == 'EDIT' && $mdosen->gelartinggi == 'S1'): ?>selected<?php endif; ?>>S1</option>
                                        <option value="S2" <?php if($jenis == 'EDIT' && $mdosen->gelartinggi == 'S2'): ?>selected<?php endif; ?>>S2</option>
                                        <option value="S3" <?php if($jenis == 'EDIT' && $mdosen->gelartinggi == 'S3'): ?>selected<?php endif; ?>>S3</option>
                                    </select>      
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">PENDIDIKAN TERTINGGI</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="aktaajar" id="aktaajar" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="Y" <?php if($jenis == 'EDIT' && $mdosen->aktaajar == 'Y'): ?>selected<?php endif; ?>>Y</option>
                                        <option value="T" <?php if($jenis == 'EDIT' && $mdosen->aktaajar == 'T'): ?>selected<?php endif; ?>>T</option>
                                    </select>      
                                </div>
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">SURAT IJIN MENGAJAR</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="ijinajar" id="ijinajar" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="Y" <?php if($jenis == 'EDIT' && $mdosen->ijinajar == 'Y'): ?>selected<?php endif; ?>>Y</option>
                                        <option value="T" <?php if($jenis == 'EDIT' && $mdosen->ijinajar == 'T'): ?>selected<?php endif; ?>>T</option>
                                    </select>      
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">AKTIFITAS MENGAJAR DOSEN</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="aktifitas" id="aktifitas" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="Aktif Mengajar" <?php if($jenis == 'EDIT' && $mdosen->aktifitas == 'Aktif Mengajar') echo 'selected'; ?>>Aktif Mengajar</option>
                                        <option value="Tidak Aktif Mengajar" <?php if($jenis == 'EDIT' && $mdosen->aktifitas == 'Tidak Aktif Mengajar') echo 'selected'; ?>>Tidak Aktif Mengajar</option>
                                    </select>      
                                </div>
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">STATUS AKTIF DOSEN</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="stataktdsn" id="stataktdsn" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <option value="A" <?php if($jenis == 'EDIT' && $mdosen->stataktdsn == 'A') echo 'selected'; ?>>Aktif</option>
                                        <option value="N" <?php if($jenis == 'EDIT' && $mdosen->stataktdsn == 'N') echo 'selected'; ?>>Non-Aktif</option>
                                        <option value="C" <?php if($jenis == 'EDIT' && $mdosen->stataktdsn == 'C') echo 'selected'; ?>>Cuti</option>
                                        <option value="T" <?php if($jenis == 'EDIT' && $mdosen->stataktdsn == 'T') echo 'selected'; ?>>Tugas-Belajar</option>
                                    </select>      
                                </div>
                            </div>
                            <div class="form-group row mb-">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">FOTO DOSEN</label>
                                <div class="col-sm-7">
                                    <input type="file" class="form-control" name="fotodosen" id="fotodosen" maxlength="40" >
                                </div>
                            </div>
                            <?php if ($jenis == 'EDIT' && !empty($mdosen->fotodosen)) : ?>
                            <div class="form-group row mb-">
                                <label class="col-sm-3 col-form-label text-sm-right font-weight-normal">Foto Saat Ini:</label>
                                <div class="col-sm-7">
                                    <p>
                                    <img style="width: 40px; height: 40px;" src="<?= base_url('assets/img/'.$mdosen->fotodosen) ?>" alt="">
                                    </p>
                                </div>
                            </div>
<?php endif; ?>

                            
                    
                        
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
    function cekIdDosen()
    {
        var iddosen = document.getElementById('iddosen');
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4 && ajax.status == 200)
            {
                var response = ajax.responseText;
                console.log(response);
                if(response == '201'){
                    toastr.error('Id Dosen sudah digunakan');
                    iddosen.setAttribute('placeholder',iddosen.value);
                    iddosen.value = '';
                }
            }
        }
        ajax.open('POST','<?= base_url() ?>BE/Dosen/ajax_cekIdDosen',true);
        ajax.setRequestHeader('Content-type','Application/x-www-form-urlencoded');
        ajax.send('iddosen='+iddosen.value);
    }

</script>