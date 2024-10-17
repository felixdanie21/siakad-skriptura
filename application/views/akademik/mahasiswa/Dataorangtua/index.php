<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1 class="font-weight-bold">DATA ORANGTUA</h1>
                    <h5><?= $mhsbio->namamhs ?> (<?= $mhsbio->idnim ?>)</h5>
                    <a href="<?= base_url() ?>Akademik/Mahasiswa/Data?idprodimhs=<?= $mhsbio->idprodimhs?>"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mx-auto">
                    <form class="row container-fluid mb-2" action="<?= base_url() ?>Akademik/Mahasiswa/Dataorangtua" method="post">
                        <?php if (!empty($idnim) && empty($table)): ?>
                        <a href="<?= base_url() ?>Akademik/Mahasiswa/Dataorangtua/form/<?= $idnim ?>"
                            class="btn btn-primary">TAMBAH <i class="fas fa-plus"></i></a>
                        <?php endif; ?>
                    </form>
                    <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                        <thead class="bg-info" style="position:sticky;top:0;">
                            <tr>
                                <th class="text-center">NAMA BAPAK</th>
                                <th class="text-center">NAMA IBU</th>
                                <th class="text-center">KERJA BAPAK</th>
                                <th class="text-center">KERJA IBU</th>
                                <th class="text-center">ALAMAT</th>
                                <th class="text-center">PENGHASILAN</th>
                                <th class="text-center">NOMOR WA</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($table as $t):?>
                                <tr>
                                    <td class="text-center">
                                        <?= $t['namabapak'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['kerjabapak'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['alamatortu'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['penghasilanortu'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['nomorhpwaortu'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['namaibu'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['kerjaibu'] ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url() ?>Akademik/Mahasiswa/Dataorangtua/form/<?= $t['idnim']?>?idnim=<?= $t['idnim'] ?>"
                                            class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                        <button data-toggle="modal" data-target="#modaldelete"
                                            onclick='setDelete("<?= base_url() ?>Akademik/Mahasiswa/Dataorangtua/delete/<?= $t["idnim"] ?>","Orang Tua \"<?= $t["namamhs"] ?>\"")'
                                            class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
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

    function setDelete(link, keterangan) {
        var keterangandelete = document.getElementById('keterangandelete');
        var linkdelete = document.getElementById('linkdelete');

        keterangandelete.innerHTML = keterangan;
        linkdelete.setAttribute('href', link);
    }
</script>