<?php

namespace App\Controllers\Admin;

use App\Models\AdminModel;
use App\Models\SettingModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Login extends Base_admin
{
    /**
     * @var AdminModel
     */
    private $adminModel;
    /**
     * @var SettingModel
     */
    private $settingModel;

    /************************************************************************
     * Overrides
     ************************************************************************
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->adminModel = new AdminModel();
        $this->settingModel = new SettingModel();
    }


    /************************************************************************
     * Views
     *************************************************************************/
    public function index()
    {
        echo view("login/index");
    }

    public function term()
    {
        $term_kind = $this->request->getGet('term_kind');

        $setting = $this->settingModel->asObject()->where('status<>', STATUS_DELETE)->first();

        $title = t('use_agreement');
        if($term_kind == 'use') {
            $term = $setting->use_agreement;
        }
        else {
            $term = $term_kind;
        }
        $this->load_view_without_layout("layout/term", array('page_title' => $title, 'term' => $term));
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
        $this->check_ajax();

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
        $this->check_ajax();

        $id = $this->request->getPost("id");
        $pwd = $this->request->getPost("pwd");

        $save_data = array(
            'id' => $id,
            'pwd' => $pwd
        );

        $session = session();
        $adminUid = $session->get(SESSION_ADMIN_UID);

        $this->adminModel->saveById($adminUid, $save_data);

        $this->ajax_result(AJAX_RESULT_SUCCESS);
    }
}