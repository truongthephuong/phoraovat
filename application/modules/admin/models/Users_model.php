<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model {

    public function __construct(){
        parent::__construct();

    }

    //get field via condition
    public function get_field( $field_name, $tbname, $wh ){
       $returnField = '';
        $sql = "SELECT ". $field_name ." FROM ". $tbname .$wh;
        
        $results = $this->db->query($sql)->result();
        //echo $this->db->last_query();die;
        foreach($results as $result){
            $returnField = $result->$field_name;
        }
        //echo $returnField;die;
        return $returnField;
    }

    //get field via id
    public function getField($id,$fieldName){
        $cond = 'status = 1';
        $this->db->select($fieldName);
        $this->db->where('id', $id);
           
        $query = $this->db->get('users');
        return $query->result();

    }

    //get information of user
    public function getUserInfo($field_name, $tbname, $uID){
        $CI = & get_instance();
        $sql = "SELECT ". $field_name ." FROM ". $tbname . ' WHERE id = ' .$uID;
       
        $results = $CI->db->query($sql)->result();
        foreach($results as $result){
            $returnField = $result;

        }
        return $returnField;
    }

    //get list users
    public function getList($limit,$id){
        
        $this->db->select('u.id, u.grp_id, u.mod_id, u.submod_id, u.user_code, u.authority, u.login, u.avail_flg, u.avatar, u.modified, ut.id utId, ut.name, utm.id mId');
        $this->db->from('users u');
        $this->db->join('user_types ut', 'ut.id = u.grp_id', 'left');
        $this->db->join('user_type_modules utm', 'utm.id = u.mod_id', 'left');
        //$this->db->where('u.avail_flg', 1);
        if($id != ''){
            $this->db->where('u.id', $id);
        }
        $this->db->order_by('u.id', 'ASC');
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

    public function updateUser($id,$data){
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        //echo $this->db->last_query();exit;
        return true;
    }

    public function addNew($data,$tbName){
        $this->db->insert($tbName, $data);
        return true;
    }

}