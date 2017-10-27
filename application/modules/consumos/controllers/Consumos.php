<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');


class Consumos extends CI_Controller {
	function __construct(){
		parent::__construct();
 is_login();
		$this->load->model('seguridad_model');
		$this->load->model('consumos_model', 'consumo');
          // $this->load->library('PHPExcel');
	}
	public function index(){
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
         is_login();
          /**/

          $this->load->view('include/header');
          $this->load->view('index');
          $this->load->view('include/footer');

	}

  public function new_consumo(){
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
         is_login();
          /**/

          $this->load->view('include/header');
          $this->load->view('new_consumo');
          $this->load->view('include/footer');

	}

	public function BuscarCliente(){
   is_login();
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

			$filtro    = $this->input->get("term");
			$clientes = $this->consumos_model->buscarcliente($filtro);
			echo json_encode($clientes);
		}


		public function buscarproductos(){
			 is_login();
			$filtro    = $this->input->get("term");
			$productos = $this->consumos_model->listarproducto($filtro);
			echo json_encode($productos);
		}


  public function ajax_list()

  {

  $this->load->helper('url');
  $list = $this->consumo->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $consumo) {
    $no++;
    $row = array();
    $row[] = '<input type="checkbox" class="data-check" value="'.$consumo->id.'">';
  $row[] = $consumo->factura;
  $row[] = $consumo->proveedor;

    $row[] = $consumo->descripcion;
    $row[] = $consumo->fecha;
    $row[] = $consumo->precio;
      $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_consumo('."'".$consumo->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
        <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_consumo('."'".$consumo->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
    $data[] = $row;
  }

  $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->consumo->count_all(),
          "recordsFiltered" => $this->consumo->count_filtered(),
          "data" => $data,
      );

  echo json_encode($output);

  }

     public function consumos(){
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          $this->seguridad_model->SessionActivo($url);
          /**/
          $this->load->view('constant');
          $this->load->view('view_header');
          $this->load->view('consumos/view_reportes_consumos');
          $this->load->view('view_footer');

     }
     public function GeneraReporte(){
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          $this->seguridad_model->SessionActivo($url);
          $Reporte   = json_decode($this->input->post('MiReporte'));
          $FInicial  = explode("/",$Reporte->Finicial);
          $FFinal    = explode("/",$Reporte->FFinal);
          $Documento = $Reporte->Documento;
          $FInicial  = $FInicial[2]."-".$FInicial[0]."-".(int)$FInicial[1]." 00:00:00";
          $FFinal    = $FFinal[2]."-".$FFinal[0]."-".(int)$FFinal[1]." 23:59:59";

          echo json_encode($this->consumos_model->reportesGenera($FInicial, $FFinal, $Documento));
     }

     function imprimir()
    {
        $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $this->seguridad_model->SessionActivo($url);

          /* Funciona
        $this->db->select('FECHA_FACTURA AS Fecha, CLIENTE AS Cliente');
        $this->db->from('documentos');
        $query = $this->db->get();
       */
                // $something = $this->input->post('something');

          $FInicial  = explode("/",$this->input->post('finicial'));
          $FFinal    = explode("/",$this->input->post('ffinal'));
          $Documento = $this->input->post('documento');
          $FInicial  = $FInicial[2]."-".$FInicial[0]."-".(int)$FInicial[1]." 00:00:00";
          $FFinal    = $FFinal[2]."-".$FFinal[0]."-".(int)$FFinal[1]." 23:59:59";


          $sql="SELECT P.TIPO, P.FECHA_FACTURA AS Fecha, concat(C.RFC, ' - ',C.NOMBRE, ' - ',  X.centocosto) AS Cliente, CONCAT(P.DESCRIPCION,' - Cod - ', P.CLAVE) AS Articulo, P.SALIDAS,P.PRECIO, (P.SALIDAS * P.PRECIO) AS TOTAL
FROM partidas P
INNER JOIN clientes C ON C.id = P.CLIENTE
INNER JOIN documentos O ON O.ID = P.ID_LINK
INNER JOIN centrocosto X ON X.id = O.centros
WHERE (DATE(P.FECHA_FACTURA) between'".$FInicial."' AND '".$FFinal."') AND P.TIPO='".$Documento."' ";
          //echo $sql;
          $query=$this->db->query($sql);


        if(!$query)
            return false;
        // Starting the PHPExcel library

        $objPHPExcel= new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);
        // Field names in the first row
        $fields= $query->list_fields();
        $col= 0;
        foreach($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
        // Fetching the table data
        $row= 2;
        foreach($query->result() as$data)
        {
            $col= 0;
            foreach($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
            $row++;
        }
        $objPHPExcel->setActiveSheetIndex(0);


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Consumos_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }


}
