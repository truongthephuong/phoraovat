<?php
    class Locations_model extends CI_Model
    {
    	public function __construct(){
        	parent::__construct();
        }

        function getAllLocations(){
		    $this->db->select('id,name');
		    $query = $this->db->get('locations');

		    if ($query->num_rows() > 0) {
	        	foreach($query->result() as $data) {
	              $items[$data->id] = $data->name;
	        	}
	          	$query->free_result();
	        	return $items;

		    }

		}

		public function getField($id,$fieldName){
			$cond = 'status = 1';
		    $this->db->select($fieldName);
		    $this->db->where('id', $id);
		   
		    $query = $this->db->get('locations');
		    return $query->result();

		}

		public function getIdByCode($code){
			$this->db->select('id');
		    $this->db->where('code', $code);
		    $query = $this->db->get('locations');
		    foreach($query->result() as $data) {
		    	$localId = $data->id;
		    }
		    $query->free_result();
		    return $localId;
		}
    }
?>