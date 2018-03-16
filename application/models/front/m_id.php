<?php
/**
* 
*/
class m_id extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function get_cat(){
		$this->db->where('active','1');
		return $this->db->get('storetype');
	}
	function get_username_for_welcome($id_reg){
		$this->db->where('id_reg',$id_reg);
		return $this->db->get('app_profile');
	}
	function get_type_store($storetype){
		$this->db->where('parent',$storetype);
		return $this->db->get('storetype');
	}
	function updatestat($where,$update,$table){
		$this->db->where($where);
		return $this->db->update($table,$update);
	}
	function data($number,$offset){
		//$this->db->where('status','running');
		return $query = $this->db->get('app_post',$number,$offset)->result();
	}
	function max_page(){
		//$this->db->where('status','running');
		return $this->db->get('app_post')->num_rows();
	}
	function user_agent($uservisit,$table){
		$this->db->set('id','UUID()',FALSE);
		return $this->db->insert($table,$uservisit);
	}
}
?>