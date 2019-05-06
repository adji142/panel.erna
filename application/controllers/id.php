<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Id extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('GlobalVar');
		$this->load->model('DataModels');
		$this->load->model('ModelsMember');
		$this->load->model('ModelsExecuteMaster');
		$this->load->model('ModelsXPDC');
		$this->load->model('ModelsStock');
	}
	function Index()
	{
		$this->load->view('Login');
	}
	function Home()
	{
		$this->load->view('Index');
	}
	function SettingMember()
	{
		$this->load->view('MasterSettingMember');
	}
	function GrupMember()
	{
		$this->load->view('GroupMember');
	}
	function MasterXPDC()
	{
		$this->load->view('MasterXPDC');
	}
	function MasterStock()
	{
		$this->load->view('masterStock');
	}
	function MutasiStock()
	{
		$this->load->view('MutasiStock');
	}
}