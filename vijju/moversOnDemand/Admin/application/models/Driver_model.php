<?php
class Driver_model extends CI_Model {

	public function insert_data($tbl_name,$data)                                         /* Data insert */
	    {
	      	$this->db->insert($tbl_name, $data);
	       	$insert_id = $this->db->insert_id();
	        return $insert_id;

	    }
?>