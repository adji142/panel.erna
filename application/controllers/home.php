<?php
	if(!defined('BASEPATH')) exit('hacking attempt');

/**
* 
*/
class home extends CI_Controller
{
	private $datauser;
	public function __construct()
	{
		parent:: __construct();

		$this->load->library(array('session'));
		$this->load->helper('url');
		$this->load->model('login_model');
		$this->load->database();
		$this->datauser = $this->session->userdata('data_user');
	}
	public function index()
	{
		if($this->session->userdata('islogin')==FALSE){
			redirect('login/login_form');
		}
		else{
			$this->load->model('login_model');
			$user->load->session->userdata('data_user');
			$data = array();
			$data['pengguna']=$user;
			$this->load->view('welcode_home','$data');
		}
	}
}