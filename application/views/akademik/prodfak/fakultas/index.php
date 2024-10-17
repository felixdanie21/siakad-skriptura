<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">DATA FAKULTAS</h1>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-7 mx-auto">
                <a href="<?= base_url() ?>Akademik/Prodfak/Fakultas/form" class="btn btn-primary mb-2">TAMBAH <i class="fas fa-plus"></i></a>
                <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                    <thead class="bg-info" style="position:sticky;top:0;">
                        <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">ID FAKULTAS</th>
                        <th class="text-center">NAMA FAKULTAS</th>
                        <th class="text-center">DEKAN FAKULTAS</th>
                        <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($table):?>
                            <?php foreach($table as $t):?>
                                <?php
                                    $dekan = '';
                                    if($t['iddosendekan']){
                                        $this->db->where('iddosen',$t['iddosendekan']);
                                        $dosen = $this->db->get('mdosen')->row();
                                        $dekan = $dosen->namalengkap;
                                    }    
                                ?>
                                <tr>
                                    <td class="text-center"><?= $t['urutfak'] ?></td>
                                    <td class="text-left"><?= $t['idfak'] ?></td>
                                    <td class="text-left"><?= $t['namafak'] ?></td>
                                    <td class="text-left"><?= $dekan ?></td>
                                    <td class="text-left">
                                        <a href="<?= base_url() ?>Akademik/Prodfak/Fakultas/form?idfak=<?= $t['idfak'] ?>" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                        <button data-toggle="modal" data-target="#modaldelete"  onclick='setDelete("<?= base_url() ?>Akademik/Prodfak/Fakultas/delete/<?= $t["idfak"] ?>","Fakultas \"<?= $t["namafak"] ?>\"")' class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
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