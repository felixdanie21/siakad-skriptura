
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>Dashboard/Index" class="brand-link">
      <img style="width:35px;height:45px;border-radius:50%" src="<?= base_url() ?>assets/img/<?= $midenpt->ptlogo ?>" class="brand-image">
      <small class="brand-text font-weight-light"><?= $midenpt->ptnama ?></small>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>assets/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a style="cursor:pointer;" data-toggle="modal" data-target="#modalprofile" class="d-block"><?= $this->session->userdata('username') ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav style="font-size:12px;" class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php if($indukmenu !== 'BA010000'):?>
          <li class="nav-item">
              <a id="#" href="<?= base_url() ?>Dashboard/Index" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                      DASHBOARD
                  </p>
              </a>
          </li>
          <?php endif;?>
          <?php foreach ($mmenu as $menu) : ?>
              <?php if ($menu['levelmenu'] == '1') : ?>
                  <?php
                  $this->db->where('indukmenu', $menu['kodemenu']);
                  $submenu = $this->db->get('mmenu')->result_array();
                  ?>
                  <?php if ($submenu) : ?>
                      <?php
                      $submenu = $this->MenuModel->listsubmenu($menu['kodemenu']);
                      ?>
                      <li onclick="menuOpen('<?= $menu['kodemenu'] ?>')" id="<?= $menu['kodemenu'] ?>tree" class="nav-item">
                          <a id="<?= $menu['kodemenu'] ?>" href="<?= base_url() ?><?= $menu['kontroler'] ?>" class="nav-link">
                              <i id="<?= $menu['kodemenu'] ?>icon" class="nav-icon fas fa-folder"></i>
                              <p>
                                  <?= $menu['namamenu'] ?>
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <?php foreach ($submenu as $sm) : ?>
                                  <li class="nav-item ml-3">
                                      <a id="<?= $sm['kodemenu'] ?>" href="<?= base_url() ?><?= $sm['kontroler'] ?>" class="nav-link">
                                          <i class="nav-icon fas fa-file-alt"></i>
                                          <p> <?= $sm['namamenu'] ?></p>
                                      </a>
                                  </li>
                              <?php endforeach; ?>
                          </ul>
                      </li>
                  <?php else : ?>
                      <li class="nav-item">
                          <a id="<?= $menu['kodemenu'] ?>" href="<?= base_url() ?><?= $menu['kontroler'] ?>" class="nav-link">
                              <i class="nav-icon fas fa-file-alt"></i>
                              <p>
                                  <?= $menu['namamenu'] ?>
                              </p>
                          </a>
                      </li>
                  <?php endif; ?>
              <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

   <!-- modal logout -->
   <div class="modal fade" id="modalprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="exampleModalLabel">PROFILE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="<?= base_url() ?>Profile/update" method="POST">
            <div class="modal-body">
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-4 font-weight-normal  col-form-label">User Id</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputPassword" value="<?= $this->session->userdata('userid') ?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-4 font-weight-normal  col-form-label">Username</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputPassword" value="<?= $this->session->userdata('username') ?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-4 font-weight-normal  col-form-label">Password</label>
                <div class="col-sm-8">
                  <input type="password" name="passwordlama" maxlength="10" class="form-control" id="inputPassword" placeholder="Password Lama">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-4 font-weight-normal  col-form-label">Password Baru</label>
                <div class="col-sm-8">
                  <input type="password" name="passwordbaru" maxlength="10" class="form-control" id="inputPassword" placeholder="Masukan Password Baru">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-4 font-weight-normal  col-form-label">Konfirmasi Password</label>
                <div class="col-sm-8">
                  <input type="password" name="passwordbaru2" maxlength="10" class="form-control" id="inputPassword" placeholder="Masukan Password Baru Kembali">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-block">UPDATE</button>
            </div>
        </form>
        </div>
    </div>
  </div>