<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class MemberController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsMember');
		$this->load->model('ModelsExecuteMaster');
	}
	// Select

	function FindGroupMember(){
		$data = array('success' => false ,'message'=>array(),'data'=>array());
		$id = $this->input->post('id');	
		$where = array(
				'id' =>$id
			);
		try {
			$exec = $this->ModelsExecuteMaster->FindData($where,'mastersettingmember');
			if($exec->num_rows()>0){
				$data['success'] = true;
				$data['data'] = $exec->result();
			}
			else{

				$InsertData = array(
					'errorcode'		=> '500-01',
					'errordesc'		=> 'Server Error',
					'stacktrace'	=> 'MemberController line 35',
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

	// Insert
	function AddGroupMmber()
	{
		$data = array('success' => false ,'message'=>array());
		$GroupName = $this->input->post('GrName');
		$GroupDiscount = $this->input->post('GrDisc');
		$OtherBenefit1 = $this->input->post('GrOthr1');
		$OtherBenefit2 = $this->input->post('GrOthr2');
		$OtherBenefit3 = $this->input->post('GrOthr3');
		$TglAktif = $this->input->post('GrActDate');
		$GrMinSpen = $this->input->post('GrMinSpen');
		$GrQuota = $this->input->post('GrQuota');

		$InsertData = array(
			'namagrade'			=> $GroupName,
			'tglaktif'			=> $TglAktif,
			'benefitdiscount'	=> $GroupDiscount,
			'benefitlain1'		=> $OtherBenefit1,
			'benefitlain2'		=> $OtherBenefit2,
			'benefitlain3'		=> $OtherBenefit3,
			'minimumspend'		=> $GrMinSpen,
			'quota'				=> $GrQuota,
		);

		$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'mastersettingmember');
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
	function EditGroupMmber()
	{
		$data = array('success' => false ,'message'=>array());
		$idGrp = $this->input->post('idGrp');
		$GroupName = $this->input->post('GrName');
		$GroupDiscount = $this->input->post('GrDisc');
		$OtherBenefit1 = $this->input->post('GrOthr1');
		$OtherBenefit2 = $this->input->post('GrOthr2');
		$OtherBenefit3 = $this->input->post('GrOthr3');
		$TglAktif = $this->input->post('GrActDate');
		$GrMinSpen = $this->input->post('GrMinSpen');
		$GrQuota = $this->input->post('GrQuota');

		$InsertData = array(
			'namagrade'			=> $GroupName,
			'benefitdiscount'	=> $GroupDiscount,
			'benefitlain1'		=> $OtherBenefit1,
			'benefitlain2'		=> $OtherBenefit2,
			'benefitlain3'		=> $OtherBenefit3,
			'minimumspend'		=> $GrMinSpen,
			'quota'				=> $GrQuota,
		);
		$where = array(
			'id'				=> $idGrp
		);
		$exec = $this->ModelsExecuteMaster->ExecUpdate($InsertData,$where,'mastersettingmember');
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

	function SetPassifGroupMmber()
	{
		$data = array('success' => false ,'message'=>array());
		$idGrp = $this->input->post('idGrppasif');
		$Tglpasif = $this->input->post('passifdate');

		$InsertData = array(
			'tglpasif'			=> $Tglpasif
		);
		$where = array(
			'id'				=> $idGrp
		);
		$exec = $this->ModelsExecuteMaster->ExecUpdate($InsertData,$where,'mastersettingmember');
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
}