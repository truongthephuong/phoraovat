<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 18-Sep-17
 * Time: 8:41 PM
 */

class preOrders_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function createOrder($data) {
        if ($this->db->insert('pre_orders', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getCartNumber($clientCart) {
        return $this->db
            ->where('transaction', $clientCart)
            ->count_all_results('pre_orders');
    }

    public function getOrderInfo($transactionId) {
        $this->db->select('*');
        $this->db->where('transaction', $transactionId);
        $query = $this->db->get('pre_orders');
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

        if ($CI->db->update('pre_orders')) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteOrder($transactionId, $pId) {
        $tbName = 'pre_orders';
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
        $CI->db->from('pre_orders');
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

    public function moveOrderInfo ($transactionId, $orderId) {
        $this->db->select('product_id, quantity, price');
        $this->db->where('transaction', $transactionId);
        $query = $this->db->get('pre_orders');
        $datas = $query->result_array();

        if (count($datas) != NULL) {
            //Insert data from pre_order to order table
            foreach ($datas as $item) {
                $this->db->set('transaction', $transactionId);
                $this->db->set('product_id', $item['product_id']);
                $this->db->set('quantity', $item['quantity']);
                $this->db->set('price', $item['price']);
                $this->db->set('order_id', $orderId);
                $this->db->insert('orders');
            }

           //Delete data of pre_order table with transaction id parameter
            $this->db->delete('pre_orders', array('transaction' => $transactionId));
        }
    }

}