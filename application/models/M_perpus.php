<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class M_perpus extends CI_model
{
	
	function edit_data($where,$table)
	{
		return $this->db->get_where($table,$where);
	}
	function get_data($table)
	{
		return $this->db->get($table);
	}
	function insert_data($data,$table){
		$this->db->insert($table,$data);
	}
	function update_data($table,$data,$where){
		$this->db->update($table,$data,$where);
	}
	function delete_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

}

?>