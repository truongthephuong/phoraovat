<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin_model extends AppModel {
    var $_primary_key = 'id';
    var $_tablename = 'users';

    public function admin_model($id = NULL){
        parent::AppModel($id);

    }

    //Get field
    public function get_field( $field_name, $tbname, $wh ){
        $CI = & get_instance();
       
        $sql = "SELECT ". $field_name ." FROM ". $tbname .$wh;
        
        $results = $CI->db->query($sql)->result();
        foreach($results as $result){
            $returnField = $result->$field_name;
        }
        
        return $returnField;
    }

    //Get user information
    public function getUserInfo($field_name, $tbname, $uID){
        $CI = & get_instance();
        $sql = "SELECT ". $field_name ." FROM ". $tbname . ' WHERE id = ' .$uID;
       
        $results = $CI->db->query($sql)->result();
        foreach($results as $result){
            $returnField = $result;

        }
        return $returnField;
    }

    //Get list products
	public function getListProd($limit,$start,$id){

		$this->db->select('
		    	prod.id, prod.title name, prod.created, prod.rank, prod.image, prod.status,
		    	c.name catename, sc.name subcatename, sc2.name subcatename2
		    ');
		$this->db->from('asds prod');
		$this->db->join('categories c', 'c.id = prod.cate_id', 'left');
		$this->db->join('subcategories sc', 'sc.id = prod.subcate_id', 'left');
		$this->db->join('sub2categories sc2', 'sc2.id = prod.subcate1_id', 'left');
		$this->db->order_by('created', 'DESC');
		$this->db->limit($limit,$start);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			//echo $this->db->last_query();
			return $query->result();

		}

		return false;

	}

	//get number of records via cate id
	public function record_count(){
		$this->db->from('asds');
		return $this->db->count_all_results();
	}

	public function delField($field,$id,$tbName){
		$this->db->delete($tbName, array($field => $id));
		return true;
	}

	public function addNew($datas,$tbName){
		$this->db->insert($tbName, $datas);
		return true;
	}

	//Get detail via id
	public function getDetail($id)
	{
		$this->db->select();
		$this->db->where('id', $id);
		$query = $this->db->get('asds');
		return $query->result();

	}

}