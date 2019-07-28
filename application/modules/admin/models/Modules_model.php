<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Modules_model extends CI_Model {
	public function __construct(){
        parent::__construct();

    }
	//get list users
    public function getList($limit,$id){
        
        $this->db->select('id, per_id, name, module_ctr, module_act, folder_url, rank, icon, status');
        $this->db->from('cms_modules');
        if($id != ''){
            $this->db->where('id', $id);
        }
        $this->db->order_by('id', 'ASC');
        //$query = $this->db->get('users',$limit);
        $query = $this->db->get();
        return $query->result();
    }

    //get all module function
    function getAllList(){
        $this->db->select('id,name');
        $this->db->from('cms_modules');
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
        $this->db->update('users');
        //echo $this->db->last_query();exit;
    }

    public function updateModule($id,$data){
        $this->db->where('id', $id);
        $this->db->update('cms_modules', $data);
        //echo $this->db->last_query();exit;
        return true;
    }

    public function getMenuList(){
        
        $this->db->select('id, name,module_ctr,module_act');
        $this->db->from('cms_modules');
        $this->db->where('status', 1);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result();

    }

    //delete module via field and id
    public function delField($field,$id,$tbName){
        $this->db->delete($tbName, array($field => $id));
        return true;
    }

    //add new module
    public function addNew($data,$tbName){
        $this->db->insert($tbName, $data);
        return true;
    }

}

?>