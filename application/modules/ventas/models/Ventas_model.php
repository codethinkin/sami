<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function buscarcliente($filtro){
		$sql="SELECT concat(nameCus) AS label, nit, nameCus FROM customers   WHERE (nit LIKE  '%".$filtro."%' or nameCus LIKE '%".$filtro."%')";
		$query=$this->db->query($sql);
		return $query->result();
	}
	public function UpdateExistenciasProducto($codigo,$cantidad){
		$sql="update product set cantidad= cantidad - '".$cantidad."' where codigo='".$codigo."'";
		$query=$this->db->query($sql);
		return True;
	}

  public function Clientes(){
  		$sql="select * from customers order by nameCus ASC";
  		$query=$this->db->query($sql);
  		return $query->result();
  	}
  	public function Centros($id){
  		$sql="select * from centrocosto where customers='".$id."'";
  		$query=$this->db->query($sql);
  		return $query->result();
  	}

    public function listarproducto($filtro){
  		$sql="SELECT concat(p.codigo,' - ', p.referencia, ' - ', p.descripcion) AS label, p.codigo, p.descripcion, p.precio_compra,p.precio_venta, p.cantidad,
  		p.referencia, p.estado
  		FROM product AS p
  		WHERE (p.descripcion LIKE  '%".$filtro."%' and p.estado =1  or p.codigo LIKE '%".$filtro."%' and p.estado =1 or p.referencia LIKE '%".$filtro."%' and p.estado =1 )";

  		$query=$this->db->query($sql);
  		return $query->result();

  		$query=$this->db->query($sql);
  		return $query->result();
  	}

    public function saveOrderDocumento($arrarOrder){
    		$this->db->trans_start();
         	$this->db->insert('documentos', $arrarOrder);
         	$ids = $this->db->insert_id();
         	$this->db->trans_complete();
         	return $ids;
    	}
    	public function saveOrderPartidas($arrarOrder){
    		$this->db->trans_start();
         	$this->db->insert('partidas', $arrarOrder);
         	$this->db->trans_complete();
    	}

}
