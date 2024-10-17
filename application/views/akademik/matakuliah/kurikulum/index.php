<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">DATA KURIKULUM</h1>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-7 mx-auto">
                <a href="<?= base_url() ?>Akademik/Matakuliah/Kurikulum/form" class="btn btn-primary mb-2">TAMBAH <i class="fas fa-plus"></i></a>
                <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                    <thead class="bg-info" style="position:sticky;top:0;">
                        <tr>
                        <th class="text-center">ID KURIKULUM</th>
                        <th class="text-center">NAMA KURIKULUM</th>
                        <th class="text-center">STATUS AKTIF</th>
                        <th class="text-center">KETERANGAN KURIKULUM</th>
                        <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($table):?>
                            <?php foreach($table as $t):?>
                                <tr>
                                    <td class="text-center"><?= $t['idkuri'] ?></td>
                                    <td class="text-left"><?= $t['namakuri'] ?></td>
                                    <td class="text-center">
                                        <?php 
                                            switch($t['ketkuri']){
                                                case "A":
                                                    echo "Aktif";
                                                    break;
                                                case "N":
                                                    echo "Non-aktif";
                                                    break;
                                            }
                                        ?>
                                    </td>                                    
                                    <td class="text-left"><?= $t['ketkuri'] ?></td>
                                    <td class="text-left">
                                        <a href="<?= base_url() ?>Akademik/Matakuliah/Kurikulum/form?idkuri=<?= $t['idkuri'] ?>" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                        <button data-toggle="modal" data-target="#modaldelete"  onclick='setDelete("<?= base_url() ?>Akademik/Matakuliah/Kurikulum/delete/<?= $t["idkuri"] ?>"," Nama Kurikulum \"<?= $t["namakuri"] ?>\"")' class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
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