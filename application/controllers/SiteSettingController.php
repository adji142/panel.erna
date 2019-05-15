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
	function ViewBanner()
	{
		$data = array('success' => false ,'message'=>array(),'data'=>array());
		$id = $this->input->post('id');	
		$where = array(
				'id' =>$id
			);
		try {
			$exec = $this->ModelsExecuteMaster->FindData($where,'sitebanner');
			if($exec->num_rows()>0){
				$data['success'] = true;
				$data['data'] = $exec->result();
			}
			else{

				$InsertData = array(
					'errorcode'		=> '500-01',
					'errordesc'		=> 'Server Error',
					'stacktrace'	=> 'SiteSettingController line 78',
				);
				$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
				$data['message'] = '404-01';
			}
		} catch (Exception $e) {
			$InsertData = array(
				'errorcode'		=> '500',
				'errordesc'		=> 'Exception Server Error',
				'stacktrace'	=> $e->getMessage(),
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
		}
		echo json_encode($data);
	}
	function SetPassif()
	{
		$data = array('success' => false ,'message'=>array());

		$id = $this->input->post('id');
		$table = $this->input->post('table');

		$update = array('tglpasif' => date("Y-m-d H:i:s"));
		$where = array('id' => $id);

		$exec = $this->ModelsExecuteMaster->ExecUpdate($update,$where,$table);

		if($exec){
			$data['success'] = true;
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'SiteSettingController line 112',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '500-01';
		}
		echo json_encode($data);
	}

	// Web Setting kategori

	function CatSave()
	{
		$data = array('success' => false ,'message'=>array());

		$parent = $this->input->post('parent');
		$child = $this->input->post('child');

		// $find_catname = $this->ModelsExecuteMaster->FindData(array('id'=>$parent),'categories');

		$data = array(
			'category'	=> $child,
			'parent'	=> $parent,
			'tglaktif'	=> date('Y-m-d'),
		);
		$exec = $this->ModelsExecuteMaster->ExecInsert($data,'categories');

		if($exec){
			$data['success'] = true;
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'SiteSettingController line 142',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '500-01';
		}
		echo json_encode($data);
	}
	function CatEdit()
	{
		$data = array('success' => false ,'message'=>array());

		$id = $this->input->post('idcat');
		$parent = $this->input->post('parent');
		$child = $this->input->post('child');
		$tglpasif = $this->input->post('passifdate');

		if($tglpasif == ""){
			$tglpasif = null;
		}
		// $find_catname = $this->ModelsExecuteMaster->FindData(array('id'=>$parent),'categories');

		$data = array(
			'category'	=> $child,
			'parent'	=> $parent,
			'tglpasif'	=> $tglpasif,
		);
		$exec = $this->ModelsExecuteMaster->ExecUpdate($data,array('id'=>$id),'categories');

		if($exec){
			$data['success'] = true;
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'SiteSettingController line 175',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '500-01';
		}
		echo json_encode($data);
	}

	function ViewCat()
	{
		$data = array('success' => false ,'message'=>array(),'data'=>array());
		$id = $this->input->post('id');	
		$where = array(
				'id' =>$id
			);
		try {
			$exec = $this->ModelsExecuteMaster->FindData($where,'categories');
			if($exec->num_rows()>0){
				$data['success'] = true;
				$data['data'] = $exec->result();
			}
			else{

				$InsertData = array(
					'errorcode'		=> '500-01',
					'errordesc'		=> 'Server Error',
					'stacktrace'	=> 'SiteSettingController line 169',
				);
				$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
				$data['message'] = '404-01';
			}
		} catch (Exception $e) {
			$InsertData = array(
				'errorcode'		=> '500',
				'errordesc'		=> 'Exception Server Error',
				'stacktrace'	=> $e->getMessage(),
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
		}
		echo json_encode($data);
	}

	// Web setting about store
	function Aboutadd()
	{
		$data = array('success' => false ,'message'=>array());

		$stid = $this->input->post('stid');
		$stname = $this->input->post('stname');
		$staddr = $this->input->post('staddr');
		$statlp = $this->input->post('statlp');
		$stabout = $this->input->post('stabout');

		// $find_catname = $this->ModelsExecuteMaster->FindData(array('id'=>$parent),'categories');
		$cekexist = $this->ModelsExecuteMaster->FindData(array('id'=>$stid),'siteabout');

		if($cekexist->num_rows() == 1){
			$data = array(
				'storename'		=> $stname,
				'storeaddress'	=> $staddr,
				'storephone'	=> $statlp,
				'storeabout'	=> $stabout,
			);
			$exec = $this->ModelsExecuteMaster->ExecUpdate($data,array('id'=>$stid),'siteabout');

			if($exec){
				$data['success'] = true;
			}
			else{
				$InsertData = array(
					'errorcode'		=> '500-01',
					'errordesc'		=> 'Server Error',
					'stacktrace'	=> 'SiteSettingController line 252',
				);
				$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
				$data['message'] = '500-01';
			}
		}
		else{
			$data = array(
				'storename'		=> $stname,
				'storeaddress'	=> $staddr,
				'storephone'	=> $statlp,
				'storeabout'	=> $stabout,
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($data,'siteabout');

			if($exec){
				$data['success'] = true;
			}
			else{
				$InsertData = array(
					'errorcode'		=> '500-01',
					'errordesc'		=> 'Server Error',
					'stacktrace'	=> 'SiteSettingController line 274',
				);
				$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
				$data['message'] = '500-01';
			}
		}

		echo json_encode($data);
	}

	function ShowAbout()
	{
		$data = array('success' => false ,'message'=>array(),'data'=>array());
		$id = 1;	
		$where = array(
				'id' =>$id
			);
		try {
			$exec = $this->ModelsExecuteMaster->FindData($where,'siteabout');
			if($exec->num_rows()>0){
				$data['success'] = true;
				$data['data'] = $exec->result();
			}
			else{

				$InsertData = array(
					'errorcode'		=> '500-01',
					'errordesc'		=> 'Server Error',
					'stacktrace'	=> 'SiteSettingController line 302',
				);
				$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
				$data['message'] = '404-01';
			}
		} catch (Exception $e) {
			$InsertData = array(
				'errorcode'		=> '500',
				'errordesc'		=> 'Exception Server Error',
				'stacktrace'	=> $e->getMessage(),
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
		}
		echo json_encode($data);
	}
	function Viewfaq()
	{
		$data = array('success' => false ,'message'=>array(),'data'=>array());
		$id = $this->input->post('id');	
		$where = array(
				'id' =>$id
			);
		try {
			$exec = $this->ModelsExecuteMaster->FindData($where,'faq');
			if($exec->num_rows()>0){
				$data['success'] = true;
				$data['data'] = $exec->result();
			}
			else{

				$InsertData = array(
					'errorcode'		=> '500-01',
					'errordesc'		=> 'Server Error',
					'stacktrace'	=> 'SiteSettingController line 335',
				);
				$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
				$data['message'] = '404-01';
			}
		} catch (Exception $e) {
			$InsertData = array(
				'errorcode'		=> '500',
				'errordesc'		=> 'Exception Server Error',
				'stacktrace'	=> $e->getMessage(),
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
		}
		echo json_encode($data);
	}

	function faqSave()
	{
		$data = array('success' => false ,'message'=>array());

		$ask = $this->input->post('ask');
		$answ = $this->input->post('answ');

		// $find_catname = $this->ModelsExecuteMaster->FindData(array('id'=>$parent),'categories');

		$data = array(
			'ask'		=> $ask,
			'answer'	=> $answ,
			'parent'	=> 0,
		);
		$exec = $this->ModelsExecuteMaster->ExecInsert($data,'faq');

		if($exec){
			$data['success'] = true;
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'SiteSettingController line 142',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '500-01';
		}
		echo json_encode($data);
	}
	function faqEdit()
	{
		$data = array('success' => false ,'message'=>array());

		$id = $this->input->post('idfaq');
		$ask = $this->input->post('ask');
		$answ = $this->input->post('answ');
		// $find_catname = $this->ModelsExecuteMaster->FindData(array('id'=>$parent),'categories');

		$data = array(
			'ask'		=> $ask,
			'answer'	=> $answ
		);
		$exec = $this->ModelsExecuteMaster->ExecUpdate($data,array('id'=>$id),'faq');

		if($exec){
			$data['success'] = true;
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'SiteSettingController line 409',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '500-01';
		}
		echo json_encode($data);
	}

	function ViewInf()
	{
		$data = array('success' => false ,'message'=>array(),'data'=>array(),'count' => 0);
		$id = $this->input->post('id');	
		$where = array(
				'id' => $id
			);
		try {
			$exec = $this->ModelsExecuteMaster->FindData($where,'siteinformation');
			if($exec->num_rows()>0){
				$data['success'] = true;
				$data['data'] = $exec->result();
				$data['count'] =$exec->num_rows(); 
			}
			else{

				$InsertData = array(
					'errorcode'		=> '500-01',
					'errordesc'		=> 'Server Error',
					'stacktrace'	=> 'SiteSettingController line 428',
				);
				$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
				$data['message'] = '404-01';
			}
		} catch (Exception $e) {
			$InsertData = array(
				'errorcode'		=> '500',
				'errordesc'		=> 'Exception Server Error',
				'stacktrace'	=> $e->getMessage(),
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
		}
		echo json_encode($data);
	}

	function InfSave()
	{
		$data = array('success' => false ,'message'=>array());

		$info = $this->input->post('info');
		$field = $this->input->post('field');
		// $find_catname = $this->ModelsExecuteMaster->FindData(array('id'=>$parent),'categories');

		$data = array(
			$field		=> $info,
		);
		$exec = $this->ModelsExecuteMaster->ExecInsert($data,'siteinformation');

		if($exec){
			$data['success'] = true;
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'SiteSettingController line 466',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '500-01';
		}
		echo json_encode($data);
	}

	function infEdit()
	{
		$data = array('success' => false ,'message'=>array());

		$id = $this->input->post('id');
		$info = $this->input->post('info');
		$field = $this->input->post('field');
		// $find_catname = $this->ModelsExecuteMaster->FindData(array('id'=>$parent),'categories');

		$data = array(
			$field		=> $info
		);
		$exec = $this->ModelsExecuteMaster->ExecUpdate($data,array('id'=>$id),'siteinformation');

		if($exec){
			$data['success'] = true;
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'SiteSettingController line 409',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '500-01';
		}
		echo json_encode($data);
	}

}