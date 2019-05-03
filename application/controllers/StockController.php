<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class StockController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsExecuteMaster');
		$this->load->model('ModelsXPDC');
		$this->load->model('ModelsStock');
	}
	function GetStockRealtime()
	{
		
	}
}