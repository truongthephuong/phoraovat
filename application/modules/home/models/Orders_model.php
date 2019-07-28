<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18-Sep-17
 * Time: 8:41 PM
 */

class Orders_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function createOrder($data) {
        if ($this->db->insert('orders', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getCartNumber($clientCart) {
        return $this->db
            ->where('transaction', $clientCart)
            ->count_all_results('orders');
    }

    public function getOrderInfo($transactionId) {
        $this->db->select('*');
        $this->db->where('transaction', $transactionId);
        $query = $this->db->get('orders');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function updateOrderQuantity($transactionId, $pId) {
        $CI = & get_instance();
        $CI->db->set('quantity', 'quantity + 1', FALSE);
        $CI->db->where('product_id', $pId);
        $CI->db->where('transaction', $transactionId);

        if ($CI->db->update('orders')) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteOrder($transactionId, $pId) {
        $tbName = 'orders';
        $CI = & get_instance();
        $CI->db->where('product_id', $pId);
        $CI->db->where('transaction', $transactionId);

        if ($CI->db->delete($tbName, array('product_id' => $pId, 'transaction' => $transactionId))) {
            return true;
        } else {
            return false;
        }
    }

    public function finalOrder($transactionId) {

    }

    public function checkExist($pId, $transactionId) {
        $CI = & get_instance();
        $CI->db->select('id');
        $CI->db->from('orders');
        $CI->db->where('product_id', $pId);
        $CI->db->where('transaction', $transactionId);
        $query = $CI->db->get();
        //echo $CI->db->last_query();die;
        if ($query->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

}