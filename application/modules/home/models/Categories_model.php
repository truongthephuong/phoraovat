<?php
    class Categories_model extends CI_Model
    {
    	public function __construct(){
        	parent::__construct();
        }

        public function getAllCategories(){
		    $this->db->select('id,name');
		    $query = $this->db->get('categories');

		    if ($query->num_rows() > 0) {
	        	foreach($query->result() as $data) {
	              $items[$data->id] = $data->name;
	        	}
	          	$query->free_result();
	        	return $items;

		    }

		}

		public function getListCategories($limit,$id){
			$cond = 'status = 1';
		    $this->db->select('id,name,icon');
		    $this->db->where('status', 1);
		    if($id != ''){
		    	$this->db->where('id', $id);
		    }
		    $this->db->order_by('id', 'ASC');
		    $query = $this->db->get('categories',$limit);
		    return $query->result();

		}

		public function getField($id,$fieldName){
			$cond = 'status = 1';
		    $this->db->select($fieldName);
		    $this->db->where('id', $id);
		   
		    $query = $this->db->get('categories');
		    return $query->result();

		}

    }
?>