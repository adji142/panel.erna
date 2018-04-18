<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class post extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->helper('cookie');
		$this->load->model('front/m_id');
		$this->load->model('front/m_post');
        $this->load->model('front/m_comment');	}
    function fill($storetype){
        if($storetype == 'Goback'){
            redirect('id');
        }
        $data['title'] = "Towo.com categories ".$storetype;
        $data['total_rows'] = $this->m_post->record_count($storetype);
        $post = $this->m_post->fetch_post($storetype);
        // $data['have_post'] = null;
        $bidangusaha = '';
        foreach ($post as $key) {
            $bidangusaha = $key->bidangusaha;
        }
        if($post){
            $data['have_post'] = $post;
        }
        $data['breadcrumb'] = '
            <ol class="breadcrumb" style="margin-bottom: 5px;">
              <li><a href="Goback">Home</a></li>
              <li class="active">'.$bidangusaha.'</li>
            </ol>
        ';
        $this->load->view('front/fill', $data);
    }
    function filter_by(){
        $loc = $this->input->post('loc');
        $cat = $this->input->post('cat');
        $desc = $this->input->post('desc');
        $data['total_rows'] = $this->m_post->get_count_with_fill($loc,$cat,$desc);
        $post = $this->m_post->get_post_with_fill($loc,$cat,$desc);
        $data['have_post'] = null;
        if($post){
            $data['have_post'] = $post;
        }
        $this->load->view('front/fill', $data);
    }
    function single($id){

        if($id == 'Goback'){
            redirect('id');
        }
        elseif(substr($id, 0,3) == 'Dis'){
            redirect('front/post/fill/dis');   
        }
        elseif (substr($id, 0,3) == 'foo') {
            redirect('front/post/fill/foo');
        }
        elseif (substr($id, 0,3) == 'but') {
            redirect('front/post/fill/but');
        }
        elseif (substr($id, 0,3) == 'oll'){
            redirect('front/post/fill/oll');
        }
        ob_start();
        system("ipconfig /all");
        $mycomp = ob_get_contents();
        ob_clean();

        $mac_addr = "Physical";
        $pmac_addr = strpos($mycomp, $mac_addr);
        $mac = substr($mycomp,($pmac_addr+36),17);

        $view = array(
            "id_post"=>$id,
            "view"=>1,
            "like"=>0,
            "user_ID"=>$mac,
            "date_time"=>date("Y-m-d H:i:s")
        );
        $set_view = $this->m_post->set_view($view,"view_like_post");
        $getratting = $this->m_post->get_ratting($id,$mac)->result();
        $avgrate = $this->m_post->get_avg_rat($id)->result();
        $data["Ratting"]=null;
        $data["ratFlag"]=null;
        foreach ($getratting as $key) {
            $data["Ratting"]=$key->Ratting;
            $data["ratFlag"]=$key->ratFlag;
            $data["mac"]=$key->Ratting;
        }
        foreach ($avgrate as $rate_avg) {
            $data['avg'] = $rate_avg->avg;
        }
        $data['user_ID'] = $mac;
        $post_det = $this->m_post->get_detail($id);
        $data['post_Detail'] = null;
        if($post_det){
            $data['post_Detail'] = $post_det;
        }
        $bidangusaha = '';
        $title = '';
        $id_post='';
        foreach ($post_det as $key) {
            $bidangusaha = $key->bidangusaha;
            $title = $key->promo_title;
            $id_post = $key->id_post;
        }
        $data['get_comment'] = $this->m_comment->get_comment($id)->result();
        $data['breadcrumb'] = '
            <ol class="breadcrumb" style="margin-bottom: 5px;">
              <li><a href="Goback">Home</a></li>
              <li><a href="'.substr($bidangusaha, 0,3).$id_post.'">'.$bidangusaha.'</a></li>
              <li class="active">'.$title.'</li>
            </ol>
        ';
        $this->load->view('front/single',$data);
    }
    function create_rate(){
        $id_post = $this->input->post('pid');
        $rate =  $this->input->post("score");
        $mac = $this->input->post("mac");
        $data['rated'] = $this->m_post->get_ratting($id_post,$mac)->result();
        if($data['rated']==FALSE){
            $insert = array(
                'id_post'=>$id_post,
                'ratFlag'=>1,
                'Ratting'=>$rate,
                'user_ID'=>$mac,
                'lastUpdate'=>date("Y-m-d H:i:s")
            );
            $this->m_post->create_ratting($insert,'ratting');
            $this->session->set_userdata('uid',$mac);
        }
        else{
            $update = array(
                'Ratting'=>$rate,
                'lastUpdate'=>date("Y-m-d H:i:s")
            );
            $where = array(
                'id_post'=>$id_post,
                'user_ID'=>$mac
            );
            $this->rating_model->update_rate($update,$where,'ratting');
            $this->session->set_userdata('uid',$mac);
        }
    }
}
?>