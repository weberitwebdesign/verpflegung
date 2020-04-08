<div class="row">
  <h2>Bestellung <small> Wählen Sie Ihr gewünschtes Lieferdatum</small></h2>
<?php
  foreach ($DeliveryDates as $i => $oLiefertag){
    echo '<a class="btn btn-default" href="' . $sUrlBase . $sCurrent . '/' . $i . '" role="button">' . nice_date($oLiefertag->lieferdatum, 'l, d.m.Y') . '</a>';
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
          <img src="<?=$sUrlBase;?>assets/img/<?= $oMenu->ID;?>.png" alt="...">
          <div class="caption">
            <h4><?= substr($oMenu->Name,6, -1);?></h4>
            <p>CHF <?= $oMenu->VKPreis;?></p>
<?php
            echo form_open($sUrlBase. $sCurrent . '/0');
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
