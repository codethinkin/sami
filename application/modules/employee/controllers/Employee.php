<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More

     is_login();

     $this->load->model('Employee_model','employee');
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
  $list = $this->employee->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $employee) {
    $no++;
    $row = array();
    $row[] = '<input type="checkbox" class="data-check" value="'.$employee->id.'">';
$row[] = $employee->code;
$row[] = $employee->names;

    $row[] = $employee->function;
    $row[] = $employee->phone2;
    $row[] = $employee->phone1;
      $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_employee('."'".$employee->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
        <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_employee('."'".$employee->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
    $data[] = $row;
  }

  $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->employee->count_all(),
          "recordsFiltered" => $this->employee->count_filtered(),
          "data" => $data,
      );

  echo json_encode($output);

}

public function nit_check_employee()
            {
                if($this->input->is_ajax_request()) {
                $nit = $this->input->post('code');
                if(!$this->form_validation->is_unique($nit, 'employees.code')) {
                 $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'El Nombre digitado ya se encuentra registrado..')));
                    }
                }
            }
                public function ajax_edit($id)
                {
                  $data = $this->employee->get_by_id($id);
                  echo json_encode($data);
                }

  public function ajax_add()
                    {
                                    $this->_validate();


                      $data = array(

                                        'names' => $this->input->post('name'),
                                        'code' => $this->input->post('code'),
                                        'function' => $this->input->post('function'),
                                        'phone1' => $this->input->post('phone1'),
                                        'phone2' => $this->input->post('phone2'),
                                        'state' => $this->input->post('state'),

                              );
                      $insert = $this->employee->save($data);



    echo json_encode(array("status" => TRUE));
                    }
  public function ajax_update()
                      {
                        $this->_validate();
                        $data = array(
                          'names' => $this->input->post('name'),
                          'code' => $this->input->post('code'),
                          'function' => $this->input->post('function'),
                          'phone1' => $this->input->post('phone1'),
                          'phone2' => $this->input->post('phone2'),
                          'state' => $this->input->post('state'),
                          );
                        $this->employee->update(array('id' => $this->input->post('id')), $data);
                        echo json_encode(array("status" => TRUE));
                      }



          public function ajax_delete($id)
                    {
                        $this->employee->delete_by_id($id);
                      echo json_encode(array("status" => TRUE));
                      }

        public function ajax_bulk_delete()
                      {
                        $list_id = $this->input->post('id');
                        foreach ($list_id as $id) {
                          $this->employee->delete_by_id($id);
                        }
                        echo json_encode(array("status" => TRUE));
                      }

      private function _validate()

                      {
                        $data = array();
                        $data['error_string'] = array();
                        $data['inputerror'] = array();
                        $data['status'] = TRUE;

                        if($this->input->post('name') == '')
                        {
                          $data['inputerror'][] = 'name';
                          $data['error_string'][] = 'El campo Nombre es requerido';
                          $data['status'] = FALSE;
                        }

                        if($this->input->post('state') == '')
                        {
                          $data['inputerror'][] = 'state';
                          $data['error_string'][] = 'El campo Estado es requerido';
                          $data['status'] = FALSE;
                        }

                        if($this->input->post('code') == '')
                        {
                          $data['inputerror'][] = 'code';
                          $data['error_string'][] = 'El campo Código es requerido';
                          $data['status'] = FALSE;

                        }

                                              if($data['status'] === FALSE)

                        {
                          echo json_encode($data);
                          exit();
                        }
                      }



}
