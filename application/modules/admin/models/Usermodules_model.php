<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usermodules_model extends CI_Model {
	public function __construct(){
        parent::__construct();

    }
	
    // get modules id via group id
    public function getModId($grp){
        $this->db->select('id_mod');
        $this->db->from('user_type_modules');
        $this->db->where('user_id', $grp);
        $this->db->distinct();
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    // get sub modules id via group id
    public function getSubModId($grp){
        $this->db->select('id_submod');
        $this->db->from('user_type_modules');
        $this->db->where('user_id', $grp);
        $this->db->distinct();
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

    //delete module via field and id
    public function delField($field,$id,$tbName){
        $this->db->delete($tbName, array($field => $id));
        return true;
    }

    //add new module
    public function addNew($datas,$tbName){
        $this->db->insert($tbName, $datas);
        return true;
    }

}

?>