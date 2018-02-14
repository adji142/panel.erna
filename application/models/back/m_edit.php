<?php defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* 
	*/
	class m_edit extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}
		function get_count_pic($id_post,$id_reg){
			$this->db->where('id_reg',$id_reg);
			$this->db->where('id_post',$id_post);
			return $this->db->get('foto');
		}
		function get_photo($id_post,$id_reg){
			$this->db->where('id_reg',$id_reg);
			$this->db->where('id_post',$id_post);
			return $this->db->get('app_post');
		}
		function get_token($id_post,$id_reg){
			$sql = "select foto.token,app_post.id_post from foto,app_post where foto.id_reg=app_post.id_reg and foto.id_post=app_post.id_post and foto.id_post=$id_post and app_post.id_post=$id_post";
			return $this->db->query($sql);
		}
		function get_foto($id_reg,$id_post,$token){
			$this->db->where('id_reg',$id_reg);
			$this->db->where('id_post',$id_post);
			$this->db->where('token',$token);
			return $this->db->get('foto');
		}
		function change_foto($update_tb_foto,$where_tb_foto,$table){
			$this->db->where($where_tb_foto);
			return $this->db->update($table,$update_tb_foto);
		}
		function change_post($update_tb_post,$where_tb_post,$table){
			$this->db->where($where_tb_post);
			return $this->db->update($table,$update_tb_post);
		}
		function get_post($id_reg,$id_post){
			$this->db->where('id_post',$id_post);
			$this->db->where('id_reg',$id_reg);
			return $this->db->get('app_post');
		}
		function go_edit($update,$where,$table){
			$this->db->where($where);
			return $this->db->update($table,$update);
		}
	}
?>