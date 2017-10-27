<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_Customers() {
    return $this->db->get('setting')->result();
    }

    function countUsers()
    {
      $this->db->from('users')->where('status', 'active');
      return $this->db->count_all_results();
    }

    function countVent()
    {
      $this->db->from('documentos')->where('TIPO', 'Venta');
      return $this->db->count_all_results();
    }

    function countCom()
    {
      $this->db->from('documentos')->where('TIPO', 'Entrada');
      return $this->db->count_all_results();
    }

    function countProduct()
    {
      $this->db->from('product')->where('estado', 1);
      return $this->db->count_all_results();
    }

    public function getCompras(){
      $name = 2017;
      $compra= "Entrada";
  		$this->db->select('sum(total) AS Total, monthname(FECHA_FACTURA) AS Mes, year(FECHA_FACTURA) AS Anio, TIPO ');
  		$this->db->from('documentos');
      $this->db->where('year(FECHA_FACTURA)', $name);
      $this->db->where('TIPO', $compra);
      $this->db->group_by('Mes');
  		$query = $this->db->get();

  		return $query->result();
  	}

    public function getVentas(){
      $name = 2017;
      $venta= "Venta";
      $this->db->select('sum(total) AS Total, monthname(FECHA_FACTURA) AS Mes, year(FECHA_FACTURA) AS Anio, TIPO ');
      $this->db->from('documentos');
      $this->db->where('year(FECHA_FACTURA)', $name);
      $this->db->where('TIPO', $venta);
      $this->db->group_by('Mes');
      $query = $this->db->get();

      return $query->result();
    }

}
