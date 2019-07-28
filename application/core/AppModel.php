<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppModel extends CI_Model {

    protected $_tablename = '';
    protected $_primary_key = 'id';
    private $_loaded = FALSE;
    protected $_numrow = 0;
    protected $_conditions = null;

    //Constant
    const STATUS_TRUE  = 1;
    const STATUS_FALSE = 0;
    
    //Delete flag.
    const DELETE_FLAG_TRUE  = 1;
    const DELETE_FLAG_FLASE = 0;

    /**
     * Constructor
     *
     * @access public
     */
    function AppModel($id = NULL){
        parent::__construct();
        if(empty($this->_tablename))
            $this->_tablename = strtolower(get_class($this));
        
        if(!is_null($id)){
            $this->set_id($id);
            $this->get();
        }
        
        log_message('debug', "AppModel Class Initialized");
    }
    
    function get(){
        if(empty($this->{$this->_primary_key})){
            $this->_loaded = FALSE;
            return $this->is_loaded();
        }
        
        $this->db->where($this->_primary_key, $this->{$this->_primary_key});
        $res = $this->db->get($this->_tablename);
        if($res->num_rows() > 0){
            $row = $res->row_array();
            $this->_field_mapping($row);
            $this->_loaded = TRUE;
        }else{
            $this->_loaded = FALSE;
        }
        return $this->is_loaded();
    }
    
    function get_id() {
	    // fix issue undefined property for primary key once
	    // try to save data without set primary key null
	    if ( ! isset($this->{$this->_primary_key}) ) {
		    $this->set_id(NULL);
	    }

        return $this->{$this->_primary_key};
    }
    
    function set_id($id) {
        $this->{$this->_primary_key} = (int) $id;

        return $this;
    }
    
    function delete(){
        $this->db->where($this->_primary_key, $this->{$this->_primary_key});
        $this->db->delete($this->_tablename);
    }
    
    function get_lists($conditions = NULL, $limit = NULL, $offset = NULL, $order_by = NULL, $order_type=0, $select='*'){

        $this->_numrow = 0;

	    if( ! empty($conditions) ) {
            $this->_conditions = $conditions;
		    $this->db->where($conditions);
	    }

	    if ( $limit ) {
		    $this->db->limit($limit);
	    }

	    if ( $offset ) {
		    $this->db->offset($offset);
	    }

	    if( ! is_null($order_by) ) {
		    if(is_string($order_by))
			    $order_by = array($order_by => $order_type);

		    foreach($order_by as $s => $t)
			    $this->db->order_by($this->sort_field($s), $this->sort_type($t));

	    }

	    $this->db->select($select);
	    $query = $this->db->get($this->_tablename);
	    $this->_numrow = $query->num_rows();

	    if(empty($this->_mapping)){
		    return $query->result();
	    } else {
		    $items = array();
		    foreach($query->result() as $item){
			    foreach($this->_mapping as $map)
				    $item->{key($map)} = $item->{current($map)};
			    $items[] = $item;
		    }

		    return $items;
	    }

        return array();
    }
    
    function is_loaded(){
        return $this->_loaded;
    }
    
    function get_numrows($conditions = null) {
        if ($conditions) {
            $this->_conditions = $conditions;
        }

        if ($this->_conditions) {
            $this->db->from($this->_tablename);
            $this->db->where($this->_conditions);
            $this->_numrow = $this->db->count_all_results();
        }

        return $this->_numrow;
    }
    
    function save($data){
        if (!$data) {
            return false;
        }

        $this->db->set($data);

        if($this->get_id()) {
            $this->db->where($this->_primary_key, $this->{$this->_primary_key});
            return $this->db->update($this->_tablename);
        } else {
            return $this->db->insert($this->_tablename);
        }
    }
    
    public function sort_field($idx = NULL){
        if(is_null($idx))
            return $this->_primary_key;

        if(empty($this->_mapping))
            return $idx;

        $idx = strtolower($idx);
        foreach($this->_mapping as $m)
            if(key($m) == $idx)
                return current($m);

        return $this->_primary_key;
    }
    
    public function sort_type($idx=0){
        return $idx==1?' DESC ':' ASC ';
    }
    
    function _field_mapping($row){
        foreach($row as $k=>$v)
            $this->{$k} = $v;
        if(!empty($this->_mapping)){
            foreach($this->_mapping as $map){
                if(current($map) == $this->_primary_key)
                    $this->set_id($row[current($map)]); 
                $this->{key($map)} = $row[current($map)];
            }
        }
    }

    function switch_status($id, $field){
        $this->set_id($id);
        if(!$this->get()){
            return '';
        }

        if(!empty($this->_mapping)){
            foreach($this->_mapping as $m){
                $key = array_search($field, $m);
                if($key!==FALSE){
                    $current_status = $this->{key($m)};
                    $new_status = ($current_status=='1')?'0':'1';
                    $this->save(array(current($m) => $new_status));
                    break;
                }
            }
        }else{
            $current_status = $this->$field;
            $new_status = ($current_status=='1')?'0':'1';
            $this->save(array($field => $new_status));
        }
        return $new_status;
    }

    public function set_table_name($table_name) {
      $this->_tablename = $table_name;
    }

   
}
