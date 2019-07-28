<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Members_model extends CI_Model {

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
        $this->db->select($fieldName);
        $this->db->where('id', $id);
           
        $query = $this->db->get('members');
        return $query->result();
    }

    //get information of user
    public function getUserInfo($mID){
        $CI = & get_instance();
        $returnField = '';
        $this->db->select('mp.id, mp.total_point, mp.max_bid, m.username memName');
        $this->db->from('members m');
        $this->db->join('member_point mp', 'm.id = mp.mem_id', 'left');
        $this->db->where('m.id', $mID);
        //$this->db->order_by('m.id', 'ASC');
        //$query = $this->db->get('users',$limit);
        $query = $this->db->get();
        $results = $query->result();
        foreach($results as $result){
            $returnField = $result;
        }
        return $returnField;
    }

    //get bidding information of member
    public function getMemBidInfo($mID){
        $this->db->select('b.id, b.bid_point, b.bid_num, b.draw_num, br.bid_type');
        $this->db->from('bidding b');
        $this->db->join('bidding_rate br', 'br.id = b.bid_rate', 'left');
        $this->db->where('b.mem_id', $mID);
        //$this->db->order_by('m.id', 'ASC');
        //$query = $this->db->get('users',$limit);
        $query = $this->db->get();
        return $results = $query->result();
    }

    public function changeField($field,$value,$condField,$condValue){
        $this->db->set($field, $value);
        $this->db->where($condField, $condValue);
        $this->db->update('users');
        //echo $this->db->last_query();exit;
    }

    //Update member point table with data input
    public function updateMember($id,$data){
        $this->db->where('id', $id);
        $this->db->update('member_point', $data);
        //echo $this->db->last_query();
        return true;
    }

    //Update point for member with pay point case
    public function updatePoint($id, $newPoint, $winFlag) {
        $this->db->where('mem_id', $id);
        if ($winFlag === 'win') {
            $this->db->set('total_point', 'total_point + ' . $newPoint, FALSE);
        } else {
            $this->db->set('total_point', 'total_point - ' . $newPoint, FALSE);
        }
        $this->db->update('member_point');
       // echo $this->db->last_query();
        return true;
    }

    //add new member
    public function addNew($data,$tbName){
        $this->db->insert($tbName, $data);
        return $this->db->insert_id();
    }

    //get list users
    public function getList($limit,$id){
        $this->db->select('m.id, m.username, m.email, m.created, m.status, md.fullname, md.tell, mp.total_point totalPoint, mp.max_bid maxBid, mp.id memPointId');
        $this->db->from('members m');
        $this->db->join('member_detail md', 'md.mem_id = m.id', 'left');
        $this->db->join('member_point mp', 'mp.mem_id = m.id', 'left');
        //$this->db->where('u.avail_flg', 1);
        if($id != ''){
            $this->db->where('m.id', $id);
        }
        $this->db->order_by('m.id', 'ASC');
        //$query = $this->db->get('users',$limit);
        $query = $this->db->get();
        return $query->result();
    }

    //Update member information
    public function updateMemberInfo($id,$data){
        $this->db->where('id', $id);
        $this->db->update('members', $data);
        //echo $this->db->last_query();
        return true;
    }

}