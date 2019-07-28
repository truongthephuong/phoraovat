<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class baseController extends CI_Controller {

	public function baseController() {
        parent::__construct();
        $CI = & get_instance();
        $CI->load->library(array('session','pagination'));
        $CI->load->database();
    }

    /* config for template*/

    function view($view){
        $this->view = $view;
    }

    protected function getOpt($model,$fncName){
        $data = array();
        $this->load->model($model);
        $query = $this->$model->$fncName();
        return $query;
    }

    protected function getListCate($model,$fncName,$limit,$id){
        $data = array();
        $this->load->model($model);
        $query = $this->$model->$fncName($limit,$id = '');
        return $query;

    }

    protected function convert_vi_to_en($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }

    protected function getId($str){
        $tmp = explode('_',preg_replace('/.html/','',$str));
        return end($tmp);
    }

    public function _list_cate(){

        if($this->session->userdata("userName")){
            $data['subview'] = '/admin/products/list_cate';
            $data['title'] = 'Phunu24h.com->Danh mục sản phẩm';

            $CI = & get_instance();
            $CI->load->model('categories_model');

            $pageNum = 0;
            //Config for paging
            $total_row = $CI->categories_model->record_count();
            // Initialize empty array.
            $config = array();
            // Set base_url for every links
            $config["base_url"] = base_url().'admin/products/list_cate/';
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

            $lstProd = $CI->categories_model->getListCategories($config["per_page"],$start,'');
            $str_links = $CI->pagination->create_links();
            $data["paginations"] = explode('&nbsp;',$str_links );
            $data['lstProd'] = $lstProd;
            $data['curPage'] = $CI->pagination->cur_page;
            $this->load->view('/admin/main',$data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    //edit news category action
    public function _cateEdit($id, $curPage = 0){
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

                if($CI->categories_model->updateCate($id,$arrData)){
                    redirect(base_url().'admin/products/list_cate/'.$currentPage);
                }
            }else{
                $data['subview'] = '/admin/products/frmcate';
                $data['title'] = 'Admin Home Page - Edit Categories';
                $data['errors'] = $errors;
                $data['uID'] = $id;
                $data['caption'] = 'Chỉnh sửa danh mục';
                $data['curPage'] = $curPage;

                $lstCate = $CI->categories_model->getListCategories(1,'',$id);
                //$data['lstCate'] = $lstCate;
                foreach($lstCate as $cate){
                    $data['name'] = $cate->name;
                    $data['rank'] = $cate->rank;
                    $data['status'] = $cate->status;
                    $data['icon'] = $cate->icon;
                }
                $this->load->view('/admin/main', $data);
            }
        }else{

            redirect(base_url().'admin/');
        }
    }

    public function _addCate(){
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

    public function _list_subcate($pageNum=1){

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
    public function _subCateEdit($id, $curPage = 0){
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

    public function _addSubCate(){
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

    public function _list_subcate1(){
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
    public function _subCateEdit1($id, $curPage = 0){
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

    public function _addSubCate1(){
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