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

  public function index($iPage = 1)
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
    $aData['cart'] = $this->load->view('update_cart_view', '', TRUE);
    $this->renderAll($this->sControllerName . '_view', $aData);
  }

  public function edit($iPage)
  {
    $aCart = array(
      'id'      => $this->input->post('id', true),
      'qty'     => $this->input->post('qty', true),
      'price'   => $this->input->post('price', true),
      'name'    => $this->input->post('name', true),
    );

    echo 'hallo';
    $rowID = $this->cart->insert($aCart);
    echo $rowID;
    $aData['cart'] = $this->load->view('update_cart_view', '', TRUE);
    $this->index($iPage);
  }
  public function editr(){

  }

}
