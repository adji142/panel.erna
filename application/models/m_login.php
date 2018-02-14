<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
/**
* 
*/
class m_login extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->tableName = 'users_goo';
        $this->primaryKey = 'id_reg';
	}
	//login
	function get_user($user,$pass){
		$this->db->where("email",$user);
		$this->db->where("pass",$pass);
		return $this->db->get("user");
	}
	function secon_step($status,$user){
		$this->db->where("email",$user);
		$this->db->where("status","Activated");
		return $this->db->get("user");
	}
	function log($insert,$table){
		$this->db->insert($table,$insert);
	}
	function condition($status_user,$where,$table){
		$this->db->where($where);
		$this->db->update($table,$status_user);
	}
	//register
	function cek_reg_mail($email){
		$this->db->where('email',$email);
		return $this->db->get('registration');
	}
	function register($data,$table){
		$this->db->insert($table,$data);
	}
	function register_val_code($val,$table){
		$this->db->insert($table,$val);
	}
	//verification
	function cekmail_vercode($email){
		$this->db->where('email',$email);
		return $this->db->get('ver_code');
	}
	function cek_ver_code($ver_code){
		$this->db->where('ver_code',$ver_code);
		return $this->db->get('ver_code');
	}
	function cek_all($email){
		$this->db->where('email',$email);
		return $this->db->get('registration');
	}
	function add_user($data_input,$table){
		$this->db->insert($table,$data_input);
	}
	function update_atv($where,$data_update,$table){
		$this->db->where($where);
		$this->db->update($table,$data_update);
	}
	function add_profile($add_profile,$table){
		$this->db->insert($table,$add_profile);
	}
	//reset_pass
	function cek_mail_reset($email){
		$this->db->where('email',$email);
		return $this->db->get('registration');
	}
	function cek_email_old($email,$old_md){
		$this->db->where('pass',$old_md);
		$this->db->where('email',$email);
		return $this->db->get('user');
	}
	function update_pass_reg($where_reg,$data_update_reg,$table){
		$this->db->where($where_reg);
		$this->db->update($table,$data_update_reg);
	}
	function update_pass_user($where_user,$data_update_user,$table){
		$this->db->where($where_user);
		$this->db->update($table,$data_update_user);
	}
	//login with goo_auth
	function get_id_face_reg($id_fb){
		$this->db->where("id_reg",$id_fb);
		return $this->db->get('registration');
	}
	function get_id_face_profile($id_fb){
		$this->db->where("id_reg",$id_fb);
		return $this->db->get('app_profile');
	}
	function get_id_face_user($id_fb){
		$this->db->where("id_reg",$id_fb);
		return $this->db->get('user');
	}
	function get_id_face_ver($id_fb){
		$this->db->where("id_reg",$id_fb);
		return $this->db->get('ver_code');
	}
	function add_user_fb($data_input_fb,$table){
		$this->db->insert($table,$data_input_fb);
	}
}
?>