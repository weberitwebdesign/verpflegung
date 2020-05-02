<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends My_Model
{
  public function getAllItems()
  {
    $this->db->select('id, first_name, last_name, company, username, email, phone, last_login, active, kd_nav');
    return $this->db->get('users')->result();
  }

  public function deleteItemAndRelatedRessources($iId, $sPath = '')
  {
      $sReturn = 'nok';
      $this->db->where('id', $iId);
      if ($this->db->delete('lieferdatum')) {
          $sReturn = 'ok';
      }
      return $sReturn;
  }
}
