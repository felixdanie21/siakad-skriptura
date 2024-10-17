<div class="card">
    <div class="card-body login-card-body rounded-circle">
        <p class="login-box-msg">Silahkan Login terlebih dahulu</p>

        <?php if($this->session->userdata('authinfomsg')):?>
        <div class="alert alert-info" role="alert">
            <?= $this->session->userdata('authinfomsg') ?>
            <?php $this->session->unset_userdata('authinfomsg');?>
        </div>
        <?php endif;?>

        <?php if($this->session->userdata('autherrormsg')):?>
            <div class="alert alert-danger" role="alert">
                <?= $this->session->userdata('autherrormsg') ?>
                <?php $this->session->unset_userdata('autherrormsg');?>
            </div>
        <?php endif;?>

        <?php if($this->session->userdata('authsuccessmsg')):?>
            <div class="alert alert-success" role="alert">
                <?= $this->session->userdata('authsuccessmsg') ?>
                <?php $this->session->unset_userdata('authsuccessmsg');?>
            </div>
        <?php endif;?>

        <form action="<?= base_url() ?>Auth/login_post" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="User ID" name="userid" autofocus required>
            <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">
                Remember Me
                </label>
            </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">MASUK</button>
            </div>
            <!-- /.col -->
        </div>
        </form>
    </div>
    <!-- /.login-card-body -->
</div>
