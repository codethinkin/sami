<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordencompra_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
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

  	public function listarproveedor($filtro){
  		$sql="SELECT concat(p.nit,' - ', p.name) AS label,  p.nit,  p.name
  		FROM provider AS p
  		WHERE (p.nit LIKE  '%".$filtro."%' or p.name LIKE '%".$filtro."%')";

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
    	public function UpdateExistenciasProducto($codigo,$cantidad,$prome,$precioV,$precio){

    		$sql="update product set cantidad= cantidad + '".$cantidad."', precio_compra = '".$prome."', precio_venta = '".$prome."', compra='".$precio."' where codigo='".$codigo."'  ";
    		$query=$this->db->query($sql);
    		return True;
    	}

      public function reportesGenera($FInicial, $FFinal, $Documento){
      		$sql="SELECT D.TIPO, D.FECHA_FACTURA, D.FACTURA, P.PROVEEDOR, GROUP_CONCAT(P.DESCRIPCION, '-Cant-' ,P.ENTRADAS, '-Val-',P.PRECIO) as Articulo, D.BRUTO, D.TOTAL_IMPUESTO, D.TOTAL
      FROM documentos D
      INNER JOIN partidas P ON P.ID_LINK = D.ID
      WHERE (DATE(D.FECHA_FACTURA) between'".$FInicial."' AND '".$FFinal."') AND D.TIPO='".$Documento."'
      GROUP BY D.ID";
      		//echo $sql;
      		$query=$this->db->query($sql);
      		return $query->result();
      	}

public function excel(){
$this->db->select('ID, TIPO, FECHA ');
$THIS->db->from('documentos');
$query = $this->db->get();


return $query;
}

public function usrchk($code) {
       $qry = "SELECT count(*) as cnt from documentos where FACTURA= ? ";
       $res = $this->db->query($qry,array( $code ))->result();
       if ($res[0]->cnt > 0) {
           echo '1';
       } else {
           echo '0';
       }
   }





}
