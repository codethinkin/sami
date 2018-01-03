<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordencompra extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
      $this->load->model('ordencompra_model');
//$this->load->library('Excel');
//$this->load->library('export_excel');
  }

  public function index()
  {
    is_login();
    if(CheckPermission("user", "own_read")){
        $this->load->view('include/header');
        $this->load->view('orden_compra');
        $this->load->view('include/footer');
    } else {
        $this->session->set_flashdata('messagePr', 'You don\'t have permission to access.');
        redirect( base_url().'user/profile', 'refresh');
    }
  }

  public function list_order()
  {
    is_login();
    if(CheckPermission("user", "own_read")){
        $this->load->view('include/header');
        $this->load->view('index');
        $this->load->view('include/footer');
    } else {
        $this->session->set_flashdata('messagePr', 'You don\'t have permission to access.');
        redirect( base_url().'user/profile', 'refresh');
    }
  }

  public function buscarproductos(){
  		$filtro    = $this->input->get("term");
  		$productos = $this->ordencompra_model->listarproducto($filtro);
  		echo json_encode($productos);
  	}

  	public function buscarproveedor(){
  		$filtro    = $this->input->get("term");
  		$proveedores = $this->ordencompra_model->listarproveedor($filtro);
  		echo json_encode($proveedores);
  	}

    public function addcarrito(){

    		$CarritoOrdenCompra   = json_decode($this->input->post('MiCarrito'));
    		if(isset($_SESSION['CarritoOrdencompra'.$CarritoOrdenCompra->IdSession])){
    				$carrito_orderventa=$_SESSION['CarritoOrdencompra'.$CarritoOrdenCompra->IdSession];
    				if(isset($CarritoOrdenCompra->Codigo)){
    					$txtCodigo = $CarritoOrdenCompra->Codigo;
    					$precio    = $CarritoOrdenCompra->Pcompra;
    					$cantidad  = $CarritoOrdenCompra->Cantidad;
    					$descripcio= $CarritoOrdenCompra->Descripcion;
    					$Proveedor = $CarritoOrdenCompra->Proveedor;
    					$Costo     = $CarritoOrdenCompra->Costo;
    					$precio2   = $CarritoOrdenCompra->Pnuevo;
    					$donde     = -1;
    					for($i=0;$i<=count($carrito_orderventa)-1;$i ++){
    					if($txtCodigo==$carrito_orderventa[$i]['txtCodigo']){
    						$donde=$i;
    					}
    					}
    					if($donde != -1){
    						$cuanto=$carrito_orderventa[$donde]['cantidad'] + $cantidad;
    						$carrito_orderventa[$donde]=array("txtCodigo"=>$txtCodigo,"precio"=>$precio,"cantidad"=>$cuanto,"descripcion"=>$descripcio,"proveedor"=>$Proveedor,"costo"=>$Costo,"precioventa"=>$precio2);
    					}else{
    						$carrito_orderventa[]=array("txtCodigo"=>$txtCodigo,"precio"=>$precio,"cantidad"=>$cantidad,"descripcion"=>$descripcio,"proveedor"=>$Proveedor,"costo"=>$Costo,"precioventa"=>$precio2);

    					}
    				}
    		}else{
    				$txtCodigo = $CarritoOrdenCompra->Codigo;
    				$precio    = $CarritoOrdenCompra->Pcompra;
    				$cantidad  = $CarritoOrdenCompra->Cantidad;
    				$descripcio= $CarritoOrdenCompra->Descripcion;
    				$Proveedor = $CarritoOrdenCompra->Proveedor;
    				$Costo     = $CarritoOrdenCompra->Costo;
    				$precio2   = $CarritoOrdenCompra->Pnuevo;
    				$carrito_orderventa[]=array("txtCodigo"=>$txtCodigo,"precio"=>$precio,"cantidad"=>$cantidad,"descripcion"=>$descripcio,"proveedor"=>$Proveedor,"costo"=>$Costo,"precioventa"=>$precio2);
    		}
    		$_SESSION['CarritoOrdencompra'.$CarritoOrdenCompra->IdSession]=$carrito_orderventa;
    		echo json_encode($_SESSION['CarritoOrdencompra'.$CarritoOrdenCompra->IdSession]);
    	}

      public function saveOrder(){

      		$arrayResponse = array("NumOrden"=>"0","Msg"=>"Error: Ocurrio Un Error Intente de Nuevo", "TipoMsg"=>"Error");
      		$OrderCompra   = json_decode($this->input->post('MiCarrito'));
      		$RecuperaOrder = $_SESSION["CarritoOrdencompra".$OrderCompra->IdSession];
      		$impuesto      = 19;
      		$arrayDocumento= array(
      				"TIPO"				=>"Entrada",
      				"FECHA"				=>date('Y-m-j H:i:s'),
      				"FECHA_FACTURA"		=>$OrderCompra->FechaF,
      				"FACTURA"			=>$OrderCompra->Factura,
      				"BASEIMPUESTO"		=>$impuesto,
      				"TOTAL_IMPUESTO"	=>$OrderCompra->IVA,
      				"PROVEEDOR"			=>$OrderCompra->Proveedor,
      				"BRUTO"				=>$OrderCompra->Subtotal,
      				"TOTAL"				=>$OrderCompra->Total,
      				"USUARIO"			=>$this->session->userdata('ID'),

      				);
      		$saveOrderDocument = $this->ordencompra_model->saveOrderDocumento($arrayDocumento);

      				$entrada = "Entrada";
      				$fecha = date('Y-m-j H:i:s');

      		if($saveOrderDocument!=0){
      			foreach ($RecuperaOrder as $key => $value) {
      				$entrada = "Entrada";
      				$fecha = date('Y-m-j H:i:s');

      				$precio = $value["precio"];
      				$precioV = $value["precioventa"];
$existencia = $value["existencia"];

              $prome  = 0;

                            if($precioV <= 0){
                                  $prome  = $precio;

                            }else{
                                  $prome = (($precio+$precioV)/2);
                            }

      				//$prome = (($precio+$precioV)/2);

      				$arrayPartidas = array(
      					"ID_LINK"			=> $saveOrderDocument,
      					"TIPO"				=> $entrada,
      					"FECHA"				=> $fecha,
      					"PROVEEDOR"			=> $value["proveedor"],
      					"CLAVE"				=> $value["txtCodigo"],
      					"COSTO"				=> $value["costo"],
      					"precio_venta"		=> $precioV,
      					"DESCRIPCION"		=> $value["descripcion"],
      					"ENTRADAS"			=> $value["cantidad"],
      					"PRECIO"		    => $precio,
      					);
      				# code...
      				$this->ordencompra_model->saveOrderPartidas($arrayPartidas);
      				//$this->ordencompra_model->saveOrderPartidas($saveOrderDocument,$entrada,$fecha,$value["proveedor"],$value["txtCodigo"],$value["costo"],);
      				$this->ordencompra_model->UpdateExistenciasProducto($value["txtCodigo"],$value["cantidad"],$prome,$precioV, $precio );

      			}
      			$arrayResponse = array("NumOrden"=>$saveOrderDocument,"Msg"=>"<strong>Orden de Compra: ".$saveOrderDocument."</strong>, La Orden de Compra se Guardado Correctamente", "TipoMsg"=>"Sucefull");
      		}
      		echo json_encode($arrayResponse);

      	}

function reporte()
{
  is_login();
  if(CheckPermission("user", "own_read")){
      $this->load->view('include/header');
      $this->load->view('reporte');
      $this->load->view('include/footer');
  } else {
      $this->session->set_flashdata('messagePr', 'You don\'t have permission to access.');
      redirect( base_url().'user/profile', 'refresh');
  }

}

public function GeneraReporte(){

         $Reporte   = json_decode($this->input->post('MiReporte'));
         $FInicial  = explode("/",$Reporte->Finicial);
         $FFinal    = explode("/",$Reporte->FFinal);
         $Documento = $Reporte->Documento;
         $FInicial  = $FInicial[2]."-".$FInicial[0]."-".(int)$FInicial[1]." 00:00:00";
         $FFinal    = $FFinal[2]."-".$FFinal[0]."-".(int)$FFinal[1]." 23:59:59";

         echo json_encode($this->ordencompra_model->reportesGenera($FInicial, $FFinal, $Documento));
    }


    public function Excel(){
          $this->excel->setActiveSheetIndex(0);
          $this->excel->getActiveSheet()->setTitle('test worksheet');
          $this->excel->getActiveSheet()->setCellValue('A1', 'Un poco de texto');
          $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
          $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
          $this->excel->getActiveSheet()->mergeCells('A1:D1');

          header('Content-Type: application/vnd.ms-excel');
          header('Content-Disposition: attachment;filename="nombredelfichero.xls"');
          header('Cache-Control: max-age=0'); //no cache
          $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
          // Forzamos a la descarga
          $objWriter->save('php://output');
      }


      public function chk_usr()
      {
      if(isset($_POST))
                {
                  $code = $_POST['factura'];
                  $this->ordencompra_model->usrchk($code);
                }
        }


                      public function ajax_edit($id)
                      {
                        $data = $this->customer->get_by_id($id);
                        echo json_encode($data);
                      }
}
