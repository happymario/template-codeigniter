<?php


namespace App\Models;
use App\Libraries\SSP;

class NoticeModel extends BaseModel
{
    protected $table = 'tb_notice';
    protected $primaryKey = 'uid';
    protected $allowedFields = ["updated_at", "created_at", "deleted_at", "status", "title", "content", "image_url", "admin_uid"];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;

    protected function initialize()
    {
        parent::initialize();
    }

    public function datatable_list($start, $length, $order, $keyword){
        $limit = SSP::limit(["start" => $start, "length" => $length]);
        $where = "E.status != ".STATUS_DELETE." and E.admin_uid = A.uid";
        if (!empty($keyword)) {
            $where .= " and (E.title like '%$keyword%' or E.content like '%$keyword%')";
        }
        $select_list = "E.*, A.id as admin_id";

        $order_by = " E.updated_at desc";
        if($order != null && count($order) > 0) {
            $dir = $order[0]['dir'];
            $order_by = " E.updated_at ".$dir;
        }

        $sql = <<<EOT
            select $select_list
            from tb_notice E, tb_admin A
            where $where 
EOT;
        $sql_total = $sql." order by $order_by". ' ' . $limit;
        $arr_data = $this->db->query($sql_total)->getResult();

        $sql_count = str_replace($select_list, "count(E.uid) as cnt", $sql);
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
        foreach ($arr_data as $row) {
            $column_index = 0;
            $temp = array();
            $temp[$column_index++] = $temp['index'] = $recordsFiltered - ($_POST['start'] + $row_index) + 1;
            $temp[$column_index++] = $temp['title'] = $row->title;
            $temp[$column_index++] = $temp['content'] = $row->content;
            $temp[$column_index++] = $temp['updated_at'] = $row->updated_at;
            $temp[$column_index++] = $temp['image_url'] = $row->image_url;
            $temp[$column_index++] = $temp['admin_id'] = $row->admin_id;
            $temp[$column_index++] = $temp['uid'] = $row->uid;
            $temp[$column_index++] = $temp['admin_uid'] = $row->admin_uid;
            $return_data[] = $temp;

            $row_index++;
        }

        return SSP::generateOutData($_POST, $return_data, $recordsTotal, $recordsFiltered);
    }
}