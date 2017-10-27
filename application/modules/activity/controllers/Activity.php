<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
$this->load->model('Activity_model', 'activity');
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
    $list = $this->activity->get_datatables();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $activity) {
      $no++;
      $row = array();
      $row[] = '<input type="checkbox" class="data-check" value="'.$activity->id.'">';
      $row[] = $activity->nameActivity;
      $row[] = $activity->state;
      $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_activity('."'".$activity->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
          <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_activity('."'".$activity->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
      $data[] = $row;
    }

    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->activity->count_all(),
            "recordsFiltered" => $this->activity->count_filtered(),
            "data" => $data,
        );

    echo json_encode($output);

  }



    public function ajax_add()

                      {
                        $this->_validate();
                        $states = "Activo";
                        $data = array(
                                          'nameActivity' => $this->input->post('nameActivity'),
                                          'state' => $this->input->post('state'),

                                );
                                $name = $_POST['nameActivity'];
                                $cat= $this->activity->usrchk($name);
                                  if($cat ==1){
                                      $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'La Actividad  ya se encuentra registrada..')));
                                  }else{
                        $insert = $this->activity->save($data);
                      echo json_encode(array("status" => TRUE));
  }
                      }
    public function ajax_update()
                        {
                          $this->_validate();
                          $data = array(
                            'nameActivity' => $this->input->post('nameActivity'),
                            'state' => $this->input->post('state'),
                                              );
                          $this->activity->update(array('id' => $this->input->post('id')), $data);
                          echo json_encode(array("status" => TRUE));
                        }



            public function ajax_delete($id)
                      {
                          $this->activity->delete_by_id($id);
                        echo json_encode(array("status" => TRUE));
                        }

          public function ajax_bulk_delete()
                        {
                          $list_id = $this->input->post('id');
                          foreach ($list_id as $id) {
                            $this->activity->delete_by_id($id);
                          }
                          echo json_encode(array("status" => TRUE));
                        }

        private function _validate()

                        {
                          $data = array();
                          $data['error_string'] = array();
                          $data['inputerror'] = array();
                          $data['status'] = TRUE;

                          if($this->input->post('nameActivity') == '')
                          {
                            $data['inputerror'][] = 'nameActivity';
                            $data['error_string'][] = 'El campo Nombre de la Actividad es requerido';
                            $data['status'] = FALSE;
                          }

                            if($data['status'] === FALSE)

                          {
                            echo json_encode($data);
                            exit();
                          }
                        }

    public function chk_usr()
    {
    if(isset($_POST))
              {
                $name = $_POST['name'];
                $this->activity->usrchk($name);
              }
      }



  }
