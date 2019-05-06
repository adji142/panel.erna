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
	function InsertStock()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		$kodestok = $this->input->post('kodestok');
		$nmstok = $this->input->post('nmstok');
		$statusstok = $this->input->post('statusstok');
		$sat = $this->input->post('sat');
		$berat = $this->input->post('berat');
		$stkcActDate = $this->input->post('stkcActDate');
		$InsertData = array(
			'kodestok'			=> $kodestok,
			'namastok'			=> $nmstok,
			'statusstok'		=> $statusstok,
			'satuan'			=> $sat,
			'beratperpcs'		=> $berat,
			'tglaktif'			=> $stkcActDate,
		);

		$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'masterstok');
		if($exec){
			$data['success'] = true;
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'StockController line 48',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '500-01';
		}
		echo json_encode($data);
	}
	function FindStock()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$id = $this->input->post('id');

		$where = array(
			'id'			=> $id,
		);

		$exec = $this->ModelsExecuteMaster->FindData($where,'masterstok');
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$InsertData = array(
				'errorcode'		=> '404-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'StockController line 74',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '404-01';
		}
		echo json_encode($data);
	}

	function SetPasifStock()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');
		$id = $this->input->post('idGrppasif');
		$passifdate = $this->input->post('passifdate');

		$InsertData = array(
			'tglpasif'			=> $passifdate,
		);
		$where = array(
			'id'				=> $id,
		);
		$exec = $this->ModelsExecuteMaster->ExecUpdate($InsertData,$where,'masterstok');
		if($exec){
			$data['success'] = true;
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'StockController line 102',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '500-01';
		}
		echo json_encode($data);
	}
}