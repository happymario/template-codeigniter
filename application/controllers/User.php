<?php

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load_view('user/index', array(), array('page_title' => t('menu_users'), 'menu' => MENU_USER));
    }

    public function ajax_table()
    {
        $limit = SSP::limit($_POST);
        $search_name = $this->input->post('search_name');

        $where = '';

        if (!empty($search_name)) {
            $where .= " and name like '%$search_name%'";
        }

        $sql_total = <<<EOT
            select *
            from tb_user
            where status <> 'n' $where
            order by uid desc 
EOT;
        $sql_count = <<<EOT
            select count(*) as cnt
            from tb_user
            where status <> 'n' $where
EOT;

        $sql = $sql_total . ' ' . $limit;

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
            $temp[$column_index++] = $temp['name'] = $row->name;
            $temp[$column_index++] = $temp['login_type'] = $row->login_type;
            $temp[$column_index++] = $temp['pwd'] = (empty($row->pwd) || $row->login_type == "naver") ? '---' : $row->pwd;
            $temp[$column_index++] = $temp['status'] = $row->status;
            $temp[$column_index++] = $temp['uid'] = $row->uid;
            $return_data[] = $temp;

            $row_index++;
        }

        echo json_encode(SSP::generateOutData($_POST, $return_data, $recordsTotal, $recordsFiltered));
    }

    public function get_contents($user_uid)
    {
        $response_data = $this->db->query("select * from tb_user where uid = $user_uid")->row();
        die (json_encode($response_data));
    }

    public function save()
    {
        $user_uid = $this->input->post('user_uid');

        $name = $this->input->post('name') ?? '';
        $pwd = $this->input->post('pwd') ?? '';
        $status = $this->input->post('status') ?? '';

        $save_data = array(
            'name' => $name,
            'pwd' => $pwd,
            'status' => $status
        );

        $dup_cnt = $this->db->get_where('tb_user', array('uid<>' => $user_uid, 'name' => $name))->num_rows();
        if ($dup_cnt > 0) {
            die ("dup");
        }

        if ($user_uid > 0) {
            $this->db->update('tb_user', $save_data, array('uid' => $user_uid));
        } else {
            $this->db->insert('tb_user', $save_data);
        }
        die ("success");
    }

    public function delete()
    {
        $user_uid = $this->input->post('user_uid');
        $this->db->update('tb_user', array('status' => 'n'), array('uid' => $user_uid));
        die ("success");
    }
}
