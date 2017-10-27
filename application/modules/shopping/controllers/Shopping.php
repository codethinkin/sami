<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    is_login();

    $this->load->model('Shopping_model', 'shopping');
  }

  public function index(){
      is_login();
      if(CheckPermission("user", "own_read")){
          $this->load->view('include/header');
          $this->load->view('index');
          $this->load->view('include/footer');
      } else {
          $this->session->set_flashdata('messagePr', 'Usted no tiene permisos para acceder a esta sitio.');
          redirect( base_url().'user/profile', 'refresh');
      }
  }

  public function ajax_list()

  {

  $this->load->helper('url');
  $list = $this->shopping->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $shopping) {
    $no++;
    $row = array();
    $row[] = '<input type="checkbox" class="data-check" value="'.$shopping->ID.'">';
    $row[] = '<a  href="javascript:void(0)" title="Editar" onclick="edit_shopping('."'".$shopping->ID."'".')"><i class="glyphicon glyphicon-eye-open"></i>  '.$shopping->FACTURA.' </a>';
    $row[] = $shopping->FECHA_FACTURA;
    $row[] = $shopping->PROVEEDOR;
    $row[] = $shopping->BRUTO;
    $row[] = $shopping->TOTAL_IMPUESTO;
    $row[] = $shopping->TOTAL;
    //  $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_shopping('."'".$shopping->ID."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
        //<a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_shopping('."'".$shopping->ID."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
    $data[] = $row;
  }

  $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->shopping->count_all(),
          "recordsFiltered" => $this->shopping->count_filtered(),
          "data" => $data,
      );

  echo json_encode($output);

  }

  public function nit_check_shopping()
            {
                if($this->input->is_ajax_request()) {
                $nit = $this->input->post('code');
                if(!$this->form_validation->is_unique($nit, 'shoppings.code')) {
                 $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'El Nombre digitado ya se encuentra registrado..')));
                    }
                }
            }


  public function ajax_edit($id)
  {
    $data = $this->shopping->get_by_id($id);
    echo json_encode($data);
  }



  }
