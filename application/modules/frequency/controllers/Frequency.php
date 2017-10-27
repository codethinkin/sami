<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frequency extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeignameer : Write Less Do More

     is_login();

     $this->load->model('Frequency_model','frequency');
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
  $list = $this->frequency->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $frequency) {
    $no++;
    $row = array();
    $row[] = '<input type="checkbox" class="data-check" value="'.$frequency->id.'">';
    $row[] = $frequency->nameFrequency;
    $row[] = $frequency->state;
      $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_frequency('."'".$frequency->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
        <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_frequency('."'".$frequency->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
    $data[] = $row;
  }

  $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->frequency->count_all(),
          "recordsFiltered" => $this->frequency->count_filtered(),
          "data" => $data,
      );

  echo json_encode($output);

}



  public function ajax_add()

                    {
                      $this->_validate();
                      $states = "Activo";
                      $data = array(
                                        'nameFrequency' => $this->input->post('nameFrequency'),
                                        'state' => $states,

                              );
                              $name = $_POST['name'];
                              $cat= $this->frequency->usrchk($name);
                                if($cat ==1){
                                    $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'La categoria  ya se encuentra registrada..')));
                                }else{
                      $insert = $this->frequency->save($data);
                    echo json_encode(array("status" => TRUE));
}
                    }
  public function ajax_update()
                      {
                        $this->_validate();
                        $data = array(
                          'nameFrequency' => $this->input->post('nameFrequency'),
                          'state' => $this->input->post('state'),
                          );
                        $this->frequency->update(array('id' => $this->input->post('id')), $data);
                        echo json_encode(array("status" => TRUE));
                      }



          public function ajax_delete($id)
                    {
                        $this->frequency->delete_by_id($id);
                      echo json_encode(array("status" => TRUE));
                      }

        public function ajax_bulk_delete()
                      {
                        $list_id = $this->input->post('id');
                        foreach ($list_id as $id) {
                          $this->frequency->delete_by_id($id);
                        }
                        echo json_encode(array("status" => TRUE));
                      }

      private function _validate()

                      {
                        $data = array();
                        $data['error_string'] = array();
                        $data['inputerror'] = array();
                        $data['status'] = TRUE;

                        if($this->input->post('nameFrequency') == '')
                        {
                          $data['inputerror'][] = 'nameFrequency';
                          $data['error_string'][] = 'El campo Nombre es requerido';
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
              $name = $_POST['nameFrequency'];
              $this->frequency->usrchk($name);
            }
    }



}
