<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"> KRS MANDIRI</h1>
                <a href="<?= base_url() ?>Mahasiswa/Rencanastudi/Krsmandiri"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <form action="<?= base_url() ?>Mahasiswa/Rencanastudi/Krsmandiri/simpan" method="post">
                        <div class="card-body">
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label text-sm-right font-weight-normal">NOMOR INDUK</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="idnimkls" id="idnimkls" maxlength="50" value="<?= $nim ?>" required readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-1 ">
                                    <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">PILIH KODE KELAS</label>
                                    <div class="col-sm-7">
                                        <select class="form-control col-8 mr-1" onchange="cekIdFakultas()" id="idkelas" name="idkelas">
                                            <option value="" disabled selected class="text-center">--PILIH KODE KELAS--</option>
                                            <?php foreach ($table as $mp): ?>
                                            <option value="<?= $mp['idkelas']?>"><?=$mp['idkelas']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            <div class="form-group row mb-1">
                                    <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">TAHUN AKADEMIK</label>
                                    <div class="col-sm-6">
                                        <select class="form-control col-8 mr-1"  id="idthnkls" name="idthnkls">
                                            <option value="" disabled selected>--TAHUN AKADEMIK--</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="form-group row mb-1">
                                    <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">PILIH MATAKULIAH</label>
                                    <div class="col-sm-6">
                                        <select class="form-control col-8 mr-1"  id="idmtkkls" name="idmtkkls">
                                            <option value="" disabled selected>--PILIH MATAKULIAH--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">PILIH DOSEN</label>
                                    <div class="col-sm-6">
                                        <select class="form-control col-8 mr-1" id="iddosenkelas" name="iddosenkelas">
                                        <option value="" disabled selected>--PILIH DOSEN--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">RIWAYAT MATAKULIAH</label>
                                    <div class="col-sm-6">
                                        <select class="form-control col-8 mr-1" onchange="cekIdFakultas()" id="rwymtkmhs" name="rwymtkmhs">
                                        <option value="" disabled selected>--RIWAYAT MATAKULIAH--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-1">
                                    <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">KAPASITAS KELAS</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="kapasitaskelas" id="kapasitaskelas" placeholder="KAPASITAS KELAS" maxlength="50"  required disabled>
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
<script src="<?= base_url();?>assets/js/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function(){
        loadDosenAndKapasitas();
        loadDosenAndKapasitass();
    });
    function loadDosenAndKapasitas() {
        $('#idkelas').change(function(){
            var getkelas = $('#idkelas').val();
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "<?= base_url()?>Mahasiswa/Rencanastudi/Krsmandiri/getkelas",
                data: {matkul: getkelas},
                success: function(data) {
                    console.log(data);
                    
                    var idthnkls = '';
                    var namamtk = '';
                    var dosenHtml = '';
                    var kapasitasHtml = '<input type="text" class="form-control" id="kapasitaskelas" disabled value="';
    
                    for (var i = 0; i < data.length; i++) {
                        dosenHtml += '<option value="' + data[i].namadosen + '">' + data[i].namadosen + '</option>';
                        namamtk += '<option value="' + data[i].idmtk + '">' + data[i].namamtk + '</option>';
                        idthnkls += '<option value="' + data[i].idthnkls + '">' + data[i].kettahunakad + '</option>';
                        kapasitasHtml += data[i].kapasitaskelas + ' ';
                        
                    }
    
                    kapasitasHtml += '">';
    
                    $('#iddosenkelas').html(dosenHtml).show();
                    $('#idmtkkls').html(namamtk).show();
                    $('#idthnkls').html(idthnkls).show();
                    $('#kapasitaskelas').replaceWith(kapasitasHtml);
                }
            });
        });
    }
    function cekIdFakultas() {
    var idkelas = document.getElementById('idkelas');
    var rwymtkmhs = document.getElementById('rwymtkmhs');
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var response = ajax.responseText;
            console.log(response);
            if (response == '201') {
                rwymtkmhs.innerHTML = '<option value="U" >Ulang</option>';
            } else {
                rwymtkmhs.innerHTML = '<option value="B">Baru</option>';
            }
        }
    }
    ajax.open('POST', '<?= base_url() ?>Mahasiswa/Rencanastudi/Krsmandiri/ajax_cekRiwayat', true);
    ajax.setRequestHeader('Content-type', 'Application/x-www-form-urlencoded');
    ajax.send('idkelas=' + idkelas.value);
}
 
</script>