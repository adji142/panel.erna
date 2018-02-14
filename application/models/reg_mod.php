<?php
	/**
	* 
	*/
	class reg_mod extends CI_Model
	{
		
		// function __construct(argument)
		// {
		// 	# code...
		// }
		function input_reg($data,$table){
			$this->db->insert($table,$data);
		}
	}
?>