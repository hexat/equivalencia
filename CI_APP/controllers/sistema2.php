<?php 
class Sistema2 extends CI_Controller {


	function __construct()
    {
        parent::__construct();
 
        $this->load->database();
		$this->load->helper('url','form');
		$this->load->library('grocery_CRUD');
 
    }
	
	public function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->view('tela_login');	
	}
	
	}
	
	

?>
