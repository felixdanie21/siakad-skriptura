<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1 class="font-weight-bold">MATAKULIAH DOSEN</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8 mx-auto">
                    <form class="row container-fluid mb-2" action="<?= base_url() ?>Akademik/Dosen/Matkuldosen"
                        method="post">
                        <select class="form-control col-3 mr-1" id="iddosenmtk" name="iddosenmtk">
                            <option value="" disabled selected>--PILIH DOSEN--</option>
                            <?php foreach ($mdosen as $mb): ?>
                                    <option value="<?= $mb['iddosen'] ?>" <?php if ($iddosenmtk == $mb['iddosen']): ?>selected<?php endif; ?>>
                                        <?= $mb['namadosen'] ?>
                                    </option>
                            <?php endforeach; ?>
                        </select>
                        <button class=" btn btn-primary mr-1"><i class="fa fa-search"></i></button>
                        <?php if ($iddosenmtk): ?>
                        <a href="<?= base_url() ?>Akademik/Dosen/Matkuldosen/form/<?= $iddosenmtk ?>"
                            class="btn btn-primary">TAMBAH <i class="fas fa-plus"></i></a>
                        <?php endif; ?>
                    </form>
                    <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                        <thead class="bg-info" style="position:sticky;top:0;">
                            <tr>
                                <th class="text-center">NAMA DOSEN</th>
                                <th class="text-center">MATAKULIAH DOSEN</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($table):?>
                            <?php foreach($table as $t):?>
                            <tr>
                                <td class="text-center">
                                    <?= $t['namadosen'] ?>
                                </td>
                                <td class="text-center">
                                    <?= $t['namamtk'] ?>
                                </td>
                                
                                <td class="text-center">
                                    <a href="<?= base_url() ?>Akademik/Dosen/Matkuldosen/form/<?= $t['iddosen']?>?idmtkdsn=<?= $t['idmtkdsn'] ?>"
                                        class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                    
                                    <button data-toggle="modal" data-target="#modaldelete"
                                    onclick='setDelete("<?= base_url() ?>Akademik/Dosen/Matkuldosen/delete/<?= $t["idmtkdsn"] ?>"," Matakuliah  \"<?= $t["namamtk"] ?>\"")'
                                    class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
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
<div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel"><i class="fas fa-question-circle"></i>
                    KONFIRMASI</h5>
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
        <?php if(!$iddosenmtk):?>
        window.onload = function(){
            toastr.info('Pili Dosen Terlebih Dahulu.');
        }
    <?php endif;?>

    function setDelete(link, keterangan) {
        var keterangandelete = document.getElementById('keterangandelete');
        var linkdelete = document.getElementById('linkdelete');

        keterangandelete.innerHTML = keterangan;
        linkdelete.setAttribute('href', link);
    }
</script>