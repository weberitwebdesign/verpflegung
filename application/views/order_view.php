<div class="row">
  <h2>Bestellung <small> Wählen Sie Ihr gewünschtes Lieferdatum</small></h2>
<?php
setlocale (LC_TIME, 'German', 'de_DE', 'deu', "de_DE.UTF-8");

  foreach ($DeliveryDates as $i => $oLiefertag){
    $sClass = ($i ==  $iPage) ? 'active ' : '';
    if($this->ion_auth->is_admin()){
      switch($oLiefertag->status){
        case 1:
          $sClass .= 'btn btn-warning';
        break;
        case 2:
          $sClass .= 'btn btn-success';
        break;
      }
    echo '<a class="' . $sClass .'" href="' . $sUrlBase . $sCurrent . '/' . $i . '" role="button">' . strftime("%A, %d.%m.%Y", strtotime($oLiefertag->lieferdatum)) . '<br><small><small>Bestellschluss: ' . strftime("%A, %d.%m.%Y", strtotime($oLiefertag->bestellschluss)) . '</small></small></a> ';
    } else {
      if ($oLiefertag->status == '2'){
        echo '<a class="' . $sClass . 'btn btn-default" href="' . $sUrlBase . $sCurrent . '/' . $i . '" role="button">' . strftime("%A, %d.%m.%Y", strtotime($oLiefertag->lieferdatum)) . '<br><small><small>Bestellschluss: ' . strftime("%A, %d.%m.%Y", strtotime($oLiefertag->bestellschluss)) . '</small></small></a> ';
      }
    }

  }
?>
</div><br>

<div class="col-md-8">
<?php
  $count = 0;
  foreach ($menu as $i => $oMenu){
    $data = array(
      'id'  => $oMenu->ID,
      'price'   => $oMenu->VKPreis,
      'name' => substr($oMenu->Name,6, -1),
      'qty' => 1,
      'deliverydate' => $sDeliveryDate,
      'options' => array('DeliveryDate' => $sDeliveryDate), //$aDeliveryDate,
    );

    echo ($count % 3 == 0) ? '<div class="row">' : '';
?>
      <div class="col-md-4">
        <div class="thumbnail">
<?php
          if (realpath('assets/img/prod_img/' . $oMenu->ID . '.png')){
            $picurl = $sUrlBase . 'assets/img/prod_img/' . $oMenu->ID . '.png';
          } elseif (realpath('assets/img/prod_img/' . $oMenu->ID . '.jpg')) {
            $picurl = $sUrlBase . 'assets/img/prod_img/' . $oMenu->ID . '.jpg';
          } else {
            $picurl = $sUrlBase . 'assets/img/prod_img/no_pic.png';
          }
 ?>
          <img src="<?=$picurl;?>">
          <div class="caption">
            <h4><?= substr($oMenu->Name,6, -1);?></h4>
            <p>CHF <?= $oMenu->VKPreis;?></p>
<?php
            echo form_open($sUrlBase. $sCurrent . '/' .$iPage);
              echo form_hidden($data);
?>
              <p><input type="submit" name="myorder" value="Bestellen" class="btn btn-primary" />
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#<?= $oMenu->ID;?>_Modal">
                  <img src="<?=$sUrlBase;?>assets/img/info.png" style="width:20px; height:20px;">
                </button>
              </p>
            </form>
            <div class="modal fade" id="<?= $oMenu->ID;?>_Modal" tabindex="-1" role="dialog" aria-labelledby="meinModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Schließen">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="meinModalLabel">Hinweis zu <?= substr($oMenu->Name,6, -1);?></h4>
                  </div>
                  <div class="modal-body">
                    <strong>Allergene</strong>
                      <p><?= $oMenu->Allergene;?></p>
<?php
                        echo $oMenu->Spuren != ''
                         ? '<strong>Kann Spuren enthalten von:</strong><p>' . $oMenu->Spuren . '</p>'
                         : '';
?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php
    echo ($count % 3 == 2) ? '</div>' : '';
    $count++;
  }
  $count--;
  echo ($count % 3 != 2) ? '</div>' : '';
?>
</div>
<div class="col-md-4">
  <?=$cart;?>
</div>
