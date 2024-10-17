<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA TAHUN AKADEMIK</h1>
                <a href="<?= base_url() ?>Konfigurasi/Tahunakademik"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5 mx-auto">
                <div class="card card-primary">
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="<?= base_url() ?>Konfigurasi/Tahunakademik/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                            <input type="hidden" class="form-control" name="idthn" id="idthn" <?php if($jenis == 'EDIT'):?>value="<?= $mthnak->idthn ?>"<?php endif;?>>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">TAHUN AKADEMIK</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="tahunakad" id="tahunakad" required>
                                        <?php for($tahun=2000;$tahun<2100;$tahun++):?>
                                            <option value="<?= $tahun ?>" <?php if(($jenis == 'EDIT' && $mthnak->tahunakad == $tahun) || ($jenis == "TAMBAH" && $tahun == date('Y'))): ?>selected<?php endif; ?>><?= $tahun ?></option>
                                        <?php endfor ;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="jenissemester" class="col-sm-4 col-form-label font-weight-normal text-sm-right">SEMESTER</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="jenissemester" id="jenissemester" required>
                                        <option value="" disabled>-- PILIH --</option>
                                        <option value="1" <?php if($jenis == 'EDIT' && $mthnak->jenissemester == '1'): ?>selected<?php endif; ?>>GASAL</option>
                                        <option value="2" <?php if($jenis == 'EDIT' && $mthnak->jenissemester == '2'): ?>selected<?php endif; ?>>GENAP</option>
                                    </select>
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