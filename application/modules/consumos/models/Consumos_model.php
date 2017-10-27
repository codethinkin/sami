<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Consumos_model extends CI_Model {

  var $table = 'partidas';
  var $column_order = array(null,'factura','proveedor','descripcion', 'fecha',null); //set column field database for datatable orderable
  var $column_search = array('factura','proveedor','descripcion', 'fecha'); //set column field database for datatable searchable just firstname , lastname , address are searchable
  var $order = array('id' => 'desc'); // default order



function __construct()
     {
          parent::__construct();
     }
     public function buscarcliente($filtro){
		$query=$this->db->query($sql);
		$sql="SELECT concat(nit,' - ', name) AS label, nit, name FROM customers   WHERE (nit LIKE  '%".$filtro."%' or name LIKE '%".$filtro."%')";
		return $query->result();
	}
	public function UpdateExistenciasProducto($codigo,$cantidad){
		$sql="update product set cantidad= cantidad - '".$cantidad."' where codigo='".$codigo."'";
		$query=$this->db->query($sql);
		return True;
	}
	public function reportesGenera($FInicial, $FFinal, $Documento){
		$sql="SELECT P.TIPO, P.FECHA_FACTURA, concat(C.NOMBRE, ' - ',  X.centocosto) AS Cliente, CONCAT(P.DESCRIPCION,' - Cod - ', P.CLAVE) AS Articulo, P.SALIDAS,P.PRECIO, (P.SALIDAS * P.PRECIO) AS TOTAL
FROM partidas P
INNER JOIN clientes C ON C.id = P.CLIENTE
INNER JOIN documentos O ON O.ID = P.ID_LINK
INNER JOIN centrocosto X ON X.id = O.centros
WHERE (DATE(P.FECHA_FACTURA) between'".$FInicial."' AND '".$FFinal."') AND P.TIPO='".$Documento."' ";
		//echo $sql;
		$query=$this->db->query($sql);
		return $query->result();
	}

		/*public function reportesConsumo($FInicial, $FFinal, $Documento){
		$sql="SELECT P.TIPO, P.FECHA_FACTURA AS Fecha, concat(C.NOMBRE, ' - ',  O.centros) AS Cliente, CONCAT(P.DESCRIPCION,' - Cod - ', P.CLAVE) AS Articulo, P.SALIDAS,P.PRECIO
FROM partidas P
INNER JOIN clientes C ON C.id = P.CLIENTE
INNER JOIN documentos O ON O.ID = P.ID_LINK
WHERE (DATE(P.Fecha) between'".$FInicial."' AND '".$FFinal."') AND P.TIPO='".$Documento."' ";
		//echo $sql;
		$query=$this->db->query($sql);
		return $query->result();
	}

*/

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

$this->db->select('documentos.ID, documentos.fecha, documentos.factura, sum(partidas.precio) AS precio,   partidas.proveedor, partidas.descripcion, partidas.ID_LINK');
$this->db->join('documentos', ' partidas.id=documentos.id ');

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

public function listarproducto($filtro){
  $sql="SELECT concat(p.codigo,' - ', p.referencia, ' - ', p.descripcion) AS label, p.codigo, p.descripcion, p.precio_compra,p.precio_venta, p.cantidad,
  p.referencia, p.estado
  FROM product AS p
  WHERE (p.descripcion LIKE  '%".$filtro."%' and p.estado =1  or p.codigo LIKE '%".$filtro."%' and p.estado =1  or p.referencia LIKE '%".$filtro."%' and p.estado =1)";

  $query=$this->db->query($sql);
  return $query->result();

  $query=$this->db->query($sql);
  return $query->result();
}







}
