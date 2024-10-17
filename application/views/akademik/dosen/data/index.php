<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">DATA DOSEN</h1>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mx-auto"> 
                <form class="row container-fluid mb-1" action="<?= base_url() ?>Akademik/Dosen/Data" method="post">
                    <select class="form-control col-3 mr-1" id="idprodidosen" name="idprodidosen">
                        <option value="" disabled selected>--PILIH PRODI--</option>
                        <?php foreach ($mprodi as $mp): ?>
                        <option value="<?= $mp['idprodi']?>"<?php if ($idprodidosen == $mp ['idprodi']):?>selected<?php endif;?>><?=$mp['namaprodi']?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class=" btn btn-primary mr-1"><i class="fa fa-search"></i></button>
                    <?php if ($idprodidosen):?>
                        <a href="<?= base_url() ?>Akademik/Dosen/Data/form/<?= $idprodidosen ?>" class="btn btn-primary">TAMBAH <i class="fas fa-plus"></i></a>
                    <?php endif;?>
                </form>
            <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                    <thead class="bg-info" style="position:sticky;top:0;">
                        <tr>
                        <th class="text-center">KODE DOSEN</th>
                        <th class="text-center">PRODI</th>
                        <th class="text-center">NAMA DOSEN</th>
                        <th class="text-center">NAMA LENGKAP</th>
                        <th class="text-center">NIDN</th>
                        <th class="text-center">NIK DOSEN</th>
                        <th class="text-center">NOMOR WHATSAPP</th>
                        <th class="text-center">EMAIL PT</th>
                        <th class="text-center">FOTO DOSEN</th>
                        <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($table):?>
                            <?php foreach($table as $t):?>
                                <tr>
                                    <td class="text-center"><?= $t['iddosen'] ?></td>
                                    <td class="text-center"><?= $t['namaprodi'] ?></td>
                                    <td class="text-center"><?= $t['namadosen'] ?></td>
                                    <td class="text-left"><?= $t['namalengkap'] ?></td>
                                    <td class="text-left"><?= $t['nomornidn'] ?></td>
                                    <td class="text-left"><?= $t['nikdosen'] ?></td>
                                    <td class="text-left"><?= $t['nomorwa'] ?></td>
                                    <td class="text-left"><?= $t['emailpt'] ?></td>
                                    <td>
                                        <img style="width: 40px; height: 40px;" src="<?= base_url('assets/img/'.$t['fotodosen']) ?>" alt="">
                                    </td>
                                    <td class="text-left">
                                    <a href="<?= base_url() ?>Akademik/Dosen/Data/form/<?= $t['idprodi']?>?iddosen=<?= $t['iddosen'] ?>" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                        <button data-toggle="modal" data-target="#modaldelete"  onclick='setDelete("<?= base_url() ?>Akademik/Dosen/Data/delete/<?= $t["iddosen"] ?>","Dosen \"<?= $t["namadosen"] ?>\"")' class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
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
    <?php if(!$idprodidosen):?>
        window.onload = function(){
            toastr.info('Pili Prodi terlebih dahulu.');
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