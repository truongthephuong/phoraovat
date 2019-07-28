<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once( APPPATH.'libraries/baseController.php' );
class Member extends baseController{
	function Member() {
		parent::baseController();
		$CI = &get_instance();
		$CI->load->helper(array('url', 'html', 'home', 'captcha'));
		$CI->load->database();
		$CI->load->library(array('encryption', 'pagination', 'session'));
    }

    public function index(){
    	echo 'user page index';exit;
        $data['subview'] = '/user/list';
        $data['title'] = 'Danh sách user';
        $this->load->view('/admin/main',$data);
    }

}

?>