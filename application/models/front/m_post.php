<?php
/**
* 
*/
class m_post extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function record_count($type){
		$this->db->select("app_post.*,app_profile.bidangusaha,app_profile.address");
		$this->db->from("app_post");
		$this->db->join("app_profile","app_profile.id_reg=app_post.id_reg","inner");
		$this->db->like("app_post.status","running");
		$this->db->like("app_profile.bidangusaha",$type);
		return $this->db->count_all_results();
	}
	function fetch_post($type){
		//$this->db->limit($limit, $start);
		//$query = $this->db->query("select * from app_post p inner join app_profile pr on p.id_reg = pr.id_reg where pr.bidangusaha = '$type' limit $limit,$start");//and app_profile.bidangusaha='$type' and app_post.status not like 'expired'");
		$this->db->select("app_post.*,app_profile.bidangusaha,app_profile.address");
		$this->db->from("app_post");
		$this->db->join("app_profile","app_profile.id_reg=app_post.id_reg","inner");
		$this->db->where("app_profile.bidangusaha",$type);
		$this->db->where("app_post.status","running");
		return $this->db->get()->result();
		
	}
	function get_post_with_fill($loc,$cat,$desc){
		$this->db->select("app_post.*,app_profile.bidangusaha,app_profile.address");
		$this->db->from("app_post");
		$this->db->join("app_profile","app_profile.id_reg=app_post.id_reg","inner");
		$this->db->like("app_post.status","running");
		$this->db->like("app_profile.address",$loc);
		$this->db->like("app_profile.bidangusaha",$cat);
		$this->db->like("app_post.description",$desc);
		$this->db->limit($limit,$start);
		return $this->db->get()->result();
	}
	function get_count_with_fill($loc,$cat,$desc){
		$this->db->select("app_post.*,app_profile.bidangusaha,app_profile.address");
		$this->db->from("app_post");
		$this->db->join("app_profile","app_profile.id_reg=app_post.id_reg","inner");
		$this->db->like("app_post.status","running");
		$this->db->like("app_profile.address",$loc);
		$this->db->like("app_profile.bidangusaha",$cat);
		$this->db->like("app_post.description",$desc);
		return $this->db->count_all_results();
	}
	function get_tags(){
		$this->db->order_by('ct','desc');
		return $this->db->get('tag_count');
	}
	function get_filter_cat(){
		return $this->db->get('storetype');
	}
}
?>