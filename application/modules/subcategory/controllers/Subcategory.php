<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeignameer : Write Less Do More

     is_login();

     $this->load->model('Subcategory_model','subcategory');
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
  $list = $this->subcategory->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $subcategory) {
    $no++;
    $row = array();
    $row[] = '<input type="checkbox" class="data-check" value="'.$subcategory->id.'">';
    $row[] = $subcategory->category;
    $row[] = $subcategory->name;
    $row[] = $subcategory->state;
      $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_category('."'".$subcategory->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
        <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_category('."'".$subcategory->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
    $data[] = $row;
  }

  $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->subcategory->count_all(),
          "recordsFiltered" => $this->subcategory->count_filtered(),
          "data" => $data,
      );

  echo json_encode($output);

}


public function getSubcategoria(){
   echo json_encode($this->subcategory->getSubcategoria());

}

public function chk_usr()
{
if(isset($_POST))
          {
            $name = $_POST['name'];
            $this->subcategory->usrchk($name);
          }
  }
                public function ajax_edit($id)
                {
                  $data = $this->subcategory->get_by_id($id);
                  echo json_encode($data);
                }

  public function ajax_add()

                    {
                      $this->_validate();
                      $states = "Activo";
                      $data = array(
                                        'name'      => $this->input->post('name'),
                                        'category'  => $this->input->post('category'),
                                        'state'     => $states,

                              );

                              $name = $_POST['name'];
                              $cat= $this->subcategory->usrchk($name);
                                if($cat ==1){
                                    $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'La categoria  ya se encuentra registrada..')));
                                }else{
                      $insert = $this->subcategory->save($data);
                    echo json_encode(array("status" => TRUE));
}
                    }

  public function ajax_update()
                      {
                        $this->_validate();
                        $data = array(
                          'name'     => $this->input->post('name'),
                          'state'    => $this->input->post('state'),
                          'category' => $this->input->post('category'),
                          );
                        $this->subcategory->update(array('id' => $this->input->post('id')), $data);
                        echo json_encode(array("status" => TRUE));
                      }



          public function ajax_delete($id)
                    {
                        $this->subcategory->delete_by_id($id);
                        echo json_encode(array("status" => TRUE));
                      }

        public function ajax_bulk_delete()
                      {
                        $list_id = $this->input->post('id');
                        foreach ($list_id as $id) {
                          $this->subcategory->delete_by_id($id);
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


                                        if($data['status'] === FALSE)

                                        {
                                          echo json_encode($data);
                                          exit();
                                        }
                                      }



}
