<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold"><?= $jenis ?> DATA ORANGTUA</h1>
                <a href="<?= base_url() ?>Akademik/Mahasiswa/Dataorangtua/index/<?= $mhsbio->idnim?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                    <form action="<?= base_url() ?>Akademik/Mahasiswa/Dataorangtua/simpan/<?= $jenis ?>" method="post">
                        <div class="card-body">
                        <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NAMA MAHASISWA</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="idnim" id="idnim">
                                        <option value="<?= $mhsbio->idnim?>"><?= $mhsbio->namamhs?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NAMA BAPAK</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="namabapak" id="namabapak" maxlength="15" <?php if($jenis == 'TAMBAH'):?>required<?php else:?>value="<?= $mhsprf->namabapak ?>" readonly<?php endif;?>>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">KERJA BAPAK</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="kerjabapak" id="kerjabapak" maxlength="50" <?php if($jenis == 'EDIT'):?>value="<?= $mhsprf->kerjabapak ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">ALAMAT ORANGTUA</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="alamatortu" id="alamatortu" maxlength="50" <?php if($jenis == 'EDIT'):?>value="<?= $mhsprf->alamatortu ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">PENGHASILAN ORANGTUA</label>
                                <div class="col-sm-3">
                                    <input  type="number" class="form-control" name="penghasilanortu" id="penghasilanortu" <?php if($jenis == 'EDIT'):?>value="<?= $mhsprf->penghasilanortu ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NOMOR HP/WA</label>
                                <div class="col-sm-3">
                                    <input  type="text" class="form-control" name="nomorhpwaortu" id="nomorhpwaortu" <?php if($jenis == 'EDIT'):?>value="<?= $mhsprf->nomorhpwaortu ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">NAMA IBU</label>
                                <div class="col-sm-7">
                                    <input  type="text" class="form-control" name="namaibu" id="namaibu" <?php if($jenis == 'EDIT'):?>value="<?= $mhsprf->namaibu ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">KERJA IBU</label>
                                <div class="col-sm-3">
                                    <input  type="text" class="form-control" name="kerjaibu" id="kerjaibu" <?php if($jenis == 'EDIT'):?>value="<?= $mhsprf->kerjaibu ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">ASAL SEKOLAH</label>
                                <div class="col-sm-5">
                                    <input  type="text" class="form-control" name="asalsekolah" id="asalsekolah" <?php if($jenis == 'EDIT'):?>value="<?= $mhsprf->asalsekolah ?>"<?php endif;?> required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label for="inputPassword" class="col-sm-3 col-form-label font-weight-normal text-sm-right">JURUSAN SEKOLAH</label>
                                <div class="col-sm-5">
                                    <input  type="text" class="form-control" name="jurusansekolah" id="jurusansekolah" <?php if($jenis == 'EDIT'):?>value="<?= $mhsprf->jurusansekolah ?>"<?php endif;?> required>
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