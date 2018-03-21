<?php
class m_comment extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function make_comment($data,$table){
		$this->db->set('id', 'UUID()', FALSE);
		return $this->db->insert($table,$data);
	}
	function get_comment($id){
		$this->db->where('id_post',$id);
		$this->db->order_by('feedback_date', 'DESC');
		return $this->db->get('feedback');
	}
}

?>