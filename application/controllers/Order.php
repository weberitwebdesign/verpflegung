<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MC
{
  protected $sControllerName = "";
  protected $sTableName      = "";

  public function __construct()
  {
    $this->sControllerName = $this->sTableName = strtolower(__CLASS__);
    parent::__construct($this->sControllerName, FALSE, FALSE);
  }

  public function index()
  {
    $aData['sControllerName'] = $this->sControllerName;
    $this->renderAll($this->sControllerName . '_view', $aData);
  }
}
