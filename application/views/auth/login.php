<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Bernet Catering GmbH</title>

<!-- Bootstrap CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

<!-- Debug Bar CSS -->
<?php
    if($_SERVER['CI_ENV'] != 'production'){
?>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/styles/github.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<?php
    }
?>

<!-- JQuery JS -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.4.1.min.js"></script>
</head>

<body>
  <div class='container'>
<?php
    echo ($this->ion_auth->logged_in())
     ? '<div class="row">' . $sMenu . '</div>'
     : '';
 ?>

<div class="row">
  <h2><?php echo lang('login_heading');?></h2>
  <p><?php echo lang('login_subheading');?></p>
</div>
<div class="row col-md-12">
<?php
  echo ($message != "") ? '<div class="alert alert-danger" role="alert">' . $message . '</div>' : '';
  ?>
  <div class="col-md-2">
    <img src="<?=base_url();?>assets/img/big_freddy.png" id="big_freddy">
    <br/>
    <br/>
    <a href="forgot_password" class="text-right"><?php echo lang('login_forgot_password');?></a>
  </div>
  <div class="col-md-4">
    <?php echo form_open("auth/login");?>
      <div class="form-group">
        <?php echo form_label(lang('login_identity_label'), 'identity', 'class="control-label"');?>
        <?php echo form_input($identity);?>
      </div>
      <div class="form-group">
        <?php echo form_label(lang('login_password_label'), 'password', 'class="control-label"');?>
        <?php echo form_input($password);?>
      </div>
      <div class="form-group">
        <div class="checkbox">
          <label>
            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
            <?php echo lang('login_remember_label', 'remember');?>
          </label>
        </div>
      </div>
      <div class="form-group">
        <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary"');?>
      </div>
    <?php echo form_close();?>
  </div>
</div>
