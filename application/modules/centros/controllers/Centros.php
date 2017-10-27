<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Centros extends CI_Controller{

public function __construct()
  {
    parent::__construct();
    //Codeignameer : Write Less Do More

     is_login();

     $this->load->model('Centros_model','centros');
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
  $list = $this->centros->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $centros) {
    $no++;
    $row = array();
    $row[] = '<input type="checkbox" class="data-check" value="'.$centros->id.'">';
    $row[] = $centros->customers;
    $row[] = $centros->centocosto;

      $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_category('."'".$centros->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
        <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_category('."'".$centros->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
    $data[] = $row;
  }

  $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->centros->count_all(),
          "recordsFiltered" => $this->centros->count_filtered(),
          "data" => $data,
      );

  echo json_encode($output);

}


public function getCentros(){
   echo json_encode($this->centros->getCentros());

}

public function chk_usr()
{
if(isset($_POST))
          {
            $name = $_POST['name'];
            $this->centros->usrchk($name);
          }
  }
                public function ajax_edit($id)
                {
                  $data = $this->centros->get_by_id($id);
                  echo json_encode($data);
                }

  public function ajax_add()

                    {
                      $this->_validate();
                      $states = 1;
                      $data = array(
                                        'customers'     => $this->input->post('customers'),
                                        'centocosto'  => $this->input->post('centocosto'),
                                        'estatus'     => $this->input->post('estatus'),

                              );


                      $insert = $this->centros->save($data);
                    echo json_encode(array("status" => TRUE));

                    }

  public function ajax_update()
                      {
                        $this->_validate();
  $states = 1;
                        $data = array(
                          'customers'     => $this->input->post('customers'),
                          'centocosto'  => $this->input->post('centocosto'),
                            'estatus'     => $this->input->post('estatus'),
                          );
                        $this->centros->update(array('id' => $this->input->post('id')), $data);
                        echo json_encode(array("status" => TRUE));
                      }



          public function ajax_delete($id)
                    {
                        $this->centros->delete_by_id($id);
                        echo json_encode(array("status" => TRUE));
                      }

        public function ajax_bulk_delete()
                      {
                        $list_id = $this->input->post('id');
                        foreach ($list_id as $id) {
                          $this->centros->delete_by_id($id);
                        }
                        echo json_encode(array("status" => TRUE));
                      }

                      private function _validate()

                                      {
                                        $data = array();
                                        $data['error_string'] = array();
                                        $data['inputerror'] = array();
                                        $data['status'] = TRUE;

                                        if($this->input->post('customers') == '')
                                        {
                                          $data['inputerror'][] = 'customers';
                                          $data['error_string'][] = 'El Campo Cliente es requerido';
                                          $data['status'] = FALSE;
                                        }


                                        if($data['status'] === FALSE)

                                        {
                                          echo json_encode($data);
                                          exit();
                                        }
                                      }



}
