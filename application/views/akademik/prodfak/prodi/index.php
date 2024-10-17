<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">DATA PROGRAM STUDI</h1>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12 mx-auto">
                <a href="<?= base_url() ?>Akademik/Prodfak/Prodi/form" class="btn btn-primary mb-2">TAMBAH <i class="fas fa-plus"></i></a>
                <table style="font-size:14px;" id="table1" class="table table-sm table-bordered bg-light table-hover">
                    <thead class="bg-info" style="position:sticky;top:0;">
                        <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">ID PRODI</th>
                        <th class="text-center">NAMA PRODI</th>
                        <th class="text-center">FAKULTAS</th>
                        <th class="text-center">KETUA PRODI</th>
                        <th class="text-center">AKREDITASI</th>
                        <th class="text-center">JENJANG STUDI</th>
                        <th class="text-center">GAMBAR AKREDITASI</th>
                        <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($table):?>
                            <?php foreach($table as $t):?>
                                <?php
                                    $kaprodi = '';
                                    if($t['iddosenprodi']){
                                        $this->db->where('iddosen',$t['iddosenprodi']);
                                        $dosen = $this->db->get('mdosen')->row();
                                        $kaprodi = $dosen->namalengkap;
                                    }    
                                ?>
                                <tr>
                                    <td class="text-center"><?= $t['urutfak'] ?>.<?= $t['urutprodi'] ?></td>
                                    <td class="text-left"><?= $t['idprodi'] ?></td>
                                    <td class="text-left"><?= $t['namaprodi'] ?></td>
                                    <td class="text-left"><?= $t['namafak'] ?></td>
                                    <td class="text-left"><?= $kaprodi ?></td>
                                    <td class="text-left"><?= $t['statakreprodi'] ?></td>
                                    <td class="text-left"><?= $t['jenjangstudi'] ?></td>
                                    <td class="text-center">
                                        <?php if($t['gambarakre']):?>
                                            <button data-toggle="modal" data-target="#modalviewimage" onclick="viewGambarAkre('<?= $t['gambarakre'] ?>','GAMBAR AKREDITASI PRODI <?= strtoupper($t['namaprodi']) ?>')" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                        <?php endif;?>
                                    </td>
                                    <td class="text-left">
                                        <a href="<?= base_url() ?>Akademik/Prodfak/Prodi/form?idprodi=<?= $t['idprodi'] ?>" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                        <button data-toggle="modal" data-target="#modaldelete"  onclick='setDelete("<?= base_url() ?>Akademik/Prodfak/Prodi/delete/<?= $t["idprodi"] ?>","Prodi \"<?= $t["namaprodi"] ?>\"")' class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else:?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">- tidak ada data ditampilkan -</td>
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

<!-- Modal Delete -->
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

<!-- Modal View Image -->
<div class="modal fade" id="modalviewimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="ketgambarakre"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img style="width:100%" id="gambarakre" src="" alt="">
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

    function viewGambarAkre(file,keterangan)
    {
        var gambarakre = document.getElementById('gambarakre');
        var ketgambarakre = document.getElementById('ketgambarakre');
        gambarakre.setAttribute('src','<?= base_url() ?>assets/img/prodi/'+file);
        ketgambarakre.innerHTML = keterangan;
    }
</script>