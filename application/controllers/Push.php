<?php


class Push extends MY_Controller
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
        $this->load_view('push/index', array(), array('page_title' => t('menu_notifications'), 'menu' => MENU_NOTIFICATION));
    }
}