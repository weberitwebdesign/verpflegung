

<div class="col-md-8">
<?php
  $count = 0;
  foreach ($menu as $i => $oMenu){
    $data = array(
      'id'  => $oMenu->ID,
      'price'   => $oMenu->VKPreis,
      'name' => substr($oMenu->Name,6, -1),
      'qty' => 1,
      'options' => array('DeliveryDate' => '2020-03-28'), //$aDeliveryDate,
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
            echo form_open($sUrlBase. $sCurrent . '/edit/2');
              echo form_hidden($data);
?>
              <p><input type="submit" name="mysubmit" value="Bestellen" class="btn btn-primary" />
              <a href="#" class="btn btn-default" role="button">Informationen</a></p>
            </form>
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
