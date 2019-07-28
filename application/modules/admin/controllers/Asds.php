<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 7/27/2019
 * Time: 9:43 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
include_once( APPPATH.'libraries/baseController.php' );
class Asds extends baseController {
    function Asds() {
        parent::baseController();
        $CI = & get_instance();
        $this->load->helper(array('url','security','form','admin'));
        $this->load->library(array('session', 'pagination'));
        $this->load->database();
        //print_r ($this->leftNaviba());exit;
    }

    //List products/asds function
    public function list_product($pageNum = 1){

        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $data['subview'] = '/admin/products/list_product';
            $data['title'] = 'PhoRaoVat.Net/Danh sách tin rao ';

            $CI = & get_instance();
            $CI->load->model('admin_model');

            $pageNum = 0;
            //Config for paging
            $total_row = $CI->admin_model->record_count();
            // Initialize empty array.
            $config = array();
            // Set base_url for every links
            $config["base_url"] = base_url().'admin/list_product/';
            // Set total rows in the result set you are creating pagination for.
            $config["total_rows"] = $total_row;
            // Number of items you intend to show per page.
            $config["per_page"] = 20;
            // Use pagination number for anchor URL.
            $config['use_page_numbers'] = TRUE;
            //Set that how many number of pages you want to view.
            $config['num_links'] = 5;
            // Open tag for CURRENT link.
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            // Close tag for CURRENT link.
            $config['cur_tag_close'] = '</a>';
            // By clicking on performing NEXT pagination.
            $config['next_link'] = 'Next';
            // By clicking on performing PREVIOUS pagination.
            $config['prev_link'] = 'Previous';
            // To initialize "$config" array and set to pagination library.
            $CI->pagination->initialize($config);

            $start = $pageNum;

            if($CI->uri->segment(4)){
                $start = $CI->uri->segment(4)*$config["per_page"] - ( $config["per_page"] - 1);
            }

            $lstProd = $CI->admin_model->getListProd($config["per_page"],$start,'');
            $str_links = $CI->pagination->create_links();
            $data["paginations"] = explode('&nbsp;',$str_links );
            $data['lstProd'] = $lstProd;

            $this->load->view('/admin/main',$data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    //Edit products/asds function
    public function productEdit($id){
        $CI = & get_instance();
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $CI->load->model('admin_model');
            $CI->load->model('categories_model');
            $CI->load->model('subcategories_model');
            $CI->load->model('sub2categories_model');
            $errors = '';
            $arrOpt = $CI->getOpt('categories_model','getAllCategories');
            $arrSubOpt = $CI->getOpt('subcategories_model','getAllCategories');
            $arrSubOpt[0] = '-- Select Sub Category --';
            $arrSubOpt1 = $CI->getOpt('sub2categories_model','getAllCategories');

            if($CI->input->post('saveEdit')){
                $arrData =array(
                    'name'  => $CI->input->post('name'),
                    'fcate_id' => $CI->input->post('fcate_id'),
                    'cate_id' => $CI->input->post('cate_id'),
                    'subcate_id' => $CI->input->post('subcate_id'),
                    'status'    =>  ($CI->input->post('status') == 'on') ? 1 : 0,
                    'rank'  =>  $CI->input->post('rank')
                );

                if($CI->admin_model->updateProduct($id,$arrData)){
                    redirect('admin/list_product');
                }
            }else {
                $data['subview'] = '/admin/products/frmproduct';
                $data['title'] = 'Admin Home Page - Edit Product';
                $data['errors'] = $errors;
                $data['uID'] = $id;
                $data['caption'] = 'Edit product';
                $data['arrOpt'] = $arrOpt;
                $data['arrSubOpt'] = $arrSubOpt;
                $data['arrSubOpt1'] = $arrSubOpt1;

                if($CI->input->post('getSubCate')){
                    //echo $CI->input->post('getSubCate');die;
                    $CI->load->model('subcategories_model');
                    $arrOpt = $CI->subcategories_model->getSubCateWhere($CI->input->post('getSubCate'));
                    echo  json_encode($arrOpt);exit;
                }

                if($CI->input->post('getSub2Cate')){
                    //echo 'getSubCate'.$CI->input->post('getSubCate');exit;
                    //$CI = & get_instance();
                    $CI->load->model('sub2categories_model');
                    $arrOpt = $CI->sub2categories_model->getSubCateWhere($CI->input->post('getSub2Cate'));
                    echo  json_encode($arrOpt);exit;
                }

                $lstProd = $CI->admin_model->getDetail($id);
                //$data['lstCate'] = $lstCate;
                foreach ($lstProd as $prod) {
                    $data['name'] = $prod->title;
                    $data['description'] = $prod->description;
                    $data['detail'] = $prod->detail;
                    $data['price'] = $prod->price;
                    $data['promo'] = $prod->promo;
                    $data['image'] = $prod->image;
                    $data['created'] = $prod->created;
                    $data['rank'] = $prod->rank;
                    $data['status'] = $prod->status;
                    $data['fcate_id'] = $prod->fcate_id;
                    $data['cate_id'] = $prod->cate_id;
                    $data['subcate_id'] = $prod->subcate_id;
                }
                $this->load->view('/admin/main', $data);
            }
        }else{
            redirect(base_url().'admin/');
        }
    }

    //Add new products/asds function
    public function addNew(){
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('asds_model');
            $CI->load->model('categories_model');
            $CI->load->model('subcategories_model');
            $CI->load->model('sub2categories_model');
            $errors = '';
            $arrOpt = $CI->getOpt('categories_model','getAllCategories');
            $arrSubOpt = $CI->getOpt('subcategories_model','getAllCategories');
            $arrSubOpt[0] = '-- Select Sub Category --';
            $arrSubOpt1 = $CI->getOpt('sub2categories_model','getAllCategories');

            if($CI->input->post('getSubCate')){
                echo $CI->input->post('getSubCate');die;
                $CI->load->model('subcategories_model');
                $arrOpt = $CI->subcategories_model->getSubCateWhere($CI->input->post('getSubCate'));
                echo  json_encode($arrOpt);exit;
            }

            if($CI->input->post('getSub2Cate')){
                //echo 'getSubCate'.$CI->input->post('getSubCate');exit;
                //$CI = & get_instance();
                $CI->load->model('sub2categories_model');
                $arrOpt = $CI->sub2categories_model->getSubCateWhere($CI->input->post('getSub2Cate'));
                echo  json_encode($arrOpt);exit;
            }

            if($CI->input->post('saveEdit')){
                $arrData =array(
                    'name'  => $CI->input->post('title'),
                    'fcate_id' => $CI->input->post('fcate_id'),
                    'cate_id' => $CI->input->post('cate_id'),
                    'subcate_id' => $CI->input->post('subcate_id'),
                    'description'     =>  $CI->input->post('description'),
                    'detail'  => $CI->input->post('detail'),
                    'status'    =>  ($CI->input->post('status') == 'on') ? 1 : 0,
                    'rank'  =>  $CI->input->post('rank')
                );

                if($_FILES['img']['name']){
                    $arrData['image'] = $_FILES['img']['name'];
                    $config['upload_path']          = 'upload/product/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 100;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 768;

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('img')){

                        $data['subview'] = 'admin/products/frmproduct';
                        $data['title'] = 'Admin Home Page - Add New Product';
                        $data['errors'] = $this->upload->display_errors();
                        $this->load->view('/admin/main', $data);

                    }
                }

                if($CI->products_model->addNew('products',$arrData)){
                    redirect('admin/news/list_product');
                }
            }
            $data['subview'] = '/admin/products/frmproduct';
            $data['title'] = 'Admin Home Page - Add New Product';
            $data['errors'] = $errors;
            $data['addNew'] = 'addNew';
            $data['caption'] = 'Add New Product';
            $data['arrOpt'] = $arrOpt;
            $data['arrSubOpt'] = $arrSubOpt;
            $data['arrSubOpt1'] = $arrSubOpt1;

            $this->load->view('/admin/main', $data);

        }else{
            redirect(base_url().'admin/');
        }
    }

    public function list_cate($pageNum = 1){

        $this->session->set_userdata('last_page', base_url(uri_string()));
        $this->_list_cate($pageNum = 1);
    }

    //edit news category action
    public function cateEdit($id){
        $this->session->set_userdata('last_page', base_url(uri_string()));
        $this->_cateEdit($id);
    }

    public function addCate(){
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('categories_model');
            $errors = '';

            if($CI->input->post('saveEdit')){
                $arrData =array(
                    'name'  => $CI->input->post('name'),
                    'status'    =>  ($CI->input->post('status') == 'on') ? 1 : 0,
                    'rank'  =>  $CI->input->post('rank')
                );

                if($_FILES['img']['name']){
                    $arrData['icon'] = $_FILES['img']['name'];
                    $config['upload_path']          = 'upload/icons/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 100;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 768;

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('img')){

                        $data['subview'] = 'admin/products/editCate';
                        $data['title'] = 'Admin Home Page - Edit Category';
                        $data['errors'] = $this->upload->display_errors();
                        $this->load->view('/admin/main', $data);

                    }
                }

                if($CI->categories_model->addNew($id,$arrData)){
                    redirect('admin/list_cate');
                }
            }else{
                $data['subview'] = '/admin/products/frmcate';
                $data['title'] = 'Admin Home Page - Add New Categories';
                $data['caption'] = 'Thêm mới danh mục';
                $data['errors'] = $errors;
                $data['addNew'] = true;

                $this->load->view('/admin/main', $data);
            }
        }else{
            redirect(base_url().'admin/');
        }
    }

    public function list_subcate($pageNum = 1){

        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $data['subview'] = '/admin/products/list_subcate';
            $data['title'] = 'Phunu24h.com->Danh mục sản phẩm con';

            $CI = & get_instance();
            $CI->load->model('subcategories_model');

            $pageNum = 0;
            //Config for paging
            $total_row = $CI->subcategories_model->record_count();
            // Initialize empty array.
            $config = array();
            // Set base_url for every links
            $config["base_url"] = base_url().'admin/list_subcate/';
            // Set total rows in the result set you are creating pagination for.
            $config["total_rows"] = $total_row;
            // Number of items you intend to show per page.
            $config["per_page"] = 10;
            // Use pagination number for anchor URL.
            $config['use_page_numbers'] = TRUE;
            //Set that how many number of pages you want to view.
            $config['num_links'] = 5;
            // Open tag for CURRENT link.
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            // Close tag for CURRENT link.
            $config['cur_tag_close'] = '</a>';
            // By clicking on performing NEXT pagination.
            $config['next_link'] = 'Next';
            // By clicking on performing PREVIOUS pagination.
            $config['prev_link'] = 'Previous';
            // To initialize "$config" array and set to pagination library.
            $CI->pagination->initialize($config);

            $start = $pageNum;

            if($CI->uri->segment(3)){
                $start = $CI->uri->segment(4)*$config["per_page"] - ( $config["per_page"] - 1);
            }

            $lstProd = $CI->subcategories_model->getListCategories($config["per_page"],$start,'');
            $str_links = $CI->pagination->create_links();
            $data["paginations"] = explode('&nbsp;',$str_links );
            $data['lstProd'] = $lstProd;
            $this->load->view('/admin/main',$data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    //edit news sub category action
    public function subCateEdit($id){
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('subcategories_model');
            $errors = '';
            $arrOpt = $CI->getOpt('categories_model','getAllCategories');

            if($CI->input->post('saveEdit')){
                $arrData =array(
                    'name'  => $CI->input->post('name'),
                    'cate_id' => $CI->input->post('cate_id'),
                    'status'    =>  ($CI->input->post('status') == 'on') ? 1 : 0,
                    'rank'  =>  $CI->input->post('rank')
                );
                if($_FILES['img']['name']){
                    $arrData['icon'] = $_FILES['img']['name'];
                    $config['upload_path']          = 'upload/icons/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 100;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 768;

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('img')){

                        $data['subview'] = 'admin/products/editCate';
                        $data['title'] = 'Admin Home Page - Edit Category';
                        $data['errors'] = $this->upload->display_errors();
                        $this->load->view('/admin/main', $data);

                    }
                }

                if($CI->subcategories_model->updateSubCate($id,$arrData)){
                    redirect('admin/list_subcate');
                }
            }else{
                $data['subview'] = '/admin/products/frmsubcate';
                $data['title'] = 'Admin Home Page - Edit Sub Categories';
                $data['errors'] = $errors;
                $data['uID'] = $id;
                $data['caption'] = 'Chỉnh sửa danh mục con';
                $data['arrOpt'] = $arrOpt;


                $lstCate = $CI->subcategories_model->getList($id);
                //$data['lstCate'] = $lstCate;
                foreach($lstCate as $cate){
                    $data['name'] = $cate->name;
                    $data['rank'] = $cate->rank;
                    $data['status'] = $cate->status;
                    $data['cate_id'] = $cate->cate_id;
                }
                $this->load->view('/admin/main', $data);
            }
        }else{

            redirect(base_url().'admin/');
        }
    }

    public function addSubCate(){
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('subcategories_model');
            $errors = '';
            $arrOpt = $CI->getOpt('categories_model','getAllCategories');

            if($CI->input->post('saveEdit')){
                $arrData =array(
                    'name'  => $CI->input->post('name'),
                    'cate_id' => $CI->input->post('cate_id'),
                    'status'    =>  ($CI->input->post('status') == 'on') ? 1 : 0,
                    'rank'  =>  $CI->input->post('rank')
                );

                if($CI->subcategories_model->addNew($id,$arrData)){
                    redirect('admin/list_subcate');
                }

            }else{
                $data['subview'] = '/admin/products/frmsubcate';
                $data['title'] = 'Admin Home Page - Add New Categories';
                $data['caption'] = 'Thêm mới danh mục con';
                $data['errors'] = $errors;
                $data['addNew'] = true;
                $data['arrOpt'] = $arrOpt;

                $this->load->view('/admin/main', $data);
            }
        }else{
            redirect(base_url().'admin/');
        }
    }

    public function list_subcate1($pageNum = 1){

        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $data['subview'] = '/admin/products/list_subcate1';
            $data['title'] = 'Phunu24h.com->Danh mục sản phẩm con';

            $CI = & get_instance();
            $CI->load->model('sub2categories_model');

            $pageNum = 0;
            //Config for paging
            $total_row = $CI->sub2categories_model->record_count();
            // Initialize empty array.
            $config = array();
            // Set base_url for every links
            $config["base_url"] = base_url().'admin/products/list_subcate1/';
            // Set total rows in the result set you are creating pagination for.
            $config["total_rows"] = $total_row;
            // Number of items you intend to show per page.
            $config["per_page"] = 10;
            // Use pagination number for anchor URL.
            $config['use_page_numbers'] = TRUE;
            //Set that how many number of pages you want to view.
            $config['num_links'] = 5;
            // Open tag for CURRENT link.
            $config['cur_tag_open'] = '&nbsp;<a class="current">';
            // Close tag for CURRENT link.
            $config['cur_tag_close'] = '</a>';
            // By clicking on performing NEXT pagination.
            $config['next_link'] = 'Next';
            // By clicking on performing PREVIOUS pagination.
            $config['prev_link'] = 'Previous';
            // To initialize "$config" array and set to pagination library.
            $CI->pagination->initialize($config);

            $start = $pageNum;

            if($CI->uri->segment(3)){
                $start = $CI->uri->segment(4)*$config["per_page"] - ( $config["per_page"] - 1);
            }

            $lstProd = $CI->sub2categories_model->getListCategories($config["per_page"],$start,'');
            $str_links = $CI->pagination->create_links();
            $data["paginations"] = explode('&nbsp;',$str_links );
            $data['lstProd'] = $lstProd;
            $this->load->view('/admin/main',$data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    //edit news sub category action
    public function subCateEdit1($id){
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('categories_model');
            $CI->load->model('subcategories_model');
            $CI->load->model('sub2categories_model');
            $errors = '';
            $arrOpt = $CI->getOpt('categories_model','getAllCategories');
            $arrSubOpt = $CI->getOpt('subcategories_model','getAllCategories');
            $arrSubOpt[0] = '-- Select Sub Category --';

            if($CI->input->post('saveEdit')){
                $arrData =array(
                    'name'  => $CI->input->post('name'),
                    'cate_id' => $CI->input->post('cate_id'),
                    'subcate_id' => $CI->input->post('subcate_id'),
                    'status'    =>  ($CI->input->post('status') == 'on') ? 1 : 0,
                    'rank'  =>  $CI->input->post('rank')
                );

                if($CI->sub2categories_model->updateSubCate($id,$arrData)){
                    redirect('admin/list_subcate');
                }
            }else{
                $data['subview'] = '/admin/products/frmsubcate1';
                $data['title'] = 'Admin Home Page - Edit Sub Categories';
                $data['errors'] = $errors;
                $data['uID'] = $id;
                $data['caption'] = 'Chỉnh sửa danh mục con';
                $data['arrOpt'] = $arrOpt;
                $data['arrSubOpt'] = $arrSubOpt;


                $lstCate = $CI->sub2categories_model->getList($id);
                //$data['lstCate'] = $lstCate;
                foreach($lstCate as $cate){
                    $data['name'] = $cate->name;
                    $data['rank'] = $cate->rank;
                    $data['status'] = $cate->status;
                    $data['cate_id'] = $cate->cate_id;
                    $data['subcate_id'] = $cate->subcate_id;
                }
                $this->load->view('/admin/main', $data);
            }
        }else{

            redirect(base_url().'admin/');
        }

        if($CI->input->post('getSubCate')){
            //echo 'getSubCate'.$CI->input->post('getSubCate');exit;
            $CI = & get_instance();
            $CI->load->model('subcategories_model');
            $arrOpt = $CI->subcategories_model->getSubCateWhere($CI->input->post('getSubCate'));
            echo  json_encode($arrOpt);exit;
        }

        if($CI->input->post('getSub2Cate')){
            //echo 'getSubCate'.$CI->input->post('getSubCate');exit;
            $CI = & get_instance();
            $CI->load->model('sub2categories_model');
            $arrOpt = $CI->sub2categories_model->getSubCateWhere($CI->input->post('getSub2Cate'));
            echo  json_encode($arrOpt);exit;
        }

    }

    public function addSubCate1(){
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('categories_model');
            $CI->load->model('subcategories_model');
            $CI->load->model('sub2categories_model');
            $errors = '';
            $arrOpt = $CI->getOpt('categories_model','getAllCategories');
            $arrSubOpt = $CI->getOpt('subcategories_model','getAllCategories');
            $arrSubOpt[0] = '-- Select Sub Category --';

            if($CI->input->post('saveEdit')){
                $arrData =array(
                    'name'  => $CI->input->post('name'),
                    'cate_id' => $CI->input->post('cate_id'),
                    'subcate_id' => $CI->input->post('subcate_id'),
                    'status'    =>  ($CI->input->post('status') == 'on') ? 1 : 0,
                    'rank'  =>  $CI->input->post('rank')
                );

                if($CI->sub2categories_model->addNew($id,$arrData)){
                    redirect('admin/list_subcate');
                }

            }else{
                $data['subview'] = '/admin/products/frmsubcate1';
                $data['title'] = 'Admin Home Page - Add New Categories';
                $data['caption'] = 'Thêm mới danh mục con';
                $data['errors'] = $errors;
                $data['addNew'] = true;
                $data['arrOpt'] = $arrOpt;
                $data['arrSubOpt'] = $arrSubOpt;

                $this->load->view('/admin/main', $data);
            }
        }else{
            redirect(base_url().'admin/');
        }

        if($CI->input->post('getSubCate')){
            //echo 'getSubCate'.$CI->input->post('getSubCate');exit;
            $CI = & get_instance();
            $CI->load->model('subcategories_model');
            $arrOpt = $CI->subcategories_model->getSubCateWhere($CI->input->post('getSubCate'));
            echo  json_encode($arrOpt);exit;
        }

        if($CI->input->post('getSub2Cate')){
            //echo 'getSubCate'.$CI->input->post('getSubCate');exit;
            $CI = & get_instance();
            $CI->load->model('sub2categories_model');
            $arrOpt = $CI->sub2categories_model->getSubCateWhere($CI->input->post('getSub2Cate'));
            echo  json_encode($arrOpt);exit;
        }
    }

}