<h2>Wie möchten Sie bezahlen</h2>

<div class="list-group">
  <a href="<?=$sUrlBase . $sCurrent;?>/payByBill" class="list-group-item">
    <div class="media">
      <div class="media-left media-middle col-md-3">
          <img class="media-object" src="<?=$sUrlBase;?>assets/img/rechnung.png" alt="Bezahlung auf Rechnung">
      </div>
      <div class="media-body">
        <h4 class="media-heading">Bezahlung auf Rechnung</h4>
        Wir senden Ihnen die papierlose Rechnung per E-Mail. Zahlungsfrist 14 Tagen
      </div>
    </div>
  </a>
</div>

<div class="list-group">
  <a href="#twintmodal" data-toggle="modal" data-target="#twintmodal" data-backdrop="static" class="list-group-item">
<!--  <a href="<?=$sUrlBase . $sCurrent;?>/payByTwint" class="list-group-item"> -->
    <div class="media">
      <div class="media-left media-middle col-md-3">
          <img class="media-object" src="<?=$sUrlBase;?>assets/img/twint.png" alt="Bezahlung mit Twint">
      </div>
      <div class="media-body">
        <h4 class="media-heading">Bezahlung mit Twint</h4>
        Bequem, einfach & schnell.
      </div>
    </div>
  </a>
</div>

<div class="modal fade twintmodal" tabindex="-1" role="dialog" aria-labelledby="twintmodal" aria-hidden="true" id="twintmodal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4>Bezahlen mit Twint</h4>
      </div>
      <div class="modal-body text-center">
        <p>Bitte scannen Sie den QR-Code in Ihrer Twint App und geben Sie den Totalbetrag <strong>CHF <?php echo $this->cart->format_number($this->cart->total()); ?></strong> ein.</p>
        <img src="<?=$sUrlBase;?>assets/img/twint_qr.jpg" style="width:233px; height:300px">
        <p><strong>Totalbetrag CHF <?php echo $this->cart->format_number($this->cart->total()); ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Abbruch</button>
        <button type="button" class="btn btn-primary">Done</button>
    </div>
  </div>
</div>
<!-- <div class="list-group">
  <a href="#" class="list-group-item">
    <div class="media">
      <div class="media-left media-middle col-md-3">
          <img class="media-object" src="<?=$sUrlBase;?>assets/img/creditcard.png" alt="Bezahlung mit Kreditkarten">
      </div>
      <div class="media-body">
        <h4 class="media-heading">Bezahlung mit Kreditkarten</h4>
        Wir akzeptieren MasterCard & Visa
      </div>
    </div>
  </a>
</div> -->
