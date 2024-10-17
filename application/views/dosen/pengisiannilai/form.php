<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA PENGISISAN PENILAIAAN</h1>
                <a href="<?= base_url() ?>Dosen/Pengisiannilai/Nilaimahasiswa/index_komponenpnl/<?= $mhsbio->idnim ?>?idkelaskrs=<?= $tkelas->idkelas ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <form action="<?= base_url() ?>Dosen/Pengisiannilai/Nilaimahasiswa/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">NIM</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="idnimnil" id="idnimnil" maxlength="20" value="<?=$mhsbio->idnim?>" <?php if($jenis == 'TAMBAH'):?><?php endif;?> required readonly>
                                        </div>
                                    </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">NAMA MAHASISWA</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="namamhs" id="namamhs" maxlength="20" value="<?=$mhsbio->namamhs?>" required readonly>
                                        </div>
                                    </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">KODE KELAS</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="idkelas" id="idkelas" maxlength="20" value="<?= $tkelas->idkelas?>" <?php if($jenis == 'EDIT'):?>value="<?= $tnildetkom->idkelas ?>"<?php endif;?> required readonly>
                                </div>
                            </div>
                                <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">PENILAIIAN</label>
                                <div class="col-sm-5">
                                <select class="form-control" name="kodepenilaian" id="kodepenilaian" onchange="cekKomponen()" >
                                        <option class="text-center" value="" disabled selected>-- PILIH PENILAIAN --</option>
                                            <?php foreach ($tkomnilbot as $mk):?>
                                            <option value="<?= $mk['kodepenilaian']?>" <?php if($jenis == 'EDIT'):?><?php if($mk['kodepenilaian'] == $tnildetkom->kodepenilaian):?>selected<?php endif;?><?php endif;?>><?= $mk['namapenilaian'] ?></option>
                                            <?php endforeach; ?>
                                </select>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" name="bobotprosen" id="bobotprosen1" maxlength="20" value="" required >
                            <input type="hidden" class="form-control" name="idthnkls" id="idthnkls1" maxlength="20" value="" required >
                            <input type="hidden" class="form-control" name="idmtkkls" id="idmtkkls1" maxlength="20" value="" required >

                        <div class="form-group row mb-1">
                            <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">NILAI ANGKA</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nilangka" id="nilangka" maxlength="20"  <?php if($jenis == 'EDIT'):?>value="<?=$tnildetkom->nilangka?> "<?php endif;?> required >
                                    </div>
                                </div>
                            <input type="hidden" class="form-control" name="bobotprosen" id="bobotprosen1" maxlength="20"  <?php if($jenis == 'EDIT'):?>value="<?=$tnildetkom->nilangka?> "<?php endif;?> required >

                        <div class="form-group row mb-1">
                            <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">NILAI PEROLEHAN</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nilperolehan" id="nilperolehan" value=""  maxlength="20" <?php if($jenis == 'EDIT'):?>value="<?=$tnildetkom->nilperolehan?>" <?php endif;?> required readonly>

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
    function cekKomponen() {
    var kodepenilaian = document.getElementById('kodepenilaian').value;
    var idkelas = document.getElementById('idkelas').value;
    var nilperolehanElem = document.getElementById('bobotprosen1');
    var idthnklsValue = document.getElementById('idthnkls1');
    var idmtkklsValue = document.getElementById('idmtkkls1');
    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            try {
                var data = JSON.parse(ajax.responseText);

                if (data.status === '201') {
                    nilperolehanElem.value = data.bobotprosen;
                    idthnklsValue.value = data.idthnkls;
                    idmtkklsValue.value = data.idmtkkls;
                } else {
                }
            } catch (e) {
                console.error("Error parsing JSON:", e);
            }
        }
    }

    ajax.open('POST', '<?= base_url() ?>Dosen/Pengisiannilai/Nilaimahasiswa/ajax_cekRiwayat', true);
    ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    ajax.send('idkelas=' + idkelas + '&kodepenilaian=' + kodepenilaian);
}
</script>
<script>
    // Fungsi untuk menghitung nilai perolehan
    function hitungNilaiPerolehan() {
        // Ambil nilai kodepenilaian, bobotprosen1, dan nilangka
        var kodepenilaian = document.getElementById('kodepenilaian').value;
        var bobotprosen1 = document.getElementById('bobotprosen1').value;
        var nilangka = document.getElementById('nilangka').value;

        // Set nilai bobotprosen1 jika kodepenilaian sudah terisi
        if (kodepenilaian && !bobotprosen1) {
            // Misalnya, kita set nilai bobotprosen1 ke 20 jika kodepenilaian sudah ada
            document.getElementById('bobotprosen1').value = 20;
            bobotprosen1 = 20; // Update nilai bobotprosen1
        }

        // Hitung nilai perolehan jika bobotprosen1 dan nilangka telah diisi
        if (bobotprosen1) {
            var nilaiPerolehan = (bobotprosen1 / 100) * nilangka;
            nilaiPerolehan = Math.round(nilaiPerolehan);
            document.getElementById('nilperolehan').value = nilaiPerolehan;
        }
    }

    // Panggil fungsi saat ada perubahan nilai nilangka
    document.getElementById('nilangka').addEventListener('input', hitungNilaiPerolehan);

    // Panggil fungsi saat ada perubahan nilai bobotprosen1
    document.getElementById('bobotprosen1').addEventListener('input', hitungNilaiPerolehan);

    // Jalankan fungsi untuk mengisi bobotprosen1 jika kodepenilaian sudah terisi
    hitungNilaiPerolehan();
</script>