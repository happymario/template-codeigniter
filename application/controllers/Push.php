<?php


class Push extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("session");
        $this->load->library('form_validation');
        $this->load->database();
    }

    public function index()
    {
        $this->load_view('push/index', array(), array('page_title' => t('menu_notifications'), 'menu' => MENU_NOTIFICATION));
    }


    public function ajax_send_gotify()
    {
        $this->_set_api_params([
            new ApiParamModel('access_token', 'required'),
            new ApiParamModel('title', 'required'),
            new ApiParamModel('message', 'required'),
        ]);

        $access_token = $this->api_params->access_token;
        $this->_check_access_token($access_token);

        $user_row = $this->_get_user_info($access_token);
        $response = send_push_gotify(GOTIFY_PUSH_KEY, $user_row->dev_type, $user_row->push_token, PUSH_TYPE_NOTICE, $this->api_params->title, $this->api_params->message);
        // 성공이면
        if(array_key_exists('id', $response)) {
//            $log_data = [
//                "sender_type" => "admin", "sender_uid" => $user_row->uid, "receiver_type" => $recv_app_kind, "receiver_uid" => $recv_uid,
//                "type" => $push_type, "title" => $title, "content" => $content, "data" => json_encode($data, true)
//            ];
//            $this->db->insert("tb_push_his", $log_data);
        }

        $this->_response_success();
    }
}