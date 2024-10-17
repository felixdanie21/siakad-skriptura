<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1 class="font-weight-bold">MATAKULIAH DITAWARKAN</h1>
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
                <div class="col-10 mx-auto">
                <?php foreach ($table1 as $mp): ?>
                        
                        <input class="form-control col-3 mr-1 mb-2" type="text" value="<?= $mp['kettahunakad']?>" readonly>
                    
                    <?php endforeach; ?>
                
                    <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                        <thead class="bg-info" style="position:sticky;top:0;">
                            <tr>
                                <th class="text-center">KODE KELAS</th>
                                <th class="text-center">NAMA MATAKULIAH</th>
                                <th class="text-center">NAMA DOSEN</th>
                                <th class="text-center">KAPASITAS KELAS</th>
                                <th class="text-center">RUANG KELAS</th>
                                <th class="text-center">RUANG PRAKTIKUM</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($table):?>
                                <?php foreach($table as $t):?>
                                <tr>
                                    <td class="text-left">
                                        <?= $t['idkelas'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?= $t['namamtk'] ?>
                                    </td>
                                   
                                    <td class="text-left">
                                        <?= $t['namadosen'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['kapasitaskelas'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?= $t['namaruang'] ?>
                                    </td>
                                    <td class="text-left">
                                        <?= $t['koderuangprak'] ?>
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
