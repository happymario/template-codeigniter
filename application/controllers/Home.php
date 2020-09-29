<?php


class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("session");
        $this->load->library('form_validation');
        $this->load->database();
    }

    public function index()
    {
        $this->load_view('home/index', array(), array('page_title' => t('menu_home'), 'menu' => MENU_USER));
    }
}