<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class ProductController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsMember');
		$this->load->model('ModelsExecuteMaster');
	}
	function PostImage()
	{
		var_dump($this->input->post('base64'));
	}
}