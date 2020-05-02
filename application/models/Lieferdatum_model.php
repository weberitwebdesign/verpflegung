<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lieferdatum_model extends My_Model
{
  public function getAllItems()
  {
    $this->db->select('*');
    $this->db->where('lieferdatum >=', date("Y-m-d H:i:s"));
    $this->db->order_by('lieferdatum', 'ASC');
    return $this->db->get('lieferdatum')->result();
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
