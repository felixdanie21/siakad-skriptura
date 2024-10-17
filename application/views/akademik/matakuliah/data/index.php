<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">DATA MATAKULIAH</h1>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12 mx-auto">
                <form class="row container-fluid mb-2" action="<?= base_url() ?>Akademik/Matakuliah/Data" method="post">
                    <select class="form-control col-3 mr-1" id="idkurmtk" name="idkurmtk" required>
                        <option value="" disabled selected>-- PILIH KURIKULUM --</option>
                        <?php foreach ($mkurikulum as $mk): ?>
                        <option value="<?= $mk['idkuri']?>"<?php if ($idkurmtk == $mk ['idkuri']):?>selected<?php endif;?>><?=$mk['namakuri']?></option>
                        <?php endforeach; ?>
                    </select>
                    <select class="form-control col-3 mr-1" id="idprodimtk" name="idprodimtk" required>
                        <option value="" disabled selected>-- PILIH PRODI --</option>
                        <?php foreach ($mprodi as $mp): ?>
                        <option value="<?= $mp['idprodi']?>"<?php if ($idprodimtk == $mp ['idprodi']):?>selected<?php endif;?>><?=$mp['namaprodi']?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class=" btn btn-primary mr-1"><i class="fa fa-search"></i></button>
                    <?php if ($idkurmtk):?>
                        <a href="<?= base_url() ?>Akademik/Matakuliah/Data/form/<?= $idprodimtk ?>/<?= $idkurmtk ?>" class="btn btn-primary">TAMBAH <i class="fas fa-plus"></i></a>
                    <?php endif;?>
                </form>
                <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                    <thead class="bg-info" style="position:sticky;top:0;">
                        <tr>
                
                        <th class="text-center">KODE MATAKULIAH</th>
                        <th class="text-center">MATAKULIAH</th>
                        <th class="text-center">SEMESTER  DITAWARKAN</th>
                        <th class="text-center">JENIS SEMESTER</th>
                        <th class="text-center">TIPE MATKUL</th>
                        <th class="text-center">NILAI LULUS</th>
                        <th class="text-center">SKS</th>
                        <th class="text-center">KODE MATAKULIAH PDDIKTI</th>
                        <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($table):?>
                            <?php foreach($table as $t):?>
                                <tr>
                                    <td class="text-center"><?= $t['idmtk'] ?></td>
                                    <td class="text-left"><?= $t['namamtk'] ?></td>
                                    <td class="text-center"><?= $t['smsmtk'] ?></td>
                                    <td class="text-center">
                                        <?php 
                                            switch($t['jnssms']){
                                                case "1":
                                                    echo "GASAL";
                                                    break;
                                                case "2":
                                                    echo "GENAP";
                                                    break;
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                            switch($t['tipemtk']){
                                                case "W":
                                                    echo "WAJIB";
                                                    break;
                                                case "P":
                                                    echo "PILIHAN";
                                                    break;
                                            }
                                        ?>
                                    </td>
                                    <td class="text-center"><?= $t['nilailulus'] ?></td>
                                    <td class="text-center"><?= $t['sksmtk'] ?></td>
                                    <td class="text-center"><?= $t['kodemtkpddikti'] ?></td>
                                    <td class="text-left">
                                        <a href="<?= base_url() ?>Akademik/Matakuliah/Data/form/<?= $t['idprodi']?>/<?=$t['idkuri']?>?idmtk=<?= $t['idmtk'] ?>" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                        <button data-toggle="modal" data-target="#modaldelete"  onclick='setDelete("<?= base_url() ?>Akademik/Matakuliah/Data/delete/<?= $t["idmtk"] ?>","Matakuliah \"<?= $t["namamtk"] ?>\"")' class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else:?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">- tidak ada data ditampilkan -</td>
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

    <?php if(!$idkurmtk):?>
        window.onload = function(){
            toastr.info('Pili Kurikulum dan Prodi terlebih dahulu.');
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