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
	function CekInvoice()
	{
		$data = array('success' => false ,'message'=>array());
		$id = $this->input->post('id');

		$getdata = $exec = $this->ModelsExecuteMaster->FindData(array('statusorder'=>2,'id'=>$id),'deliveryorder');

		if ($getdata->num_rows() == 0) {
			$data['message'] = 'Pembayaran Belum di Konfirmasi';
		}
		else{
			$update = $this->ModelsExecuteMaster->ExecUpdate(array('statusorder'=>3),array('id'=>$id),'deliveryorder');
			if ($update) {
				$data['success'] = true;
			}
			else{
				$data['message'] = 'Gagal Update Pemesanan';
			}
		}
		echo json_encode($data);
	}
	function Kirim()
	{
		$data = array('success' => false ,'message'=>array());

		$sendder = $this->input->post('sendder');
		$Outlet = $this->input->post('Outlet');
		$resi = $this->input->post('resi');
		$doid = $this->input->post('doid');
		$nomertrx = '4'.date('Y')."".date('m')."".date('d')."".rand();
		$tgltrx = date("Y-m-d H:i:s");

		// insert pengiriman
		$datainsert = array(
			'nopengiriman'		=> $nomertrx,
			'tglpengiriman'		=> $tgltrx,
			'doid'				=> $doid,
			'pengirim'			=> $sendder,
			'outletxpdc'		=> $Outlet,
			'nomerresi'			=> $resi,
		);

		$insert = $this->ModelsExecuteMaster->ExecInsert($datainsert,'pengiriman');
		if ($insert) {
			$update = $this->ModelsExecuteMaster->ExecUpdate(array('statusorder'=>4),array('id'=>$doid),'deliveryorder');
			if ($update) {
				$data['success'] = true;
			}
			else{
				$data['message'] = 'Gagal Update Status, Hubungi Administrator';
			}
		}
		else{
			$data['message'] = 'Gagal Proses Pengiriman, Hubungi Administrator';
		}
		echo json_encode($data);
	}
}