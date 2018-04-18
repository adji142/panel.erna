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
		$this->db->join("vw_picCount","app_post.id_post=vw_picCount.id_post","inner");
		$this->db->like("app_post.status","running");
		$this->db->like("app_profile.bidangusaha",$type);
		return $this->db->count_all_results();
	}
	function fetch_post($type){
		//$this->db->limit($limit, $start);
		//$query = $this->db->query("select * from app_post p inner join app_profile pr on p.id_reg = pr.id_reg where pr.bidangusaha = '$type' limit $limit,$start");//and app_profile.bidangusaha='$type' and app_post.status not like 'expired'");
		$this->db->select("app_post.*,app_profile.bidangusaha,app_profile.address,vw_picCount.pic");
		$this->db->from("app_post");
		$this->db->join("app_profile","app_profile.id_reg=app_post.id_reg","inner");
		$this->db->join("vw_picCount","app_post.id_post=vw_picCount.id_post","inner");
		$this->db->like("app_profile.bidangusaha",$type);
		$this->db->like("app_post.status","running");
		return $this->db->get()->result();
		
	}
	function get_post_with_fill($loc,$cat,$desc){
		$this->db->select("app_post.*,app_profile.bidangusaha,app_profile.address,vw_picCount.pic");
		$this->db->from("app_post");
		$this->db->join("app_profile","app_profile.id_reg=app_post.id_reg","inner");
		$this->db->join("vw_picCount","app_post.id_post=vw_picCount.id_post","inner");
		$this->db->like("app_post.status","running");
		$this->db->like("app_profile.address",$loc);
		$this->db->like("app_profile.bidangusaha",$cat);
		$this->db->like("app_post.description",$desc);
		return $this->db->get()->result();
	}
	function get_count_with_fill($loc,$cat,$desc){
		$this->db->select("app_post.*,app_profile.bidangusaha,app_profile.address,vw_picCount.pic");
		$this->db->from("app_post");
		$this->db->join("app_profile","app_profile.id_reg=app_post.id_reg","inner");
		$this->db->join("vw_picCount","app_post.id_post=vw_picCount.id_post","inner");
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
	function get_detail($id){
		$this->db->select("app_post.*,app_profile.*,_ViewCount.view");
		$this->db->from("app_post");
		$this->db->join("app_profile","app_profile.id_reg=app_post.id_reg","inner");
		$this->db->join("_ViewCount","app_post.id_post=_ViewCount.id_post","inner");
		// $this->db->join("")
		$this->db->where("app_post.id_post","$id");
		return $this->db->get()->result();
	}
	function set_view($inser,$table)
	{
		$this->db->set('id', 'UUID()', FALSE);
		return $this->db->insert($table,$inser);
	}
	function get_ratting($id,$mac){
		$this->db->select("*");
		$this->db->where("id_post",$id);
		$this->db->where("user_ID",$mac);
		return $this->db->get("ratting");
	}
	function get_avg_rat($id){
		$this->db->select("avg(ratting) as avg");
		$this->db->where("id_post",$id);
		return $this->db->get("ratting");
	}
	function create_ratting($insert,$table){
		$this->db->set('id','UUID()',FALSE);
		return $this->db->insert($table,$insert);
	}
	function update_rate($update,$where,$table){
		$this->db->where($where);
		return $this->db->update($table,$update);
	}
}
?>