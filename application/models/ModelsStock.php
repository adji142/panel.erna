<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class ModelsStock extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function GetStokSaldo()
	{
		$data = "
			select a.id,a.kodestok,a.namastok,a.satuan,a.beratperpcs,a.statusstok,0 QtyReady,a.tglaktif FROM masterstok a
			LEFT JOIN mutasistokdetail b on a.id = b.stokid and b.canceled is null
			where a.tglpasif is null
		";	
		return $this->db->query($data);
	}
}