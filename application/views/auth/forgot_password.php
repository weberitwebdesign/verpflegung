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

<h2><?php echo lang('forgot_password_heading');?></h2>
<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

<div class="row col-md-12">
  <?php echo ($message != "") ? '<div class="alert alert-danger" role="alert">' . $message . '</div>' : ''; ?>
  <div class="col-md-6">
    <?php echo form_open("auth/forgot_password");?>
      <div class="form-group">
        <?php echo form_label(sprintf(lang('forgot_password_email_label'), $identity_label),'identity','class="control-label"'); ?>
      	<?php echo form_input($identity);?>
      </div>
      <div class="form-group">
        <?php echo form_submit('submit', lang('forgot_password_submit_btn'), 'class="btn btn-primary"');?>
      </div>
    <?php echo form_close();?>
  </div>
</div>
