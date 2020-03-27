<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model{

    /**
       * name:        getRow
       *
       * get associative array with data from one Record
       *
       * @param       string  $sTable    database table name
       * @param       string  $sFields   fieldnames, comma separated
       * @param       array   $aWHere    data for WHERE-Clause, key =
       *                                 fieldname, value = search string
       * @param       string  $sSort    field(s) for ORDER BY
       * @return      object
       *
       * @author      Roger Klein - rklein [at] klik-info [dot] ch
       * @date        20100610
       *
       **/
      public function getRow($sTable,
                             $sFields,
                             $aWhere,
                             $sSort = '')
      {
         $this->db->select($sFields, false);
         $sSort  != '' and  $this->db->order_by($sSort);
         return $this->db->get_where($sTable, $aWhere)->row_array();
      }

    public function saveRecord($sTable, $aData, $iItemId = -1, $sIdField = 'id', $autoincrement = true)
    {
        $this->filterDataArray($sTable, $aData);
        if ($iItemId != -1){
            $this->db->where($sIdField, $iItemId);
            $this->db->update($sTable, $aData);
        } else {
            if ($autoincrement === false) {
                $iItemId = $aData[$sIdField] = $this->getNextId($sTable);
                $this->db->insert($sTable, $aData);
            } else {
                $this->db->insert($sTable, $aData);
                $iItemId = $this->db->insert_id();
            }
        }
        return $iItemId;
    }

    private function filterDataArray($sTable, $aData)
    {
        $aFields = $this->db->list_fields($sTable);
        foreach ($aData as $key => $value) {
            if (in_array($key, $aFields) == false){
                unset($aData[$key]);
            }
        }
    }

    private function getNextId($sTable, $sIdField = 'id', $sWhere = '')
    {
        return $this->getNextValue($sTable, $sIdField, $sWehere);
    }

    private function getNextValue($sTable, $sIdField = 'id', $sWhere ='')
    {
        if ($sTable == '') {return -1;}
        $iReturnValue = 1;
        $this->db->select_max($sIdField, 'max');
        $sWhere != '' and $this->db->where($sWhere);
        $oResult = $this->db->get($sTable)->result();
        isset($oResult[0]) and $iReturnValue = $oResult[0]->max + 1;
        return $iReturnValue;
    }

    private function deleteTable($sTableName){
        $this->db->truncate($sTableName);
    }
}
