<?php
/**
 * Created by Star_Man
 * 2019-07-24 11:17:33
 */

require_once 'ApiBase.php';

class User extends ApiBase
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $this->_set_api_params([
            new ApiParamModel('email', ''),
            new ApiParamModel('pwd', 'required')
        ]);

        $email = $this->api_params->email;
        $pwd = $this->api_params->pwd;
        $user_row = $this->db->get_where('tb_user', array('id' => $email, 'pwd' => $pwd))->row();
        $cur_time = date("Y-m-d H:i:s", time());

        if ($user_row === null) {
            $this->_response_error(API_RESULT_ERROR_USER_NO_EXIST);
        }

        if ($user_row->status != 1) {
            $this->_response_error(STATUS_NORMAL);
        }

        $update_data['login_time'] = $cur_time;
        $this->db->update('tb_user', $update_data, array('uid' => $user_row->uid));

        $this->_response_success(array(
            'user_uid' => (int)$user_row->uid
        ));
    }


    public function signup()
    {
        $this->_set_api_params([
            new ApiParamModel('email', 'required'),
            new ApiParamModel('pwd', 'required')
        ]);

        $email = $this->api_params->email;
        if (!empty($email) && $this->_email_duplicated($email)) {
            $this->_response_error(API_RESULT_ERROR_EMAIL_DUPLICATE);
        }

        $insert_data = [
            'id' => $this->api_params->email,
            'pwd' => $this->api_params->pwd,
        ];

        $this->db->insert('tb_user', $insert_data);

        $this->_response_success(array(
            'user_uid' => $this->db->insert_id()
        ));
    }

    public function _email_duplicated($email)
    {
        $dup_row = $this->db->get_where('tb_user', array('id' => $email))->row();
        return ($dup_row != null);
    }
}