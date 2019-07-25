<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class ModelsOrder extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function GetOrder()
	{
		$query = "
			SELECT 
				a.*,b.nomerorder,c.namabank,
				CASE WHEN a.confirmed = 0 then 'Belum di konfirmasi' ELSE 'Terkonfirmasi' END StatusBayar
			FROM pembayaran a
			LEFT JOIN deliveryorder b on a.doid = b.id
			LEFT JOIN masterrekening c on a.rekeningid = c.id
			ORDER BY a.tglpembayaran DESC
		";
		return $this->db->query($query);
	}
	function SumOrder($ORDRID)
	{
		$data = "SELECT SUM(qtyorder) Qty,SUM(gros) gros,SUM(discount) discount,SUM(ongkir) ongkir,SUM(gros-discount)+ongkir TOTAL FROM deliveryorderdetail where headerid = $ORDRID group by ongkir" ;
		return $this->db->query($data);
	}
}