<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class ModelsExecuteMaster extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function ExecUpdate($data,$where,$table)
	{
        $this->db->where($where);
        return $this->db->update($table,$data);
	}
	function ExecInsert($data,$table)
	{
		return $this->db->insert($table,$data);
	}
	function FindData($where,$table){
		$this->db->where($where);
		return $this->db->get($table);
	}
	function FindDataWithLike($where,$table){
		$this->db->like($where,'both');
		return $this->db->get($table);
	}
}