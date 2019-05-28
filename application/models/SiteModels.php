<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class SiteModels extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function GetProduct()
	{
		$data = "SELECT a.id,a.tittle,c.category,a.qty,case when a.promomember = 1 THEN 'Yes' else 'No' End memberpromo 
				FROM post_product a
				LEFT JOIN categories c on a.categories = c.id 
				where a.tglpasif is null
		";
		return $this->db->query($data);
	}
}