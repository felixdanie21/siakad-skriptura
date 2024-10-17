<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">PENAWARAN MATAKULIAH</h1>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mx-auto">
                <form class="row container-fluid mb-2" action="<?= base_url() ?>Akademik/Aturkelas/Tawarmatkul" method="post">
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
                    <?php if ($idthnkls):?>
                        <a href="<?= base_url() ?>Akademik/Aturkelas/Tawarmatkul/form/<?= $idprodikls ?>/<?= $idthnkls ?>" class="btn btn-primary">TAMBAH <i class="fas fa-plus"></i></a>
                    <?php endif;?>
                </form>
                <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                    <thead class="bg-info" style="position:sticky;top:0;">
                        <tr>
                
                        <th class="text-center">KODE KELAS</th>
                        <th class="text-center">MATAKULIAH</th>
                        <th class="text-center">DOSEN</th>
                        <th class="text-center">RUANG</th>
                        <th class="text-center">JAM MULAI</th>
                        <th class="text-center">JAM SELESAI</th>
                        <th class="text-center">KAPASITAS KELAS</th>
                        <th class="text-center">JUMLAH PESERTA</th>
                        <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($table as $t):?>
                            <tr>
                                <td class="text-center"><?= $t['idkelas'] ?></td>
                                <td class="text-left"><?= $t['namamtk'] ?></td>
                                <td class="text-left"><?= $t['namadosen'] ?></td>
                                <td class="text-left"><?= $t['namaruang'] ?></td>
                                <td class="text-center"><?= $t['jammulaikelas'] ?></td>
                                <td class="text-center"><?= $t['jamselesaikelas'] ?></td>
                                <td class="text-center"><?= $t['kapasitaskelas'] ?></td>
                                <td class="text-center"><?= $t['jumpeserta'] ?></td>
                                <td class="text-left">
                                    <a href="<?= base_url() ?>Akademik/Aturkelas/Tawarmatkul/form/<?= $t['idprodi']?>/<?=$t['idthn']?>?idkelas=<?= $t['idkelas'] ?>" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                    <button data-toggle="modal" data-target="#modaldelete"  onclick='setDelete("<?= base_url() ?>Akademik/Aturkelas/Tawarmatkul/delete/<?= $t["idkelas"] ?>","KELAS \"<?= $t["idkelas"] ?>\"")' class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
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