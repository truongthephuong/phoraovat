<?php

class members_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function getAllLocations()
	{
		$this->db->select('id,name');
		$query = $this->db->get('members');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $data) {
				$items[$data->id] = $data->name;
			}
			$query->free_result();
			return $items;
		}
	}

	//Get fields with input are fields, table via id
	public function getField($id, $fieldName, $tbName)
	{
		$this->db->select($fieldName);
		$this->db->where('id', $id);
		$query = $this->db->get($tbName);

		return $query->result();

	}

	//Check existing username
	public function checkExistuser($fieldId, $fieldName)
	{
		$this->db->select('id');
		$this->db->where($fieldId, $fieldName);
		$query = $this->db->get('members');

		return $query->result();

	}

	//add new member
	public function addNew($data,$tbName){
		$this->db->insert($tbName, $data);
		return $this->db->insert_id();
	}

}

?>