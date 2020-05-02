<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lieferdatum extends MC
{
  protected $sControllerName = "";
  protected $sTableName      = "";

  public function __construct()
  {
    $this->sControllerName = $this->sTableName = strtolower(__CLASS__);
    parent::__construct($this->sControllerName, TRUE);

     $this->load->library('form_validation');
     $this->load->helper('date');
  }

  public function index()
  {
    $aData['sControllerName'] = $this->sControllerName;
    $aData['aItems'] = $this->Model->getAllItems();
    $this->renderAll($this->sControllerName . '_view', $aData);
  }

  public function edit($iId= -1)
  {
    $this->_prepareValidation();
    if ($this->form_validation->run() === false){
      $this->_showPage(array('iId' => $iId));
    } else {
      try {
        $aData['lieferdatum']    = $this->input->post('lieferdatum', true);
        $aData['bestellschluss'] = $this->input->post('bestellschluss', true);

        $aData['iId'] = $iId = $this->Model->saveRecord($this->sTableName, $aData, $iId);
        if ($this->input->post('submit') == 'speichern & neu'){
          redirect('lieferdatum/edit/-1', 'refresh');
        } else {
          redirect('Lieferdatum', 'refresh');
        }
      }
      catch(exception $e){
        $this->_showPage(array('iId' => $iId));
      }
    }
  }
  private function _showPage($aData = array())
  {
    $aData = array(
      'iId'      => $aData['iId'],
      'lieferdatum' => '',
      'bestellschluss' => '',
      'status' => '',
    );

    if ($aData['iId'] != -1) {
      $row = $this->Model->getRow($this->sTableName,
                                  'lieferdatum, bestellschluss, status',
                                   array('id' => $aData['iId'])
                                  );
      $aData = array_merge($aData, $row);
    }
    $aData['sControllerName'] = $this->sControllerName;
    $this->renderAll($this->sControllerName . '_edit_view', $aData);
    }

  private function _prepareValidation()
  {
    $aRules = array(
      array(
        'field' => 'lieferdatum',
        'label' => 'Lieferdatum',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'bestellschluss',
        'label' => 'Bestellschluss',
        'rules' => 'trim|required'
      )
    );

    $this->form_validation->set_rules($aRules);
  }

  public function deleteRecord()
  {
    $iId = $this->input->post('iId', true);
    if ((string)((int)$iId) !== $iId) {
      exit('nok');
    } else {
      exit($this->Model->deleteItemAndRelatedRessources($iId));
    }
  }

  public function setStatus($iId, $iStatus = 0)
  {
    $sReturn = 'nok';
    if (($iStatus == 0 || $iStatus == 1 || $iStatus == 2) && (string)((int)$iId) === $iId
     && $this->Model->saveRecord($this->sTableName, array('status' => $iStatus), $iId)) {
       $aStatus = array('inaktiv', 'prüfung', 'aktiv');
       $sReturn = $aStatus[$iStatus];
    }
    exit ($sReturn);
  }
}
