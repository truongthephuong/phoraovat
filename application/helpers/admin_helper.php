<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    if (!function_exists('getSubListCategories')){
    	
        function getSubListCategories($id){
            $CI = & get_instance();
            $data = array();
            $CI ->load->model('Subcategories_model');
            $query = $CI ->Subcategories_model->getList($id);
            return $query;

        }

    }

    if(!function_exists('getArrOpt')){
	    function getArrOpt($model, $fncName)
	    {
		    $CI = &get_instance();
		    $data = array();
		    $CI->load->model($model);
		    $query = $CI->$model->$fncName();
		    return $query;
	    }
    }
    
    if(!function_exists('getField')){

        function getField($id,$model,$fieldName){

            $CI = & get_instance();
            $data = array();
            $CI->load->model($model);
            $query = $CI->$model->getField($id,$fieldName);

            return $query;
        }

    }

    if(!function_exists('convert_vi_to_en')){
        
        function convert_vi_to_en($str) {
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
    }

    if(!function_exists('delComar')){
        function delComar($str){
            return preg_replace('/,/','',$str);
        }
    }

    if(!function_exists('getFiledSubTable')){
        function getFiledSubTable($field,$id,$model,$fieldName){
            $CI = & get_instance();
            $data = array();
            $CI->load->model($model);
            $query = $CI->$model->getFieldSubTable($field,$id,$fieldName);

            return $query;
        }
    }

    if(!function_exists('leftNaviba')){
        function leftNaviba(){
            $CI = & get_instance();
            $CI->load->model('modules_model');
            $lstMenuModule = $CI->modules_model->getMenuList();
            //var_dump($lstModule);die;
            return $lstMenuModule;
        }
    }

    if(!function_exists('is_login')){
        function is_login(){
            if($this->session->userdata("userName")){
                return true;
            }else{
                return false;
            }
        }
    }

    if(!function_exists('checkExist')){
        function checkExist($tbName,$condField,$condValue){
            $CI = & get_instance();
            $CI->db->select('id');
            $CI->db->from($tbName);
            $CI->db->where($condField, $condValue);
            $query = $CI->db->get();
            //echo $CI->db->last_query();
            if ($query->num_rows() > 0) {
                return 1;
            }else{
                return 0;
            }
        }
    }


?>