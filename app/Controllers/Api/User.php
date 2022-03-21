<?php
/**
 * Created by HappyMario
 * 2019-07-24 11:17:33
 */

namespace App\Controllers\Api;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class User extends Base_api
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
    }


    public function logout()
    {
        $access_token = $this->get_access_token();

        $user_uid = $this->userModel->get_user_uid_by_access_token($access_token);
        if($user_uid == null) {
            return $this->response_error_code(API_RESULT_ERROR_ACCESS_TOKEN);
        }

        $save_data = array("logout" => STATUS_ON, 'access_token' => '');
        $this->userModel->saveById($user_uid, $save_data);

        return $this->response_success();
    }

    public function signout()
    {
        $access_token = $this->get_access_token();

        $user_uid = $this->userModel->get_user_uid_by_access_token($access_token);
        if($user_uid == null) {
            return $this->response_error_code(API_RESULT_ERROR_ACCESS_TOKEN);
        }

        $save_data = array("status" => USER_STATUS_EXIT, "logout" => STATUS_ON, 'access_token' => '');
        $this->userModel->saveById($user_uid, $save_data);

        return $this->response_success();
    }

    public function backup() {
        $access_token = $this->get_access_token();

        $user_uid = $this->userModel->get_user_uid_by_access_token($access_token);
        if($user_uid == null) {
            return $this->response_error_code(API_RESULT_ERROR_ACCESS_TOKEN);
        }

        if (!isset($_FILES['uploadfile'])) {
            return $this->response_error(API_RESULT_ERROR_PARAM);
        }

        $backup_file = $this->uploadFile($_FILES['uploadfile'], 'user');
        $save_data = array("backup_url" => $backup_file['file_url']);
        $this->userModel->saveById($user_uid, $save_data);

        return $this->response_success($backup_file);
    }
}