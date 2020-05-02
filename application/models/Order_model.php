<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model{


  public function getDeliveryDates()
  {
    $this->db->where('lieferdatum <=', $this->getHighestDate());
    $this->db->where('bestellschluss >=', date("Y-m-d"));
    $this->db->where('status >', 0);
    $this->db->order_by('lieferdatum', 'ASC');
    return $this->db->get('lieferdatum')->result();
  }

  public function getHighestDate(){
    $query = $this->db->query("SELECT MAX(Enddatum) AS datum FROM artikel AS a
    LEFT JOIN preise AS p ON a.id = p.IDProdukt
    WHERE a.Name LIKE 'Snäx%*'");
    $row = $query->row();
    return $row->datum;
  }

  public function getProducts($sDt)
  {
    $this->db->select('a.ID, a.Name, p.VKPreis, a.Allergene, a.Spuren');
    $this->db->where('a.ID = p.IDProdukt');
    $this->db->where('p.Startdatum <=', $sDt);
    $this->db->where('p.Enddatum >=', $sDt);
    $this->db->where('a.Name LIKE', 'Snäx%*');
    return $this->db->get('artikel AS a, preise AS p')->result();
  }

  public function saveOrder($sKdNav, $items = array()){
    $aData = array(
      'Kunde' => $sKdNav,
      'Datum' => $items['deliverydate'],
      'Was' => 'Einzelartikel',
      'MLorArtnr' => $items['id'],
      'Anzahl' => $items['qty'],
      'Created' => date("Y-m-d H:i:s", now()),
    );
    return $this->db->insert('bestellung', $aData);
  }

  public function getKdNav($userId){
    $this->db->select('kd_nav', 'firstname', 'lastname');
    $this->db->where('id', $userId);
    return $this->db->get('users')->result();
  }
}
