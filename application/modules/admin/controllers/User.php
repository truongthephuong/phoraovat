<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once( APPPATH.'libraries/baseController.php' );
class User extends baseController{
	function User() {
        parent::baseController();
        $CI = & get_instance();
        $this->load->helper(array('url','security','form','admin'));
        $this->load->library('session');
        $this->load->database();
        
    }

    public function list_user(){
        if($this->session->userdata("userName")){
            $data['subview'] = '/admin/user/list';
            $data['title'] = 'Phoraovat.com->Danh sách user';

            $CI = & get_instance();
            $CI->load->model('users_model');

            $lstUser = $CI->users_model->getList($limit='',$id='');
            $data['lstUser'] = $lstUser;
            $this->load->view('/admin/main',$data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    public function addNew(){
        //echo 'Add new user page';exit;
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            if($CI->input->post('saveEdit')){

            }else{
                $data['addNew'] = 1;
                $data['modalTitle'] = 'Add New User';

                $CI->load->model('users_model');
                $arrOpt = $CI->getOpt('groups_model','getAll');
                $data['arrOpt'] = $arrOpt;
                $data['avail_flg'] = 1;
                $this->load->view('admin/user/frmUser', $data);
            }

        }
    }

    public function changeStatus($id = '',$curStatus){
        //echo 'ajax function '.$id.' and '.$curStatus;exit;
        $curStatus = ( $curStatus == 1 ) ? 0 : 1;
        $CI = & get_instance();
        $CI->load->model('users_model');

        $CI->users_model->changeField('avail_flg',$curStatus,'id',$id);die;
    }

    public function editUser($id){
        //echo 'edit user';exit;
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('users_model');
            if($CI->input->post('saveEdit')){
                $arrData =array(
                    'login'  => $CI->input->post('login'),
                    'grp_id'  =>  $CI->input->post('grp_id'),
                    'authority'  =>  $CI->input->post('authority'),
                    'avail_flg'    =>  ($CI->input->post('avail_flg') == 'on') ? 1 : 0,
                    'folder_url'    => $CI->input->post('folder_url'),
                    'password'  =>  do_hash($CI->input->post('password'),'md5')
                );
                if($CI->users_model->updateUser($id,$arrData)){
                    redirect('admin/list_user');
                }
            }else{
                $fieldName = 'grp_id, login, authority, password, avail_flg, created, avatar';
                $data['addNew'] = 0;
                $data['modalTitle'] = 'Edit User';

                $CI->load->model('users_model');
                $arrOpt = $CI->getOpt('groups_model','getAll');

                $userInfo = $CI->users_model->getField($id,$fieldName);
                foreach($userInfo as $info){
                    $data['grp_id'] = $info->grp_id;
                    $data['login'] = $info->login;
                    $data['authority'] = $info->authority;
                    $data['password'] = $info->password;
                    $data['avail_flg'] = $info->avail_flg;
                    $data['created'] = $info->created;
                    $data['avatar'] = $info->avatar;
                }
                $data['arrOpt'] = $arrOpt;
                $this->load->view('admin/user/frmUser', $data);
            }

        }
    }

}

?>