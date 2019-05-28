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
		$this->load->model('SiteModels');
	}
	function test()
	{
		$this->load->view('test');
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
	// site setting
	function siteBanner()
	{
		$this->load->view('WebSetBanner');
	}
	function siteCategories()
	{
		$this->load->view('WebSetCategories');
	}
	function siteAbout()
	{
		$this->load->view('WebSetAbout');
	}
	function siteInfo()
	{
		$this->load->view('WebSetInfo');
	}
	function PostItem()
	{
		$this->load->view('PostProduct');
	}
}