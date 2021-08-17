<?php

namespace App\Controllers\Admin;

use App\Models\AdminModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Login extends AdminBase
{
    /************************************************************************
     * Overrides
     *************************************************************************/
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->adminModel = new AdminModel();
    }


    /************************************************************************
     * Pages
     *************************************************************************/
    public function index()
    {
        echo view("login/index");
    }

    public function term()
    {
        $term_kind = $this->input->get('term_kind');

        $this->db->select('*');
        $setting = $this->db->get_where('tb_setting', array('status' => STATUS_NORMAL))->row();

        $title = t('use_agreement');
        $term = $setting->use_agreement;
        $this->load->view("layout/term", array('page_title' => $title, 'term' => $term));
    }

    public function logout()
    {
        $this->session->unset_userdata(SESSION_ADMIN_UID);
        redirect('Login');
    }


    /************************************************************************
     * Ajax APIs
     *************************************************************************/
    public function ajax_login()
    {
        if (!$this->request->isAJAX()) {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }

        $id = $this->request->getPost('id');
        $pwd = $this->request->getPost('pwd');
        $exist = $this->adminModel->checkAdmin($id, $pwd);
        if ($exist == null) {
            $this->ajax_result(AJAX_RESULT_EMPTY);
        } else {
            $this->set_my_uid($exist);
            $this->ajax_result(AJAX_RESULT_SUCCESS);
        }
    }

    public function ajax_change_admin_info()
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