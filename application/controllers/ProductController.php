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
	function fakeUrl()
	{
		var_dump($this->input->post('base64'));
	}
	function PostImage()
	{
		$data = array('success' => false ,'message'=>array());
		$GetMax = $this->ModelsExecuteMaster->GetMax('post_product','','')->row();
		$status = $GetMax->status;

		$file_image = $this->input->post('file_image');
		$image_token = $this->input->post('image_token');

		$idpost;

		if($status == "0"){
			$idpost = 1;
		}
		else{
			$idpost += 1;	
		}

		$datainsert = array(
			'postid'	=> $idpost,
			'image'		=> $file_image,
			'imagetoken'=> $image_token
		);

		$exec = $this->ModelsExecuteMaster->ExecInsert($datainsert,'imagetable');
		if($exec){
			$data['success'] = true;
		}
		else{
			$data['message'] = 'gagal';
		}
		echo json_encode($data);
	}
	function DelImage()
	{
		$data = array('success' => false ,'message'=>array());

		$token = $this->input->post('token');

		$foto= $this->ModelsExecuteMaster->FindData(array('imagetoken'=>$token),'imagetable');

		if($foto->num_rows() > 0){
			$deleted = $this->ModelsExecuteMaster->DeleteData(array('imagetoken'=>$token),'imagetable');
			if($deleted){
				$data['success'] = true;
			}
			else{
				$data['message'] = 'ups';
			}
		}
		echo json_encode($data);
	}
	function Getsubcategori()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());
		$id = $this->input->post('idcat');
		$where = array(
			'parent'			=> $id,
		);

		$exec = $this->ModelsExecuteMaster->FindData($where,'categories');
		if($exec){
			$data['success'] = true;
			if($id <> 0){
				$data['data'] =$exec->result();
			}
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'ProductController line 89',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '404-01';
		}
		echo json_encode($data);
	}
}