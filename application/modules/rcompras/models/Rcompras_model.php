<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rcompras_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
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


}
