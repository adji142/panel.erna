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
		$large = $this->input->post('large');
		$med = $this->input->post('med');
		$tumb = $this->input->post('tumb');

		$idpost;

		if($GetMax->id == "0"){
			$idpost = 1;
		}
		else{
			$idpost = $GetMax->id+1;	
		}

		$datainsert = array(
			'postid'	=> $idpost,
			'image'		=> $file_image,
			'imagetoken'=> $image_token,
			'used'		=> 0,
			'name_l'	=> $large,
			'name_m'	=> $med,
			'name_t'	=> $tumb,
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
	function GetStock()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());
		$id = $this->input->post('idstok');

		$exec = $this->ModelsExecuteMaster->GetSaldoStock($id);
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'ProductController line 112',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '404-01';
		}
		echo json_encode($data);
	}
	function AddProduct()
	{
		$data = array('success' => false ,'message'=>array());

		$allownextstep = true;

		$title = $this->input->post('title');
		$desc = $this->input->post('desc');
		$categori = $this->input->post('categori');
		$subcategori = $this->input->post('subcategori');
		$stok = $this->input->post('stok');
		$qty = $this->input->post('qty');
		$hpp = $this->input->post('hpp');
		$promomember = $this->input->post('promomember');
		// $promo = $this->input->post('promo');
		$realstock = $this->input->post('realstock');

		$flag_member = 0;
		
		if($realstock < $qty){
			$data['message'] = 'E-01'; // qty > stok
			$allownextstep = false;
		}

		if($promomember == '1'){
			$flag_member = 1;
		}

		if ($allownextstep == true) {
			$insert = array(
				'stockid'		=> $stok,
				'categories'	=> $subcategori,
				'price'			=> $hpp,
				'tittle'		=> $title,
				'description'	=> $desc,
				'tglaktif'		=> date("Y-m-d"),
				'promomember'	=> $flag_member,
				'qty'			=> $qty,
			);


			$exec = $this->ModelsExecuteMaster->ExecInsert($insert,'post_product');
			if($exec){
				$data['success'] = true;

			}
			else{
				$InsertData = array(
					'errorcode'		=> '500-01',
					'errordesc'		=> 'Server Error',
					'stacktrace'	=> 'ProductController line 163',
				);
				$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
				$data['message'] = '500-01';
			}
		}
		echo json_encode($data);
	}

	function GetImage()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());
		$id = $this->input->post('id');

		$exec = $this->ModelsExecuteMaster->FindData(array('postid'=>$id),'imagetable');
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'ProductController line 193',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '404-01';
		}
		echo json_encode($data);
	}
	function Findpost()
	{
		$data = array('success' => false ,'message'=>array(),'data' =>array());
		$id = $this->input->post('id');

		$exec = $this->ModelsExecuteMaster->FindData(array('postid'=>$id),'imagetable');
		if($exec){
			$data['success'] = true;
			$data['data'] =$exec->result();
		}
		else{
			$InsertData = array(
				'errorcode'		=> '500-01',
				'errordesc'		=> 'Server Error',
				'stacktrace'	=> 'ProductController line 193',
			);
			$exec = $this->ModelsExecuteMaster->ExecInsert($InsertData,'errorlog');
			$data['message'] = '404-01';
		}
		echo json_encode($data);
	}
	function test()
	{
		$promomember = $this->input->post('promomember');

		var_dump($promomember);
	}
}