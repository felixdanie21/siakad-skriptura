<style>
    .belum{
        color: red;
    }
    .sudah{
        color: blue;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">PENGISIAN KRS</h1>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9 mx-auto">
                <form class="row container-fluid mb-2" action="<?= base_url() ?>Akademik/Nilaistudi/Krs" method="post">
                    <select class="form-control col-3 mr-1" id="idprodimhs" name="idprodimhs">
                        <option value="" disabled selected>--PILIH PRODI--</option>
                        <?php foreach ($mprodi as $mp): ?>
                        <option value="<?= $mp['idprodi']?>"<?php if ($idprodimhs == $mp ['idprodi']):?>selected<?php endif;?>><?=$mp['namaprodi']?></option>
                        <?php endforeach; ?>
                    </select>
                    <select class="form-control col-3 mr-1" id="tahunmasuk" name="tahunmasuk">
                        <option value="" disabled selected>--PILIH TAHUN MASUK--</option>
                        <?php foreach ($mhsbio as $mp): ?>
                        <option value="<?= $mp['tahunmasuk']?>"<?php if ($tahunmasuk == $mp ['tahunmasuk']):?>selected<?php endif;?>><?=$mp['tahunmasuk']?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class=" btn btn-primary mr-1"><i class="fa fa-search"></i></button>
                    
                </form>
                <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                    <thead class="bg-info" style="position:sticky;top:0;">
                        <tr>
                
                        <th class="text-center">NIM</th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center">DOSEN WALI</th>
                        <th class="text-center">STATUS KRS</th>
                        <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($table):?>
                            <?php foreach ($table as $t): ?>
                            <tr>
                                <td class="text-center statuskrs"><?= $t['idnim'] ?></td>
                                <td class="text-left"><?= $t['namamhs'] ?></td>
                                <td class="text-left"></td>
                                <td class="text-center">
                                    <?php
                                    $status = "BELUM";
                                    foreach ($tahunterakhir as $d) {
                                        if ($d['idnim'] == $t['idnim']) {
                                            $status = "SUDAH";
                                            break;
                                        }
                                    }
                                    $statusClass = ($status === 'BELUM') ? 'belum' : 'sudah';;
                                    echo '<span class="' . $statusClass . '">' . $status . '</span>';
                                    ?>
                                </td>

                                <td class="text-center">
                                    <a href="<?= base_url() ?>Mahasiswa/Rencanastudi/Krsmandiri/form/<?= $t['idnim'] ?>" class="btn btn-primary ">
                                        <i class="fas fa-plus"></i>
                                    </a>
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
    function setDelete(link,keterangan)
    {
        var keterangandelete = document.getElementById('keterangandelete');
        var linkdelete = document.getElementById('linkdelete');

        keterangandelete.innerHTML = keterangan;
        linkdelete.setAttribute('href',link);
    }
</script>