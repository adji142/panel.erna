<?php defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	* 
	*/
	class m_expired extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}
		function get_post($id_reg){
			$this->db->where('id_reg',$id_reg);
			$this->db->where('status','expired');
			return $this->db->get('app_post');
		}
		function search($search){
			$query = $this->db->select('*')->from('app_post')->like('description',$search)->like('status','expired')->get();
			if($query->num_rows()>0){
				return $query->result();
			}
			else{
				return null;
			}
		}
		//test model
		public function get_autocomplete($search_data,$id_reg)
        {
                $this->db->select('*');
                $this->db->like('description', $search_data);
                $this->db->or_like('tag',$search_data);
                $this->db->where('id_reg',$id_reg);
                $this->db->where('status','expired');
                return $this->db->get('app_post')->result();
        	
        }
        public function get_asc($search_data){
        	$this->db->select('*');
        	$this->db->where('id_reg',$search_data);
        	$this->db->where('status','expired');
        	$this->db->order_by('post_date','asc');
        	return $this->db->get('app_post')->result();
        }
        public function get_desc($search_data){
        	$this->db->select('*');
        	$this->db->where('id_reg',$search_data);
        	$this->db->where('status','expired');
        	$this->db->order_by('post_date','desc');
        	return $this->db->get('app_post')->result();
        }
	}
?>