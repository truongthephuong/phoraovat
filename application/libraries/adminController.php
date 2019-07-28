<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class adminController extends CI_Controller {
	public function adminController() {
        parent::__construct();

    }
    /* config for template*/
        
    function view($view){
        $this->view = $view;
    }
    
    function add($key, $val){
        if(is_string($key))
            $key = array($key=>$val);
        foreach($key as $k=>$v)
            $this->data[$k] = $v;
    }

    /**
     * Return json encode when calling ajax
     *
     * @param boolean $status - whether call ajax that's successful or not
     * @param string $message - return message when calling ajax
     * @param boolean $is_serialize - change data from array or object type to string type
     * @since 09/08/2015
     * @author van_tai
     */
    protected function encode_json($data = array(), $status = true , $message = array(), $is_serialize = false) {

        $return = array('status' => $status);
        if (!empty($message)) {
            $return['message'] = $message;
        }

        if (!empty($data)) {
            if ($is_serialize == true) {
                $data = print_r($data, true);
            }
            $return['data'] = $data;
        }

        header('Content-type: application/json');
        echo json_encode($return);
        exit;
    }
    
        
    /**
     * Add js file
     *
     * @since 09/08/2015
     * @author van_tai
     */ 
    protected function _add_js_files($path) {     
        if (is_array($path)) {
            $this->_js_files = array_merge($this->_js_files, $path);
            return true;
        }
        
        $this->_js_files[] = $path;
    }
    
    /**
     * Render js file
     *
     * @return string
     * @since 09/09/2015
     * @author van_tai
     */ 
    protected function _rend_js_file() {
        $str = '';
        
        foreach ($this->_js_files as $file) {
            $str .= sprintf("<script type='text/javascript' src='%s'></script>", $file);
        }
        
        return $str;
    }
    
    /**
     * Render js file
     *
     * @return string
     * @since 09/09/2015
     * @author van_tai
     */ 
    protected function _assign_js() {
        $this->add('js_files', $this->_rend_js_file());
    }
    
    /**
     * Add js code.
     *
     * @since 09/08/2015
     * @author van_tai
     */ 
    protected function _add_js_code($code) {        
        $this->_js_code .= $code;
    }
    
    /**
     * Assign js code
     *
     * @return string
     * @since 09/09/2015
     * @author van_tai
     */ 
    protected function _assign_js_code() {
        $this->add('js_code', sprintf("<script type='text/javascript'>%s</script>", $this->_js_code));
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

}