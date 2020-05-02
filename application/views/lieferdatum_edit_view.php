<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<h2><?= $iId == -1 ? 'Neues Lieferdatum' : 'Lieferdatum editieren'; ?></h2>
<?php
echo form_open($sUrlBase . $sCurrent . '/edit/' . $iId);
  $sClass = form_error('lieferdatum') != '' ? 'form-group has-error' : 'form-group';
  echo '<div class="row">';
    echo '<div class="', $sClass, ' col-md-2">';
      echo form_label('Lieferdatum*', 'lieferdatum');
      $aAttribute = array(
        'name'     => 'lieferdatum',
        'id'       => 'lieferdatum',
        'type'     => 'date',
        'class'    => 'form-control',
        'required' => 'required',
        'tabindex' => '1',
        'value'    => set_value('lieferdatum', $lieferdatum),
      );
      echo form_input($aAttribute);
    echo '</div>';

    $sClass = form_error('bestellschluss*') != '' ? 'form-group has-error' : 'form-group';
    echo '<div class="', $sClass, ' col-md-2">';
      echo form_label('Bestellschluss*', 'bestellschluss');
      $aAttribute = array(
        'name'     => 'bestellschluss',
        'id'       => 'bestellschluss',
        'type'     => 'date',
        'class'    => 'form-control',
        'required' => 'required',
        'tabindex' => '2',
        'value'    => set_value('bestellschluss', $bestellschluss),
      );
      echo form_input($aAttribute);
    echo '</div>';
  echo '</div>';
echo form_submit('submit', 'speichern & neu', 'class="btn btn-primary"');
echo form_submit('submit', 'speichern & zurück', 'class="btn btn-primary"');
echo form_close();
 ?>
