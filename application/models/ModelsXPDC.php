<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class ModelsXPDC extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function GetXPDCList()
	{
		$Data = '
			select a.*,count(b.id) jmlservice from masterxpdc a
			left join masterxpdcdetail b on a.id =b.xpdcid
			where a.tglpasif is null
			group by a.id,a.xpdccode,a.xpdcname,a.hrgaperkg,a.asuransi,a.othercost,a.tglaktif,a.tglpasif,a.alamathq,a.notlphq,a.email,a.website,a.webtracking
		';
		return $this->db->query($Data);
	}
}