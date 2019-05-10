<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class SiteSettingController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsMember');
		$this->load->model('ModelsExecuteMaster');
	}
	function test()
	{
		$image = $this->input->post('image');
		var_dump($image);
	}
	function saveBanner()
	{
		$data = array('success' => false ,'message'=>array());
		$image = $this->input->post('image');
		$hl = $this->input->post('hl');
		$title = $this->input->post('title');
		$subtitle = $this->input->post('subtitle');
		$bannerActDate = $this->input->post('bannerActDate');

		$insert = array(
			'image'			=>$image,
			'hightlight'	=>$hl,
			'title'			=>$title,
			'subtitle'		=>$subtitle,
			'tglaktif'		=>$bannerActDate
		);

		$count = $this->ModelsExecuteMaster->GetData('sitebanner');

		if($count->num_rows()<=5){
			$exec = $this->ModelsExecuteMaster->ExecInsert($insert,'sitebanner');
			if($exec){
				$data['success'] = true;
			}
			else{
				$InsertData = array(
					'errorcode'		=> '500-01',
					'errordesc'		=> 'Server Error',
					'stacktrace'	=> 'SiteSettingController line 49',
				);
				$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
				$data['message'] = '500-01';
			}
		}
		else{
			$data['message'] = 'FullBanner';
		}
		echo json_encode($data);
	}
}