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

                  function get_type_sections($id)
                  {

                    $equipox = $this->db->get_where('equipment' , array(
                        'id' => $id
                          ))->result_array();
            echo '<option value="0">...Seleccionar La Equipo...</option>';
                              foreach ($equipox as $row) {
                                  echo '<option value="' . $row['id'] . '">' . $row['equipmentType'] . '</option>';

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
          $row[] = '<a  href="javascript:void(0)" title="Editar Orden" onclick="edit_order('."'".$order->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
                    <a href="javascript:void(0)" title="Eliminar Orden" onclick="delete_order('."'".$order->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>
                    <a  href="http://localhost:81/sami/order/pdf_order/'."$order->id".'" title="Imprimir Orden" ><i class="glyphicon glyphicon-print"></i> </a>
                    <a   href="javascript:void(0)" title="Registrar Actividad" onclick="activity_order('."'".$order->id."'".')"><i class="glyphicon glyphicon-th-list"></i> </a>
                    <a   href="javascript:void(0)" title="Liquidar Orden" onclick="print_order('."'".$order->id."'".')"><i class="glyphicon glyphicon-usd"></i> </a>
                    ';
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
public function ajax_edit($id){
        $data = $this->order->get_by_id($id);
        echo json_encode($data);
}

public function ajax_edit_activity($id){
        $data = $this->order->get_by_id_order_activity($id);
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
if($this->input->post('frequency')== NULL){
$escape = 5;
}else{
$escape = $this->input->post('frequency');
}
                          $code  = $query;
                          $data  = array(
                                            'autorized' => $this->input->post('autorized'),
                                            'frequency' => $escape,
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
                                            'cotizacion' => $this->input->post('cotizacion'),
                                            'sdc' => $this->input->post('sdc'),
                                            'capex' => $this->input->post('capex'),
                                            'ordencompra' => $this->input->post('ordencompra'),
                                            'ordenenka' => $this->input->post('ordenenka'),
                                            'code' => $cod
                                  );
                          $insert = $this->order->save($data);
                        echo json_encode(array("status" => TRUE));


                        }


                        public function ajax_add_liq()

                                                {

                                                  $datos  = array(
                                                                    'detalle' => $this->input->post('detalle',TRUE),
                                                                    'code' => $this->input->post('code',TRUE),
                                                                    'customers' => $this->input->post('name',TRUE)
                                                                );
                                                  $guardar = $this->order->save_liq($datos);
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
                              'autorized' => $this->input->post('autorized'),
                              'cotizacion' => $this->input->post('cotizacion'),
                              'sdc' => $this->input->post('sdc'),
                              'capex' => $this->input->post('capex'),
                              'ordencompra' => $this->input->post('ordencompra'),
                              'startActivity' => $this->input->post('startActivity'),
                              'ordenenka' => $this->input->post('ordenenka'),
                              );
                            $this->order->update(array('id' => $this->input->post('id')), $data);
                            echo json_encode(array("status" => TRUE));
                          }



                          public function ajax_liquidar()
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




/*
public function pdf()
{
  //load mPDF library
  $this->load->library('M_pdf');
  //load mPDF library


  //now pass the data//
   $this->data['title']="MY PDF TITLE 1.";
   $this->data['description']="";
   $this->data['description']=$this->official_copies;
   //now pass the data //


  $html=$this->load->view('pdf',$this->data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.

  //this the the PDF filename that user will get to download
  $pdfFilePath ="OrdenTrabajo.pdf";


  //actually, you can pass mPDF parameter on this load() function
  $pdf = $this->m_pdf->load();


  $css = file_get_contents('http://localhost:81/sami/assets/css/pdf.css');

  $pdf->WriteHTML($css,1);


  //generate the PDF!
  $pdf->WriteHTML($html,2);
  //offer it to user via browser download! (The PDF won't be saved on your server HDD)
  $pdf->Output($pdfFilePath, "D");
}
*/

public function pdf_blanco()
    {
        //Carga la librería que agregamos
        $this->load->library('mydompdf');
        //$saludo será una variable dentro la vista
        $data["saludo"] = "Hola mundo!";
        //$html tendrá el contenido de la vista
        $html           = $this->load->view('pdf_blanco', $data, true);
        /*
         * load_html carga en dompdf la vista
         * render genera el pdf
         * stream ("nombreDelDocumento.pdf", Attachment: true | false)
         * true = forza a descargar el pdf
         * false = genera el pdf dentro del navegador
         */
        $this->mydompdf->load_html($html);
        $this->mydompdf->render();
        $this->mydompdf->stream("welcome.pdf", array(
            "Attachment" => false
        ));
    }

    function pdf_order($id)
    {

        $this->load->library('mydompdf');
        $this->load->model('Order_model');
        $row = $this->Order_model->get_by_id_order($id);
        $base = $this->Order_model->get_by_order($id);

        $data = array(
      'id' 					          => $row->id,
      'code' 				          => $row->code,
      'autorized' 				    => $row->autorized,
      'startActivity' 				=> $row->startActivity,
      'frequency' 				    => $row->frequency,
      'nit' 				          => $row->nit,
      'activity' 				      => $row->activity,
      'customers'             => $row->customers,
      'observation'           => $row->observation,
      'mark'                  => $row->mark,
      'model'                 => $row->model,
      'serie'                 => $row->serie,
      'equipmentType'         => $row->equipmentType,
      'activityFrequency'     => $row->activityFrequency,
      'sdc'                   => $row->sdc,
      'ordencompra'           => $row->ordencompra,
      'cotizacion'            => $row->cotizacion,
      'capex'                 => $row->capex,
      'base'                  => $this->Order_model->get_by_order($id)

);

       //$data['code'] = 12121;
        $html = $this->load->view('header_footer', $data, true);
        $this->mydompdf->load_html($html);
        $this->mydompdf->render();
            //Así se agrega css a la vista que queremos renderizar
            //En la vista hay que agregarlo con link en el head del documento html
        $this->mydompdf->set_base_path('./assets/css/dompdf.css'); //agregar de nuevo el css
        $this->mydompdf->stream("OrdenDeTrabajo.pdf", array(
            "Attachment" => false
        ));
    }

function liq(){

  $data  = array(

                    'customers' => $this->input->post('name'),
                    'precio' => $this->input->post('precio'),
                    'detalle' => $this->input->post('detalle'),
                    'code' => $this->input->post('codigo'),
          );
  $insert = $this->order->save_liq($data);
  echo json_encode(array("status" => TRUE));


}


public function save_liq()

                        {
                          $data  = array(
                                          'detalle' => $this->input->post('detalle'),
                                            'precio' => $this->input->post('precio'),
                                            'customers' => $this->input->post('name'),
                                            'code' => $this->input->post('code'),
                                  );
                          $insert = $this->order->save_liq($data);
                        echo json_encode(array("status" => TRUE));


                        }





    }
