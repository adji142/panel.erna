<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class id extends CI_Controller
{
	private $perPage = 6;
	function __construct()
	{
		parent::__construct();
          //session_start();
          $this->load->helper('cookie');
          $this->load->model('front/m_id');
          $this->load->library('user_agent');
          $this->load->library('Ajax_pagination');
	}
	function index(){
    $this->load->database();
    // add user activity
    ob_start();
    system("ipconfig /all");
    $mycomp = ob_get_contents();
    ob_clean();

    $mac_addr = "Physical";
    $host_name = "Host Name";
    $pmac_addr = strpos($mycomp, $mac_addr);
    $p_mac_host = strpos($mycomp, $host_name);
    $mac = substr($mycomp,($pmac_addr+36),17);
    $host = substr($mycomp,($p_mac_host+36),17);
    
    if ($this->agent->is_browser()){
    $agent = $this->agent->browser().' '.$this->agent->version();
    }elseif ($this->agent->is_mobile()){
    $agent = $this->agent->mobile();
    }else{
    $agent = 'Data user gagal di dapatkan';
    }
    $uservisit = array(
      "ip"=>$this->input->ip_address(),
      "mac"=>$mac,
      "browser"=>$this->agent->platform(),
      "Host_Name"=>$host,
      "browser"=>$agent,
      "lastupdatetime"=>date("Y-m-d H:i:s")
    );
    $this->m_id->user_agent($uservisit,"uservisit");
    // end user act
		
    	$count = $this->db->get('app_post')->num_rows();
    	if(!empty($this->input->get("page"))){
    	$start = ceil($this->input->get("page") * $this->perPage);
    	$query = $this->db->limit($start, $this->perPage)->get("app_post");
    	$data['posts'] = $query->result();
    	$result = $this->load->view('data', $data);
    	echo json_encode($result);
    	}else{
    	$query = $this->db->limit(5, $this->perPage)->get("app_post");
    	$data['posts'] = $query->result();
		$this->load->view('front/index',$data);
	}
  $now_day = date("Y-m-d");
  $where = array('end_period < '=> $now_day);
  $update = array('status'=>'expired');
  $this->m_id->updatestat($where,$update,'app_post');
}
public function fill(){
  $data = array();
  //get row count
  $totalRec = count($this->m_id->getRows());
  //end get rows

  //page config
  $config['target']='#postList';
  $config['base_url']=base_url().'id/';
  $config['total_rows'] = $totalRec;
  $config['per_page'] = $this->perPage;
  $this->Ajax_pagination->initialize($config);
  //end page config

  //get post data
  
  $this->load->view('front/fill',$data);
}
}
?>