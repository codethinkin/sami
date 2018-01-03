<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

 is_login();
 $this->load->model("Dashboard_model");
    //Codeigniter : Write Less Do More
  }

  public function index() {
    is_login();
    if(CheckPermission("user", "own_read")){

       

      $totalUser = $this->Dashboard_model->countUsers();
      $totalProduct = $this->Dashboard_model->countProduct();
      $totalVentas = $this->Dashboard_model->countVent();
      $totalCompras = $this->Dashboard_model->countCom();

       $data = array(
                'totalUser' => $totalUser,
                'totalProduct ' => $totalProduct,
                'totalVentas' => $totalVentas,
                'totalCompras' => $totalCompras
              );
        $this->load->view('include/header');
        $this->load->view('index', $data);
        $this->load->view('include/footer');
    } else {
        $this->session->set_flashdata('messagePr', 'You don\'t have permission to access.');
        redirect( base_url().'dashboard', 'refresh');
    }
	}

  public function get_modal() {
      is_login();
      if($this->input->post('id')){
          $data['userData'] = getDataByid('users',$this->input->post('id'),'users_id');
          echo $this->load->view('add_user', $data, true);
      } else {
          echo $this->load->view('add_user', '', true);
      }
      exit;
  }

  public function getCompras(){
		$result = $this->Dashboard_model->getCompras();
		echo json_encode($result);
	}

  public function getVentas(){
		$result = $this->Dashboard_model->getVentas();
		echo json_encode($result);
	}

function email(){

$config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_user' => 'ralvarezloud@gmail.com',
  'smtp_pass' => 'Elguru47198@'
);
  $this->load->library('email', $config );
$this->email->set_netline("\r\n");

$this->email->from('ralvarezloud@gmail.com', 'SAMIC');
$this->email->to('ralvarezloud@gmail.com');
//$this->email->cc('another@another-example.com');
//$this->email->bcc('them@their-example.com');

$this->email->subject('Email Test');
$this->email->message('Testing the email class.');

if($this->email->send())
{
	echo "El correo fue enviado";
}else{
	show_error($this->emai->print_debugger());
	}
}




}
