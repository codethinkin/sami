<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }


  public function reportesGenera($FInicial, $FFinal, $Documento){
  		$sql="SELECT P.TIPO, P.FECHA_FACTURA, concat(C.nameCus, ' - ',  X.centocosto) AS Cliente, CONCAT(P.DESCRIPCION,' - Cod - ', P.CLAVE) AS Articulo, P.SALIDAS,P.PRECIO, (P.SALIDAS * P.PRECIO) AS TOTAL
  FROM partidas P
  INNER JOIN customers C ON C.id = P.CLIENTE
  INNER JOIN documentos O ON O.ID = P.ID_LINK
  INNER JOIN centrocosto X ON X.id = O.centros
  WHERE (DATE(P.FECHA_FACTURA) between'".$FInicial."' AND '".$FFinal."') AND P.TIPO='".$Documento."' ";
  		//echo $sql;
  		$query=$this->db->query($sql);
  		return $query->result();
  	}

}
