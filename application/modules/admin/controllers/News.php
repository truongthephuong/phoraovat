<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class News extends CI_Controller
    {
        function news_list()
        {
            // Load model
            $this->load->model('news_model');

            // Gọi function trong model
            $news_list = $this->news_model->getList();
            $this->load->view('news/listNews',$news_list);
        }

        public function index(){
            $this->load->view('news/index');
        }
    }
?>