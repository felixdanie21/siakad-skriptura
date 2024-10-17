<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1 class="font-weight-bold">RIWAYAT KRS</h1>
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
                
                    <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                        <thead class="bg-info" style="position:sticky;top:0;">
                            <tr>
                                <th class="text-center">TAHUN AKADEMIK</th>
                                <th class="text-center">TOTAL SKS</th>
                                <th class="text-center">SKS LULUS</th>
                                <th class="text-center">IP SEMSTER</th>
                                <th class="text-center">TOTAL BOBOT</th>
                                <th class="text-center">IP KOMULATIF</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($table):?>
                                <?php foreach($table as $t):?>
                                <tr>
                                    <td class="text-left">
                                        <?= $t['kettahunakad'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['totalskskrs'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['totalskskhs'] ?>
                                    </td>
                                    
                                    <td class="text-center">
                                        <?= $t['ipsemester'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['totalbobot'] ?>
                                    </td>
                                    <td class="text-center">
                                        
                                    </td>       
                                    <td class="text-center">
                                    <a href="<?= base_url() ?>Mahasiswa/Rencanastudi/Riwayatkrs/preview/<?= $t['idthnkhs'] ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                    </a>
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
