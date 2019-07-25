<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class OrderController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsMember');
		$this->load->model('ModelsExecuteMaster');
		$this->load->model('ModelsOrder');
	}

	function GetBuktiTransfer()
	{
		$data = array('success' => false ,'message'=>array(),'data'=>array());
		$id = $this->input->post('id');	
		$where = array(
				'id' =>$id
			);
		try {
			$exec = $this->ModelsExecuteMaster->FindData($where,'pembayaran');
			if($exec->num_rows()>0){
				$data['success'] = true;
				$data['data'] = $exec->result();
			}
			else{

				$InsertData = array(
					'errorcode'		=> '500-01',
					'errordesc'		=> 'Server Error',
					'stacktrace'	=> 'OrderController line 36',
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
	function Konfirmasi()
	{
		$data = array('success' => false ,'message'=>array());
		$id = $this->input->post('id');

		$getdo = $this->ModelsExecuteMaster->FindData(array('id'=>$id),'pembayaran');
		$doid = $getdo->row()->doid;

		$updatestatusbayar = $this->ModelsExecuteMaster->ExecUpdate(array('confirmed'=>1),array('id'=>$id),'pembayaran');
		if ($updatestatusbayar) {
			$updatestatusdo = $this->ModelsExecuteMaster->ExecUpdate(array('statusorder'=>2),array('id'=>$doid),'deliveryorder');
			if ($updatestatusdo) {
				$data['success'] = true;
			}
			else{
				$data['message'] = 'Gagal Update Status Order';
			}
		}
		else{
			$data['message'] = 'Gagal Update Status pembayaran';
		}
		echo json_encode($data);
	}
}