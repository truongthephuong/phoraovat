<?php

class Admin extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $data['subview'] = 'admin/index_view';
        $data['title'] = 'Admin System';
        $this->load->view('admin/main',$data);
    }

    public function add(){
        $data['subview'] = 'admin/addcate_view';
        $data['info'] =  array(
            'name' => 'Phuong Truong - Alex',
            'website' => 'phunu24h.com',
            'email' => 'truongthephuong@gmail.com',
            'phone' => '0909488113',
        );
        $data['title'] = 'Add A Category';
        $this->load->view('admin/main', $data);
    }
}
?>