<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1 class="font-weight-bold">MATAKULIAH PRASYARAT</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 mx-auto">
                    <form class="row container-fluid mb-2" action="<?= base_url() ?>Akademik/Matakuliah/Prasyarat" method="post">
                        <select class="form-control col-2 mr-1" id="sortby" name="sortby">
                            <option value="nama" <?php if ($sortby === 'nama'): ?>selected<?php endif; ?>>SORT BY NAMA</option>
                            <option value="semester" <?php if ($sortby === 'semester'): ?>selected<?php endif; ?>>SORT BY SEMESTER</option>
                        </select>
                        <button class="btn btn-primary mr-1"><i class="fa fa-search"></i></button>
                    </form>
                    <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                        <thead class="bg-info" style="position:sticky;top:0;">
                            <tr>
                                <th class="text-center">NAMA MATAKULIAH</th>
                                <th class="text-center">SEMESTER</th>
                                <th class="text-center">MATAKULIAH PRASYARAT</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($table as $t):?>
                                <?php 
                                    $this->db->where('idmtkutama',$t['idmtk']);
                                    $mtksyr = $this->db->get('mtksyr')->result_array();
                                ?>
                                <tr>
                                    <td class="text-left"><?= $t['namamtk'] ?></td>
                                    <td class="text-center"><?= $t['smsmtk'] ?></td>
                                    <td class="text-center">
                                        <?php foreach($mtksyr as $ms):?>
                                            <?= $ms['idmtksyarat'] ?>,
                                        <?php endforeach;?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url() ?>Akademik/Matakuliah/Prasyarat/form/<?= $t['idmtk']?>" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                                        <button data-toggle="modal" data-target="#modaldelete" onclick='setDelete("<?= base_url() ?>Akademik/Matakuliah/Prasyarat/delete/<?= $t["idmtk"] ?>","Matakuliah Syarat \"<?= $t["namamtk"] ?>\"")' class="btn btn-sm btn-dark"><i class="fas fa-trash"></i></button>
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