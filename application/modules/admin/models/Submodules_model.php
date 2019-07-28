<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Submodules_model extends CI_Model {
	public function __construct(){
        parent::__construct();

    }
	//get list users
    public function getList($limit,$id){ 
        $this->db->select('sm.id, sm.mod_id, sm.name, sm.module_ctr, sm.module_act, sm.folder_url, sm.rank, sm.icon, sm.status, m.name subname');
        $this->db->from('cms_submodules sm');
        $this->db->join('cms_modules m', 'm.id = sm.mod_id', 'left');
        if($id != ''){
            $this->db->where('sm.id', $id);
        }
        $this->db->order_by('sm.id', 'ASC');
        //$query = $this->db->get('users',$limit);
        $query = $this->db->get();
        return $query->result();

    }

    //get all sub module function
    function getAllList(){
        $this->db->select('id,name');
        $this->db->from('cms_submodules');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach($query->result() as $data) {
                $items[$data->id] = $data->name;
            }

            $query->free_result();
            return $items;

        }

    }

    public function changeField($field,$value,$condField,$condValue){
        $this->db->set($field, $value);
        $this->db->where($condField, $condValue);
        $this->db->update('cms_submodules');
        //echo $this->db->last_query();exit;
    }

    // Update field via data input and id
    public function updateModule($id,$data){
        $this->db->where('id', $id);
        $this->db->update('cms_submodules', $data);
        //echo $this->db->last_query();exit;
        return true;
    }

    //get fields on sub table 
    public function getFieldSubTable($field,$id,$fieldName){
        
        $this->db->select($fieldName);
        $this->db->where($field, $id);
	    $this->db->where('status', 1);
        $query = $this->db->get('cms_submodules');
        return $query->result();

    }

    //delete field via input field and id
    public function delField($field,$id,$tbName){
        $this->db->delete($tbName, array($field => $id));
        return true;
    }

    //add new sub module
    public function addNew($datas,$tbName){
        $this->db->insert($tbName, $data);
        return true;
    }

}

?>