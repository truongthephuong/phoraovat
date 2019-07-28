<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class layout_model extends CI_Model {
	public function __construct(){
        parent::__construct();

    }
	//get list users
    public function getList($limit,$id){
        
        $this->db->select('id, theme, width, height, style_bg, title, meta, meta_des, status');
        $this->db->from('layout');
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
        $this->db->update('users');
        //echo $this->db->last_query();exit;
    }
}

?>