<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class m_post extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function coba($id_post){
		$this->db->where('id_post',$id_post);
		return $this->db->get('foto');
	}
	function go_post($input,$table){
		$this->db->insert($table,$input);
	}
	function tag($go_for_tag,$table){
		$this->db->insert($table,$go_for_tag);
	}
}
?>