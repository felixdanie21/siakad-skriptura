<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">PENGISIAN NILAI MAHASISWA</h1>
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
            <div class="col-sm-7 mx-auto">
                <form class="row container-fluid mb-2" action="<?= base_url() ?>Dosen/Pengisiannilai/Nilaimahasiswa" method="post">
                    <select class="form-control col-3 mr-1" id="idkelas" name="idkelas">
                        <option value="" disabled selected>-- PILIH KELAS --</option>
                        <?php foreach ($tkelas as $tk): ?>
                            <option value="<?= $tk['idkelas']?>"<?php if ($idkelaskrs == $tk['idkelas']):?>selected<?php endif;?>><?=$tk['idkelas']?></option>
                        <?php endforeach; ?>
                    </select>
                    

                    <button class=" btn btn-primary mr-1"><i class="fa fa-search"></i></button>
                    
                </form>
                
                <table id="table1" class="table table-sm table-bordered bg-light table-hover mt-2">
                    <thead class="bg-info" style="position:sticky;top:0;">
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NIM</th>
                            <th class="text-center">NAMA MAHASISWA</th>
                            
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    <input type="hidden" name="nomor_urut" value="<?= $no=1; ?>">                        
                    <?php foreach($table as $t):?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-left"><?= $t['idnimkls'] ?></td>
                                <td class="text-left"><?= $t['namamhs'] ?></td>
                                <td class="text-center">

                                <a href="<?= base_url() ?>Dosen/Pengisiannilai/Nilaimahasiswa/index_komponenpnl/<?= $t['idnimkls'] ?>?idkelaskrs=<?= $t['idkelaskrs'] ?>" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
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
    <?php if(!$idkelaskrs):?>
        window.onload = function(){
            toastr.info('Pili Kelas terlebih Dahulu.');
        }
    <?php endif;?>
</script>
<script>
    function setDelete(link,keterangan)
    {
        var keterangandelete = document.getElementById('keterangandelete');
        var linkdelete = document.getElementById('linkdelete');

        keterangandelete.innerHTML = keterangan;
        linkdelete.setAttribute('href',link);
    }
</script>