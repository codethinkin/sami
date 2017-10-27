<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Sales_model', 'sales');
  }


    public function index(){
        is_login();
        if(CheckPermission("user", "own_read")){

          $ventas = $this->sales->get_all();
          $data  = array('sales' => $ventas );
            $this->load->view('include/header');

            $this->load->view('index', $data);
            $this->load->view('include/footer');
            } else {
            $this->session->set_flashdata('messagePr', 'Usted no tiene permisos para acceder a esta sitio.');
            redirect( base_url().'user/profile', 'refresh');
        }
    }

    public function ajax_list()

    {

    $this->load->helper('url');
    $list = $this->sales->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $sales) {
      $no++;
      $row = array();
      $row[] = '<input type="checkbox" class="data-check" value="'.$sales->ID.'">';
      $row[] = $sales->FECHA_FACTURA;
      $row[] = $sales->CLIENTE;
  $row[] = $sales->centros;
      $row[] = $sales->BRUTO;
      $row[] = $sales->TOTAL_IMPUESTO;
      $row[] = $sales->TOTAL;
      //  $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_sales('."'".$sales->ID."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
          //<a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_sales('."'".$sales->ID."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
      $data[] = $row;
    }

    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sales->count_all(),
            "recordsFiltered" => $this->sales->count_filtered(),
            "data" => $data,
        );

    echo json_encode($output);

    }

    public function nit_check_sales()
              {
                  if($this->input->is_ajax_request()) {
                  $nit = $this->input->post('code');
                  if(!$this->form_validation->is_unique($nit, 'saless.code')) {
                   $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'El Nombre digitado ya se encuentra registrado..')));
                      }
                  }
              }
                  public function ajax_edit($id)
                  {
                    $data = $this->sales->get_by_id($id);
                    echo json_encode($data);
                  }



    }
