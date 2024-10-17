<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">DATA KOMPONEN NILAI</h1>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <form class="row container-fluid mb-2" action="<?= base_url() ?>Akademik/Nilaistudi/Komponennilai" method="post">
                    <select class="form-control col-3 mr-1" id="idthnkls" name="idthnkls">
                        <option value="" disabled selected>-- PILIH TAHUN AKADEMIK --</option>
                        <?php foreach ($mthnak as $mk): ?>
                            <option value="<?= $mk['idthn']?>"<?php if ($idthnkls == $mk ['idthn']):?>selected<?php endif;?>><?=$mk['kettahunakad']?></option>
                        <?php endforeach; ?>
                    </select>
                    <select class="form-control col-3 mr-1" id="idprodikls" name="idprodikls">
                        <option value="" disabled selected>--PILIH PRODI--</option>
                        <?php foreach ($mprodi as $mp): ?>
                        <option value="<?= $mp['idprodi']?>"<?php if ($idprodikls == $mp ['idprodi']):?>selected<?php endif;?>><?=$mp['namaprodi']?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class=" btn btn-primary mr-1"><i class="fa fa-search"></i></button>
                </form>
                <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                    <thead class="bg-info" style="position:sticky;top:0;">
                        <tr>
                
                        <th class="text-center">KODE KELAS</th>
                        <th class="text-center">MATAKULIAH</th>
                        <th class="text-center">DOSEN</th>
                        <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($table as $t):?>
                            <tr>
                                <td class="text-left"><?= $t['idkelas'] ?></td>
                                <td class="text-left"><?= $t['namamtk'] ?></td>
                                <td class="text-left"><?= $t['namadosen'] ?></td>
                                <td class="text-left">
                                <a href="<?= base_url() ?>Dosen/Komponenpnl/Komponenpnl/form/<?= $t['idkelas'] ?>/<?= $t['iddosenkelas'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
    <?php if(!$idthnkls):?>
        window.onload = function(){
            toastr.info('Pili Tahun Akademik dan Prodi Terlebih Dahulu.');
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