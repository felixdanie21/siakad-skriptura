<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold">ATUR MATAKULIAH PRASYARAT</h1>
                <a href="<?= base_url() ?>Akademik/Matakuliah/Prasyarat/?idmtkutama=<?= $matkul->idmtk?>"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                        <form action="<?= base_url() ?>Akademik/Matakuliah/Prasyarat/simpan/" method="post">
                            <div class="card-body">
                                <div class="form-group row mb-1">
                                        <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">NAMA MATAKULIAH</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="idmtkutama" id="idmtkutama">
                                                <option value="<?= $matkul->idmtk?>"><?= $matkul->namamtk?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label for="inputPassword" class="col-sm-4 col-form-label font-weight-normal text-sm-right">MATAKULIAH PRASYARAT</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2" multiple="multiple" data-placeholder="-- PILIH MATAKULIAH --" id="idmtksyarat" name="idmtksyarat[]" required>
                                                <?php foreach ($matakuliahsyarat as $mb): ?>
                                                    <?php 
                                                        $this->db->where('idmtkutama',$matkul->idmtk);
                                                        $this->db->where('idmtksyarat',$mb['idmtk']);
                                                        $isData = $this->db->get('mtksyr')->row();
                                                    ?>
                                                    <option value="<?= $mb['idmtk']?>" <?php if($isData):?>selected<?php endif;?>><?=$mb['namamtk']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
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