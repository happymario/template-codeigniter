<?php

class User extends MY_Controller
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
        $search_name = $this->input->post('search_keyword');

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
            $temp[$column_index++] = $temp['status'] = $row->status;
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
        $user_uid = $this->input->post('user_uid');
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $pwd = $this->input->post('pwd');
        $status = $this->input->post('status');

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
        $user_uid = $this->input->post('user_uid');
        if(isEmpty($user_uid)) {
            die(AJAX_RESULT_ERROR);
        }

        $this->userModel->delete_row_by_status($user_uid);
        die (AJAX_RESULT_SUCCESS);
    }
}
