<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1 class="font-weight-bold">JADWAL MINGGU INI</h1>
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9 mx-auto">
                <form class="row container-fluid mb-1" action="<?= base_url() ?>Mahasiswa/Jadwalkuliah/Mingguini" method="post">
                    <select class="form-control col-3 mr-1" id="idthnkrs" name="idthnkrs">
                        <option value="" disabled selected>--PILIH TAHUN AKADEMIK--</option>
                        <?php foreach ($mthnak as $mp): ?>
                        <option value="<?= $mp['idthn']?>"<?php if ($idthnkrs == $mp ['idthn']):?>selected<?php endif;?>>
                            <?=$mp['kettahunakad']?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <button class=" btn btn-primary mr-1"><i class="fa fa-search"></i></button>
                    
                </form>
                    <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                        <thead class="bg-info" style="position:sticky;top:0;">
                            <tr>
                                <th class="text-center">SEMESTER</th>
                                <th class="text-center">NAMA MATAKULIAH</th>
                                <th class="text-center">NAMA DOSEN</th>
                                <th class="text-center">HARI PERKULIAHAN</th>
                                <th class="text-center">JAM MULAI KELAS</th>
                                <th class="text-center">JAM SELESAI KELAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($table):?>
                                <?php foreach($table as $t):?>
                                <tr>
                                    <td class="text-center">
                                        <?= $t['jenissemester'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?= $t['namamtk'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?= $t['namadosen'] ?>
                                    </td>
                                    
                                    <td class="text-center">
                                        <?= $t['harikelas'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['jammulaikelas'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['jamselesaikelas'] ?>
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
<script>
        <?php if(!$idthnkrs):?>
        window.onload = function(){
            toastr.info('Pili Tahun Akademik Terlebih Dahulu.');
        }
    <?php endif;?>

    function setDelete(link, keterangan) {
        var keterangandelete = document.getElementById('keterangandelete');
        var linkdelete = document.getElementById('linkdelete');

        keterangandelete.innerHTML = keterangan;
        linkdelete.setAttribute('href', link);
    }
</script>