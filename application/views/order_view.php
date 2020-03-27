<div class="row">
  <h1>Bestellung</h1>
<?php
$datestring = '%l, %d. %F %Y';
$deltime = strtotime($aDeliveryDate->lieferdatum);
$ordtime = strtotime($aDeliveryDate->bestellschluss);
  echo '<h3>Lieferung am ' . mdate($datestring, $deltime) . '  ' . $show_left_arrow . '  ' . $show_right_arrow . '</h3>';
  echo "<p>Bestellschluss " .  mdate($datestring, $ordtime) . "</p>";

echo '</div>';
$count = 0;
echo '<div class="row">';
foreach ($menu as $i => $oMenu){
  $count++;
  echo ($count % 4 == 0) ? '<div class="row">' : '';
  ?>
  <div class="col-sm-4 col-md-3">
    <div class="thumbnail">
      <img src="assets/img/<?= $oMenu->ID;?>.png" alt="...">
      <div class="caption">
        <h4><?= substr($oMenu->Name,6, -1);?></h4>
        <p>CHF <?= $oMenu->VKPreis;?></p>
<?php   $data = array(
          'id'  => $oMenu->ID,
          'price'   => $oMenu->VKPreis,
          'name' => substr($oMenu->Name,6, -1),
          'qty' => 1
);
       echo form_open($sUrlBase. $sCurrent . '/edit/2');
        echo form_hidden($data);
        ?>
        <p><input type="submit" name="mysubmit" value="Submit Post!" class="btn btn-primary" />
           <a href="#" class="btn btn-default" role="button">Informationen</a></p>
         </form>
      </div>
    </div>
  </div>
<?php
echo ($count % 4 == 3) ? '</div>' : '';
} ?>
</div>
<?=$cart;?>
