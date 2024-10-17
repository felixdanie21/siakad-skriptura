<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">PENGISIAN NILAI MAHASISWA</h1>
            <a href="<?= base_url() ?>Dosen/Pengisiannilai/Nilaimahasiswa?idnimnil=<?= $mhsbio->idnim ?>&idkelas=<?= $tkelas->idkelas ?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <a href="<?= base_url() ?>Dosen/Pengisiannilai/Nilaimahasiswa/form/<?= $mhsbio->idnim?>/<?= $tkrs->idkelaskrs ?>" class="btn btn-primary">TAMBAH<i class="fas fa-plus"></i></a>
                <table id="table1" class="table table-sm table-bordered bg-light table-hover mt-2">
                    <thead class="bg-info" style="position:sticky;top:0;"> 
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">NIM</th>
                            <th class="text-center">NAMA MAHASISWA</th>
                            <th class="text-center">KODE KELAS</th>
                            <th class="text-center">KODE PENILAIAAN</th>
                            <th class="text-center">NILAI ANGKA</th>
                            <th class="text-center">NILAI PEROLEHAN</th>
                            <th class="text-center">AKSI</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <input type="hidden" name="nomor_urut" value="<?= $no=1; ?>">                        
                    <?php foreach($tnildetkom as $t):?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-left"><?= $t['idnimnil'] ?></td>
                                <td class="text-left"><?= $t['namamhs'] ?></td>
                                <td class="text-left"><?= $t['idkelas'] ?></td>
                                <td class="text-left"><?= $t['namapenilaian'] ?></td>
                                <td class="text-right"><?= $t['nilangka'] ?></td>
                                <td class="text-right"><?= $t['nilperolehan'] ?> </td>
                                <td class="text-left">
                                    <a href="<?= base_url() ?>Dosen/Pengisiannilai/Nilaimahasiswa/form/<?= $t['idnimnil'] ?>/<?= $t['idkelas'] ?>?idnimnil=<?= $t['idnimnil'] ?>&kodepenilaian=<?= $t['kodepenilaian'] ?>" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                    <a data-toggle="modal" data-target="#modaldelete" onclick='setDelete("<?= base_url() ?>Dosen/Pengisiannilai/Nilaimahasiswa/delete/<?= $t["idnimnil"] ?>/<?= $t["kodepenilaian"]?>/<?= $t["idkelas"]?> ","Nama Penilaian \"<?= $t["namapenilaian"] ?>\"")' class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="6" class="text-bold">TOTAL</td>
                            <td class="text-bold text-right"><?= $table1->total_nilperolehan?>  </td>
                            <td></td>
                        </tr>
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