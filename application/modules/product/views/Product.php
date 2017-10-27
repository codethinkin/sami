<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More

     is_login();

     $this->load->model('Product_model','product');
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
  $list = $this->product->get_datatables();
  $data = array();
  $no = $_POST['start'];
  foreach ($list as $product) {
$compra = number_format($product->compra, 0, '.', '.');
    $no++;
    $row = array();
    $row[] = '<input type="checkbox" class="data-check" value="'.$product->id.'">';

    $row[] = $product->codigo;
    $row[] = $product->referencia;
    $row[] = $product->descripcion;
    $row[] = $product->marca;
    $row[] = $product->cantidad;
    $row[] = $compra;
    $row[] = $product->ubicacion;

  $row[] = '<a class="btn btn-primary btn-xs" href="javascript:void(0)" title="Editar" onclick="edit_product('."'".$product->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
            <a class="btn btn-info btn-xs" href="javascript:void(0)" title="Informacion" onclick="info_product('."'".$product->id."'".')"><i class="glyphicon glyphicon-eye-open"></i> </a>
            <a class="btn btn-danger btn-xs" href="javascript:void(0)" title="Eliminar" onclick="delete_product('."'".$product->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
    $data[] = $row;
  }

  $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->product->count_all(),
          "recordsFiltered" => $this->product->count_filtered(),
          "data" => $data,
      );

  echo json_encode($output);

}

/*public function nit_check_product()
            {
                if($this->input->is_ajax_request()) {
                $nit = $this->input->post('code');
                if(!$this->form_validation->is_unique($nit, 'products.code')) {
                 $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'El Nombre digitado ya se encuentra registrado..')));
                    }
                }
            }
*/

public function ajax_edit($id)
                {
                  $data = $this->product->get_by_id($id);
                  echo json_encode($data);
                }

/*
                public function info_product($id)
                                {
                                  $data = $this->product->get_by_id($id);
                                  echo json_encode($data);
                                }
*/
  public function ajax_add()

                    {
                                      $this->_validate();
                                        $data = array(

                                        'codigo'           => $this->input->post('code'),
                                        'descripcion'      => $this->input->post('description'),
                                        'marca'            => $this->input->post('marca'),
                                        'referencia'       => $this->input->post('referencia'),
                                        'ubicacion'        => $this->input->post('ubicacion'),
                                        'unidadMedida'     => $this->input->post('unidadMedida'),
                                        'stock'            => $this->input->post('stock'),
                                        'id_category'     => $this->input->post('category'),
                                        'id_subcategory'  => $this->input->post('subcategory'),
                                        'precio_compra'    => $this->input->post('precio'),
                                        'compra'           => $this->input->post('precio'),

                              );
                      $insert = $this->product->save($data);
                    echo json_encode(array("status" => TRUE));
                    }


  public function ajax_update()
                      {

                        $data = array(
                          'codigo'            => $this->input->post('code'),
                          'descripcion'       => $this->input->post('description'),
                          'marca'             => $this->input->post('marca'),
                          'referencia'        => $this->input->post('referencia'),
                          'ubicacion'         => $this->input->post('ubicacion'),
                          'unidadMedida'      => $this->input->post('unidadMedida'),
                          'stock'             => $this->input->post('stock'),
                          'id_category'      => $this->input->post('category'),
                          'id_subcategory'   => $this->input->post('subcategory'),
                          'compra'            => $this->input->post('precio'),
                          );
                        $this->product->update(array('id' => $this->input->post('id')), $data);
                        echo json_encode(array("status" => TRUE));
                      }



          public function ajax_delete($id)
                    {
                        $this->product->delete_by_id($id);
                      echo json_encode(array("status" => TRUE));
                      }

        public function ajax_bulk_delete()
                      {
                        $list_id = $this->input->post('id');
                        foreach ($list_id as $id) {
                          $this->product->delete_by_id($id);
                        }
                        echo json_encode(array("status" => TRUE));
                      }

      private function _validate()

                      {
                        $data = array();
                        $data['error_string'] = array();
                        $data['inputerror'] = array();
                        $data['status'] = TRUE;

                        if($this->input->post('code') == '')
                        {
                          $data['inputerror'][] = 'code';
                          $data['error_string'][] = 'El campo Código es requerido';
                          $data['status'] = FALSE;
                        }

                        if($this->input->post('description') == '')
                        {
                          $data['inputerror'][] = 'description';
                          $data['error_string'][] = 'El campo Descripción es requerido';
                          $data['status'] = FALSE;
                        }

                        if($this->input->post('ubicacion') == '')
                        {
                          $data['inputerror'][] = 'ubicacion';
                          $data['error_string'][] = 'El campo ubicación es requerido';
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
                    $towns = $this->db->get_where('subCategory' , array(
                                        'category' => $id
                                          ))->result_array();
                                              foreach ($towns as $row) {
                                                      echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';

                            }

                        }

public function chk_usr()
{
if(isset($_POST))
          {
            $code = $_POST['code'];
            $this->product->usrchk($code);
          }
  }




}
