<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class GlobalVar extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function GetAccessKU($userid)
	{
		$data = "select a.*,c.HakAkses from kelasusiauser a 
				inner join akseskelasusia b on b.id = a.aksesid 
				inner join users c on a.userid = c.id
				where a.userid = $userid";
		return $this->db->query($data);
	}
	function GetSideBar($userid)
	{
		$data = "
			select REPLACE(left(d.menusubmenu,2),'.','') menu,d.* from users a
			inner join userrole b on a.id = b.userid
			inner join permissionrole c on b.roleid = c.roleid
			inner join permission d on c.permissionid = d.id
			where a.id = $userid
			order by menusubmenu asc
		";
		return $this->db->query($data);
	}
	function GetMasterPPA($value)
	{
		$this->db->where('id',$value);
		return $this->db->get('masterppa');
	}
}