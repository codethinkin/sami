<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller{

      public function __construct()
      {
        parent::__construct();
        //Codeigniter : Write Less Do More

         is_login();

         $this->load->model('Order_model','order');
      }

      public function index(){
          is_login();
             $clientes = $this->order->Clientes();


          $data = array(
                          'cliente' => $clientes);
          if(CheckPermission("user", "own_read")){
              $this->load->view('include/header');
              $this->load->view('index', $data);
              $this->load->view('include/footer');
          } else {
              $this->session->set_flashdata('messagePr', 'You don\'t have permission to access.');
              redirect( base_url().'user/profile', 'refresh');
          }
      }

      function get_equipment_sections($id)
              {
                      $towns = $this->db->get_where('equipment' , array(
                                          'customers' => $id
                                            ))->result_array();
echo '<option value="0">...Seleccionar Equipo...</option>';
                                                foreach ($towns as $row) {

                                                        echo '<option value="' . $row['id'] . '">' . $row['code'] . '</option>';


                              }

                          }

function get_mark_sections($id)
{
  $mark = $this->db->get_where('equipment' , array(
      'id' => $id
        ))->result_array();
echo '<option value="0">...Seleccionar La Marca...</option>';
            foreach ($mark as $row) {
                echo '<option value="' . $row['id'] . '">' . $row['mark'] . '</option>';

          }
      }

      function get_model_sections($id)
      {
        $model = $this->db->get_where('equipment' , array(
            'id' => $id
              ))->result_array();
echo '<option value="0">...Seleccionar El Modelo...</option>';
                  foreach ($model as $row) {
                      echo '<option value="' . $row['id'] . '">' . $row['model'] . '</option>';

                }
            }

            function get_serie_sections($id)
            {

              $serie = $this->db->get_where('equipment' , array(
                  'id' => $id
                    ))->result_array();
echo '<option value="0">...Seleccionar La Serie...</option>';
                        foreach ($serie as $row) {
                            echo '<option value="' . $row['id'] . '">' . $row['serie'] . '</option>';

                      }
                  }


      public function BuscarCliente(){
       		$filtro    = $this->input->get("term");
    			$clientes = $this->order->buscarcliente($filtro);
    			echo json_encode($clientes);
    		}

        public function clientes(){
            $clientes = $this->order->Clientes();
            echo json_encode($clientes);
          }





      public function ajax_list()

    {

      $this->load->helper('url');
      $list = $this->order->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $order) {
        $no++;
        $row = array();
        $row[] = '<input type="checkbox" class="data-check" value="'.$order->id.'">';
        $row[] = $order->code;
        $row[] = $order->nit;
        $row[] = $order->nameCus;
        $row[] = $order->nameActivity;
        $row[] = $order->startActivity;
        $row[] = $order->state;
          $row[] = '<a  href="javascript:void(0)" title="Editar" onclick="edit_order('."'".$order->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
                    <a href="javascript:void(0)" title="Eliminar" onclick="delete_order('."'".$order->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>
                    <a  href="javascript:void(0)" title="Imprimir" onclick="print_order('."'".$order->id."'".')"><i class="glyphicon glyphicon-print"></i> </a>';
        $data[] = $row;
      }

      $output = array(
              "draw" => $_POST['draw'],
              "recordsTotal" => $this->order->count_all(),
              "recordsFiltered" => $this->order->count_filtered(),
              "data" => $data,
          );

      echo json_encode($output);

    }

    public function nit_check_order()
                {
                    if($this->input->is_ajax_request()) {
                    $nit = $this->input->post('nit');
                    if(!$this->form_validation->is_unique($nit, 'orders.nit')) {
                     $this->output->set_content_type('application/json')->set_output(json_encode(array('message' => 'El NIT digitado ya se encuentra registrado..')));
                        }
                    }
                }
                    public function ajax_edit($id)
                    {
                      $data = $this->order->get_by_id($id);
                      echo json_encode($data);
                    }

      public function ajax_add()

                        {
                          $this->db->select_max('code');
                           $query = $this->db->get('order');
                           if ($query->num_rows() > 0)
                           {
                              $row = $query->row();
                              $codigo = $row->code;
                           }

$cod = $codigo + 1;

                          $this->_validate();
                          $states = 1;

                          $code  = $query;
                          $data  = array(
                                            /*'nit' => $this->input->post('nit'),
                                            'name' => $this->input->post('name'),
                                            'contact' => $this->input->post('contact'),
                                            'address' => $this->input->post('address'),
                                            'phone1' => $this->input->post('phone1'),
                                            'phone2' => $this->input->post('phone2'),
                                            'email' => $this->input->post('email'),
                                            'status' => $states,*/
                                            'activity' => $this->input->post('activity'),
                                            'observation' => $this->input->post('observation'),
                                            'employee' => $this->input->post('employee'),
                                            'state' => $this->input->post('state'),
                                            'name' => $this->input->post('name'),
                                            'startActivity' => $this->input->post('startActivity'),
                                            'mark' => $this->input->post('mark'),
                                            'model' => $this->input->post('model'),
                                            'serie' => $this->input->post('serie'),
                                            'codigo' => $this->input->post('codigo'),
                                            'code' => $cod


                                  );
                          $insert = $this->order->save($data);
                        echo json_encode(array("status" => TRUE));


                        }
      public function ajax_update()
                          {
                            $this->_validate();
                            $data = array(
                              'activity' => $this->input->post('activity'),
                              'observation' => $this->input->post('observation'),
                              'employee' => $this->input->post('employee'),
                              'state' => $this->input->post('state'),
                              'name' => $this->input->post('name'),
                              'startActivity' => $this->input->post('startActivity'),
                              );
                            $this->order->update(array('id' => $this->input->post('id')), $data);
                            echo json_encode(array("status" => TRUE));
                          }



                          public function ajax_print()
                                              {

                                                $data = array(
                                                  'activity' => $this->input->post('activity'),
                                                  'observation' => $this->input->post('observation'),
                                                  'employee' => $this->input->post('employee'),
                                                  'state' => $this->input->post('state'),
                                                  'name' => $this->input->post('name'),
                                                  'startActivity' => $this->input->post('startActivity'),
                                                  );
                                                $this->order->update(array('id' => $this->input->post('id')), $data);
                                                echo json_encode(array("status" => TRUE));
                                              }



              public function ajax_delete($id)
                        {
                            $this->order->delete_by_id($id);
                          echo json_encode(array("status" => TRUE));
                          }

            public function ajax_bulk_delete()
                          {
                            $list_id = $this->input->post('id');
                            foreach ($list_id as $id) {
                              $this->order->delete_by_id($id);
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
                              $data['error_string'][] = 'El campo Nombre del Cliente es requerido';
                              $data['status'] = FALSE;
                            }

                            if($this->input->post('activity') == '')
                            {
                              $data['inputerror'][] = 'activity';
                              $data['error_string'][] = 'El campo Tipo de Actividad es requerido';
                              $data['status'] = FALSE;

                            }




                            if($data['status'] === FALSE)

                            {
                              echo json_encode($data);
                              exit();
                            }
                          }


                          public function descargar(){

                            $data = [];

                            $hoy = date("dmyhis");

                                //load the view and saved it into $html variable
                                $html =
                                "<style>@page {
                        			    margin-top: 0.5cm;
                        			    margin-bottom: 0.5cm;
                        			    margin-left: 0.5cm;
                        			    margin-right: 0.5cm;
                        			}
                        			</style>".
                                "<body>
                                	<div style='color:#006699;'><b>".$this->input->post('customers')."<b></div>".
                                		"<div style='width:50px; height:50px; background-color:red;'>asdf</div>

                                </body>";

                                // $html = $this->load->view('v_dpdf',$date,true);

                            //$html="asdf";
                                //this the the PDF filename that user will get to download
                                $pdfFilePath = "cipdf_".$hoy.".pdf";

                                //load mPDF library
                                $this->load->library('M_pdf');
                                $mpdf = new mPDF('c', 'A4-L');
                            $mpdf->WriteHTML($html);
                            $mpdf->Output($pdfFilePath, "D");
                               // //generate the PDF from the given html
                               //  $this->m_pdf->pdf->WriteHTML($html);

                               //  //download it.
                               //  $this->m_pdf->pdf->Output($pdfFilePath, "D");
                          }


    }
