<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/2/2020
 * Time: 4:37 PM
 */
namespace App\Models;
use App\Libraries\SSP;

class PushModel extends BaseModel
{
    /**
     * 테이블명
     */
    protected $table = 'tb_push_his';
    protected $primaryKey = 'uid';
    protected $allowedFields = ["status", "created_at", "deleted_at", "updated_at", "sender_uid", "receiver_uid", "sender_type", "type", "title", "message", "data"];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;

    protected function initialize()
    {
        parent::initialize();
    }

    public function datatable_list($start, $length, $order, $keyword){
        $limit = SSP::limit(["start" => $start, "length" => $length]);

        $status = STATUS_DELETE;
        $where = "E.status != $status and E.sender_uid = A.uid";
        if (!empty($keyword)) {
            $where .= " and (E.title like '%$keyword%' or E.message like '%$keyword%')";
        }

        $select_list = "E.*, A.id as admin_id, A.uid as admin_uid";

        $order_by = " E.created_at desc";
        if($order != null && count($order) > 0) {
            $dir = $_POST['order'][0]['dir'];
            $order_by = " E.updated_at ".$dir;
        }

        $sql = <<<EOT
            select $select_list
            from tb_push_his E, tb_admin A
            where $where 
EOT;
        $sql_total = $sql." order by $order_by". ' ' . $limit;
        $sql_count = str_replace($select_list, "count(E.uid) as cnt", $sql);

        $arr_data = $this->db->query($sql_total)->getResult();
        $total_data_cnt = (int)$this->db->query($sql_count)->getRow('cnt');

        if (count($arr_data) > 0) {
            $recordsTotal = $total_data_cnt;
            $recordsFiltered = $recordsTotal;
        } else {
            $recordsTotal = 0;
            $recordsFiltered = $recordsTotal;
        }

        $return_data = array();

        $row_index = 1;
        $user_model = model("UserModel");
        foreach ($arr_data as $row) {
            $column_index = 0;
            $temp = array();
            $temp[$column_index++] = $temp['uid'] = $row->uid;
            $temp[$column_index++] = $temp['index'] = $recordsFiltered - ($_POST['start'] + $row_index) + 1;

            if($row->sender_type == 'user') {
                $user = $user_model->get_row_by_uid($row->sender_uid);
                $temp[$column_index++] = $temp['sender'] = $user->name;
            }
            else {
                $temp[$column_index++] = $temp['sender'] = $row->admin_id;
            }
            if($row->receiver_uid == null) {
                $temp[$column_index++] = $temp['receiver'] = t('all');
            }
            else {
                $user = $user_model->get_row_by_uid($row->receiver_uid);
                $temp[$column_index++] = $temp['receiver'] = $user->name;
            }
            $temp[$column_index++] = $temp['title'] = $row->title;
            $temp[$column_index++] = $temp['message'] = $row->message;
            $temp[$column_index++] = $temp['created_at'] = $row->created_at;
            $temp[$column_index++] = $temp['sender_type'] = $row->sender_type;
            $temp[$column_index++] = $temp['admin_uid'] = $row->admin_uid;
            $return_data[] = $temp;

            $row_index++;
        }

        return SSP::generateOutData($_POST, $return_data, $recordsTotal, $recordsFiltered);
    }

    public function  get_sent_cnt($keyword) {
        $where = "status !=" . STATUS_DELETE;
        if ($keyword != null) {
            $where .= " and (title like '%$keyword%' or message like '%$keyword%')";
        }
        $sql = "select sum(status) as sumup from tb_push_his where $where";
        $point = $this->db->query($sql)->getRow("sumup");
        if ($point == null || $point == "") {
            $point = 0;
        }

        return $point;
    }


    public function api_list($page_num, $receiver_uid) {
        $count_per_page = API_PAGE_CNT;
        $page_start = API_PAGE_CNT * $page_num;
        $where = "H.status=".STATUS_NORMAL." AND (H.receiver_uid={$receiver_uid} OR H.receiver_uid IS NULL)";
        $order_by = "H.created_at desc";
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
        $list = $query->getResultArray();

        $sql_count = str_replace($select_list, "count(*) as cnt", $sql);
        $result_total_count = (int)$this->db->query($sql_count)->getRow('cnt');
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
            $new_data['reg_time'] = $data['created_at'];
            $new_data['data'] = json_decode($data['data'], true);
            $list[$i] = $new_data;
        }

        return[
            'total_count' => $result_total_count,
            'total_page' => $result_total_page,
            'is_last' => $is_last,
            'list' => $list
        ];
    }
}