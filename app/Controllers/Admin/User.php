<?php
namespace App\Controllers\Admin;

class User extends AdminBase
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel', 'userModel');
    }

    public function index()
    {
        $this->load_view('user/index', array(), array('page_title' => t('menu_users'), 'menu' => MENU_USER));
    }


    public function photo_list()
    {
        $this->load_view('user/photo_list', array(), array('page_title' => t('menu_photo_check'), 'menu' => MENU_PHOTO_CHECK));
    }


    public function ajax_table()
    {
        $limit = SSP::limit($_POST);
        $search_name = $this->request->getPost('search_keyword');

        $where = 'U.status <> '.STATUS_DELETE;
        if (!empty($search_name)) {
            $where .= " and name like '%$search_name%'";
        }
        $select_list = "U.*";

        $sql_total = <<<EOT
            select U.*
            from tb_user U
            where $where
EOT;
        $sql_count = str_replace($select_list,"count(*) as cnt", $sql_total);
        $sql = $sql_total . ' order by U.uid desc ' . $limit;

        $arr_data = $this->db->query($sql)->result();
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
            $temp[$column_index++] = $temp['id'] = $row->id;
            $temp[$column_index++] = $temp['name'] = $row->name;
            $temp[$column_index++] = $temp['profile_url'] = $row->profile_url;
            $temp[$column_index++] = $temp['status'] = $row->status;
            $temp[$column_index++] = $temp['backup_url'] = $row->backup_url;
            $temp[$column_index++] = $temp['profile_url_check'] = $row->profile_url_check;
            $temp[$column_index++] = $temp['uid'] = $row->uid;
            $return_data[] = $temp;

            $row_index++;
        }

        echo json_encode(SSP::generateOutData($_POST, $return_data, $recordsTotal, $recordsFiltered));
    }

    public function ajax_detail($user_uid)
    {
        if(isEmpty($user_uid)) {
            die(AJAX_RESULT_ERROR);
        }

        $response_data = $this->userModel->get_row_by_uid($user_uid);
        die (json_encode($response_data));
    }

    public function ajax_save()
    {
        $user_uid = $this->request->getPost('user_uid');
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $pwd = $this->request->getPost('pwd');
        $status = $this->request->getPost('status');

        if(isEmpty($id) || isEmpty($name) || isEmpty($pwd) || isEmpty($status)) {
            die(AJAX_RESULT_ERROR);
        }

        if($user_uid != null) {
            $is_duplicate = $this->userModel->id_duplicated_1($user_uid, $id);
            if ($is_duplicate == true) {
                die(AJAX_RESULT_DUP);
            }

            $is_duplicate = $this->userModel->name_duplicated_1($user_uid, $name);
            if ($is_duplicate == true) {
                die(AJAX_RESULT_DUP);
            }
        }
        else {
            if($this->userModel->id_duplicated($id)) {
                die(AJAX_RESULT_DUP);
            }
            if($this->userModel->name_duplicated($name)) {
                die(AJAX_RESULT_DUP);
            }
        }

        $save_data = array(
            'id' => $id,
            'name' => $name,
            'pwd' => $pwd,
            'status' => $status
        );
        if (isset($_FILES['uploadfile'])) {
            $upload_result = $this->upload_file($_FILES['uploadfile']);
            if($upload_result != null) {
                $save_data['profile_url'] = $upload_result['file_url'];
                $save_data['profile_url_check'] = STATUS_NORMAL;
            }
        }
        $this->userModel->save_by_uid($save_data, $user_uid);

        die (AJAX_RESULT_SUCCESS);
    }

    public function ajax_delete()
    {
        $user_uid = $this->request->getPost('user_uid');
        if(isEmpty($user_uid)) {
            die(AJAX_RESULT_ERROR);
        }

        $this->userModel->delete_row_by_status($user_uid);
        die (AJAX_RESULT_SUCCESS);
    }

    public function ajax_photo_list() {
        $page_num = $this->request->getGet('page');
        $status = $this->request->getGet('status');
        if(isEmpty($page_num)) {
            die(AJAX_RESULT_ERROR);
        }

        $count_per_page = API_PAGE_CNT;
        $page_start = API_PAGE_CNT * $page_num;
        $where = "H.profile_url_check=".$status." AND H.profile_url<>''";
        $order_by = "H.reg_time desc";
        $select_list = "H.*";

        $sql = <<<EOF
                SELECT
                  $select_list
                FROM
                    tb_user H
                WHERE
                    {$where}
EOF;
        $sql_list =  $sql." order by {$order_by} LIMIT {$page_start},{$count_per_page}";

        $query = $this->db->query($sql_list);
        $list = $query->result_array();

        $sql_count = str_replace($select_list, "count(*) as cnt", $sql);
        $result_total_count = (int)$this->db->query($sql_count)->row('cnt');
        $result_total_page = (int)($result_total_count / $count_per_page + 1);
        $is_last = $result_total_page - 1 <= (int)$page_num;

        for ($i = 0; $i < count($list); $i++) {
            $data = $list[$i];
            $new_data = array();
            $new_data = $data;
            $new_data['reg_time'] = $data['reg_time'];
            $list[$i] = $new_data;
        }

        die(json_encode([
            'total_count' => $result_total_count,
            'total_page' => $result_total_page,
            'is_last' => $is_last,
            'list' => $list
        ]));
    }

    public function ajax_change_photo_status()
    {
        $user_uid = $this->request->getPost('user_uid');
        $status = $this->request->getPost('status');

        if(isEmpty($user_uid)) {
            die(AJAX_RESULT_ERROR);
        }

        if($status < STATUS_DELETE  ||  $status > STATUS_CHECK) {
            die(AJAX_RESULT_ERROR);
        }

        $save_data = ["profile_url_check" => $status];

        $this->userModel->save_by_uid($save_data, $user_uid);
        die (AJAX_RESULT_SUCCESS);
    }
}
