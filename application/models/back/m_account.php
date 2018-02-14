<?php defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* 
	*/
	class m_account extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}
		function insert_soc($sess_data,$table){
			$this->db->insert($table,$sess_data);
		}
		function check_already($id_reg,$provider){
			$this->db->where('id_reg',$id_reg);
			$this->db->where('oauth_provider',$provider);
			$this->db->where('loggedin',1);
			return $this->db->get('social_user');
		}
		function check_already_goo($id_reg,$provider_goo){
			$this->db->where('id_reg',$id_reg);
			$this->db->where('oauth_provider',$provider_goo);
			$this->db->where('loggedin',1);
			return $this->db->get('social_user');
		}
		function check_already_ig($id_reg){
			$this->db->where('id_reg',$id_reg);
			$this->db->where('oauth_provider','Instagram');
			return $this->db->get('social_user');
		}
		function check_first($id_reg,$provider_goo){
			$this->db->where('id_reg',$id_reg);
			$this->db->where('oauth_provider',$provider_goo);
			return $this->db->get('social_user');
		}
		function cek_id_wo_logedin($id_reg){
			$this->db->where('id_reg',$id_reg);
			$this->db->where('oauth_provider','Instagram');
			return $this->db->get('social_user');
		}
	}
?>