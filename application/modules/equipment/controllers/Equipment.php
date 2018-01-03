<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Equipment_model', 'equipment');
  }


      public function index(){
          is_login();
          if(CheckPermission("user", "own_read")){
              $this->load->view('include/header');
              $this->load->view('index');
              $this->load->view('include/footer');
          } else {
              $this->session->set_flashdata('messagePr', 'You don\'t have permission to access.');
              redirect( base_url().'user/equipment', 'refresh');
          }
      }

        public function ajax_list()

      {

        $this->load->helper('url');
        $list = $this->equipment->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $equipment) {
      $compra = number_format($equipment->compra, 0, '.', '.');
          $no++;
          $row = array();
          $row[] = '<input type="checkbox" class="data-check" value="'.$equipment->id.'">';

          $row[] = $equipment->nameCus;
          $row[] = $equipment->equipmentType;
          $row[] = $equipment->code;
          $row[] = $equipment->mark;
          $row[] = $equipment->model;
          $row[] = $equipment->serie;
          $row[] = $equipment->nameLoad;

        $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_equipment('."'".$equipment->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
                  <a class="btn btn-info btn-xs" href="javascript:void(0)" title="Informacion" onclick="info_equipment('."'".$equipment->id."'".')"><i class="glyphicon glyphicon-eye-open"></i> </a>
                  <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_equipment('."'".$equipment->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
          $data[] = $row;
        }

        $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->equipment->count_all(),
                "recordsFiltered" => $this->equipment->count_filtered(),
                "data" => $data,
            );

        echo json_encode($output);

      }

      /*public function nit_check_equipment()
                  {
                      if($this->input->is_ajax_request()) {
                      $nit = $this->input->post('code');
                      if(!$this->form_validation->is_unique($nit, 'equipments.code')) {
                       $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'El Nombre digitado ya se encuentra registrado..')));
                          }
                      }
                  }
      */

      public function ajax_edit($id)
                      {
                        $data = $this->equipment->get_by_id($id);
                        echo json_encode($data);
                      }

      /*
                      public function info_equipment($id)
                                      {
                                        $data = $this->equipment->get_by_id($id);
                                        echo json_encode($data);
                                      }
      */
        public function ajax_add()
                          {

                                            $this->_validate();
                                              $data = array(
                                              'customers'           => $this->input->post('customers'),
                                              'code'                => $this->input->post('code'),
                                              'codeinte'                => $this->input->post('codeinte'),
                                              'equipmentType'         => $this->input->post('equipmentType'),
                                              'etapa'               => $this->input->post('etapa'),
                                              'engine'              => $this->input->post('engine'),
                                              'fuel'                => $this->input->post('fuel'),
                                              'mark'                => $this->input->post('mark'),
                                              'model'               => $this->input->post('model'),
                                              'serie'               => $this->input->post('serie'),
                                              'load'                => $this->input->post('load'),
                                              'mastil'              => $this->input->post('mastil'),
                                              'status'              => 1,

                                    );
                            $insert = $this->equipment->save($data);
                          echo json_encode(array("status" => TRUE));
                          }


        public function ajax_update()
                            {

                              $data = array(
                                'customers'           => $this->input->post('customers'),
                                'code'              => $this->input->post('code'),
                                'codeinte'                => $this->input->post('codeinte'),
                                'equipmentType'         => $this->input->post('equipmentType'),
                                'etapa'               => $this->input->post('etapa'),
                                'engine'              => $this->input->post('engine'),
                                'fuel'                => $this->input->post('fuel'),
                                'mark'                => $this->input->post('mark'),
                                'model'               => $this->input->post('model'),
                                'serie'               => $this->input->post('serie'),
                                'load'                => $this->input->post('load'),
                                'mastil'              => $this->input->post('mastil'),
                                'status'              => $this->input->post('status'),
                                );
                              $this->equipment->update(array('id' => $this->input->post('id')), $data);
                              echo json_encode(array("status" => TRUE));
                            }



                public function ajax_delete($id)
                          {
                              $this->equipment->delete_by_id($id);
                            echo json_encode(array("status" => TRUE));
                            }

              public function ajax_bulk_delete()
                            {
                              $list_id = $this->input->post('id');
                              foreach ($list_id as $id) {
                                $this->equipment->delete_by_id($id);
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
                                $data['error_string'][] = 'El campo Cliente es requerido';
                                $data['status'] = FALSE;
                              }

                              if($this->input->post('code') == '')
                              {
                                $data['inputerror'][] = 'code';
                                $data['error_string'][] = 'El campo Código es requerido';
                                $data['status'] = FALSE;
                              }

                              if($this->input->post('equipmentType') == '')
                              {
                                $data['inputerror'][] = 'equipmentType';
                                $data['error_string'][] = 'El campo Tipo de Equipo es requerido';
                                $data['status'] = FALSE;
                              }



                                                    if($data['status'] === FALSE)

                              {
                                echo json_encode($data);
                                exit();
                              }
                            }

          function get_subcate_section($id)
                  {
                          $towns = $this->db->get_where('equipment' , array(
                                              'customers' => $id
                                                ))->result_array();
                                                    foreach ($towns as $row) {
                                                            echo '<option value="' . $row['id'] . '">' . $row['code'] . '</option>';

                                  }

                              }

      public function chk_usr()
      {
      if(isset($_POST))
                {
                  $code = $_POST['code'];
                  $this->equipment->usrchk($code);
                }
        }




      }
