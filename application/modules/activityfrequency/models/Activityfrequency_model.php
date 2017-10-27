<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Activityfrequency_model extends CI_Model{

    var $table = 'Activity_frequency';
    var $column_order = array(null,'activityFrequency','state','nameFrequency',null); //set column field database for datatable orderable
    var $column_search = array('activityFrequency', 'nameFrequency', 'state'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id' => 'desc'); // default order

    public function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function usrchk($name) {
           $qry = "SELECT count(*) as cnt from subcategory where name= ? ";
           $res = $this->db->query($qry,array( $name))->result();
           if ($res[0]->cnt > 0) {
               echo '1';
           } else {
               echo '0';
           }
       }

    private function _get_datatables_query()
    {
      $this->db->select('Activity_frequency.id, activity_frequency.activityFrequency, activity_frequency.state,  frequency.nameFrequency ');
      $this->db->from($this->table);
      $this->db->join('frequency', 'frequency.id = Activity_frequency.frequency');
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

    public function getSubcategoria(){
  		$this->db->select('s.id, s.name, s.state,  c.name AS category');
  		$this->db->from('subcategoria s');
  		  $this->db->join('category c', 'c.id = d.category');

  		// $q = "SELECT p.idPersona rownum, p.idPersona,p.nombre,p.appaterno app,p.apmaterno,p.dni,c.ciudad,p.email
  		// 		FROM persona p
  		// 		INNER JOIN ciudades c ON c.idCiudad = p.idCiudad
  		// 		LIMIT 0,2";

  		// $r = $this->db->query($q);
  		$r = $this->db->get();

  		return $r->result();
  	}



    }
