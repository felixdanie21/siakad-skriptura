<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 text-center">
            <h1 class="font-weight-bold">SISTEM AKADEMIK <?= $midenpt->ptnama ?></h1>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php foreach ($mmodul as $modul) : ?>
                    <?php if((($modul['kodemodul'] == "BE" || $modul['kodemodul'] == "BF" || $modul['kodemodul'] == "BG") && $this->session->userdata('userstat') == 'SA') || $this->session->userdata('userstat') !== 'SA'):?>
                        <div class="col-sm-4">
                            <a href="<?= base_url() . $modul['kontroler'] ?>">
                                <div class="info-box">
                                    <span class="info-box-icon bg-modul"><i class="<?= $modul['icon'] ?>"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text font-weight-bold text-dark"><?= $modul['namamodul'] ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif;?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->