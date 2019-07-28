<?php
    class Asds_model extends CI_Model
    {
    	public function __construct(){
        	parent::__construct();
        }

        //get list via cate id 
		public function getListProd($fields,$id,$limit){
			$cond = 'status = 1';
		    $this->db->select($fields);
		    $this->db->where('status', 1);
		    $this->db->where('cate_id', $id);
		   	$this->db->order_by('created', 'DESC');
		   	$this->db->limit($limit);
		    $query = $this->db->get('asds');

		    if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}

		    return false;

		}

        //get list via location id 
		public function getListProdLocal($fields,$id,$limit){
			$cond = 'status = 1';
		    $this->db->select($fields);
		    $this->db->where('status', 1);
		    $this->db->where('local_id', $id);
		   	$this->db->order_by('created', 'DESC');
		   	$this->db->limit($limit);
		    $query = $this->db->get('asds');

		    if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}

		    return false;

		}

		//get list via cate_id with paging
		public function getListProdPaging($fields,$cateId,$limit,$start){

		    $this->db->select($fields);
		    $this->db->limit($limit,$start);
		    $this->db->where('status', 1);
		    $this->db->where('cate_id', $cateId);
		   	$this->db->order_by('created', 'DESC');
		   	
		    $query = $this->db->get('asds');
		    //echo $this->db->last_query();
		    if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}

		    return false;

		}

		//get list via cate_id and subcate_id with paging
		public function getListProdPaging2($fields,$cateId,$subCateId,$limit,$start){

		    $this->db->select($fields);
		    $this->db->limit($limit,$start);
		    $this->db->where('status', 1);
		    $this->db->where('cate_id', $cateId);
		    $this->db->where('subcate_id', $subCateId);
		   	$this->db->order_by('created', 'DESC');
		   	
		    $query = $this->db->get('asds');
		    //echo $this->db->last_query();
		    if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}

		    return false;

		}

		//get list via local_id with paging
		public function getListProdLocalPaging($fields,$localId,$limit,$start){

		    $this->db->select($fields);
		    $this->db->limit($limit,$start);
		    $this->db->where('status', 1);
		    $this->db->where('local_id', $localId);
		   	$this->db->order_by('created', 'DESC');
		   	
		    $query = $this->db->get('asds');
		    //echo $this->db->last_query();
		    if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}

		    return false;

		}

		//get number of records via cate id
		public function record_count($id){
			$this->db->where('cate_id', $id);
			$this->db->from('asds');
			return $this->db->count_all_results();
			
		}

		//get number of records via cate id
		public function record_count2($cateId,$subcateId){
			$this->db->where('cate_id', $cateId);
			$this->db->where('subcate_id', $subcateId);
			$this->db->from('asds');
			return $this->db->count_all_results();
			
		}

		//get number of records via local id
		public function record_count_local($id){
			$this->db->where('local_id', $id);
			$this->db->from('asds');
			return $this->db->count_all_results();
			
		}

		//Get detail via id
		public function getDetail($fields,$id){
		    $this->db->select($fields);
		    $this->db->where('status', 1);
		    $this->db->where('id', $id);
		   	$query = $this->db->get('asds');
		   	return $query->result();
		}

		//Get more list via cate id and member id
		public function getListProdMore($fields,$cateId,$memId){
			$cond = 'status = 1';
		    $this->db->select($fields);
		    $this->db->where('status', 1);
		    $this->db->where('cate_id', $cateId);
		    $this->db->where('mem_id', $memId);
		   	$this->db->order_by('created', 'DESC');	
		    $query = $this->db->get('asds');

		    if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
			
		    return false;

		}

    }
?>