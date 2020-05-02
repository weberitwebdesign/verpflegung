<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<h2>Neuer Benutzer</h2>
<?= $message;?>

<?php
echo form_open($sUrlBase . $sCurrent . '/create');
  echo '<div class="form-horizontal">';

    $sClass = form_error('first_name') != '' ? 'form-group has-error' : 'form-group';
    echo '<div class="', $sClass, '">';
      echo form_label('Vorname *', 'first_name', 'class="col-md-2 control-label"');
      echo '<div class="col-md-6">';
        echo form_input($first_name);
    echo '</div></div>';

    $sClass = form_error('last_name') != '' ? 'form-group has-error' : 'form-group';
    echo '<div class="', $sClass, '">';
      echo form_label('Nachnamen*', 'last_name', 'class="col-md-2 control-label"');
      echo '<div class="col-md-6">';
        echo form_input($last_name);
    echo '</div></div>';

    $sClass = form_error('company') != '' ? 'form-group has-error' : 'form-group';
    echo '<div class="', $sClass, '">';
      echo form_label('Firma', 'company', 'class="col-md-2 control-label"');
      echo '<div class="col-md-6">';
        echo form_input($company);
    echo '</div></div>';

    $sClass = form_error('email') != '' ? 'form-group has-error' : 'form-group';
    echo '<div class="', $sClass, '">';
      echo form_label('E-Mail', 'email', 'class="col-md-2 control-label"');
      echo '<div class="col-md-6">';
        echo form_input($email);
    echo '</div></div>';

    $sClass = form_error('phone') != '' ? 'form-group has-error' : 'form-group';
    echo '<div class="', $sClass, '">';
      echo form_label('Telefon', 'phone', 'class="col-md-2 control-label"');
      echo '<div class="col-md-6">';
        echo form_input($phone);
    echo '</div></div>';

    $sClass = form_error('kd_nav') != '' ? 'form-group has-error' : 'form-group';
    echo '<div class="', $sClass, '">';
      echo form_label('Anforder ID *', 'kd_nav', 'class="col-md-2 control-label"');
      echo '<div class="col-md-6">';
        echo form_input($kd_nav);
    echo '</div></div>';
  echo '</div>';
  echo form_submit('submit', 'Benutzer erstellen', 'class="btn btn-primary"');
echo form_close();
