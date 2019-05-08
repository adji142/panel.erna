<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class mutasiStockModels extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function GetHeader($fromdate,$todate)
	{
		$data = "select a.*,d.whscode,d.whsname,e.username,COALESCE(COUNT(b.id),0) jmlitem From mutasistok a
				LEFT JOIN mutasistokdetail b on a.id = b.mutasiid
				LEFT JOIN masterasalstok d on a.asalstockid = d.id
				LEFT JOIN users e on a.createdby = e.id
				where a.tgltransaksi BETWEEN '$fromdate' AND '$todate'
				GROUP BY a.id,a.notransaksi,a.tgltransaksi,a.asalstockid,a.tglterimagudang,a.createdby,a.createdon,a.print,a.canceled,a.canceleddate,d.whscode,d.whsname,e.username";
		return $this->db->query($data);
	}
}