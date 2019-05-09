<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class MutasiStockController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsExecuteMaster');
		$this->load->model('ModelsXPDC');
		$this->load->model('ModelsStock');
		$this->load->model('mutasiStockModels');
	}
	function GetMutasiStockHeader()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$fromdate = $this->input->post('fromdate');
		$todate = $this->input->post('todate');

		$where  = array(
			'tgltransaksi' >= $fromdate,
			'tgltransaksi' <= $todate,
		);

		$exec = $this->mutasiStockModels->GetHeader($fromdate,$todate);
		if($exec->num_rows()>0){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'MutasiStockController line 39',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '404-01';
		}
		echo json_encode($data);
	}
	function GetMutasiStockDetail()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$mutasiid = $this->input->post('id');

		$exec = $this->mutasiStockModels->GetDetail($mutasiid);
		if($exec->num_rows()>0){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'MutasiStockController line 39',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '404-01';
		}
		echo json_encode($data);
	}
	function AddHeader()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$notrx = $this->input->post('notrx');
		$userid = $this->input->post('userid');
		$tgltrx = $this->input->post('tgltrx');
		$sumberstk = $this->input->post('sumberstk');
		$now = new DateTime();
		$input = array(
			'notransaksi'		=> $notrx,
			'tgltransaksi'		=> $tgltrx,
			'asalstockid'		=> $sumberstk,
			'createdby'			=> $userid,
			'createdon'			=> date("Y-m-d H:i:s"),
			'print'				=> 0,
		);

		try {
			$exec = $this->ModelsExecuteMaster->ExecInsert($input,'mutasistok');
			if($exec){
				$data['success'] = true;
			}
			else{
				$data['message'] = '500-01';
			}	
		} catch (Exception $e) {
			$InsertData = array(
				'errorcode'		=> '500',
				'errordesc'		=> 'Exception Server Error',
				'stacktrace'	=> $e->getMessage(),
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '404-01';
		}
		echo json_encode($data);
	}

	function AddDetail()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());

		$kodestk = $this->input->post('kodestk');
		$mutasiid = $this->input->post('mutasiid');
		$useriddetail = $this->input->post('useriddetail');
		$qty = $this->input->post('qty');
		$hrgperpcs = str_replace(',', '', $this->input->post('hrgperpcs'));

		
		$input = array(
			'mutasiid'			=> $mutasiid,
			'stokid'			=> $kodestk,
			'qty'				=> $qty,
			'harga'				=> $hrgperpcs,
			'createdby'			=> $useriddetail,
			'createdon'			=> date("Y-m-d H:i:s"),
		);

		try {
			$exec = $this->ModelsExecuteMaster->ExecInsert($input,'mutasistokdetail');
			if($exec){
				$data['success'] = true;
			}
			else{
				$data['message'] = '500-01';
			}	
		} catch (Exception $e) {
			$InsertData = array(
				'errorcode'		=> '500',
				'errordesc'		=> 'Exception Server Error',
				'stacktrace'	=> $e->getMessage(),
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '404-01';
		}
		echo json_encode($data);
	}
	function Cancel()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());
		$tipe = $this->input->post('tipe');
		$id = $this->input->post('id');

		if($tipe == 'All'){
			$where = array(
				'id'	=> $id
			);
			$data = array(
				'canceled'		=> 1,
				'canceleddate'	=> date("Y-m-d H:i:s"),
			);
			$exec = $this->ModelsExecuteMaster->ExecUpdate($data,$where,'mutasistok');
			if($exec){
				$where = array(
					'mutasiid'		=> $id
				);
				$data = array(
					'canceled'		=> 1,
					'canceleddate'	=> date("Y-m-d H:i:s"),
				);
				$exec2 = $this->ModelsExecuteMaster->ExecUpdate($data,$where,'mutasistokdetail');
				if ($exec2) {
					$data['success']	= true;
				}
				else
				{
					$InsertData = array(
						'errorcode'		=> '100-01',
						'errordesc'		=> 'Gagao Update Mutasi stok Detail',
						'stacktrace'	=> 'MutasiStockController line 177',
					);
					$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
					$data['message']	= '100-1'; // gagal update detail
				}
			}
			else{
				$InsertData = array(
					'errorcode'		=> '100-02',
					'errordesc'		=> 'Gagao Update Mutasi stok Header',
					'stacktrace'	=> 'MutasiStockController line 187',
				);
				$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
				$data['message']	= '100-2'; // gagal update header
			}
		}
		elseif ($tipe == 'item') {
			$where = array(
					'id'		=> $id
				);
			$data = array(
				'canceled'		=> 1,
				'canceleddate'	=> date("Y-m-d H:i:s"),
			);
			$exec2 = $this->ModelsExecuteMaster->ExecUpdate($data,$where,'mutasistokdetail');
			if ($exec2) {
				$data['success']	= true;
			}
			else
			{
				$InsertData = array(
					'errorcode'		=> '100-01',
					'errordesc'		=> 'Gagao Update Mutasi stok Detail',
					'stacktrace'	=> 'MutasiStockController line 210',
				);
				$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
				$data['message']	= '100-1'; // gagal update header
			}
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Gagao Update Mutasi Invalid Tyoe',
				'stacktrace'	=> 'MutasiStockController line 290',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message']	= '500-1'; // Invalid tipe
		}
		echo json_encode($data);
	}
}