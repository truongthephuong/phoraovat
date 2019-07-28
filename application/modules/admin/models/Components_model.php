<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Components_model extends CI_Model {
	public function __construct(){
        parent::__construct();

    }
	//get list users
    public function getList($limit,$id){
        
        $this->db->select('co.id, co.pos_id, co.name, co.file_php, co.folder_url, co.status, co.rank, ps.pos_name posname');
        $this->db->from('components co');
        $this->db->join('position ps', 'ps.id = co.pos_id', 'left');
        if($id != ''){
            $this->db->where('co.id', $id);
        }
        $this->db->order_by('co.id', 'ASC');
        //$query = $this->db->get('users',$limit);
        $query = $this->db->get();
        return $query->result();

    }

    public function changeField($field,$value,$condField,$condValue){
        $this->db->set($field, $value);
        $this->db->where($condField, $condValue);
        $this->db->update('users');
        //echo $this->db->last_query();exit;
    }
}

?>