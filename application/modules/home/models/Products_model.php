<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 28-May-17
 * Time: 1:26 PM
 */
class Products_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	//get list via cate id
	public function getListProd($fields,$limit){
		//$cond = 'status = 1';
		$this->db->select($fields);
		$this->db->where('status', 1);
		//$this->db->where('fcate_id', $id);
		$this->db->order_by('created', 'DESC');
		$this->db->limit($limit);
		$query = $this->db->get('products');

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

    public function getListProdCate($fields, $id, $limit, $start){
        $this->db->select($fields);
        $this->db->where('status', 1);
        $this->db->where('fcate_id', $id);
        $this->db->order_by('created', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('products');
        //echo $this->db->last_query();die;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function record_count(){
        $this->db->from('products');
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
    public function getDetail($id){
        $this->db->select();
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        //echo $this->db->last_query();die;
        return $query->result();
    }

    //Get more list via cate id and member id
    public function getListProdMore($fields,$cateId){

        $this->db->select($fields);
        $this->db->where('status', 1);
        $this->db->where('cate_id', $cateId);
        $this->db->order_by('created', 'DESC');
        $query = $this->db->get('products');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }

    //Get list follow views
    public function getListProdView($fields){

        $this->db->select($fields);
        $this->db->where('status', 1);
        $this->db->order_by('count_view', 'DESC');
        $query = $this->db->get('products');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }

}