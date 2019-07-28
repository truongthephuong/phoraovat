<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once( APPPATH.'libraries/baseController.php' );

class Ajaxcall extends baseController {
	public function Ajaxcall() {
        parent::baseController();
        // $CI = & get_instance();
        $this->load->helper(array('url','security','form','admin'));
        $this->load->library(array('session'));
        $this->load->database();
        $this->load->model('categories_model');
		$this->load->model('subcategories_model');
		$this->load->model('sub2categories_model');
		$this->load->model('products_model');
    }

    public function index () {
    	echo 'Ajax index';die;
    }

    public function getCateOpt() {
        $CI = & get_instance();
        if($CI->input->post('getCate')){
            //echo 'Here Phuong ' .$CI->input->post('getSubCate');die;
            // $CI->load->model('categories_model');
            $arrOpt = $CI->categories_model->getCateWhere($CI->input->post('getCate'));
            echo json_encode($arrOpt);
            exit;
        }
    }

    public function getSubCateList() {
        $CI = & get_instance();
        if($CI->input->post('getSubCate')){
            // echo 'Here Phuong ' .$CI->input->post('getSubCate');die;
            //$CI->load->model('subcategories_model');
            $arrOpt = $CI->subcategories_model->getSubCateWhere($CI->input->post('getSubCate'));
            echo json_encode($arrOpt);
            exit;
        }
    }

    public function getSubCateOpt2() {
        $CI = & get_instance();
        if($CI->input->post('subCategory')){
            $arrOpt = $CI->sub2categories_model->getSubCateWhere($CI->input->post('subCategory'));
            echo json_encode($arrOpt);
            exit;
        }
    }

    public function getServices() {
        $CI = & get_instance();
        //echo 'Here Phuong ' .$CI->input->post('category') . ' and ' . $CI->input->post('subCategory');die;
        if ($CI->input->post('subCategory')) {
            //$CI->load->model('products_model');
            $arrOptService = $CI->products_model->getProductWhere($CI->input->post('category'), $CI->input->post('subCategory'));
            echo json_encode($arrOptService);exit;
        }
    }
}