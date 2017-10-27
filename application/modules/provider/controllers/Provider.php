<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provider extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More

     is_login();

     $this->load->model('Provider_model','provider');
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
  $list = $this->provider->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $provider) {
    $no++;
    $row = array();
    $row[] = '<input type="checkbox" class="data-check" value="'.$provider->id.'">';
    $row[] = $provider->nit;
    $row[] = $provider->name;
    $row[] = $provider->address;
    $row[] = $provider->phone1;
    $row[] = $provider->email;
      $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_provider('."'".$provider->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
        <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_provider('."'".$provider->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
    $data[] = $row;
  }

  $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->provider->count_all(),
          "recordsFiltered" => $this->provider->count_filtered(),
          "data" => $data,
      );

  echo json_encode($output);

}

public function nit_check_provider()
            {
                if($this->input->is_ajax_request()) {
                $nit = $this->input->post('nit');
                if(!$this->form_validation->is_unique($nit, 'Providers.nit')) {
                 $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'El NIT digitado ya se encuentra registrado..')));
                    }
                }
            }
                public function ajax_edit($id)
                {
                  $data = $this->provider->get_by_id($id);
                  echo json_encode($data);
                }

  public function ajax_add()

                    {
                                      $this->_validate();
$states = 1;
                      $data = array(
                                      'nit' => $this->input->post('nit'),
                                        'name' => $this->input->post('name'),
                                        'contact' => $this->input->post('contact'),
                                        'address' => $this->input->post('address'),
                                        'phone1' => $this->input->post('phone1'),
                                        'phone2' => $this->input->post('phone2'),
                                        'email' => $this->input->post('email'),
                                        'status' => $states,

                              );
                      $insert = $this->provider->save($data);
                    echo json_encode(array("status" => TRUE));
                    }
  public function ajax_update()
                      {
                        $this->_validate();
                        $data = array(
                          'nit' => $this->input->post('nit'),
                          'name' => $this->input->post('name'),
                          'contact' => $this->input->post('contact'),
                          'address' => $this->input->post('address'),
                          'phone1' => $this->input->post('phone1'),
                          'phone2' => $this->input->post('phone2'),
                          'email' => $this->input->post('email'),
                          'status' => $this->input->post('state'),
                          );
                        $this->provider->update(array('id' => $this->input->post('id')), $data);
                        echo json_encode(array("status" => TRUE));
                      }



          public function ajax_delete($id)
                    {
                        $this->provider->delete_by_id($id);
                      echo json_encode(array("status" => TRUE));
                      }

        public function ajax_bulk_delete()
                      {
                        $list_id = $this->input->post('id');
                        foreach ($list_id as $id) {
                          $this->provider->delete_by_id($id);
                        }
                        echo json_encode(array("status" => TRUE));
                      }

      private function _validate()

                      {
                        $data = array();
                        $data['error_string'] = array();
                        $data['inputerror'] = array();
                        $data['status'] = TRUE;

                        if($this->input->post('nit') == '')
                        {
                          $data['inputerror'][] = 'nit';
                          $data['error_string'][] = 'El campo NIT es requerido';
                          $data['status'] = FALSE;
                        }

                        if($this->input->post('name') == '')
                        {
                          $data['inputerror'][] = 'name';
                          $data['error_string'][] = 'El campo Razon Socila es requerido';
                          $data['status'] = FALSE;

                        }

                        if($this->input->post('contact') == '')
                        {
                          $data['inputerror'][] = 'contact';
                          $data['error_string'][] = 'El campo Contacto es requerido';
                          $data['status'] = FALSE;

                        }

                        if($this->input->post('phone1') == '')
                        {
                          $data['inputerror'][] = 'phone1';
                          $data['error_string'][] = 'El campo Télefono es requerido';
                          $data['status'] = FALSE;
                        }



                        if($data['status'] === FALSE)

                        {
                          echo json_encode($data);
                          exit();
                        }
                      }



}
