<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activityfrequency extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeignameer : Write Less Do More

     is_login();

     $this->load->model('Activityfrequency_model','activityfrequency');
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
  $list = $this->activityfrequency->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $activityfrequency) {
    $no++;
    $row = array();
    $row[] = '<input type="checkbox" class="data-check" value="'.$activityfrequency->id.'">';
    $row[] = $activityfrequency->nameFrequency;
    $row[] = $activityfrequency->activityFrequency;
    $row[] = $activityfrequency->state;
      $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_category('."'".$activityfrequency->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
        <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_category('."'".$activityfrequency->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
    $data[] = $row;
  }

  $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->activityfrequency->count_all(),
          "recordsFiltered" => $this->activityfrequency->count_filtered(),
          "data" => $data,
      );

  echo json_encode($output);

}


public function getSubcategoria(){
   echo json_encode($this->activityfrequency->getSubcategoria());

}

public function chk_usr()
{
if(isset($_POST))
          {
            $name = $_POST['name'];
            $this->activityfrequency->usrchk($name);
          }
  }
                public function ajax_edit($id)
                {
                  $data = $this->activityfrequency->get_by_id($id);
                  echo json_encode($data);
                }

  public function ajax_add()

                    {
                      $this->_validate();
                      $states = "Activo";
                      $data = array(
                                        'frequency'      => $this->input->post('frequency'),
                                        'activityFrequency'  => $this->input->post('activityFrequency'),
                                        'state'     => $states,

                              );

                              $name = $_POST['frequency'];
                              $cat= $this->activityfrequency->usrchk($name);
                                if($cat ==1){
                                    $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'La categoria  ya se encuentra registrada..')));
                                }else{
                      $insert = $this->activityfrequency->save($data);
                    echo json_encode(array("status" => TRUE));
}
                    }

  public function ajax_update()
                      {
                        $this->_validate();
                        $data = array(
                          'frequency'      => $this->input->post('frequency'),
                          'activityFrequency'  => $this->input->post('activityFrequency'),
                          'state'  => $this->input->post('state'),
                          );
                        $this->activityfrequency->update(array('id' => $this->input->post('id')), $data);
                        echo json_encode(array("status" => TRUE));
                      }



          public function ajax_delete($id)
                    {
                        $this->activityfrequency->delete_by_id($id);
                        echo json_encode(array("status" => TRUE));
                      }

        public function ajax_bulk_delete()
                      {
                        $list_id = $this->input->post('id');
                        foreach ($list_id as $id) {
                          $this->activityfrequency->delete_by_id($id);
                        }
                        echo json_encode(array("status" => TRUE));
                      }

                      private function _validate()

                                      {
                                        $data = array();
                                        $data['error_string'] = array();
                                        $data['inputerror'] = array();
                                        $data['status'] = TRUE;

                                        if($this->input->post('frequency') == '')
                                        {
                                          $data['inputerror'][] = 'frequency';
                                          $data['error_string'][] = 'El campo Nombre de Frecuencia es requerido';
                                          $data['status'] = FALSE;
                                        }


                                        if($data['status'] === FALSE)

                                        {
                                          echo json_encode($data);
                                          exit();
                                        }
                                      }



}
