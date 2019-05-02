<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class XPDCController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsExecuteMaster');
		$this->load->model('ModelsXPDC');
	}
	function AddXPDC()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		$xpdccode = $this->input->post('xpdccode');
		$xpdcname = $this->input->post('xpdcname');
		$costperkg = $this->input->post('costperkg');
		$xpdcActDate = $this->input->post('xpdcActDate');
		$hqaddress = $this->input->post('hqaddress');
		$csemail = $this->input->post('csemail');
		$hqphone = $this->input->post('hqphone');
		$website = $this->input->post('website');
		$trackingwebsite = $this->input->post('trackingwebsite');

		$InsertData = array(
			'xpdccode'			=> $xpdccode,
			'xpdcname'			=> $xpdcname,
			'tglaktif'			=> $xpdcActDate,
			'alamathq'			=> $hqaddress,
			'notlphq'			=> $hqphone,
			'email'				=> $csemail,
			'website'			=> $website,
			'webtracking'		=> $trackingwebsite,
		);

		$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'masterxpdc');
		if($exec){
			$data['success'] = true;
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'MemberController line 35',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '500-01';
		}
		echo json_encode($data);
	}
	function AddXPDCDetail()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		$headerid = $this->input->post('headerid');
		$servisesname = $this->input->post('servisesname');
		$servicedesc = $this->input->post('servicedesc');
		$costperkg = str_replace(',', '', $this->input->post('costperkg'));
		$remaks = $this->input->post('remaks');

		$InsertData = array(
			'xpdcid'			=> $headerid,
			'service'			=> $servisesname,
			'servicedesc'		=> $servicedesc,
			'costperkg'			=> $costperkg,
			'remarks'			=> $remaks,
		);

		$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'masterxpdcdetail');
		if($exec){
			$data['success'] = true;
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'XPDCController line 82',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '500-01';
		}
		echo json_encode($data);
	}
	function FindXPDDetail()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$headerid = $this->input->post('id');

		$where = array(
			'xpdcid'			=> $headerid,
		);

		$exec = $this->ModelsExecuteMaster->FindData($where,'masterxpdcdetail');
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$InsertData = array(
				'errorcode'		=> '404-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'XPDCController line 108',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '404-01';
		}
		echo json_encode($data);
	}

	function FindXPDC()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$headerid = $this->input->post('id');

		$where = array(
			'id'			=> $headerid,
		);

		$exec = $this->ModelsExecuteMaster->FindData($where,'masterxpdc');
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$InsertData = array(
				'errorcode'		=> '404-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'XPDCController line 108',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '404-01';
		}
		echo json_encode($data);
	}
}