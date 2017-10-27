<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loans extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeignameer : Write Less Do More

     is_login();

     $this->load->model('Loans_model','loans');
  }

  public function index(){
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


  public function ajax_list()

{

  $this->load->helper('url');
  $list = $this->loans->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $loans) {
    $no++;
    $row = array();
    $row[] = '<input type="checkbox" class="data-check" value="'.$loans->id.'">';
    $row[] = $loans->employee;
    $row[] = $loans->product;
    $row[] = $loans->datestart;
    $row[] = $loans->dateend;
    $row[] = $loans->state;
    $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_loans('."'".$loans->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
              <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_loans('."'".$loans->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
    $data[] = $row;
  }

  $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->loans->count_all(),
          "recordsFiltered" => $this->loans->count_filtered(),
          "data" => $data,
      );

  echo json_encode($output);

}

public function nit_check_loans()
            {
                if($this->input->is_ajax_request()) {
                $nit = $this->input->post('code');
                if(!$this->form_validation->is_unique($code, 'loans.code')) {
                 $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'El Codigo digitado ya se encuentra registrado..')));
                    }
                }
            }
                public function ajax_edit($id)
                {
                  $data = $this->loans->get_by_id($id);
                  echo json_encode($data);
                }

  public function ajax_add()

                    {
                                      //$this->_validate();
                      $data = array(

                                        'employee' => $this->input->post('employee'),
                                        'product' => $this->input->post('product'),
                                        'datestart' => $this->input->post('datestart'),
                                        'dateend' => $this->input->post('dateend'),
                                        'state' => $this->input->post('state'),

                              );
                      $insert = $this->loans->save($data);
                    echo json_encode(array("status" => TRUE));
                    }
  public function ajax_update()
                      {
                        $this->_validate();
                        $data = array(

                          'employee' => $this->input->post('employee'),
                          'product' => $this->input->post('product'),
                          'datestart' => $this->input->post('datestart'),
                          'dateend' => $this->input->post('dateend'),
                          'state' => $this->input->post('state'),
                          );
                        $this->loans->update(array('id' => $this->input->post('id')), $data);
                        echo json_encode(array("status" => TRUE));
                      }



          public function ajax_delete($id)
                    {
                        $this->loans->delete_by_id($id);
                      echo json_encode(array("status" => TRUE));
                      }

        public function ajax_bulk_delete()
                      {
                        $list_id = $this->input->post('id');
                        foreach ($list_id as $id) {
                          $this->loans->delete_by_id($id);
                        }
                        echo json_encode(array("status" => TRUE));
                      }

      private function _validate()

                      {
                        $data = array();
                        $data['error_string'] = array();
                        $data['inputerror'] = array();
                        $data['status'] = TRUE;

                        if($this->input->post('employee') == '')
                        {
                          $data['inputerror'][] = 'employee';
                          $data['error_string'][] = 'El campo Empleado es requerido';
                          $data['status'] = FALSE;
                        }
                        if($this->input->post('state') == '')
                        {
                          $data['inputerror'][] = 'state';
                          $data['error_string'][] = 'El campo Estado es requerido';
                          $data['status'] = FALSE;
                        }

                        if($this->input->post('product') == '')
                        {
                          $data['inputerror'][] = 'product';
                          $data['error_string'][] = 'El campo Producto / Insumo es requerido';
                          $data['status'] = FALSE;
                        }

                          if($data['status'] === FALSE)

                        {
                          echo json_encode($data);
                          exit();
                        }
                      }



}
