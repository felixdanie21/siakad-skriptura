<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">DATA KOMPONEN PENILAIAAN</h1>
            <h5><?= $mdosen->namadosen ?> (<?= $mdosen->iddosen ?>)</h5>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 mx-auto">
                <form class="row container-fluid mb-1" action="<?= base_url() ?>Dosen/Komponenpnl/Komponenpnl/vindex/<?= $mdosen->iddosen ?>" method="post">
                    <select class="form-control col-3 mr-1" id="idkelasnil" name="idkelasnil">
                        <option value="" disabled selected>--PILIH KELAS--</option>
                        <?php foreach ($tkelas as $tk): ?>
                        <option value="<?= $tk['idkelas']?>"<?php if ($idkelasnil == $tk['idkelas']):?>selected<?php endif;?>><?=$tk['idkelas']?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class=" btn btn-primary mr-1"><i class="fa fa-search"></i></button>
                    <?php if ($idkelasnil):?>
                        <a href="<?= base_url() ?>Dosen/Komponenpnl/Komponenpnl/form/<?= $idkelasnil ?>/<?= $mdosen->iddosen ?>" class="btn btn-primary">TAMBAH <i class="fas fa-plus"></i></a>
                    <?php endif;?>
                </form>
                <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                    <thead class="bg-info" style="position:sticky;top:0;">
                        <tr>
                        <th class="text-center">NAMA PENILAIIAN</th>
                        <th class="text-center">BOBOT PRESENTASE</th>
                        <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($table):?>
                            <?php foreach($table as $t):?>
                                <tr>
                                    <td class="text-left"><?= $t['namapenilaian'] ?></td>
                                    <td class="text-center"><?= $t['bobotprosen'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url() ?>Dosen/Komponenpnl/Komponenpnl/form?idkelasnil=<?= $t['idkelasnil'] ?>" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                        <button data-toggle="modal" data-target="#modaldelete"  onclick='setDelete("<?= base_url() ?>Dosen/Komponenpnl/Komponenpnl/delete/<?= $t["kodepenilaian"] ?>/<?= $t["idkelasnil"] ?>","Nama Komponen \"<?= $t["namapenilaian"] ?>\"")' class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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
    function setDelete(link,keterangan)
    {
        var keterangandelete = document.getElementById('keterangandelete');
        var linkdelete = document.getElementById('linkdelete');

        keterangandelete.innerHTML = keterangan;
        linkdelete.setAttribute('href',link);
    }
</script>