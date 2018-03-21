<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class dashboard extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('back/m_dash');
			$this->load->model('back/m_profile');
			$this->load->model('back/m_ongoing');
			$this->load->model('back/m_expired');
			$this->load->model('back/m_account');
			$this->load->helper('url');
		}
		function index(){
			$id_reg = $this->session->userdata('id_reg');
			$level = $this->session->userdata('level');
			if($id_reg==''){
				redirect('login');
			}
			else{
			// $data['user']=$this->m_dash->sidebar_mn($level)->result();""
			$data['title']="Dashboard - Towo.com";
			$this->load->view('back/dashboard',$data);
			}
		}
		function profile(){
			$data['title']="Your profile - Towo.com";
			$this->load->view('back/profile',$data);
		}
		function account(){
			$id_reg = $this->session->userdata('id_reg');
			$provider = 'facebook';
			if($this->session->userdata('loggedin')==FALSE){
				$cek = $this->m_account->check_already($id_reg,$provider)->result();
				foreach ($cek as $key) {
					$sess = array('name'=>$key->name);
					$this->session->set_userdata($sess);
					
				}
				redirect('back/account/');
          	}
          	else{
          		redirect('back/account/');
          		echo "hai";
          	}
			// $data['title']="Your account - Towo.com";
			// $this->load->view('back/account',$data);
		}
		function post(){
			$id_post= rand(0,99999);
			$sess_data_file['id_post']=$id_post;
			$this->session->set_userdata($sess_data_file);
			$data['title']="Post your promo - Towo.com";
			$this->load->view('back/post',$data);
		}
		function ongoing(){
			$data['title']="Ongoing promo - towo.com";
			$this->load->view('back/ongoing',$data);
		}
		function expired(){
			$data['title']="Expired promo - towo.com";
			$this->load->view('back/expired',$data);
		}
		function feedback(){
			$data['title'] = "Feedback from viewer - towo.com";
			$this->load->view('back/feedback',$data);
		}
		public function upload(){
			$id_reg = $this->session->userdata('id_reg');
			$config['upload_path']          = './img_profile/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 2048000;
			$config['max_width']            = 3264;
			$config['max_height']           = 2448;
			$this->load->library('upload',$config);

		if ( ! $this->upload->do_upload('gambar')){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('result_upload','
				<div class="col-lg-12 connectedSortable">
				<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!! Something wrong for the folowing error!</h4>
                '.$error.'
            	</div>
            	</div>
			');
			// redirect('back/dashboard/index');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$data = $this->upload->data();
			$gbr = $this->upload->data();
			$nama = $gbr['file_name'];
			$update = array(
				'photo'=>'img_profile/'.$nama
			);
			$where = array(
				'id_reg'=>$id_reg
			);
			$this->m_dash->upload($update,$where,'app_profile');
			$this->session->set_flashdata('result_upload','
				<div class="col-lg-12 connectedSortable">
				<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Succes saving!!
            	</div>
            	</div>
			');
			redirect($_SERVER['HTTP_REFERER']);
		}
		}
		
		
	}
?>