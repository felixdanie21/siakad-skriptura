<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $midenpt->ptnama ?></title>
  <link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/<?= $midenpt->ptlogo ?>">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- My css -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/myauth.css?n=2">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img style="width:50px;" src="<?= base_url() ?>assets/img/<?= $midenpt->ptlogo ?>" class="img-circle" alt="">
    <br>
    <small class="login-name"><b><?= $midenpt->ptnama ?></b></small>
  </div>
  <!-- /.login-logo -->