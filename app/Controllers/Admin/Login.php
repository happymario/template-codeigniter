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
        //$this->cachePage(1000); // 1000s
        echo view("login/index");
    }

    public function term()
    {
        $term_kind = $this->request->getGet('term_kind');

        $setting_model = model("SettingModel");
        $setting = $setting_model->asObject()->where('status<>', STATUS_DELETE)->first();

        $title = t('use_agreement');
        $term = $setting->use_agreement;
        $this->load_origin_view("layout/term", array('page_title' => $title, 'term' => $term));
    }

    public function logout()
    {
        $this->remove_my_uid();
        return redirect()->to(site_url('admin/login'));
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
        $id = $this->request->getPost("id");
        $pwd = $this->request->getPost("pwd");

        $save_data = array(
            'id' => $id,
            'pwd' => $pwd
        );

        $session = session();
        $adminUid = $session->get(SESSION_ADMIN_UID);
        $this->db->update('tb_admin', $save_data, array('uid' => $adminUid));
        die ("success");
    }
}