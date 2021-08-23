<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SSP;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class AdminBase extends BaseController
{
    /************************************************************************
     * Overrides
     *************************************************************************/
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        helper(['form', 'download']);
        $this->ssp = new SSP();
    }


    /************************************************************************
     * Views
     *************************************************************************/
    public function load_view($view_name = '', $response_data = array(), $menu_data = array())
    {
        echo view('layout/header', $menu_data);
        echo view($view_name, $response_data);
        echo view('layout/footer');
    }

    public function load_origin_view($view_name = '', $data = array())
    {
        echo view($view_name, $data);
    }

    /************************************************************************
     * Ajax API
     *************************************************************************/
    protected function upload_file($file)
    {
        $upload_file_name_only = get_unique_str();
        $upload_file_name_ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        $file_name = $upload_file_name_only . '.' . $upload_file_name_ext;

        $file_path = make_directory('temp') . DIRECTORY_SEPARATOR . $file_name;

        if (!move_uploaded_file($file['tmp_name'], $file_path)) {
            return null;
        }

        return [
            'file_name' => $file_name,
            'file_url' => get_temp_image_url($file_name)
        ];
    }

    protected function ajax_result($error = null, $message = '')
    {
        $data = [
            "result" => ($error == null? AJAX_RESULT_SUCCESS: $error),
            "msg" => $message
        ];

        die(json_encode($data, true));
    }


    /************************************************************************
     * Helpers
     *************************************************************************/
    public function set_my_uid($uid) {
        $session = session();
        $session->set(SESSION_ADMIN_UID, $uid);
    }

    public function remove_my_uid() {
        $session = session();
        $session->remove(SESSION_ADMIN_UID);
    }
}