<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/3/2020
 * Time: 11:10 AM
 */

require_once 'ApiBase.php';

class Push extends ApiBase
{
    public function __construct()
    {
        parent::__construct();
    }


    function push_list() {
        $this->_set_api_params([
            new ApiParamModel('access_token', 'required'),
            new ApiParamModel('page', 'required')
        ]);

        $page_num = $this->api_params->page;
        $access_token = $this->api_params->access_token;

        $this->_check_access_token($access_token);

        $receiver_uid = $this->_get_user_uid($access_token);

        $count_per_page = API_PAGE_CNT;
        $page_start = API_PAGE_CNT * $page_num;
        $where = "H.status=".STATUS_NORMAL." AND (H.receiver_uid={$receiver_uid} OR H.receiver_uid IS NULL)";
        $order_by = "H.reg_time desc";
        $select_list = "H.*";

        $sql = <<<EOF
                SELECT
                  $select_list
                FROM
                    tb_push_his H
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
            $new_data['sender_uid'] = $data['sender_uid'];
            $new_data['receiver_uid'] = $data['receiver_uid'];
            $new_data['type'] = $data['type'];
            $new_data['title'] = $data['title'];
            $new_data['message'] = $data['message'];
            $new_data['reg_time'] = $data['reg_time'];
            $new_data['data'] = json_decode($data['data'], true);
            $list[$i] = $new_data;
        }

        $this->_response_success([
            'total_count' => $result_total_count,
            'total_page' => $result_total_page,
            'is_last' => $is_last,
            'list' => $list
        ]);
    }
}