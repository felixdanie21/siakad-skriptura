<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">RINCIAN KOMPONEN PENILAIAN</h1>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    <style>
        .table{
            background-color: #b1e6f7;

        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <form class="row container-fluid mb-2" action="<?= base_url() ?>Mahasiswa/Hasilstudi/Hasilstudisemester" method="post">
                    <select class="form-control col-3 mr-1" id="iddosen" name="iddosen">
                        <option value="" disabled selected>-- PILIH DOSEN --</option>
                        <?php foreach ($tkrs as $tk): ?>
                            <option value="<?= $tk['iddosenkelas']?>"<?php if ($iddosen == $tk['iddosenkelas']):?>selected<?php endif;?>><?=$tk['namadosen']?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <button class=" btn btn-primary mr-1"><i class="fa fa-search"></i></button>
                </form>
                <?php if ($iddosen):?>

                <table id="table1" class="table table-hover">
                    <thead>
                        <tr>
                        <td class="text-bold" colspan="2">NAMA DOSEN</td>
                            <td ><?= $tkelas->namadosen ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="text-bold" colspan="2">KODE KELAS</td>
                            <td ><?= $tkelas->idkelas ?></td>
                        </tr>
                        <tr>
                        <td class="text-bold" colspan="2">NAMA MATAKULIAH</td>
                            <td ><?= $tkelas->namamtk ?></td>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            
                        </tr>
                    </tbody>
                    <?php endif;?>
                </table>
                <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                    <thead class="bg-info" style="position:sticky;top:0;">
                        <tr>
                
                        <th class="text-center">NIM</th>
                        <th class="text-center">KODE KELAS</th>
                        <th class="text-center">PENILAIIAN</th>
                        <th class="text-center">NILAI ANGKA</th>
                        <th class="text-center">NILAI PEROLEHAN</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($table):?>
                        <?php foreach($table as $t):?>
                            <tr>
                                <td class="text-left"><?= $t['idnimnil'] ?></td>
                                <td class="text-left"><?= $t['idkelas'] ?></td>
                                <td class="text-left"><?= $t['namapenilaian'] ?></td>
                                <td class="text-right"><?= $t['nilangka'] ?></td>
                                <td class="text-right"><?= $t['nilperolehan'] ?></td>
                                
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="text-bold">TOTAL</td>
                            <td class="text-bold text-right"><?= $table1->total_nilperolehan?>  </td>
                            
                        </tr>
                        <?php else:?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">- tidak ada data ditampilkan -</td>
                            </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-question-circle"></i> KONFIRMASI</h5>
      </div>
      <div class="modal-body">
        Anda yakin ingin menghapus data <span id="keterangandelete"></span>?
      </div>
      <div class="modal-footer">
          <a id="linkdelete" type="button" class="btn btn-primary">YA</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">TIDAK</button>
      </div>
    </div>
  </div>
</div>

<script>
    <?php if(!$iddosen):?>
        window.onload = function(){
            toastr.info('Pili Dosen Terlebih Dahulu.');
        }
    <?php endif;?>

    function setDelete(link,keterangan)
    {
        var keterangandelete = document.getElementById('keterangandelete');
        var linkdelete = document.getElementById('linkdelete');

        keterangandelete.innerHTML = keterangan;
        linkdelete.setAttribute('href',link);
    }
</script>