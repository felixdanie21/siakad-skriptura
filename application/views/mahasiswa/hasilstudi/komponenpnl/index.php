<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">HASIL STUDI PER SEMESTER</h1>
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
                <form class="row container-fluid mb-2" action="<?= base_url() ?>Mahasiswa/Hasilstudi/Komponenpnl" method="post">
                    <select class="form-control col-3 mr-1" id="idthn" name="idthn">
                        <option value="" disabled selected>-- PILIH TAHUN AKADEMIK --</option>
                        <?php foreach ($mthnak as $mt): ?>
                            <option value="<?= $mt['idthn']?>"<?php if ($idthnnil == $mt['idthn']):?>selected<?php endif;?>><?=$mt['kettahunakad']?></option>
                        <?php endforeach; ?>
                    </select>
                    

                    <button class=" btn btn-primary mr-1"><i class="fa fa-search"></i></button>
                    
                </form>
                
                <table id="table1" class="table table-sm table-bordered bg-light table-hover mt-2">
                    <thead class="bg-info" style="position:sticky;top:0;">
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NOMOR INDUK</th>
                            <th class="text-center">KODE MATAKUL</th>
                            <th class="text-center">TOTAL NILAI ANGKA</th>
                            <th class="text-center">NILAI HURUF</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($table):?>
                    <input type="hidden" name="nomor_urut" value="<?= $no=1; ?>">                        
                    <?php foreach($table as $t):?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-left"><?= $t['namamhs'] ?></td>
                                <td class="text-left"><?= $t['namamtk'] ?></td>
                                <td class="text-left"><?= $t['nilaiangka'] ?></td>
                                <td class="text-left"><?= $t['nilaihuruf'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else:?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">- tidak ada data ditampilkan -</td>
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
    <?php if(!$idthnnil):?>
        window.onload = function(){
            toastr.info('Pili Tahun Akademik.');
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