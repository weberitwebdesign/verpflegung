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
    if (array_key_exists('myorder' ,$this->input->post())){
      $aCart = array(
        'id'      => $this->input->post('id', true),
        'qty'     => $this->input->post('qty', true),
        'price'   => $this->input->post('price', true),
        'name'    => $this->input->post('name', true),
        'deliverydate' => $this->input->post('deliverydate', true),
        'options' => array('DeliveryDate' => '2020-04-08')
      );
      $rowID = $this->cart->insert($aCart);
    }

    $aData['sControllerName'] = $this->sControllerName;

// Gibt ein Array mit allen möglichen Lieferdaten zurück
    $aData['DeliveryDates'] = $this->Model->getDeliveryDates();
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

  public function edit($iPage)
  {


  }
  public function editr(){

  }

  public function payByBill(){
    $oKdNav = $this->Model->getKdNav($_SESSION['user_id']);
    $bSaveSuccess = $this->saveOrder($oKdNav[0]->kd_nav);
    if ($bSaveSuccess === true){
      $this->sendMailConfirmation($oKdNav[0]);
      $this->renderAll($this->sControllerName . '_confirmation_view');
      $this->cart->destroy();
    } else {
      $this->renderAll($this->sControllerName . '_error_view');
    }
  }
  public function payByTwint(){
    $oKdNav = $this->Model->getKdNav($_SESSION['user_id']);
    $bSaveSuccess = $this->saveOrder($oKdNav[0]->kd_nav);
    if ($bSaveSuccess === true){
      $this->sendMailConfirmation($oKdNav[0]);
      $this->renderAll($this->sControllerName . '_confirmation_view');
      $this->cart->destroy();
    } else {
      $this->renderAll($this->sControllerName . '_error_view');
    }
  }

  private function saveOrder($sKdNav){
    $bSaveSuccess = false;
    foreach ($this->cart->contents() as $items){
      $bSaveSuccess = $this->Model->saveOrder($sKdNav, $items);
    }
    return $bSaveSuccess;
  }

  private function sendMailConfirmation($sKdNav) {
  // Mail-Versand
  $this->load->library('email');
  $aConfig['charset'] = 'utf-8';
  $aConfig['wordwrap'] = true;
  $aConfig['useragent'] = 'Microsoft-Entourage/10.1.1.2418';
  $this->email->initialize($aConfig);

  $sText  = $this->lang->line('payment_ok') . PHP_EOL . PHP_EOL;
  $sText  .= $this->lang->line('besten_dank_gruss');

  $this->email->message($sText);

  //$this->email->reply_to($this->config->item('kontakt_email'));
  $this->email->reply_to($this->config->item('kontakt_email'));

  $this->email->to($this->session->userdata('email'));
  $this->email->from($this->config->item('kontakt_email'));
  $this->email->subject($this->lang->line('payment_bestaetigung'));
  $this->email->send();

  $this->email->clear();

  $this->email->message($this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname') . ' hat bezahlt.' . PHP_EOL);
  $this->email->from('payment@klik-info.ch');
  $this->email->to($this->config->item('kontakt_email'));
  $this->email->to($this->config->item('webmaster'));
  $this->email->subject($this->lang->line('payment_bestaetigung'));
  return $this->email->send();
}
}
