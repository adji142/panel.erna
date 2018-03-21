<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comment extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/m_comment');
		$this->load->library('user_agent');
	}
	function makecomment(){
		$comment = $this->input->post('comment');
		$id  = $this->input->post('id_post');
		$id_reg  = $this->input->post('company_name');
		$hostname= gethostname();
		$Fullname= php_uname();
		if ($this->agent->is_browser()){
        $agent = $this->agent->browser().' '.$this->agent->version();
        }elseif ($this->agent->is_mobile()){
        $agent = $this->agent->mobile();
        }else{
        $agent = 'Data user gagal di dapatkan';
        }
        $browser = $agent;
        $os = $this->agent->platform();
        $ip = $this->input->ip_address();

        $input = array(
        	'id_post'=>$id,
        	'id_reg'=>$id_reg,
        	'user' => $hostname,
        	'ip'=>$ip,
        	'browser'=>$browser,
        	'device_name'=> $Fullname,
        	'feedback'=>$comment,
        	'feedback_date'=> date("Y-m-d H:i:s"),
        	'read_for_owner'=>0,
        	'block'=>0
        );

        $this->m_comment->make_comment($input,'feedback');
        $this->session->set_flashdata('result_pass','
			<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            Terimakasih, Feedback anda tersampaikan
            </div>
		');
        redirect('front/post/single/'.$id);
	}
}