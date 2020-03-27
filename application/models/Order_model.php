<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends MY_Model{


  public function getDeliveryDates()
  {
    $this->db->where('lieferdatum <=', $this->getHighestDate());
    $this->db->where('bestellschluss >', date("Y-m-d H:i:s"));
    $this->db->order_by('lieferdatum', 'ASC');
    return $this->db->get('lieferdate')->result();
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
    $this->db->select('a.ID, a.Name, p.VKPreis');
    $this->db->where('a.ID = p.IDProdukt');
    $this->db->where('p.Startdatum <=', $sDt);
    $this->db->where('p.Enddatum >=', $sDt);
    $this->db->where('a.Name LIKE', 'Snäx%*');
    return $this->db->get('artikel AS a, preise AS p')->result();
  }
}
