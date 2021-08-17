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
    public function upload_file($file)
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

    public function ajax_result($error = null, $message = '')
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
    public function is_login_class()
    {
        $class_name = get_class($this);
        $arr_login_class = ["App\Controllers\Admin\Login"];
        $is_exist = false;

        for ($i = 0; $i < count($arr_login_class); $i++) {
            if ($arr_login_class[$i] == $class_name) {
                $is_exist = true;
                break;
            }
        }
        return $is_exist;
    }

    public function set_my_uid($uid) {
        $session = session();
        $session->set(SESSION_ADMIN_UID, $uid);
    }

    public function has_permission($level, $privilege)
    {
        $min_level = $this->db->get_where('tb_privilege', array('privilege_name' => $privilege))->row('min_level');
        return ($min_level >= $level);
    }
}