<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Load_model extends CI_Model{

  var $table = 'load';
  var $column_order = array(null,'nameLoad',null); //set column field database for datatable orderable
  var $column_search = array('nameLoad'); //set column field database for datatable searchable just firstname , lastname , address are searchable
  var $order = array('id' => 'desc'); // default order

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }



}
