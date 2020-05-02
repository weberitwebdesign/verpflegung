<?php
setlocale (LC_TIME, 'German', 'de_DE', 'deu', "de_DE.UTF-8");
?>
<div class="row">
<h2>Benutzer</h2>
</div>

<div class="row">
<table class="table table-bordered table-striped  table-condensed" id="tabelle_users">
  <tr>
    <th>Vorname</th>
    <th>Nachname</th>
    <th>Firma</th>
    <th>Anforderer</th>
    <th>E-Mail</th>
    <th>Telefon</th>
    <th>Letzes Anmelden</th>
    <th id="status" class="text-center">Status</th>
    <th id="buttons" class="text-right">
      <a class="btn btn-default" href="<?= $sUrlBase, $sCurrent, '/create' ?>" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
    </th>
  </tr>
  <?php
  if (is_array($aItems) && count ($aItems) > 0) {
    foreach ($aItems as $i => $oItem) {
      switch ($oItem->active){
        case 0:
          $activeStatus = '<button class="btn status" aria-label="Status inaktiv" id="users_'. $oItem->id.'_1" sytle="color:#646864; background-color: #e5e5e5;">
                           <span id="icon_' . $oItem->id . '" class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                           </button>';
          break;
        case 1:
          $activeStatus = '<button class="btn alert-success status" aria-label="Status aktiv" id="users_'. $oItem->id.'_0" >
                           <span id="icon_' . $oItem->id . '" class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
                           </button>';
          break;
      }
      ?>
      <tr id="item_<?= $oItem->id; ?>">
        <td><?= $oItem->first_name; ?></td>
        <td><?= $oItem->last_name; ?></td>
        <td><?= $oItem->company; ?></td>
        <td><?= $oItem->kd_nav; ?></td>
        <td><?= $oItem->email; ?></td>
        <td><?= $oItem->phone; ?></td>
        <td><?= strftime("%A, %d.%m.%Y", $oItem->last_login); ?></td>
        <td class="text-center"><?= $activeStatus; ?></td>
        <td class="text-right">
          <a class="btn btn-default" href="<?= $sUrlBase, $sCurrent, '/edit/', $oItem->id; ?>" role="button"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
          <button class="btn btn-default alert-danger delete"  role="button" id="lieferdatum_<?= $oItem->id; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
        </td>
      </tr>
      <?php
    }
  }
?>
</table>
</div>
