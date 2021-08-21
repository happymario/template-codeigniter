<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 8/17/2020
 * Time: 10:45 AM
 */
namespace App\Controllers\Admin;

class Appmanage  extends AdminBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function notice_list()
    {
        $this->load_view('app/notice_list', array(), array('page_title' => t('menu_notice'), 'menu' => MENU_NOTICE));
    }

    public function setting()
    {
        $use_agreement = $this->request->getPost('use_agreement');
        $client_phone = $this->request->getPost('client_phone');

        $save_data = [];
        if($client_phone != null) {
            $save_data['client_phone'] = $client_phone;
        }
        if($use_agreement != null) {
            $save_data['use_agreement'] = $use_agreement;
        }

        if(empty($save_data) == false) {
            $this->db->update('tb_setting', $save_data, ["status!=" => STATUS_DELETE]);
        }

        $sql = "select * from tb_setting where status !=".STATUS_DELETE;
        $setting = $this->db->query($sql)->row();

        $this->load_view('app/setting', array("setting" => $setting), array('page_title' => t('menu_setting'), 'menu' => MENU_SETTING));
    }

    public function ajax_notice_list() {
        $limit = SSP::limit($_POST);
        $search_keyword = $this->request->getPost('search_keyword');

        $status = STATUS_DELETE;
        $where = "E.status != $status and E.admin_uid = A.uid";
        if (!empty($search_keyword)) {
            $where .= " and (E.title like '%$search_keyword%' or E.content like '%$search_keyword%')";
        }
        $select_list = "E.*, A.id as admin_id";

        $order_by = " E.edt_time desc";
        if(array_key_exists("order", $_POST)) {
            $dir = $_POST['order'][0]['dir'];
            $order_by = " E.edt_time ".$dir;
        }

        $sql = <<<EOT
            select $select_list
            from tb_notice E, tb_admin A
            where $where 
EOT;
        $sql_total = $sql." order by $order_by". ' ' . $limit;
        $arr_data = $this->db->query($sql_total)->result();

        $sql_count = str_replace($select_list, "count(E.uid) as cnt", $sql);
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
            $temp[$column_index++] = $temp['index'] = $recordsFiltered - ($_POST['start'] + $row_index) + 1;
            $temp[$column_index++] = $temp['title'] = $row->title;
            $temp[$column_index++] = $temp['content'] = $row->content;
            $temp[$column_index++] = $temp['image_url'] = $row->image_url;
            $temp[$column_index++] = $temp['admin_id'] = $row->admin_id;
            $temp[$column_index++] = $temp['edt_time'] = $row->edt_time;
            $temp[$column_index++] = $temp['uid'] = $row->uid;
            $temp[$column_index++] = $temp['admin_uid'] = $row->admin_uid;
            $return_data[] = $temp;

            $row_index++;
        }

        echo json_encode(SSP::generateOutData($_POST, $return_data, $recordsTotal, $recordsFiltered));
    }


    public function ajax_notice_detail($notice_uid)
    {
        $response_data = $this->db->query("select * from tb_notice where uid = $notice_uid")->row();
        die (json_encode($response_data));
    }


    public function ajax_notice_save()
    {
        $uid = $this->request->getPost('uid');
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');

        $save_data = ["admin_uid" => $_SESSION[SESSION_ADMIN_UID], "title"=>$title, "content"=>$content];
        if (isset($_FILES['uploadfile']) == true) {
            $upload_result = $this->upload_file($_FILES['uploadfile']);
            if($upload_result != null) {
                $save_data['image_url'] = $upload_result['file_url'];
            }
        }
        else if($this->request->getPost('img_src') == "") {
            $save_data['image_url'] = '';
        }

        if ($uid > 0) {
            $this->db->update('tb_notice', $save_data, ["uid" => $uid]);
        } else {
            $this->db->insert('tb_notice', $save_data);
        }
        die ("success");
    }

    public function ajax_notice_delete() {
        $uid = $this->request->getPost('uid');
        $this->db->update('tb_notice', array("status"=>STATUS_DELETE), ["uid" => $uid]);
        die ("success");
    }
}