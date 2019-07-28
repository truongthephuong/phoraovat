<?php
/**
 * Created by PhuongTruong.
 * User: Admin
 * Date: 8/12/2016
 * Time: 1:47 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
include_once( APPPATH.'libraries/baseController.php' );
class Admin extends baseController {

    function Admin() {
        parent::baseController();
        $CI = & get_instance();
        $this->load->helper(array('url','security','form','admin'));
        $this->load->library(array('session', 'pagination'));
        $this->load->database();
        //print_r ($this->leftNaviba());exit;
    }

    public function index(){
        //echo 'Administrator page';die;
        $data['subview'] = '/admin/login';
        $data['title'] = 'Administrator System';
        $this->load->view('/admin/main', $data);
        
    }

    public function login(){
        $CI = & get_instance();
        $CI->load->model('users_model');

        if(empty($CI->input->post('adminLogin')) ){
            $CI->session->set_flashdata("login_fail", "Can not login, please try again");

        }else{

            $username = addslashes($CI->input->post('username'));
            $password = addslashes($CI->input->post('password'));

            $wh = " WHERE password = '". do_hash($password,'md5'). "' AND login = '" . $username . "'";
            $field_name = "id";
            $tbname = 'users';

            //echo $wh;die;
            $curID = $CI->users_model->get_field($field_name, $tbname, $wh);

            if($curID && $curID != NULL){
                $CI->session->set_flashdata("login_success", "Welcome back to admin panel");
                $field_name = 'login, mail_address, authority, user_code, grp_id';
                $tbname = 'users';
                $userData = $CI->users_model->getUserInfo($field_name, $tbname, $curID);

                $data = array(
                    'userName' => $userData->login,
                    'userEmail' => $userData->mail_address,
                    'authority' => $userData->authority,
                    'userCode' => $userData->user_code,
                    'userGrp' => $userData->grp_id
                );

                /*$cookie = array(
                   'name'   => 'phoraovat',
                   'value'  => $userData->user_code,
                   'expire' => '86500',
                   'prefix' => ''
                );
                $this->input->set_cookie($cookie);*/

                $this->session->set_userdata($data);
                if($this->session->userdata("last_page")){
                    redirect($this->session->userdata("last_page"));
                }else{
                    redirect(base_url().'admin/home');
                }

                //echo 'Logined';
            }else{
                $CI->session->set_flashdata("login_fail", "Can not login, please try again");
                redirect(base_url().'admin/');

            }
        }
    }

    //Home action
    public function home(){
        //echo 'session '.$this->session->userdata("userName");exit;
        //echo 'session '.$this->session->userdata("userName");exit;
        if($this->session->userdata("userName")){

            $data['subview'] = '/admin/dashboard';
            $data['title'] = 'Admin Home Page';

            $this->load->view('/admin/main', $data);
        }else{
            redirect(base_url().'admin');
        }

    }

    //logout action
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url().'admin/');
    }

    //list modules action
    public function list_module(){
        if($this->session->userdata("userName")){
            $data['subview'] = '/admin/listModule';
            $data['title'] = 'Admin Home Page - List Modules';

            $CI = & get_instance();
            $CI->load->model('modules_model');
            $lstModule = $CI->modules_model->getList('','');
            $data['lstModule'] = $lstModule;
            $this->load->view('/admin/main', $data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    //edit module
    public function editModule($id){
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('modules_model');
            $errors = '';

            if($CI->input->post('saveEdit')){
                $arrData =array(
                    'name'  => $CI->input->post('name'),
                    'module_ctr'  =>  $CI->input->post('module_ctr'),
                    'module_act'  =>  $CI->input->post('module_act'),
                    'status'    =>  ($CI->input->post('status') == 'on') ? 1 : 0,
                    'folder_url'    => $CI->input->post('folder_url'),
                    'rank'  =>  $CI->input->post('rank')
                );
                if($_FILES['iconModule']['name']){
                    $arrData['icon'] = $_FILES['iconModule']['name'];
                    $config['upload_path']          = 'upload/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 100;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 768;

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('iconModule')){

                        $data['subview'] = '/admin/editModule';
                        $data['title'] = 'Admin Home Page - Edit Modules';
                        $data['errors'] = $this->upload->display_errors();
                        $this->load->view('/admin/main', $data);

                    }
                }

                if($CI->modules_model->updateModule($id,$arrData)){
                    redirect('admin/list_module');
                }
            }else{
                $data['subview'] = '/admin/editModule';
                $data['title'] = 'Admin Home Page - Edit Modules';
                $data['errors'] = $errors;
                $data['uID'] = $id;

                $lstModule = $CI->modules_model->getList('',$id);
                $data['lstModule'] = $lstModule;
                $this->load->view('/admin/main', $data);
            }
        }else{
            redirect(base_url().'admin/');
        }
    }

    //list submodules action
    public function list_submodule(){
        if($this->session->userdata("userName")){
            $data['subview'] = '/admin/listSubmodule';
            $data['title'] = 'Admin Home Page - List SubModules';

            $CI = & get_instance();
            $CI->load->model('submodules_model');
            $lstSubModule = $CI->submodules_model->getList('','');
            $data['lstSubModule'] = $lstSubModule;
            $this->load->view('/admin/main', $data);
        }else{
            redirect(base_url().'admin/');
        }

    }

    //edit sub module
    public function editSubModule($id){
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('submodules_model');
            $errors = '';

            if($CI->input->post('saveEdit')){
                $arrData =array(
                    'mod_id'  => $CI->input->post('mod_id'),
                    'name'  => $CI->input->post('name'),
                    'module_ctr'  =>  $CI->input->post('module_ctr'),
                    'module_act'  =>  $CI->input->post('module_act'),
                    'status'    =>  ($CI->input->post('status') == 'on') ? 1 : 0,
                    'folder_url'    => $CI->input->post('folder_url'),
                    'rank'  =>  $CI->input->post('rank')
                );
                if($_FILES['iconModule']['name']){
                    $arrData['icon'] = $_FILES['iconModule']['name'];
                    $config['upload_path']          = 'upload/';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 100;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 768;

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('iconModule')){

                        $data['subview'] = '/admin/editSubModule';
                        $data['title'] = 'Admin Home Page - Edit Sub Modules';
                        $data['errors'] = $this->upload->display_errors();
                        $this->load->view('/admin/main', $data);

                    }
                }

                if($CI->submodules_model->updateModule($id,$arrData)){
                    redirect('admin/list_submodule');
                }
            }else{
                $data['subview'] = '/admin/editSubModule';
                $data['title'] = 'Admin Home Page - Edit Sub Modules';
                $data['errors'] = $errors;
                $data['uID'] = $id;

                $lstSubModule = $CI->submodules_model->getList($limit='',$id);
                $data['lstSubModule'] = $lstSubModule;
                $this->load->view('/admin/main', $data);
            }
        }else{
            redirect(base_url().'admin/');
        }
    }

    //list group action
    public function list_group() {
        if($this->session->userdata("userName")){
            $data['subview'] = '/admin/listGroup';
            $data['title'] = 'Admin Home Page - List Group';

            $CI = & get_instance();
            $CI->load->model('groups_model');
            $lstGroup = $CI->groups_model->getList('','');
            $data['lstGroup'] = $lstGroup;
            $this->load->view('/admin/main', $data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    //edit group action
    public function groupEdit($id) {
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('groups_model');
            $lstGroup = $CI->groups_model->getList('',$id);
            $data['lstGroup'] = $lstGroup;

            $this->load->view('/admin/groupEdit', $data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    //cms config action
    public function cms_config() {
        if($this->session->userdata("userName")){
            $data['subview'] = '/admin/cmsConfig';
            $data['title'] = 'Admin Home Page - CMS Config';

            $CI = & get_instance();
            $CI->load->model('cmsconfig_model');
            $lstConfig = $CI->cmsconfig_model->getList('','');
            $data['lstConfig'] = $lstConfig;
            $this->load->view('/admin/main', $data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    //Permission Edit
    public function perEdit($id) {

        $CI = & get_instance();
        $CI->load->model('modules_model');
        $CI->load->model('submodules_model');
        $CI->load->model('Usermodules_model');

        if($CI->input->post('saveEdit')){

            $modId = $CI->input->post('modId');
            $subModId = $CI->input->post('subModId');
            $grpId = $id;
            $flgMod = 1;
            $flgSubMod = 1;

            if($CI->Usermodules_model->delField('user_id',$grpId,'user_type_modules')){
                //update module permission
                if(count($modId) > 0 ){

                    foreach($modId as $mId):
                        $data = array(
                            'user_id'  =>  $grpId,
                            'id_mod'  =>  $mId
                        );
                        $CI->Usermodules_model->addNew($data,'user_type_modules');
                    endforeach;

                }

                //update sub module permission
                if(count($subModId) > 0 ){
                    foreach($subModId as $smId):
                        $data = array(
                            'user_id'  =>  $grpId,
                            'id_submod'  =>  $smId
                        );
                        $CI->Usermodules_model->addNew($data,'user_type_modules');
                    endforeach;

                }

            }else{
                $flgMod = 0;
            }

            if($flgMod == 1 && $flgSubMod == 1){

                redirect('/admin/list_group');

            }else{
                $data['exOk'] = 'false';
                $data['uID'] = $id;
                $this->load->view('/admin/user/perEdit',$data);

            }

        }else{

            $lstModule = $CI->modules_model->getList('','');
            $data['lstModule'] = $lstModule;

            $arrModuleId = $CI->Usermodules_model->getModId($id);
            $data['arrModuleId'] = $arrModuleId;

            $arrSubModuleId = $CI->Usermodules_model->getSubModId($id);
            $data['arrSubModuleId'] = $arrSubModuleId;

            $data['uID'] = $id;
            $this->load->view('/admin/user/perEdit',$data);
        }
    }

    public function changeStatus($condValue, $curStatus, $condField, $tbName){

        //echo 'ajax function '.$condValue.' and '.$curStatus;exit;
        $field = 'status';
        $curStatus = ( $curStatus == 1 ) ? 0 : 1;

        //$CI = & get_instance();
        $this->db->set($field, $curStatus);
        $this->db->where($condField, $condValue);

        $this->db->update($tbName);
        exit; 
    }

    public function changeRank($id, $condField, $condVal,  $tbName){
        $field = 'id';
        $CI = & get_instance();
        $this->db->set($condField, $condVal);
        $this->db->where($field, $id);

        $this->db->update($tbName);
        echo 'Update rank success';die;
    }

    public function memberList() {
        //echo 'Member list page';exit;
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $data['subview'] = '/admin/member/list';
            $data['title'] = 'VietBidding->Members list';

            $CI = & get_instance();
            $CI->load->model('members_model');

            $listMem = $CI->members_model->getList($limit='',$id='');
            $data['listMem'] = $listMem;
            $this->load->view('admin/main',$data);
        }else{
            redirect(base_url().'admin/');
        }
    }

    public function addNewMember() {
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")) {
            $CI = & get_instance();
            $CI->load->model('members_model');
            if($CI->input->post('saveEdit')) {
                $arrDataMember = array(
                    'username'  => $CI->input->post('username'),
                    'email'     =>  $CI->input->post('email'),
                    'status'    =>  1,
                    'password'  =>  do_hash($CI->input->post('password'),'md5')
                );

                //Check existing data on member_point and member_detail via last insert id from member
                $lastID = $CI->members_model->addNew($arrDataMember, 'members');
                $existMemPoint = $CI->members_model->et_field('id', 'member_point', ' WHERE mem_id = '.$lastID );
                $existMemDetail = $CI->members_model->et_field('id', 'member_detail', ' WHERE mem_id = '.$lastID );

                $CI->db->trans_start();
                if (count($existMemPoint) > 0) {
                    $arrDataMemberPoint = array(
                        'mem_id'        =>  $lastID,
                        'total_point'   =>  ($CI->input->post('point') > 0) ? $CI->input->post('point') : 0,
                        'max_bid'       =>  ($CI->input->post('rate') > 0) ? $CI->input->post('rate') : 0
                    );
                    $CI->members_model->addNew($arrDataMemberPoint, 'member_point');
                }

                if (count($existMemDetail) > 0) {
                    $arrDataMemberDetail = array(
                        'mem_id'        =>  $lastID,
                        'fullname'      =>  ($CI->input->post('fullname') > 0) ? $CI->input->post('fullname') : '',
                        'tell'          =>  ($CI->input->post('tell') > 0) ? $CI->input->post('tell') : 0
                    );
                    $CI->members_model->addNew($arrDataMemberDetail, 'member_detail');
                }
                $CI->db->trans_complete();
                redirect(base_url().'admin/memberList');
                /*if($CI->members_model->addNew($arrDataMember, 'members')){
                    redirect(base_url().'admin/memberList');
                }*/
            } else {
                $data['addNew'] = 1;
                $data['modalTitle'] = 'Add New Member';

                $data['status'] = 1;
                $this->load->view('admin/member/frmUser', $data);
            }
        }
    }

    public function editMember($id) {
        //echo $CI->input->post('saveEdit');
        $this->session->set_userdata('last_page', base_url(uri_string()));
        if($this->session->userdata("userName")){
            $CI = & get_instance();
            $CI->load->model('members_model');
            if($CI->input->post('saveEdit')){
                $arrData =array(
                    'username'  => $CI->input->post('username'),
                    //'password'  =>  $CI->input->post('password'),
                    'email'  =>  $CI->input->post('email'),
                    'status'    =>  ($CI->input->post('status') == 'on') ? 1 : 0,
                );
                if($CI->members_model->updateMemberInfo($id,$arrData)){
                    redirect(base_url().'admin/memberList');
                }
            }else{
                $fieldName = 'username, email, status';
                $memberInfo = $CI->members_model->getField($id, $fieldName);
                $data['addNew'] = 0;
                $data['modalTitle'] = 'Edit User';
                $data['memId'] = $id;

                foreach($memberInfo as $info){
                    $data['username'] = $info->username;
                    $data['email'] = $info->email;
                    $data['status'] = $info->status;
                }
                $this->load->view('admin/member/frmUser', $data);
            }

        }
    }

    //Change rate of member
    public function changeRate($id, $condField, $condVal,  $tbName){
        $field = 'id';
        $CI = & get_instance();
        $this->db->set($condField, $condVal);
        $this->db->where($field, $id);

        $this->db->update($tbName);
        echo 'Update rank success';die;
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
	
}