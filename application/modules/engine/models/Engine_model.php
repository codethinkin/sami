<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Engine_model extends CI_Model{
  var $table = 'engine';
  var $column_order = array(null,'nameEngine',null); //set column field database for datatable orderable
  var $column_search = array('nameEngine'); //set column field database for datatable searchable just firstname , lastname , address are searchable
  var $order = array('id' => 'desc'); // default order


////Modulo Conmbustible///////////

var $table2 = 'fuel';
var $column_order2 = array(null,'nameFuel',null); //set column field database for datatable orderable
var $column_search2 = array('nameFuel'); //set column field database for datatable searchable just firstname , lastname , address are searchable
var $order2 = array('id' => 'desc'); // default order

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function usrchk($usr) {
         $qry = "SELECT count(*) as cnt from engine where nameEngine= ? ";
         $res = $this->db->query($qry,array( $usr ))->result();
         if ($res[0]->cnt > 0) {
             echo '1';
         } else {
             echo '0';
         }
     }



  private function _get_datatables_query()
  {
    $this->db->from($this->table);
    $i = 0;
    foreach ($this->column_search as $item) // loop column
    {
      if($_POST['search']['value']) // if datatable send POST for search
      {
        if($i===0) // first loop
        {
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        }
        else
        {
          $this->db->or_like($item, $_POST['search']['value']);
        }
        if(count($this->column_search) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $i++;
    }
    if(isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }
    else if(isset($this->order))
    {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  function get_datatables()
  {
    $this->_get_datatables_query();
    if($_POST['length'] != -1)
    $this->db->limit($_POST['length'], $_POST['start']);
    return $this->db->get()->result();

  }

  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }


  public function get_by_id($id)
  {
    $this->db->from($this->table);
    $this->db->where('id',$id);
    $query = $this->db->get();
    return $query->row();
  }

  public function save($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function update($where, $data)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id)
  {
    $this->db->where('id', $id);
    $this->db->delete($this->table);
  }


//////////MODULO COMBUSTIBLES
private function _get_datatables_query_fuel()
{
  $this->db->from($this->table2);
  $i = 0;
  foreach ($this->column_search2 as $item) // loop column
  {
    if($_POST['search']['value']) // if datatable send POST for search
    {
      if($i===0) // first loop
      {
        $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
        $this->db->like($item, $_POST['search']['value']);
      }
      else
      {
        $this->db->or_like($item, $_POST['search']['value']);
      }
      if(count($this->column_search2) - 1 == $i) //last loop
        $this->db->group_end(); //close bracket
    }
    $i++;
  }
  if(isset($_POST['order'])) // here order processing
  {
    $this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
  }
  else if(isset($this->order2))
  {
    $order = $this->order2;
    $this->db->order_by(key($order2), $order[key($order2)]);
  }
}

function get_datatables_fuel()
{
  $this->_get_datatables_query();
  if($_POST['length'] != -1)
  $this->db->limit($_POST['length'], $_POST['start']);
  return $this->db->get()->result();

}

function count_filtered_fuel()
{
  $this->_get_datatables_query_fuel();
  $query = $this->db->get();
  return $query->num_rows();
}

public function count_all_fuel()
{
  $this->db->from($this->table2);
  return $this->db->count_all_results2();
}


public function get_by_id_fuel($id)
{
  $this->db->from($this->table2);
  $this->db->where('id',$id);
  $query = $this->db->get();
  return $query->row();
}

public function save_fuel($data)
{
  $this->db->insert($this->table2, $data);
  return $this->db->insert_id();
}

public function update_fuel($where, $data)
{
  $this->db->update($this->table2, $data, $where);
  return $this->db->affected_rows();
}

public function delete_by_id_fuel($id)
{
  $this->db->where('id', $id);
  $this->db->delete($this->table2);
}



  }
