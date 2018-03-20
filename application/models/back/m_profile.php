<?php
	/**
	* 
	*/
	class m_profile extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}
		function get_prof($id_reg){
			return $this->db->query("select *,registration.user from app_profile,registration where registration.id_reg = app_profile.id_reg and app_profile.id_reg=$id_reg");
		}
		function storetype(){
			return $this->db->query("select * from storetype where active = 1");
		}
		function userprofie($update,$where,$table){
			$this->db->where($where);
			return $this->db->update($table,$update);
		}
		function get_count_post($id_reg){
			return $this->db->query("select * from app_post where id_reg=$id_reg");
		}
		function get_count_exp($id_reg){
			return $this->db->query("select * from app_post where id_reg=$id_reg and status = 'expired'");
		}
	}
?>