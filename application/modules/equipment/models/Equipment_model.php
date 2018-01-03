<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Equipment_model extends CI_Model{

    var $table = 'equipment';
    var $column_order = array(null,'customers','description','code','mark','model', 'serie',null); //set column field database for datatable orderable
    var $column_search = array('customers','description','code','mark','model', 'serie'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'desc'); // default order

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function usrchk($code) {
           $qry = "SELECT count(*) as cnt from equipment where codigo= ? ";
           $res = $this->db->query($qry,array( $code ))->result();
           if ($res[0]->cnt > 0) {
               echo '1';
           } else {
               echo '0';
           }
       }

       /*private function _get_datatables_query($term=''){ //term is value of $_REQUEST['search']['value']
           $column = array('k.id','k.code',  'k.serie', 'k.activity', 'k.code', 'k.model', 'l.nameLoad', ' e.nameType', 'c.nameCus', 'k.equipmentType');
           $this->db->select('k.id, k.code, k.serie, k.mark, k.model, c.nameCus, l.nameLoad, e.nameType');
           $this->db->from('equipment as k');
           $this->db->join('customers as c', 'c.id = k.customers','left');
           $this->db->join('load as l', 'l.id = k.load','left');
           $this->db->join('equipmentType as e', 'e.id = k.equipmentType','left');
           $this->db->like('k.id', $term);
           $this->db->or_like('k.code', $term);
           $this->db->or_like('k.serie', $term);
          $this->db->or_like('l.nameLoad', $term);*/

          private function _get_datatables_query($term=''){ //term is value of $_REQUEST['search']['value']
           $column = array('k.id','k.code',  'k.serie', 'k.activity', 'k.code', 'k.model', 'l.nameLoad', ' e.nameType', 'c.nameCus', 'k.equipmentType');
           $this->db->select('k.id, k.code, k.serie, k.mark, k.model, c.nameCus, l.nameLoad, k.equipmentType ');
           $this->db->from('equipment as k');
           $this->db->join('customers as c', 'c.id = k.customers','left');
           $this->db->join('load as l', 'l.id = k.load','left');
           $this->db->like('k.id', $term);
           $this->db->or_like('k.code', $term);
           $this->db->or_like('k.serie', $term);
          $this->db->or_like('l.nameLoad', $term);

           if(isset($_REQUEST['equipment'])) // here order processing
           {
              $this->db->order_by($column[$_REQUEST['equipment']['0']['column']], $_REQUEST['equipment']['0']['dir']);
           }
           else if(isset($this->order))
           {
              $order = $this->order;
              $this->db->order_by(key($order), $order[key($order)]);
           }
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



    }
