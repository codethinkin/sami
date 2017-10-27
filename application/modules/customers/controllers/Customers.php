<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More

     is_login();

     $this->load->model('Customers_model','customer');
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
  $list = $this->customer->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $customer) {
    $no++;
    $row = array();
    $row[] = '<input type="checkbox" class="data-check" value="'.$customer->id.'">';
    $row[] = $customer->nit;
    $row[] = $customer->nameCus;
    $row[] = $customer->address;
    $row[] = $customer->phone1;
    $row[] = $customer->email;
  $row[] = $customer->status;
      $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_customer('."'".$customer->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
        <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_customer('."'".$customer->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
    $data[] = $row;
  }

  $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->customer->count_all(),
          "recordsFiltered" => $this->customer->count_filtered(),
          "data" => $data,
      );

  echo json_encode($output);

}

public function nit_check_customer()
            {
                if($this->input->is_ajax_request()) {
                $nit = $this->input->post('nit');
                if(!$this->form_validation->is_unique($nit, 'customers.nit')) {
                 $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'El NIT digitado ya se encuentra registrado..')));
                    }
                }
            }
                public function ajax_edit($id)
                {
                  $data = $this->customer->get_by_id($id);
                  echo json_encode($data);
                }

  public function ajax_add()

                    {
                                      $this->_validate();
$states = 1;
                      $data = array(
                                      'nit' => $this->input->post('nit'),
                                        'nameCus' => $this->input->post('name'),
                                        'contact' => $this->input->post('contact'),
                                        'address' => $this->input->post('address'),
                                        'phone1' => $this->input->post('phone1'),
                                        'phone2' => $this->input->post('phone2'),
                                        'email' => $this->input->post('email'),
                                        'status' => $states,

                              );
                      $insert = $this->customer->save($data);
                    echo json_encode(array("status" => TRUE));
                    }
  public function ajax_update()
                      {

                        $data = array(
                          'nit' => $this->input->post('nit'),
                          'nameCus' => $this->input->post('name'),
                          'contact' => $this->input->post('contact'),
                          'address' => $this->input->post('address'),
                          'phone1' => $this->input->post('phone1'),
                          'phone2' => $this->input->post('phone2'),
                          'email' => $this->input->post('email'),
                          'status' => $this->input->post('state'),
                          );
                        $this->customer->update(array('id' => $this->input->post('id')), $data);
                        echo json_encode(array("status" => TRUE));
                      }



          public function ajax_delete($id)
                    {
                        $this->customer->delete_by_id($id);
                      echo json_encode(array("status" => TRUE));
                      }

        public function ajax_bulk_delete()
                      {
                        $list_id = $this->input->post('id');
                        foreach ($list_id as $id) {
                          $this->customer->delete_by_id($id);
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
                          $data['error_string'][] = 'El campo Contacto es requerido';
                          $data['status'] = FALSE;

                        }

                    



                        if($data['status'] === FALSE)

                        {
                          echo json_encode($data);
                          exit();
                        }
                      }



}
