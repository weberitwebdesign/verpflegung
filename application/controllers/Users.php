<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MC
{
  protected $sControllerName = "";
  protected $sTableName      = "";

  public function __construct()
  {
    $this->sControllerName = $this->sTableName = strtolower(__CLASS__);
    parent::__construct($this->sControllerName, TRUE);

     $this->load->library(array('ion_auth', 'form_validation'));
     $this->load->helper('date');
  }

  public function index()
  {
    $aData['sControllerName'] = $this->sControllerName;
    $aData['aItems'] = $this->Model->getAllItems();
    $this->renderAll($this->sControllerName . '_view', $aData);
  }

  public function create()
  {
    if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$identity_column = $this->config->item('identity', 'ion_auth');
		$this->data['identity_column'] = $identity_column;

    $this->_prepareValidationNewUser();

    if ($this->form_validation->run() === TRUE)
    {
      $email = strtolower($this->input->post('email'));
      $identity = $email;
      $password = implode('',$this->_createPassword());

      $additional_data = [
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'company' => $this->input->post('company'),
				'phone' => $this->input->post('phone'),
        'kd_nav' => $this->input->post('kd_nav'),
			];
    }
    if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data))
		{
      $this->session->set_flashdata('message', $this->ion_auth->messages());
      $this->_sendConfirmation($email, $password);
      redirect("users", 'refresh');
		} else {
      $this->aData['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

      $this->aData['first_name'] = [
        'name' => 'first_name',
        'id' => 'first_name',
        'type' => 'text',
        'class' => 'form-control',
        'tabindex' => '1',
        'value' => $this->form_validation->set_value('first_name'),
      ];
      $this->aData['last_name'] = [
        'name' => 'last_name',
        'id' => 'last_name',
        'type' => 'text',
        'class' => 'form-control',
        'tabindex' => '2',
        'value' => $this->form_validation->set_value('last_name'),
      ];

      $this->aData['company'] = [
        'name' => 'company',
        'id' => 'company',
        'type' => 'text',
        'class' => 'form-control',
        'tabindex' => '3',
        'value' => $this->form_validation->set_value('company'),
      ];

      $this->aData['email'] = [
        'name' => 'email',
        'id' => 'email',
        'type' => 'email',
        'class' => 'form-control',
        'tabindex' => '4',
        'value' => $this->form_validation->set_value('email'),
      ];

      $this->aData['phone'] = [
        'name' => 'phone',
        'id' => 'phone',
        'type' => 'tel',
        'class' => 'form-control',
        'tabindex' => '5',
        'value' => $this->form_validation->set_value('phone'),
      ];

      $this->aData['kd_nav'] = [
        'name' => 'kd_nav',
        'id' => 'kd_nav',
        'type' => 'text',
        'class' => 'form-control',
        'tabindex' => '6',
        'value' => $this->form_validation->set_value('kd_nav'),
      ];


      $aData['sControllerName'] = $this->sControllerName;
      $this->renderAll($this->sControllerName . '_new_view', $this->aData);
    }
  }

  private function _createPassword()
  {
    $iLaenge = $this->config->item('min_password_length', 'ion_auth');
    $arr = array_merge(
            range(2, 9),
            range('a', 'h'),
            array('m', 's', 'w', 'x', 'y', 'z'),
            array('@', '&', '%', '!', '$', '+'));
    shuffle($arr);
    $a_code = array_slice($arr, 0, $iLaenge);
    return $a_code;
  }

  private function _prepareValidationNewUser()
  {
    $tables = $this->config->item('tables', 'ion_auth');
    $aRules = array(
      array(
        'field' => 'first_name',
        'label' => 'Vorname',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'last_name',
        'label' => 'Nachname',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'email',
        'label' => 'E-Mail',
        'rules' => 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]'
      ),
      array(
        'field' => 'phone',
        'label' => 'Telefon',
        'rules' => 'trim'
      ),
      array(
        'field' => 'company',
        'label' => 'Firma',
        'rules' => 'trim'
      ),
      array(
        'field' => 'kd_nav',
        'label' => 'Anforderer Navision',
        //'rules' => 'trim|required'
        'rules' => 'trim|required|is_unique[' . $tables['users'] . '.kd_nav]'
      )
    );

    $this->form_validation->set_rules($aRules);
  }

  private function _sendConfirmation($email, $password)
  {
    $this->load->library('email');

    $this->email->from('no_reply@bernet-catering.ch', 'Bernet Catering');
    $this->email->to($email);

    $this->email->subject('Zugangsdaten https://verpflegung.bernet-catering.ch');
    $this->email->message('Grüezi und herzlich willkommä. Dis Passwort luutet: ' . $password);
    $this->email->send();
  }
}
