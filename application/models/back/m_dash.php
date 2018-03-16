<?php
/**
* 
*/
class m_dash extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function sidebar_mn($level){
		return $this->db->query("select * from app_menu where level ='$level' and active = 1");
	}
	function user_info($id_reg){
		return $this->db->query("select user.condition,registration.user,registration.datetime_reg,app_profile.photo,app_profile.bidangusaha,app_profile.photo,app_profile.store_desc from user,registration,app_profile where user.id_reg=app_profile.id_reg and app_profile.id_reg=registration.id_reg and registration.id_reg=$id_reg group by registration.user");
	}
	function upload($update,$where,$table){
		$this->db->where($where);
		return $this->db->update($table,$update);
	}
	function go_update_post($date_now){
		return $this->db->query("update app_post set status='expired' where end_period <= '$date_now'");
	}
}
?>