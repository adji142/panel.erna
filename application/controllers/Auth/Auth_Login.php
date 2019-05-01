<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Auth_Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Auth/LoginMod','LoginMod');
	}
	function Log_Pro()
	{
		$data = array('success' => false ,'message'=>array());
        $usr = $this->input->post('username');
		$pwd =$this->input->post('password');
		// var_dump($usr);
		$Validate_username = $this->LoginMod->Validate_username($usr);
		if($Validate_username->num_rows()>0){
			$userid = $Validate_username->row()->id;
			$pwd_decript =$Validate_username->row()->password;
			// var_dump($this->encryption->decrypt($pwd_decript));
			$pass_valid = $this->encryption->decrypt($Validate_username->row()->password);
			// var_dump($this->encryption->decrypt($Validate_username->row()->password));
			// $get_Validation = $this->LoginMod->Validate_Login($userid,$this->encryption->encrypt($pwd));
			if($pass_valid == $pwd){
				$sess_data['userid']=$userid;
				$this->session->set_userdata($sess_data);
				$data['success'] = true;
			}
			else{
				$data['success'] = false;
				$data['message'] = 'L-01'; // User password doesn't match
			}
		}
		else{
			$data['message'] = 'L-02'; // Username not found
		}
		echo json_encode($data);
	}
	function logout()
	{
		delete_cookie('ci_session');
        $this->session->sess_destroy();
        redirect('Id');
	}
}