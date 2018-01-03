<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model{

      var $table = 'order';
var $table2 = 'order_has_order';
      var $column_order = array(null,'nameCus','activity','startActivity', 'code', 'nit',null); //set column field database for datatable orderable
      var $column_search = array('activity','startActivity', 'code', 'nit'); //set column field database for datatable searchable just firstname , lastname , address are searchable
      var $order = array('id' => 'desc'); // default order

      public function __construct()
      {
        parent::__construct();
        $this->load->database();
      }

      public function usrchk($usr) {
             $qry = "SELECT count(*) as cnt from code where code= ? ";
             $res = $this->db->query($qry,array( $usr ))->result();
             if ($res[0]->cnt > 0) {
                 echo '1';
             } else {
                 echo '0';
             }
         }


         private function _get_datatables_query($term=''){ //term is value of $_REQUEST['search']['value']
             $column = array('k.id','k.code',  'k.startActivity', 'k.activity', 'k.nit', 'k.state', 'c.nameCus', 'a.nameActivity', 'c.nit');
             $this->db->select('k.id, k.code, k.startActivity, k.state, k.name, k.nit, k.activity, k.ordenenka, c.nameCus, c.nit, a.nameActivity');
             $this->db->from('order as k');
             $this->db->join('customers as c', 'c.id = k.name','left');
            $this->db->join('activity as a', 'a.id = k.activity','left');
             $this->db->like('k.id', $term);
             $this->db->or_like('k.nit', $term);
             $this->db->or_like('k.startActivity', $term);
             $this->db->or_like('k.code', $term);
            $this->db->or_like('c.nameCus', $term);
            $this->db->or_like('k.state', $term);
             if(isset($_REQUEST['order'])) // here order processing
             {
                $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
             }
             else if(isset($this->order))
             {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
             }
         }
/*
      private function _get_datatables_query()
      {
        $this->db->select('order.id, order.startActivity, order.code, order.state, order.nit, customers.nameCus, order.activity');
        $this->db->from('order');
        $this->db->join('customers','order.id = customers.id');

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
*/

  public function Clientes(){
  		$sql="select * from customers order by nameCus ASC";
  		$query=$this->db->query($sql);
  		return $query->result();
  	}

public function buscarcliente($filtro){
$query=$this->db->query($sql);
$sql="SELECT concat(nit,' - ', name) AS label, nit, name FROM customers   WHERE (nit LIKE  '%".$filtro."%' or name LIKE '%".$filtro."%')";
return $query->result();
}

public function get_all_equipment($id) {
        $this->db->select('*');
        $this->db->from('equipment');
        $this->db->where('customers', $id);
        $Q = $this->db->get();
        if ($Q->num_rows > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }


function get_datatables(){
  $term = $_REQUEST['search']['value'];
  $this->_get_datatables_query($term);
  if($_REQUEST['length'] != -1)
  $this->db->limit($_REQUEST['length'], $_REQUEST['start']);
  $query = $this->db->get();
  return $query->result();
}

function count_filtered(){
  $term = $_REQUEST['search']['value'];
  $this->_get_datatables_query($term);
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

      function get_by_id_order($id)
       {
           $this->db->select('o.id, o.nit, o.startActivity, o.sdc, o.cotizacion, o.capex, o.ordencompra, o.code, a.nameActivity AS activity, concat((c.nameCus),(" - "),(c.nit))As customers,
                              c.id, e.mark, e.model, e.serie, e.equipmentType, o.autorized, q.nameFrequency AS frequency, o.observation, f.activityFrequency');
          $this->db->from('order o');
          $this->db->join('activity a', 'a.id = o.activity');
          $this->db->join('customers c', 'c.id = o.name');
          $this->db->join('equipment e', 'e.id = o.mark');
          $this->db->join('frequency q', 'q.id = o.frequency');
          $this->db->join('activity_frequency f', 'f.frequency = o.frequency');
      //    $this->db->join('sector r', 'r.id = a.sector');
      //    $this->db->join('employee e', 'e.id = a.employee');
      //    $this->db->join('origin o', 'o.id = a.origin');
          //$this->db->join('activity v', 'a.id = v.accounts');
          //$this->db->join('comments c', 'a.id = c.accounts');
      //    $this->db->where('a.type', '0');
          $this->db->where('o.id',$id);
          return $this->db->get()->row();

       }

       function get_by_id_order_activity($id)
        {
            $this->db->select('o.id, o.nit, o.startActivity, o.sdc, o.code AS ordens, o.horometer, o.cotizacion, o.capex, o.ordencompra, concat((o.code),(" - "),(o.ordenenka))As orden, o.ordenenka, o.code, a.nameActivity AS activity, concat((c.nameCus),(" - "),(c.nit))As customers,
                               c.id, e.code, e.mark, e.model, e.serie, e.equipmentType, o.autorized, q.nameFrequency AS frequency, o.observation, f.activityFrequency');
           $this->db->from('order o');
           $this->db->join('activity a', 'a.id = o.activity');
           $this->db->join('customers c', 'c.id = o.name');
           $this->db->join('equipment e', 'e.id = o.mark');
           $this->db->join('frequency q', 'q.id = o.frequency');
           $this->db->join('activity_frequency f', 'f.frequency = o.frequency');
       //    $this->db->join('sector r', 'r.id = a.sector');
       //    $this->db->join('employee e', 'e.id = a.employee');
       //    $this->db->join('origin o', 'o.id = a.origin');
           //$this->db->join('activity v', 'a.id = v.accounts');
           //$this->db->join('comments c', 'a.id = c.accounts');
       //    $this->db->where('a.type', '0');
           $this->db->where('o.id',$id);
           return $this->db->get()->row();

        }

function get_by_order($id){
  $this->db->select('o.id,  f.activityFrequency');
 $this->db->from('order o');
 $this->db->join('activity_frequency f', 'f.frequency = o.frequency');
 $this->db->where('o.id',$id);
 $query = $this->db->get();
    return $query->result();
}


public function save_liq($datos)
{
  $this->db->insert_batch($this->table2, $datos);
  return $this->db->insert_id();
}



      }
