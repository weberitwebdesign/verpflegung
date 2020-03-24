<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MC extends CI_Controller
{
  protected $aHeaderData = array(
    'aCssFiles' => array(),
    'aJsFiles'  => array()
  );

  public function __construct($sCurrent  = '', $bLoadJS    = FALSE, $bLoadModel = TRUE)
  {
    parent::__construct();

// Enable Debugbar
    if (ENVIRONMENT != 'production'){
      $this->output->enable_profiler(TRUE);
    }

// Load the model as Model if set to true
    $bLoadModel and
     $this->load->model($this->config->item('backend') . '/' .ucfirst($sCurrent) . '_model', 'Model', TRUE);

// Load Java Script if set to true
    $bLoadJS === TRUE and
     $this->aHeaderData['aJsFiles'][] = $sCurrent . '.js';

     $this->aHeaderData['sCurrent'] = $sCurrent;
     $this->aHeaderData['sUrlBase'] = site_url();
   }

  protected function renderAll($sTemplate, $aContentData = array(), $AdditionalHeaderData = array())
  {
// Laden der Navigation
    $this->aHeaderData['sMenu'] = $this->load->view('nav', $this->aHeaderData, TRUE);

//Laden View Header
    $this->load->view('header', array_merge($this->aHeaderData, $AdditionalHeaderData));

//Laden der Hauptseite
    $this->load->view($sTemplate,array_merge($aContentData));

//Laden View Footer
    $this->load->view('footer');
  }
}
