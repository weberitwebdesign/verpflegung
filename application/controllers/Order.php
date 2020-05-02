<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MC
{
  protected $sControllerName = "";
  protected $sTableName      = "";

  public function __construct()
  {
    $this->sControllerName = $this->sTableName = strtolower(__CLASS__);
    parent::__construct($this->sControllerName, FALSE);
    $this->load->helper(array('date', 'form'));
    $this->load->library('cart');
  }

  public function index($iPage = 0)
  {
    $aData['iPage'] = $iPage;
    if (array_key_exists('myorder' ,$this->input->post())){
      setlocale (LC_TIME, 'German', 'de_DE', 'deu', "de_DE.UTF-8");
      $sDeliveryDate = $this->input->post('deliverydate', true);
      $sDeliveryDate = strftime("%A, %d.%m.%Y", strtotime($sDeliveryDate));
      $aCart = array(
        'id'      => $this->input->post('id', true),
        'qty'     => $this->input->post('qty', true),
        'price'   => $this->input->post('price', true),
        'name'    => $this->input->post('name', true),
        'deliverydate' => $this->input->post('deliverydate', true),
        'options' => array('Lieferdatum' => $sDeliveryDate)
      );
      $rowID = $this->cart->insert($aCart);
    }

    $aData['sControllerName'] = $this->sControllerName;

// Gibt ein Array mit allen möglichen Lieferdaten zurück
    $aData['DeliveryDates'] = $this->Model->getDeliveryDates();
    if (empty($aData['DeliveryDates'])){
      echo "error";
    }
    $aData['sDeliveryDate'] = $aData['DeliveryDates'][$iPage]->lieferdatum;


// Holt die Produkte für das Lieferdatum
    $aData['menu'] = $this->Model->getProducts($aData['DeliveryDates'][$iPage]->lieferdatum);
    $aData['cart'] = $this->load->view('order_cart_view', '', TRUE);
    $this->renderAll($this->sControllerName . '_view', $aData);
  }

  public function payment(){
    $this->renderAll($this->sControllerName . '_payment_view');
  }

/*  public function index($iPage = 1)
  {
    $aData['sControllerName'] = $this->sControllerName;
    $aDeliveryDates = $this->Model->getDeliveryDates();
    $iCountDates = count($aDeliveryDates);
    $aData['aDeliveryDate'] = $aDeliveryDates[$iPage-1];
    $iNextPage = $iPage +1;
    $iPrevPage = $iPage -1;
    if ($iCountDates != $iPage){
      $aData['show_right_arrow'] = '<a href="' . site_url() . 'order/' . $iNextPage . '">
          <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>';
    } else {
      $aData['show_right_arrow'] = '';
    }

    if ($iPage != 1){
      $aData['show_left_arrow'] = '<a href="' . site_url() . 'order/' . $iPrevPage . '">
          <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a>';
    } else {
      $aData['show_left_arrow'] = '';
    }

    $aData['menu'] = $this->Model->getProducts($aDeliveryDates[$iPage-1]->lieferdatum);

  } */



  public function payByBill(){
    $oKdNav = $this->Model->getKdNav($_SESSION['user_id']);
    vardump($oKdNav);
    $bSaveSuccess = $this->saveOrder($oKdNav[0]->kd_nav);
    if ($bSaveSuccess === true){
      $this->sendMailConfirmation($oKdNav[0]);
      $this->renderAll($this->sControllerName . '_confirmation_view');
      $this->cart->destroy();
    } else {
      $this->renderAll($this->sControllerName . '_error_view');
    }
  }
  public function paidByTwint(){
    $oKdNav = $this->Model->getKdNav($_SESSION['user_id']);
    $bSaveSuccess = $this->saveOrder($oKdNav[0]->kd_nav);
    if ($bSaveSuccess === true){
      $this->sendMailConfirmation();
      $this->renderAll($this->sControllerName . '_confirmation_view');
      $this->cart->destroy();
    } else {
      $this->renderAll($this->sControllerName . '_error_view');
    }
  }

  private function saveOrder($sKdNav){
    $bSaveSuccess = true;
    foreach ($this->cart->contents() as $items){
      if (!$this->Model->saveOrder($sKdNav, $items)){
        $bSaveSuccess = false;
      }
    }
    return $bSaveSuccess;
  }

  private function sendMailConfirmation()
  {
    // Mail-Versand
    $this->load->library('email');

    $sText  = 'Bezahlung mit Twint.' . PHP_EOL . PHP_EOL;
    $sText  .= 'Besten Dank für Ihre Bestellung';

    $this->email->message($sText);
    $this->email->to($this->session->userdata('email'), 'benjamin@fa-weber.ch');
    $this->email->from('no_reply@bernet-catering.ch', 'Bernet Catering');
    $this->email->subject('Ihre Bestellung bei Bernet Catering GmbH');

    $this->email->send();
  }

}
