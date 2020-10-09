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

        $this->load->model('UserModel', 'userModel');
        $this->load->model('PushModel', 'pushModel');
    }

    public function index()
    {
        $this->load_view('push/index', array(), array('page_title' => t('menu_notifications'), 'menu' => MENU_NOTIFICATION));
    }

    public function ajax_table()
    {
        $limit = SSP::limit($_POST);
        $search_keyword = $this->input->post('search_keyword');

        $status = STATUS_DELETE;
        $where = "E.status != $status and E.sender_uid = A.uid";
        if (!empty($search_keyword)) {
            $where .= " and (E.title like '%$search_keyword%' or E.message like '%$search_keyword%')";
        }

        $select_list = "E.*, A.id as admin_id, A.uid as admin_uid";

        $order_by = " E.reg_time desc";
        if(array_key_exists("order", $_POST)) {
            $dir = $_POST['order'][0]['dir'];
            $order_by = " E.reg_time ".$dir;
        }

        $sql = <<<EOT
            select $select_list
            from tb_push_his E, tb_admin A
            where $where 
EOT;
        $sql_total = $sql." order by $order_by". ' ' . $limit;
        $sql_count = str_replace($select_list, "count(E.uid) as cnt", $sql);

        $arr_data = $this->db->query($sql_total)->result();
        $total_data_cnt = (int)$this->db->query($sql_count)->row('cnt');

        if (count($arr_data) > 0) {
            $recordsTotal = $total_data_cnt;
            $recordsFiltered = $recordsTotal;
        } else {
            $recordsTotal = 0;
            $recordsFiltered = $recordsTotal;
        }

        $return_data = array();

        $row_index = 1;
        foreach ($arr_data as $row) {
            $column_index = 0;
            $temp = array();
            $temp[$column_index++] = $temp['uid'] = $row->uid;
            $temp[$column_index++] = $temp['index'] = $recordsFiltered - ($_POST['start'] + $row_index) + 1;

            if($row->sender_type == 'user') {
                $user = $this->userModel->get_row_by_uid($row->sender_uid);
                $temp[$column_index++] = $temp['sender'] = $user->name;
            }
            else {
                $temp[$column_index++] = $temp['sender'] = $row->admin_id;
            }
            if($row->receiver_uid == null) {
                $temp[$column_index++] = $temp['receiver'] = t('all');
            }
            else {
                $user = $this->userModel->get_row_by_uid($row->receiver_uid);
                $temp[$column_index++] = $temp['receiver'] = $user->name;
            }
            $temp[$column_index++] = $temp['title'] = $row->title;
            $temp[$column_index++] = $temp['message'] = $row->message;
            $temp[$column_index++] = $temp['reg_time'] = $row->reg_time;
            $temp[$column_index++] = $temp['sender_type'] = $row->sender_type;
            $temp[$column_index++] = $temp['admin_uid'] = $row->admin_uid;
            $return_data[] = $temp;

            $row_index++;
        }

        echo json_encode(SSP::generateOutData($_POST, $return_data, $recordsTotal, $recordsFiltered));
    }

    public function ajax_send_gotify()
    {
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        $once_100 = $this->input->post('once_100');

        if(isEmpty($title) || isEmpty($content)) {
            die(AJAX_RESULT_ERROR);
        }

        $setting = $this->db->get_where("tb_setting", ["uid" => 1])->row();
        if($setting == null) {
            die(AJAX_RESULT_ERROR);
        }

        $count = 0;
        $max = 1;
        if($once_100 == "true") {
            $max = 100;
        }

        for($i = 0; $i < $max;$i++) {
            //$strresponse = send_push_gotify($setting->gotify_app_key, null, null, PUSH_TYPE_NOTICE, $title, $content);
            $strresponse = send_push_openfire('192.168.0.13', 'happymario', 'push', PUSH_TYPE_NOTICE, $title, $content);
            $response = json_decode($strresponse);

            // 성공이면
            if(array_key_exists('id', $response)) {
                $count +=  1;
            }
        }

        if($count > 0) {
            $save_data = [
                'sender_type' => 'admin',
                'sender_uid' => $this->_get_my_uid(),
                'receiver_uid' => null,
                'type' => PUSH_TYPE_NOTICE,
                'title' => $title,
                'message'=> $content,
                'data' => json_encode(array("count" => $count))
            ];
            $this->pushModel->insert($save_data);
            die(AJAX_RESULT_SUCCESS);
        }
        else {
            die(AJAX_RESULT_EMPTY);
        }
    }

    public function ajax_resend_gotify()
    {
        $uids = $this->input->post('uids');

        $arr_uid = json_decode($uids);

        if($arr_uid == null) {
            die(AJAX_RESULT_ERROR);
        }

        $setting = $this->db->get_where("tb_setting", ["uid" => 1])->row();
        if($setting == null) {
            die(AJAX_RESULT_ERROR);
        }

        for($i = 0; $i < count($arr_uid); $i++) {
            $push_row = $this->pushModel->get_row_by_uid($arr_uid[$i]);

            if($push_row == null) {
                continue;
            }

            send_push_gotify($setting->gotify_app_key, null, null, $push_row->type, $push_row->title, $push_row->message);
        }

        die(AJAX_RESULT_SUCCESS);
    }
}