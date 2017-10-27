<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
$this->load->model('ventas_model');
  }

  public function index()
  {
    is_login();
    if(CheckPermission("user", "own_read")){
        $this->load->view('include/header');
        $this->load->view('view_ventas');
        $this->load->view('include/footer');
    } else {
        $this->session->set_flashdata('messagePr', 'You don\'t have permission to access.');
        redirect( base_url().'user/profile', 'refresh');
    }
  }

  public function new_vent()
  {
    is_login();
    if(CheckPermission("user", "own_read")){
        $this->load->view('include/header');
        $this->load->view('view_ventas');
        $this->load->view('include/footer');
    } else {
        $this->session->set_flashdata('messagePr', 'You don\'t have permission to access.');
        redirect( base_url().'user/profile', 'refresh');
    }
  }

  public function BuscarCliente(){
is_login();
  		$filtro    = $this->input->get("term");
  		$clientes = $this->ventas_model->buscarcliente($filtro);
  		echo json_encode($clientes);
  	}

    public function buscarproductos(){
    		$filtro    = $this->input->get("term");
    		$productos = $this->ventas_model->listarproducto($filtro);
    		echo json_encode($productos);
    	}

      public function clientes(){
      		$clientes = $this->ventas_model->Clientes();
      		echo json_encode($clientes);
      	}
      	public function centros(){
      		$id_Cliente   = $this->input->get("filtro");
      		$centros = $this->ventas_model->Centros($id_Cliente);
      		echo json_encode($centros);
      	}

        public function addcarrito(){

        		$CarritoNewVenta   = json_decode($this->input->post('MiCarrito'));
        		if(isset($_SESSION['CarritoVenta'.$CarritoNewVenta->IdSession])){
        				$carrito_orderventa=$_SESSION['CarritoVenta'.$CarritoNewVenta->IdSession];
        				if(isset($CarritoNewVenta->Codigo)){
        					$txtCodigo = $CarritoNewVenta->Codigo;
        					$precio    = $CarritoNewVenta->Pcompra;
        					$cantidad  = $CarritoNewVenta->Cantidad;
        					$descripcio= $CarritoNewVenta->Descripcion;
        					//$Proveedor = $CarritoNewVenta->Proveedor;
        					$Costo     = $CarritoNewVenta->Costo;
        					//$IdProveedo= $CarritoNewVenta->IdProveedor;
        					$donde     = -1;
        					for($i=0;$i<=count($carrito_orderventa)-1;$i ++){
        					if($txtCodigo==$carrito_orderventa[$i]['txtCodigo']){
        						$donde=$i;
        					}
        					}
        					if($donde != -1){
        						$cuanto=$carrito_orderventa[$donde]['cantidad'] + $cantidad;
        						$carrito_orderventa[$donde]=array("txtCodigo"=>$txtCodigo,"precio"=>$precio,"cantidad"=>$cuanto,"descripcion"=>$descripcio,"costo"=>$Costo);
        					}else{
        						$carrito_orderventa[]=array("txtCodigo"=>$txtCodigo,"precio"=>$precio,"cantidad"=>$cantidad,"descripcion"=>$descripcio,"costo"=>$Costo);

        					}
        				}
        		}else{
        				$txtCodigo = $CarritoNewVenta->Codigo;
        				$precio    = $CarritoNewVenta->Pcompra;
        				$cantidad  = $CarritoNewVenta->Cantidad;
        				$descripcio= $CarritoNewVenta->Descripcion;
        				//$Proveedor = $CarritoNewVenta->Proveedor;
        				$Costo     = $CarritoNewVenta->Costo;
        				//$IdProveedo= $CarritoNewVenta->IdProveedor;
        				$carrito_orderventa[]=array("txtCodigo"=>$txtCodigo,"precio"=>$precio,"cantidad"=>$cantidad,"descripcion"=>$descripcio,"costo"=>$Costo);
        		}
        		$_SESSION['CarritoVenta'.$CarritoNewVenta->IdSession]=$carrito_orderventa;
        		echo json_encode($_SESSION['CarritoVenta'.$CarritoNewVenta->IdSession]);
        	}

          public function saveOrder(){

          		$arrayResponse = array("NumOrden"=>"0","Msg"=>"Error: Ocurrio Un Error Intente de Nuevo", "TipoMsg"=>"Error");

          		$OrderVenta    = json_decode($this->input->post('MiCarrito'));
          		$RecuperaOrder = $_SESSION["CarritoVenta".$OrderVenta->IdSession];
          		$RecuperaOrder = $_SESSION["CarritoVenta".$OrderVenta->IdSession];
          		$impuesto      = 19;
          		$arrayDocumento= array(
          				"TIPO"				=>"Venta",
          				"FECHA"				=>date('Y-m-j H:i:s'),
          				"CLIENTE"			=>$OrderVenta->Cliente,
          				"FECHA_FACTURA"		=>$OrderVenta->FechaFactura,
          				"FACTURA"			=>$OrderVenta->Factura,
          				"centros"			=>$OrderVenta->CENTROSCOSTOS,
          				"BASEIMPUESTO"		=>$impuesto,
          				"TOTAL_IMPUESTO"	=>$OrderVenta->IVA,
          				"BRUTO"				=>$OrderVenta->Subtotal,
          				"TOTAL"				=>$OrderVenta->Total,
          				//"USUARIO"			=>$this->session->userdata('ID')
          				);
          		$saveOrderDocument = $this->ventas_model->saveOrderDocumento($arrayDocumento);
          		if($saveOrderDocument!=0){
          			foreach ($RecuperaOrder as $key => $value) {
          				$arrayPartidas = array(
          					"ID_LINK"			=> $saveOrderDocument,
          					"TIPO"				=> "Venta",
          					"FECHA"				=> date('Y-m-j H:i:s'),
          					"CLIENTE"			=> $OrderVenta->Cliente,
          					"FECHA_FACTURA"		=> $OrderVenta->FechaFactura,
          					"CLAVE"				=> $value["txtCodigo"],
          					"COSTO"				=> $value["costo"],
          					"PRECIO"			=> $value["precio"],
          					"DESCRIPCION"		=> $value["descripcion"],
          					"SALIDAS"			=> $value["cantidad"]
          					);
          				# code...
          				$this->ventas_model->saveOrderPartidas($arrayPartidas);
          				$this->ventas_model->UpdateExistenciasProducto($value["txtCodigo"],$value["cantidad"]);

          			}
          			$arrayResponse = array("NumOrden"=>base64_encode($saveOrderDocument),"Msg"=>"<strong>Folio: ".$saveOrderDocument."</strong>, El Consumo se Guardado Correctamente", "TipoMsg"=>"Sucefull");
          		}
          		echo json_encode($arrayResponse);
              redirect('ventas');

          	}


            public function reporte()
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


}
