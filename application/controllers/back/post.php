<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
require_once('Facebook/FacebookSession.php');
require_once('Facebook/FacebookRequest.php');
require_once('Facebook/FacebookResponse.php');
require_once('Facebook/FacebookSDKException.php');
require_once('Facebook/FacebookRequestException.php');
require_once('Facebook/FacebookRedirectLoginHelper.php');
require_once('Facebook/FacebookAuthorizationException.php');
require_once('Facebook/GraphObject.php');
require_once('Facebook/GraphUser.php');
require_once('Facebook/GraphSessionInfo.php');
require_once('Facebook/Entities/AccessToken.php');
require_once('Facebook/HttpClients/FacebookCurl.php');
require_once('Facebook/HttpClients/FacebookHttpable.php');
require_once('Facebook/HttpClients/FacebookCurlHttpClient.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest; 
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\FacebookHttpable;
use Facebook\FacebookCurlHttpClient;
use Facebook\FacebookCurl;
	class post extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('back/m_dash');
			$this->load->model('back/m_profile');
			$this->load->model('back/m_post');
			$this->load->helper(array('url','file'));
		}
		function remove_foto(){

		//Ambil token foto
			$token=$this->input->post('token');
			$id_reg = $this->session->userdata('id_reg');
		
			$foto=$this->db->get_where('foto',array('token'=>$token));


			if($foto->num_rows()>0){
				$hasil=$foto->row();
				$nama_foto=$hasil->nama_foto;
				if(file_exists($file='./img_post/'.$id_reg.'/'.$nama_foto)){
				unlink($file);
				}
				$this->db->delete('foto',array('token'=>$token));

		}


		echo "{}";
	}
		function proses_upload(){
		
		$id_reg = $this->session->userdata('id_reg');
        $config['upload_path']   = './img_post/'.$id_reg;
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $this->load->library('upload',$config);
        $id_post = $this->session->userdata('id_post');
        if($this->upload->do_upload('userfile')){
        	$id_reg = $this->session->userdata('id_reg');
        	$token=$this->input->post('token_foto');
        	$nama=$this->upload->data('file_name');
        	$this->db->insert('foto',array('id_reg'=>$id_reg,'id_post'=>$id_post,'nama_foto'=>$nama,'token'=>$token));
        }
	}
	function post(){
		$this->form_validation->set_rules('title','title','required|trim');
		$this->form_validation->set_rules('desc','desc','required|trim');
		$this->form_validation->set_rules('start','start','required|trim');
		$this->form_validation->set_rules('end','end','required|trim');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('result_error','
				<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Field not supported blank value, please check and try again!!
              	</div>
			');
            redirect('back/dashboard/post');
		}
		else{
		$id_reg = $this->session->userdata('id_reg');
		$id_post = $this->session->userdata('id_post');
		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$post_date = date("Y-m-d H:i:s");
		$check_fb = $this->input->post('chk_fb');
		$check_goo = $this->input->post('chk_goo');
		$first = '';
		$second = '';
		$third='';
		$fourth='';
		$fived='';
		$tag=array();
		//hashtahg
		preg_match_all('/#(\w+)/', $desc, $matches);
		foreach ($matches[1] as $match) {
    		$keywords[] = $match;
  		}
  		$jml = count($keywords);
  		$tag = array();
  		$go_for_tag='';
  		for ($i=0; $i < $jml ; $i++) {
  			$tag[]=$keywords[$i];
  			$get = count($tag);
  			if($get > 0 ){
  			$go_for_tag = "insert into tag values ('','".$keywords[$i]."');";
  			$this->db->query($go_for_tag);
  			}
  			else{
  				array_push($tag, " ");
  			}
  		}
  		// print_r($tag);
  		$hash= implode(",", $tag);
  		// return (array) $keywords;
  		// echo $jml."<br>".$tag;
		$cek = $this->m_post->coba($id_post)->result();
		$calon=array();
		foreach ($cek as $a) {
			$calon[] = $a->nama_foto;
		}
		print_r($calon)."<br>";
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
		// echo $first."<br>".$second."<br>".$third."<br>".$fourth."<br>".$fived;
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
		//go for input
		$input = array(
			'id_post'=>$id_post,
			'id_reg'=>$id_reg,
			'promo_title'=>$title,
			'description'=>$desc,
			'post_date'=>$post_date,
			'start_period'=>$start,
			'end_period'=>$end,
			'status'=>'running',
			'tag'=>$hash,
			'pic1'=>'img_post/'.$id_reg.'/'.$first,
			'pic2'=>'img_post/'.$id_reg.'/'.$second,
			'pic3'=>'img_post/'.$id_reg.'/'.$third,
			'pic4'=>'img_post/'.$id_reg.'/'.$fourth,
			'pic5'=>'img_post/'.$id_reg.'/'.$fived
		);
		$this->m_post->go_post($input,'app_post');
		
		$this->session->set_flashdata('result_pass','
				<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Your promo has been posted !!
              </div>
			');
		if($first==""){
			$first="img_post/blank.jpg";
		}
		if ($second=="") {
			$second="img_post/blank.jpg";
		}
		if ($third=="") {
			$third="img_post/blank.jpg";
		}
		if ($fourth=="") {
			$fourth="img_post/blank.jpg";
		}
		if ($fived=="") {
			$fived="img_post/blank.jpg";
		}
		if($check_fb != '1'){
			redirect('back/dashboard/post');
		}
        else{
			FacebookSession::setDefaultApplication('1802826076676207','341026ed31f2698490742535df44c1ae');
			$neverExpiringToken = 'EAAZAnqSfkYG8BADoINeCppOyUtI7sJkzgRcIdj0ZBdJexiRtjBMy2J7iNF3SKcGkbZAf88GSZAjyuM0Xn5NJLAai2SAdp52MqLw38GMsIc0yBnu9ZBhfzd5YOeZCFJS1DuD0FMxtLotwiAZA5odrPjlxBas61cClyxt47DzmYitnmtVGofXfmozx9lVZBFZBnbagZD';
			$pageID = $this->session->userdata('oauth_uid');
			$session = new FacebookSession($neverExpiringToken);
			try {
				$post_id = (new FacebookRequest($session,'POST', '/' . $pageID . '/feed', 
        		array(
                'access_token'  => $neverExpiringToken,
                'message'   => 'Check out https://www.towo.com',
                'link'      => 'https://www.codexworld.com/post-to-facebook-wall-from-website-php-sdk/',
                // 'picture'   => base_url().'img_post/'.$id_reg.'/'.$first,
                'picture' => 'https://cdn.tutsplus.com/net/uploads/legacy/1097_fbapi/post_breakdown.png', 
                'name'      => 'http://www.towo.com/post/',
                'caption' => '$this->input->post("title")',
                'description'=> $this->input->post('desc')
        )
    )
    )->execute()->getGraphObject()->asArray();
				redirect('back/dashboard/post');
			} catch (FacebookRequestException $e) {
				echo 'ERROR! ' . __LINE__ . $e->getMessage();
			} catch (Exception $e) {
    			echo 'ERROR! ' . __LINE__ . $e->getMessage();
			}
		}
        }
	}
	// function share_fb(){
	// 	$config['callback_url']='CALL BACK URL/?fbTrue=true';
	// 	$config['App_ID']='1802826076676207';
	// 	$config['App_Secret']='341026ed31f2698490742535df44c1ae';
	// 	$facebook = new Facebook(array(
 //  			'appId'  => $config['App_ID'],
 //  			'secret' => $config['App_Secret'],
 //  			'cookie' => true
	// 	));

	// }
	function share(){
		echo '
		<a name="fb_share" type="box_count" href="http://www.facebook.com/sharer.php">post</a>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
		';
	}
	}
?>