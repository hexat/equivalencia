<?php
class Crud extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
	}
	
	function index(){
		$this->load->view('teste.php');
	}
}
?>