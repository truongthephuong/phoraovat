<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Groups_model extends CI_Model {
	public function __construct(){
        parent::__construct();

    }
	//get list users
    public function getList($limit,$id){
        
        $this->db->select('id, name, rank, status');
        $this->db->from('user_types');
        if($id != ''){
            $this->db->where('id', $id);
        }
        $this->db->order_by('id', 'ASC');
        //$query = $this->db->get('users',$limit);
        $query = $this->db->get();
        return $query->result();

    }

    public function changeField($field,$value,$condField,$condValue){
        $this->db->set($field, $value);
        $this->db->where($condField, $condValue);
        $this->db->update('user_types');
        //echo $this->db->last_query();exit;
    }

    //get field via id
    public function getField($id,$fieldName){
        $cond = 'status = 1';
        $this->db->select($fieldName);
        $this->db->where('id', $id);
           
        $query = $this->db->get('user_types');
        return $query->result();

    }

    public function getAll(){

        $this->db->select('id,name');

        $query = $this->db->get('user_types');
        $items[0] = '-- Select Category --';
        if ($query->num_rows() > 0) {

            foreach($query->result() as $data) {

                $items[$data->id] = $data->name;

            }

            $query->free_result();

            return $items;

        }

    }
}

?>