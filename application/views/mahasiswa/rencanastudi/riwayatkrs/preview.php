<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1 class="font-weight-bold">DETAIL KRS</h1>
                    <h5><?= $mhsbio->namamhs ?> (<?= $mhsbio->idnim ?>)</h5>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9 mx-auto">
                    
                        <?php foreach ($table as $mp): ?>
                        
                            <input class="form-control col-3 mr-1 mb-2" type="text" value="<?= $mp['kettahunakad']?>" readonly>
                        
                        <?php endforeach; ?>
                    
                
                    <table id="table1" class="table table-sm table-bordered bg-light table-hover">
                        <thead class="bg-info" style="position:sticky;top:0;">
                            <tr>
                                <th class="text-center">NAMA MAHASISWA</th>
                                <th class="text-center">KODE KELAS</th>
                                <th class="text-center">RIWAYAT MATAKULIAH</th>
                                <th class="text-center">SKS</th>
                                <th class="text-center">NILAI KRS</th>
                                <th class="text-center">BOBOT NILAI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($table):?>
                                <?php foreach($table as $t):?>
                                <tr>
                                    <td class="text-left">
                                    <?= $mhsbio->namamhs ?>
                                    </td>
                                    
                                    <td class="text-center">
                                        <?= $t['idkelaskrs'] ?>
                                    </td>
                                    
                                    <td class="text-center">
                                        <?= $t['rwymtkmhs'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['sksmtk'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['nilaikrs'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $t['bobotnilai'] ?>
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
