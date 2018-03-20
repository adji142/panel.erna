<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class profile extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
        	//session_start();
        	$this->load->model('back/m_dash');
        	$this->load->model('back/m_profile');
        	$this->load->model('back/m_account');
		}
		function profile(){
			$data['title']="Your profile - Towo.com";
			$this->load->view('back/profile',$data);
		}
		function userprofie(){
			$id_reg = $this->session->userdata('id_reg');
			$first = $this->input->post('first');
			$last = $this->input->post('last');
			$type = $this->input->post('store_type');
			$name = $this->input->post('store_name');
			$since = $this->input->post('since');
			$address = $this->input->post('store_address');
			$hp = $this->input->post('store_hp');
			$tlp= $this->input->post('store_number');
          		$update=array(
          			'bidangusaha'=>$type,
          			'company_name'=>$name,
          			'since'=>$since,
          			'address'=>$address
          		);
          		$where =array(
          			'id_reg'=>$id_reg
          		);
          		$cek = $this->m_profile->userprofie($update,$where,'app_profile');
              if($cek){
                $this->session->set_flashdata('result_login2','Saved!!');
                redirect('back/profile/profile');
              }
          		
          	
		}
	}
?>