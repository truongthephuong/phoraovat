<?php
/**
 * Created by PhpStorm.
 * User: PhuongTruong
 * Date: 8/25/2016
 * Time: 4:36 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
include_once( APPPATH.'libraries/baseController.php' );
class Products extends baseController{

    function Products() {
        parent::baseController();
        $CI = & get_instance();
        $CI->load->helper(array('url','security','form','admin'));
        $CI->load->library(array('session','pagination'));
        $CI->load->database();
        //print_r ($this->leftNaviba());exit;
    }

    public function list_cate(){
        $this->session->set_userdata('last_page', base_url(uri_string()));
        $this->_list_cate();
    }

    //edit news category action
    public function cateEdit($id, $curPage = 0){
        $this->session->set_userdata('last_page', base_url(uri_string()));
        $this->_cateEdit($id, $curPage = 0);
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

    public function list_subcate($pageNum=1){

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
            $config["base_url"] = base_url().'admin/products/list_subcate/';
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

            if($CI->uri->segment(4)){
                $start = $CI->uri->segment(4)*$config["per_page"] - ( $config["per_page"] - 1);
            }

            $lstProd = $CI->subcategories_model->getListCategories($config["per_page"],$start,'');
            $str_links = $CI->pagination->create_links();
            $data["paginations"] = explode('&nbsp;',$str_links );
            $data['lstProd'] = $lstProd;
            $data['curPage'] = $CI->pagination->cur_page;
            $this->load->view('/admin/main',$data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    //edit news sub category action
    public function subCateEdit($id, $curPage = 0){
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

                $currentPage = $CI->input->post('curPage');

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
                    $urlRedirect = base_url().'admin/products/list_subcate/'.$currentPage;
                    redirect($urlRedirect);
                }
            }else{
                $data['curPage'] = $curPage;
                $data['subview'] = '/admin/products/frmsubcate';
                $data['title'] = 'Admin Home Page - Edit Sub Categories';
                $data['errors'] = $errors;
                $data['uID'] = $id;
                $data['caption'] = 'Chỉnh sửa danh mục con';
                $data['arrOpt'] = $arrOpt;

                $detailCate = $CI->subcategories_model->getDetail($id);

                $data['name'] = $detailCate->name;
                $data['rank'] = $detailCate->rank;
                $data['status'] = $detailCate->status;
                $data['cate_id'] = $detailCate->cate_id;
                $data['icon'] = $detailCate->icon;

                $this->load->view('/admin/main', $data);
            }
        } else {
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
                    redirect('admin/products/list_subcate');
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

    public function list_subcate1(){
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

            if($CI->uri->segment(4)){
                $start = $CI->uri->segment(4)*$config["per_page"] - ( $config["per_page"] - 1);
            }

            $lstProd = $CI->sub2categories_model->getListCategories($config["per_page"],$start,'');
            $str_links = $CI->pagination->create_links();
            $data["paginations"] = explode('&nbsp;',$str_links );
            $data['lstProd'] = $lstProd;
            $data['curPage'] = $CI->pagination->cur_page;
            $this->load->view('/admin/main',$data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    //edit news sub category action
    public function subCateEdit1($id, $curPage = 0){
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
                $currentPage = $CI->input->post('curPage');

                if($CI->sub2categories_model->updateSubCate($id,$arrData)){
                    redirect(base_url().'admin/news/list_subcate1/'.$currentPage);
                }
            }else{
                $data['subview'] = '/admin/products/frmsubcate1';
                $data['title'] = 'Admin Home Page - Edit Sub Categories';
                $data['errors'] = $errors;
                $data['uID'] = $id;
                $data['caption'] = 'Chỉnh sửa danh mục con';
                $data['arrOpt'] = $arrOpt;
                $data['arrSubOpt'] = $arrSubOpt;
                $data['curPage'] = $curPage;

                $lstCate = $CI->sub2categories_model->getList($id);
                //$data['lstCate'] = $lstCate;
                foreach($lstCate as $cate){
                    $data['name'] = $cate->name;
                    $data['icon'] = $cate->icon;
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

    public function list_product(){
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $data['subview'] = '/admin/products/list_product';
            $data['title'] = 'Phunu24h.com->Danh sách sản phẩm ';

            $CI = & get_instance();
            $CI->load->model('products_model');

            $pageNum = 0;
            //Config for paging
            $total_row = $CI->products_model->record_count();
            // Initialize empty array.
            $config = array();
            // Set base_url for every links
            $config["base_url"] = base_url().'admin/products/list_product/';
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

            $lstProd = $CI->products_model->getListProd($config["per_page"],$start,'');
            $str_links = $CI->pagination->create_links();
            $data["paginations"] = explode('&nbsp;',$str_links );
            $data['lstProd'] = $lstProd;
            $this->load->view('/admin/main',$data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    public function productEdit($id){
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('products_model');
            $CI->load->model('categories_model');
            $CI->load->model('subcategories_model');
            $CI->load->model('sub2categories_model');
            $errors = '';

            if($CI->input->post('saveEdit')){
                $arrData =array(
                    'title'  => $CI->input->post('name'),
                    'cate_id' => $CI->input->post('cate_id'),
                    'subcate_id' => $CI->input->post('subcate_id'),
                    'subcate1_id' => $CI->input->post('subcate1_id'),
                    'description' => $CI->input->post('description'),
                    'detail' => $CI->input->post('content'),
                    'price' => $CI->input->post('price'),
                    'promo' => $CI->input->post('promo'),
                    'style' => $CI->input->post('prodStyle'),
                    'status'    =>  ($CI->input->post('status') == 'on') ? 1 : 0,
                    'rank'  =>  $CI->input->post('rank')
                );

                if($_FILES['img']['name']){
                    $arrData['image'] = $_FILES['img']['name'];
                    $config['upload_path']          = 'upload/products/';
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
                // echo '<pre>';
                // var_dump($arrData);die;
                if($CI->products_model->updateProductById($id,$arrData)){
                    redirect(base_url() . 'admin/products/list_product');
                }
            }else {
                $data['subview'] = '/admin/products/frmproduct';
                $data['title'] = 'Admin Home Page - Edit Product';
                $data['errors'] = $errors;
                $data['uID'] = $id;
                $data['caption'] = 'Edit product';

                $lstProd = $CI->products_model->getDetail($id);
                $arrOpt = $CI->getOpt('categories_model','getAllCategories');
                $arrSubOpt = $CI->getOptEdit('subcategories_model','getSubCateWhere', $lstProd[0]->cate_id);
                $arrSubOpt[0] = '-- Select Sub Category --';
                $arrSubOpt1 = $CI->getOptEdit('sub2categories_model','getSubCateWhere', $lstProd[0]->subcate_id);
                //$data['lstCate'] = $lstCate;
                $data['arrOpt'] = $arrOpt;
                $data['arrSubOpt'] = $arrSubOpt;
                $data['arrSubOpt1'] = $arrSubOpt1;
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
                    $data['cate_id'] = $prod->cate_id;
                    $data['subcate_id'] = $prod->subcate_id;
                    $data['subcate1_id'] = $prod->subcate1_id;
                    $data['prodStyle'] = $prod->style;
                }
                // echo '<pre>';
                // var_dump($arrSubOpt);die;
                $this->load->view('/admin/main', $data);
            }
        }else{
            redirect(base_url().'admin/');
        }
    }

    public function addNew(){
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('products_model');
            $CI->load->model('categories_model');
            $CI->load->model('subcategories_model');
            $CI->load->model('sub2categories_model');
            $errors = '';
            $arrOpt = $CI->getOpt('categories_model','getAllCategories');
            $arrSubOpt = $CI->getOpt('subcategories_model','getAllCategories');
            $arrSubOpt[0] = '-- Select Sub Category --';
            $arrSubOpt1 = $CI->getOpt('sub2categories_model','getAllCategories');

            if($CI->input->post('getSubCate')){

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
                    'cate_id' => $CI->input->post('cate_id'),
                    'subcate_id' => $CI->input->post('subcate_id'),
                    'subcate1_id' => $CI->input->post('subcate1_id'),
                    'description'     =>  $CI->input->post('description'),
                    'detail'  => $CI->input->post('detail'),
                    'price' => $CI->input->post('price'),
                    'promo' => $CI->input->post('promo'),
                    'style' => $CI->input->post('prodStyle'),
                    'status'    =>  ($CI->input->post('status') == 'on') ? 1 : 0,
                    'rank'  =>  $CI->input->post('rank'),
                    'style' => $CI->input->post('style')
                );

                if($_FILES['img']['name']){
                    $arrData['image'] = $_FILES['img']['name'];
                    $config['upload_path']          = 'upload/products/';
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
                    redirect(base_url() . 'admin/products/list_product');
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

    public function ajaxChange(){
        $CI = & get_instance();
        //echo 'getSubCate'.$CI->input->post('getSubCate');exit;
        if($CI->input->post('getSubCate')){

            //$CI = & get_instance();
            $CI->load->model('subcategories_model');
            $arrOpt = $CI->subcategories_model->getSubCateWhere($CI->input->post('getSubCate'));
            echo  json_encode($arrOpt);exit;
        }

        if($CI->input->post('getSub2Cate')){

            $CI->load->model('sub2categories_model');
            $arrOpt = $CI->sub2categories_model->getSubCateWhere($CI->input->post('getSub2Cate'));
            echo  json_encode($arrOpt);exit;
        }
    }

    public function changeStatus($id = '',$curStatus, $models){
        //echo 'ajax function '.$id.' and '.$curStatus.' and '.$models;exit;
        $curStatus = ( $curStatus == 1 ) ? 0 : 1;
        $CI = & get_instance();
        $arrData = array('status' => $curStatus);

        switch ($models) {
            case 'cate':
                $CI->load->model('categories_model');
                $CI->categories_model->updateCate($id,$arrData);
                break;
            case 'subCate':
                $CI->load->model('subcategories_model');
                $CI->subcategories_model->updateSubCate($id,$arrData);
                break;
            case 'subCate2':
                $CI->load->model('sub2categories_model');
                $CI->sub2categories_model->updateSubCate($id,$arrData);
                break;
            case 'products':
                $CI->load->model('products_model');
                $CI->products_model->updateProductById($id,$arrData);
                break;
        }
        die;
    }

}