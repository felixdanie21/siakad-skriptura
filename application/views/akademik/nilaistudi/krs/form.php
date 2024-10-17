<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA KRS</h1>
                <a href="<?= base_url() ?>Akademik/Nilaistudi/Krs"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 mx-auto">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= base_url() ?>Akademik/Nilaistudi/Krs/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                        <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right"> NIM</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="idnimkls" id="idnimkls">
                                    <?php foreach ($mhsbio as $mtk): ?>
                                        <option value="<?= $mtk['idnim'] ?>"><?= $mtk['idnim'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">Kelas</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="idkelaskrs" id="idkelaskrs">
                                        <?php foreach ($tkelas as $kls): ?>
                                            <option value="<?= $kls['idkelas'] ?>"><?= $kls['idkelas'] ?></option>
                                            <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">Riwayat Matakuliah</label>
                                <div class="col-sm-3">
                                <select class="form-control" name="rwymtkmhs" id="rwymtkmhs" required>
                                        <option value="" disabled selected>-- PILIH --</option>
                                        <div class="form-group row mb-1">
                                        <option value="B" <?php if($jenis == 'EDIT' && $tkrs->rwymtkmhs == 'B'): ?>selected<?php endif; ?>>BARU</option>
                                        <option value="U" <?php if($jenis == 'EDIT' && $tkrs->rwymtkmhs == 'U'): ?>selected<?php endif; ?>>Ulang</option>
                                </select>      
                                    </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">SKS</label>
                                <div class="col-sm-2">
                                    <input  type="number" class="form-control" name="sksmtk" id="sksmtk" maxlength="1" <?php if($jenis == 'EDIT'):?>value="<?= $tkrs->sksmtk?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">Bobot Nilai</label>
                                <div class="col-sm-2">
                                    <input  type="text" class="form-control" name="bobotnilai" id="bobotnilai" maxlength="1" <?php if($jenis == 'EDIT'):?>value="<?= $tkrs->bobotnilai?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">Nilai Krs</label>
                                <div class="col-sm-2">
                                    <input  type="text" class="form-control" name="nilaikrs" id="nilaikrs" maxlength="2" <?php if($jenis == 'EDIT'):?>value="<?= $tkrs->nilaikrs?>"<?php endif;?> required>
                                </div>
                            </div>
                    
                        
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-primary">SIMPAN</button>
                        </div>
                    </form>
                </div>
            <!-- /.card -->
            </div>
        </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
