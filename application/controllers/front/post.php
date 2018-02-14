<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class post extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('front/m_id');
		$this->load->model('front/m_post');
	}
    function fill($storetype){
        $loc = $this->input->post('loc');
        $cat = $this->input->post('cat');
        $desc = $this->input->post('desc');
        $data['title'] = "Towo.com categories ".$storetype;
        $data['total_rows'] = $this->m_post->record_count($loc,$cat,$desc,$storetype);
        $post = $this->m_post->fetch_post($loc,$cat,$desc,$storetype);
        $data['have_post'] = null;
        if($post){
            $data['have_post'] = $post;
        }
        $this->load->view('front/fill', $data);
    }
    function filter_by(){
        $loc = $this->input->post('loc');
        $cat = $this->input->post('cat');
        $desc = $this->input->post('desc');
        $data['total_rows'] = $this->m_post->record_count($loc,$cat,$desc,$storetype);
        $post = $this->m_post->fetch_post($loc,$cat,$desc,$storetype);
        $data['have_post'] = null;
        if($post){
            $data['have_post'] = $post;
        }
        $this->load->view('front/fill', $data);
    }
}
?>