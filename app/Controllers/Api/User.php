<?php
/**
 * Created by HappyMario
 * 2019-07-24 11:17:33
 */

namespace App\Controllers\Api;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class User extends ApiBase
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->user_model = model("UserModel");
    }

    private function _generate_access_token()
    {
        return sha1(date('Y-m-d H:i:s'));
    }

    public function signup()
    {
        $this->set_api_params([
            new ApiParamModel('id', 'required'),
            new ApiParamModel('pwd', 'required'),
            new ApiParamModel('name', 'required'),
            new ApiParamModel('profile_url', ''),
        ]);

        $id = $this->request->getPost("id");

        $duplicate = $this->user_model->id_duplicated($id);
        if ($duplicate == true) {
            $this->_response_error(API_RESULT_ERROR_EMAIL_DUPLICATE);
        }

        $user = new \App\Entities\User();
        $user->fill($this->request->getPost());
        $this->user_model->save($user);

        $this->_response_success();
    }

    public function login()
    {
        $this->set_api_params([
            new ApiParamModel('id', 'required'),
            new ApiParamModel('pwd', 'required'),
            new ApiParamModel('dev_type', 'required|in_list[android,web]'),
            new ApiParamModel('push_token', ''),
        ]);

        $id = $this->request->getPost("id");
        $pwd = $this->request->getPost("pwd");
        $dev_type = $this->request->getPost("dev_type");
        $push_token = $this->request->getPost("push_token");

        $user_row = $this->user_model->get_row_by_id($id);
        if ($user_row === null) {
            $this->_response_error(API_RESULT_ERROR_USER_NO_EXIST);
        }

        $user = new \App\Entities\User();
        if (!$user->checkPwd($pwd, $user_row->pwd)) {
            $this->_response_error(API_RESULT_ERROR_LOGIN_FAILED);
        }

        if ($user_row->status != STATUS_NORMAL) {
            $this->_response_error(API_RESULT_ERROR_USER_PAUSED);
        }

        $cur_time = get_time_stamp_str();
        $access_token = $this->_generate_access_token();

        $save_data = array(
            'access_token' => $access_token,
            'dev_type' => $dev_type,
            'login_time' => $cur_time,
            'logout' => STATUS_OFF
        );
        if (!empty($push_token)) {
            $save_data['dev_token'] = $push_token;
        }
        $this->user_model->saveById($user_row->uid, $save_data);

        $this->_response_success(array(
            "access_token" => $access_token,
            "reg_time" => $user_row->reg_time,
            "id" => $user_row->id,
            "name" => $user_row->name,
            "profile_url" => $user_row->profile_url,
            "profile_url_check" => $user_row->profile_url_check,
            "backup_url" => $user_row->backup_url,
            "status" => $user_row->status,
        ));
    }

    public function logout()
    {
        $this->set_api_params([
            new ApiParamModel('access_token', 'required')
        ]);

        $access_token = $this->request->getPost("access_token");
        $this->_check_access_token($access_token);

        $user_uid = $this->_get_user_uid($access_token);
        $save_data = array("logout" => STATUS_ON);
        $this->user_model->saveById($user_uid, $save_data);

        $this->_response_success();
    }

    public function signout()
    {
        $this->set_api_params([
            new ApiParamModel('access_token', 'required')
        ]);

        $access_token = $this->request->getPost("access_token");
        $this->_check_access_token($access_token);

        $user_uid = $this->_get_user_uid($access_token);
        $save_data = array("status" => USER_STATUS_EXIT, "logout" => STATUS_ON);
        $this->user_model->saveById($user_uid, $save_data);

        $this->_response_success();
    }

    public function backup() {
        $this->set_api_params([
            new ApiParamModel('access_token', 'required')
        ]);

        $access_token = $this->api_params->access_token;
        $this->_check_access_token($access_token);

        $user_uid = $this->_get_user_uid($access_token);

        if (!isset($_FILES['uploadfile'])) {
            $this->_response_error(API_RESULT_ERROR_PARAM);
        }

        $upload_file_name_only = get_unique_str();
        $upload_file_name_ext = pathinfo($_FILES['uploadfile']["name"], PATHINFO_EXTENSION);
        $file_name = $upload_file_name_only . '.' . $upload_file_name_ext;

        $file_path = make_directory('user') . DIRECTORY_SEPARATOR . $file_name;

        if (!move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file_path)) {
            $this->_response_error(API_RESULT_ERROR_UPLOAD);
        }

        $backup_url = get_temp_image_url($file_name, "user");
        $save_data = array("backup_url" => $backup_url);
        $this->user_model->saveById($save_data, $user_uid);

        $this->_response_success([
            'url' => $backup_url
        ]);
    }
}