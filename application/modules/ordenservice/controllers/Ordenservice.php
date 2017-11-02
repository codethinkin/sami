<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenservice extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function index(){
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
         is_login();
          /**/

          $this->load->view('include/header');
          $this->load->view('index');
          $this->load->view('include/footer');

	}




}
