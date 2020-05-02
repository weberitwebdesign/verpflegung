<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MC
{
  protected $sControllerName = "";
  protected $sTableName      = "";

  public function __construct()
  {
    $this->sControllerName = $this->sTableName = strtolower(__CLASS__);
    parent::__construct($this->sControllerName, TRUE, FALSE);
  }

  public function index()
  {
    $aData['sControllerName'] = $this->sControllerName;
    $this->renderAll($this->sControllerName . '_view', $aData);
  }

  public function upload()
  {
    $sError = '';
    $sLog = '';
    $sError = $this->do_upload();
    $sLog = $sError == '' ? 'Upload erfolgreich' : '';

    if ($sError == "") {
      echo '<p class="bg-success"><strong>' . $_FILES['file-upload']['name'] . '</strong> - ' . $sLog . '</p>';
    } else {
      echo '<p class="bg-warning"><strong>' . $_FILES['file-upload']['name'] . '</strong> - ' . $sError . '</p>';
    }
  }

  private function do_upload()
  {
// Source
    $sSource = $_FILES['file-upload']['tmp_name'];

    $aConfig['upload_path'] = './assets/img/prod_img/';
    $aConfig['allowed_types'] = 'jpg|png';
    $aConfig['max_size']     = '1000';
    $aConfig['min_width'] = '600';
    $aConfig['min_height'] = '300';
    $aConfig['overwrite'] = true;
    $aConfig['file_ext_tolower'] = true;
    $this->load->library('upload', $aConfig);

// Überprüfung der Bildatei
    if (!$this->upload->do_upload('file-upload')){
      return $this->upload->display_errors('','');
    } else {

// Konfiguration für das Zuschneiden und Resize
      $aImgFile = $this->upload->data();
      $this->load->library('image_lib');
      if ($aImgFile['image_width'] <= $aImgFile['image_height']){
        $aImgConfig['width']          = 680;
        $bWidth = true;
      } else {
        $aImgConfig['height']         = 330;
        $bWidth = false;
      }
      $aImgConfig['image_library']  = 'gd2';
      $aImgConfig['source_image']   = $aConfig['upload_path'] . $aImgFile['file_name'];
      $aImgConfig['create_thumb']   = false;
      $aImgConfig['maintain_ratio'] = true;
      $aImgConfig['quality']        = '100%';

// Resize der Bilddatei
      $this->image_lib->initialize($aImgConfig);
      $this->image_lib->resize();

// Zuschneiden der Bilddatei
      $iImgHeight = $aImgFile['image_height'] / ($aImgFile['image_width'] / 680);
      $iImgWidth = $aImgFile['image_width'] / ($aImgFile['image_height'] / 330);

      if ($bWidth) {;
        $aImgConfig['y_axis'] = ($iImgHeight - 680) / 2;
      } else {
        $aImgConfig['x_axis'] = ($iImgWidth - 330) / 2;
      }
      $aImgConfig['maintain_ratio'] = false;
      $this->image_lib->clear();
      $this->image_lib->initialize($aImgConfig);
      $this->image_lib->crop();
    }
  }
}
