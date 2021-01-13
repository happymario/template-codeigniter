<?php


class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("session");
        $this->load->database();

        $this->lang->load('admin', LANGUAGE);
    }

    public function index()
    {
        $this->load->view("login/index");
    }

    public function term()  {
        $term_kind = $this->input->get('term_kind');

        $this->db->select('*');
        $setting = $this->db->get_where('tb_setting', array('status' => STATUS_NORMAL))->row();

        $title = t('use_agreement');
        $term = $setting->use_agreement;
        $this->load->view("layout/term", array('page_title' => $title, 'term' => $term));
    }
    
    public function login()
    {
        $id = $this->input->post('id');
        $pwd = $this->input->post('pwd');
        $row = $this->db->get_where('tb_admin', array('id' => $id, 'pwd' => $pwd))->row();
        if ($row == null) {
            echo "no_exist";
        } else {
            $this->session->set_userdata(SESSION_ADMIN_UID, $row->uid);
            echo "success";
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(SESSION_ADMIN_UID);
        redirect('Login');
    }

    public function change_admin_info()
    {
        $id = $this->input->post("id");
        $pwd = $this->input->post("pwd");

        $save_data = array(
            'id' => $id,
            'pwd' => $pwd
        );

        $this->db->update('tb_admin', $save_data, array('uid' => $this->session->userdata(SESSION_ADMIN_UID)));
        die ("success");
    }
}