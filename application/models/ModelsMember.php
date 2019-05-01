<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class ModelsMember extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function ListingMember()
	{
		$data = "
			select a.Id,a.namamember,c.username,a.email,a.notlp,a.membersince,b.namagrade,
			CASE 
				WHEN a.verifymember = 1 THEN
					'Aktif'
				ELSE
					'Pasif'
			END Status
			from mastermember a
			LEFT JOIN mastersettingmember b on a.jenismemberid = b.id
			LEFT JOIN users c on a.userid = c.id
			ORDER BY a.membersince DESC
			";
		return $this->db->query($data);
	}
	function ListingGroupMember()
	{
		$this->db->where(array('tglpasif'=>NULL));
		return $this->db->get('mastersettingmember');
	}
}