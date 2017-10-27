<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestamos extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

 is_login();
    //Codeigniter : Write Less Do More
  }

  public function index() {
    is_login();
    if(CheckPermission("user", "own_read")){
        $this->load->view('include/header');
        $this->load->view('index');
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




}
