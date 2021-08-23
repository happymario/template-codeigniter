<?php
namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Push extends AdminBase
{
    /************************************************************************
     * Overrides
     *************************************************************************/
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->user_model = model("UserModel");
        $this->push_model = model("PushModel");
    }


    /************************************************************************
     * View
     *************************************************************************/
    public function index()
    {
        $this->load_view('push/index', array(), array('page_title' => t('menu_notifications'), 'menu' => MENU_NOTIFICATION));
    }

    public function ajax_table()
    {
        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $order = $this->request->getPost('order');
        $keyword = $this->request->getPost('search_keyword');

        $data = $this->push_model->datatable_list($start, $length, $order, $keyword);

        echo json_encode($data);
    }

    public function ajax_send_push()
    {
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $once_100 = $this->request->getPost('once_100');

        if(!$this->validate(['title' => 'required', 'content'  => 'required'])) {
            die(AJAX_RESULT_ERROR);
        }

        $setting_model = model("SettingModel");
        $setting = $setting_model->where("status<>", STATUS_DELETE)->first();
        if($setting == null) {
            die(AJAX_RESULT_ERROR);
        }

        $count = 0;
        $max = 1;
        if($once_100 == "true") {
            $max = 100;
        }

        for($i = 0; $i < $max;$i++) {
            $strresponse = send_push_gotify($setting["gotify_app_key"], null, null, PUSH_TYPE_NOTICE, $title, $content);
            if($strresponse == false) {
                $count +=  1;
                continue;
            }
            //$strresponse = send_push_openfire('192.168.0.13', 'happymario', 'push', PUSH_TYPE_NOTICE, $title, $content);
            $response = json_decode($strresponse);

            // 성공이면
            if(array_key_exists('id', $response)) {
                $count +=  1;
            }
        }

        $session = session();
        $adminUid = $session->get(SESSION_ADMIN_UID);
        if($count > 0) {
            $save_data = [
                'sender_type' => 'admin',
                'sender_uid' => $adminUid,
                'receiver_uid' => null,
                'type' => PUSH_TYPE_NOTICE,
                'title' => $title,
                'message'=> $content,
                'data' => json_encode(array("count" => $count))
            ];
            $this->push_model->save($save_data);
            die(AJAX_RESULT_SUCCESS);
        }
        else {
            die(AJAX_RESULT_EMPTY);
        }
    }

    public function ajax_resend_gotify()
    {
        $arr_uid = $this->request->getPost('uids');

        if($arr_uid == null) {
            die(AJAX_RESULT_ERROR);
        }

        $setting_model = model("SettingModel");
        $setting = $setting_model->where("status<>", STATUS_DELETE)->first();
        if($setting == null) {
            die(AJAX_RESULT_ERROR);
        }

        for($i = 0; $i < count($arr_uid); $i++) {
            $push_row = $this->push_model->findById($arr_uid[$i]);

            if($push_row == null) {
                continue;
            }

            send_push_gotify($setting["gotify_app_key"], null, null, $push_row["type"], $push_row["title"], $push_row["message"]);
        }

        die(AJAX_RESULT_SUCCESS);
    }

    public function ajax_push_delete() {
        $uid = $this->request->getPost('uid');
        $this->push_model->deleteById($uid, true);
        die (AJAX_RESULT_SUCCESS);
    }
}