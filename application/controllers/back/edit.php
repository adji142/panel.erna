<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class edit extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('back/m_dash');
			$this->load->model('back/m_profile');
			$this->load->model('back/m_post');
			$this->load->model('back/m_ongoing');
			$this->load->model('back/m_edit');
			$this->load->helper(array('url','file'));
		}
		function show($param){
			$data['id_post'] = $param;
			$sess_data['id_post']=$param;
			$this->session->set_userdata($sess_data);
			$data['title'] = "Edit post - Towo.com";
			$this->load->view('back/edit',$data);
		}
		function token($have_token){
			$sess_data_token['have_token']=$have_token;
			$this->session->set_userdata($sess_data_token);
			$data['title'] = "Changing picture - towo.com";
			$this->load->view('back/modal',$data);
		}
		function change_pic(){
			$token = $this->session->userdata('have_token');
			$id_post = $this->session->userdata('id_post');
			$id_reg = $this->session->userdata('id_reg');
			$get_token = $this->m_edit->get_token($id_post,$id_reg)->result();
			$have_token = array();
			foreach ($get_token as $key) {
			  $have_token[]=$key->token;
			}
			$possition = array_search($token, $have_token);
			$fix_poss = 1+$possition;
			$config['upload_path']          = './img_post/'.$id_reg;
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
				redirect('
					<script>
						window.location=history.go(-1);
					</script>
				');
			}
			else{
				$data = $this->upload->data();
				$gbr = $this->upload->data();
				$nama = $gbr['file_name'];
				//first steps
				$update_tb_foto=array(
					'nama_foto'=>$nama
				);
				$where_tb_foto=array(
					'id_reg'=>$id_reg,
					'id_post'=>$id_post,
					'token'=>$token
				);
				$this->m_edit->change_foto($update_tb_foto,$where_tb_foto,'foto');

				//second steps
				$update_tb_post=array(
					'pic'.$fix_poss =>'img_post/'.$id_reg.'/'.$nama
				);
				$where_tb_post=array(
					'id_reg'=>$id_reg,
					'id_post'=>$id_post
				);
				$this->m_edit->change_post($update_tb_post,$where_tb_post,'app_post');
				$this->session->set_flashdata('result_upload','
				<div class="col-lg-12 connectedSortable">
				<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Succes saving!!
            	</div>
            	</div>
				');
				redirect('back/edit/show/'.$id_post);
			}
		}
		function update_post(){
			$id_reg = $this->session->userdata('id_reg');
			$id_post = $this->session->userdata('id_post');
			$cek = $this->m_post->coba($id_post)->result();
			$title = $this->input->post('title');
			$desc = $this->input->post('desc');
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$calon=array();
			$first = '';
			$second = '';
			$third='';
			$fourth='';
			$fived='';
			foreach ($cek as $a) {
				$calon[] = $a->nama_foto;
			}
			$jumlah = count($calon);
			for ($i=0; $i < $jumlah ; $i++) {
			if($i==0){
				$first =$calon[$i];
			}
			elseif($i==1){
				$second=$calon[$i];
			}
			elseif ($i==2) {
				$third= $calon[$i];
			}
			elseif ($i==3) {
				$fourth= $calon[$i];
			}
			elseif ($i==4) {
				$fived= $calon[$i];
			}
			}
			if($first==""){
			$first="empty";
			}
			if ($second=="") {
				$second="empty";
			}
			if ($third=="") {
				$third="empty";
			}
			if ($fourth=="") {
				$fourth="empty";
			}
			if ($fived=="") {
				$fived="empty";
			}
			$update = array(
				'promo_title'=>$title,
				'description'=>$desc,
				'start_period'=>$start,
				'end_period'=>$end,
				'pic1'=>'img_post/'.$id_reg.'/'.$first,
				'pic2'=>'img_post/'.$id_reg.'/'.$second,
				'pic3'=>'img_post/'.$id_reg.'/'.$third,
				'pic4'=>'img_post/'.$id_reg.'/'.$fourth,
				'pic5'=>'img_post/'.$id_reg.'/'.$fived
			);
			$where =array(
				'id_reg'=>$id_reg,
				'id_post'=>$id_post
			);
			$this->m_edit->go_edit($update,$where,'app_post');
			$this->session->set_flashdata('result_pass','
				<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Your promo has been edited !!
              </div>
			');
        	redirect('back/dashboard/ongoing');
		}
		}
?>