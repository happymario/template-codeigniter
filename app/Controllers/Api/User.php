<?php
/**
 * Created by Star_Man
 * 2019-07-24 11:17:33
 */

namespace App\Controllers\Api;

class User extends ApiBase
{

    public function __construct()
    {
        parent::__construct();
    }

    private function _generate_access_token()
    {
        return sha1(date('Y-m-d H:i:s'));
    }

    public function signup()
    {
        $this->_set_api_params([
            new ApiParamModel('id', 'required'),
            new ApiParamModel('pwd', 'required'),
            new ApiParamModel('name', 'required'),
            new ApiParamModel('profile_url', ''),
        ]);

        $id = $this->api_params->id;
        $duplicate = $this->userModel->id_duplicated($id);
        if ($duplicate == true) {
            $this->_response_error(API_RESULT_ERROR_EMAIL_DUPLICATE);
        }

        $save_data = (array)$this->api_params;
        $insert_uid = $this->userModel->save_by_uid($save_data);

        $this->_response_success();
    }

    public function login()
    {
        $this->_set_api_params([
            new ApiParamModel('id', 'required'),
            new ApiParamModel('pwd', 'required'),
            new ApiParamModel('dev_type', 'required|in_list[android,web]'),
            new ApiParamModel('push_token', ''),
        ]);

        $id = $this->api_params->id;
        $pwd = $this->api_params->pwd;
        $dev_type = $this->api_params->dev_type;
        $push_token = $this->api_params->push_token;

        $user_row = $this->userModel->get_row_by_id($id);
        if ($user_row === null) {
            $this->_response_error(API_RESULT_ERROR_USER_NO_EXIST);
        }

        if ($user_row->pwd != $pwd) {
            $this->_response_error(API_RESULT_ERROR_LOGIN_FAILED);
        }

        if ($user_row->status != STATUS_NORMAL) {
            $this->_response_error(API_RESULT_ERROR_USER_PAUSED);
        }

        $cur_time = getTimeStampString();
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

        $this->userModel->save_by_uid($save_data, $user_row->uid);

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
        $this->_set_api_params([
            new ApiParamModel('access_token', 'required')
        ]);

        $access_token = $this->api_params->access_token;
        $this->_check_access_token($access_token);

        $user_uid = $this->_get_user_uid($access_token);
        $save_data = array("logout" => STATUS_ON);
        $this->userModel->save_by_uid($save_data, $user_uid);

        $this->_response_success();
    }

    public function signout()
    {
        $this->_set_api_params([
            new ApiParamModel('access_token', 'required')
        ]);

        $access_token = $this->api_params->access_token;
        $this->_check_access_token($access_token);

        $user_uid = $this->_get_user_uid($access_token);
        $save_data = array("status" => USER_STATUS_EXIT, "logout" => STATUS_ON);
        $this->userModel->save_by_uid($save_data, $user_uid);

        $this->_response_success();
    }

    public function backup() {
        $this->_set_api_params([
            new ApiParamModel('access_token', 'required')
        ]);

        $access_token = $this->api_params->access_token;
        $this->_check_access_token($access_token);

        $user_uid = $this->_get_user_uid($access_token);

        if (!isset($_FILES['uploadfile'])) {
            $this->_response_error(API_RESULT_ERROR_PARAM);
        }

        $upload_file_name_only = getUniqueString();
        $upload_file_name_ext = pathinfo($_FILES['uploadfile']["name"], PATHINFO_EXTENSION);
        $file_name = $upload_file_name_only . '.' . $upload_file_name_ext;

        $file_path = make_directory('user') . DIRECTORY_SEPARATOR . $file_name;

        if (!move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file_path)) {
            $this->_response_error(API_RESULT_ERROR_UPLOAD);
        }

        $backup_url = get_temp_image_url($file_name, "user");
        $save_data = array("backup_url" => $backup_url);
        $this->userModel->save_by_uid($save_data, $user_uid);

        $this->_response_success([
            'url' => $backup_url
        ]);
    }
}