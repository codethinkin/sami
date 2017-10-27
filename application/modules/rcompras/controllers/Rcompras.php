<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rcompras extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    is_login();

    $this->load->model('Rcompras_model','report');
   $this->load->library('PHPExcel');

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

  public function GeneraReporte(){

    $Reporte   = json_decode($this->input->post('MiReporte'));
  $FInicial  = explode("/",$Reporte->Finicial);
  $FFinal    = explode("/",$Reporte->FFinal);
  $Documento = $Reporte->Documento;
  $FInicial  = $FInicial[2]."-".$FInicial[0]."-".(int)$FInicial[1]." 00:00:00";
  $FFinal    = $FFinal[2]."-".$FFinal[0]."-".(int)$FFinal[1]." 23:59:59";

  echo json_encode($this->report->reportesGenera($FInicial, $FFinal, $Documento));
      }


function imprimir()
          {
                $FInicial  = explode("/",$this->input->post('finicial'));
                $FFinal    = explode("/",$this->input->post('ffinal'));
                $Documento = $this->input->post('documento');
                $FInicial  = $FInicial[2]."-".$FInicial[0]."-".(int)$FInicial[1]." 00:00:00";
                $FFinal    = $FFinal[2]."-".$FFinal[0]."-".(int)$FFinal[1]." 23:59:59";


                $sql="SELECT P.TIPO, P.FECHA_FACTURA AS Fecha, concat(C.RFC, ' - ',C.nameCus, ' - ',  X.centocosto) AS Cliente, CONCAT(P.DESCRIPCION,' - Cod - ', P.CLAVE) AS Articulo, P.SALIDAS,P.PRECIO, (P.SALIDAS * P.PRECIO) AS TOTAL
      FROM partidas P
      INNER JOIN customers C ON C.id = P.CLIENTE
      INNER JOIN documentos O ON O.ID = P.ID_LINK
      INNER JOIN centrocosto X ON X.id = O.centros
      WHERE (DATE(P.FECHA_FACTURA) between'".$FInicial."' AND '".$FFinal."') AND P.TIPO='".$Documento."' ";
                //echo $sql;
                $query=$this->db->query($sql);


              if(!$query)
                  return false;
              // Starting the PHPExcel library

              $objPHPExcel= new PHPExcel();
              $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
              $objPHPExcel->setActiveSheetIndex(0);
              // Field names in the first row
              $fields= $query->list_fields();
              $col= 0;
              foreach($fields as $field)
              {
                  $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
                  $col++;
              }
              // Fetching the table data
              $row= 2;
              foreach($query->result() as$data)
              {
                  $col= 0;
                  foreach($fields as $field)
                  {
                      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                      $col++;
                  }
                  $row++;
              }
              $objPHPExcel->setActiveSheetIndex(0);


      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
              // Sending headers to force the user to download the file
              header('Content-Type: application/vnd.ms-excel');
              header('Content-Disposition: attachment;filename="Consumos_'.date('dMy').'.xls"');
              header('Cache-Control: max-age=0');
              $objWriter->save('php://output');
          }

}
