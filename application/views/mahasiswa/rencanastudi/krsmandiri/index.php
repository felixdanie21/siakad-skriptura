<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1 class="font-weight-bold">KRS MANDIRI</h1>
                    <?php if($mhsbio):?>
                    <h5><?= $mhsbio->namamhs ?> (<?= $mhsbio->idnim ?>)</h5>
                    <?php else:?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted">- Mahasiswa Tidak Terdaftar -</td>
                                </tr>
                    <?php endif;?>

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
        <!-- <div class="col-12 mx-auto"> -->
        <?php if($table):?>
            <table id="table1" class="table table-hover">
                <thead>
                    <tr>
                        <td class="text-bold" colspan="3">NIM</td>
                        <td colspan="6"><?= $mhsbio->idnim ?></td>
                        <td class="text-bold" colspan="2">TAHUN AKADEMIK</td>
                        <td colspan="5"><?= $table1->kettahunakad ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold" colspan="3">NAMA</td>
                        <td colspan="6"><?= $mhsbio->namamhs ?></td>
                        <td class="text-bold" colspan="2">SEMESTER</td>
                        <td colspan="5"><?= $table1->jnssms ?></td>
                    </tr>
                    <tr>
                        <td class="text-bold" colspan="3">PROGRAM STUDI</td>
                        <td colspan="6"><?= $table1->namaprodi ?></td>
                        <td class="text-bold" colspan="3">ANGKATAN</td>
                        <td colspan="4"><?= $mhsbio->tahunmasuk ?></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                    </tr>
                </tbody>
            </table>
            <!-- </div> -->

            <?php endif;?>
            <div class="row">
                <div class="col-12 mx-auto">
                <?php if($mhsbio): ?>
                    <a href="<?= base_url() ?>Mahasiswa/Rencanastudi/Krsmandiri/form/<?= $mhsbio->idnim ?>" class="btn btn-primary mb-2">TAMBAH <i class="fas fa-plus"></i></a>
                        <?php else:?>
                            <?php endif;?>
                        <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                            <thead class="bg-info" style="position:sticky;top:0;">
                                <tr>
                                    <th class="text-center">NAMA KELAS</th>
                                    <th class="text-center">NAMA MATAKULIAH</th>
                                    <th class="text-center">NAMA DOSEN</th>
                                    <th class="text-center">B/U</th>
                                    <th class="text-center">SKS</th>
                                    <th class="text-center">HARI PERKULIAHAN</th>
                                    <th class="text-center">AKSI</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($table):?>
                                    <?php foreach($table as $t):?>
                                        <tr>
                                            <td class="text-left">
                                                <?= $t['idkelaskrs'] ?>
                                            </td>
                                            <td class="text-left">
                                                <?= $t['namamtk'] ?>
                                            </td>
                                            <td class="text-left">
                                                <?= $t['namadosen'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $t['rwymtkmhs'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $t['sksmtk'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $t['harikelas'] ?>
                                            </td>
                                            <td class="text-left">
                                                <button data-toggle="modal" data-target="#modaldelete"  onclick='setDelete("<?= base_url() ?>Mahasiswa/Rencanastudi/Krsmandiri/delete/<?= $t["idkelaskrs"] ?>","Nama Matakuliah \"<?= $t["namamtk"] ?>\"")' class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
                                            </td>
                                            
                                        </tr>
                                        

                                        
                                        <?php endforeach; ?>
                                        
                                        <tr>
                                            <td colspan="4" class="text-bold">TOTAL</td>
                                            <td class="text-bold text-center"><?= $table1->total_sksmtk?>  </td>
                                            <td colspan="3"></td>
                                        </tr>
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
