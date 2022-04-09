<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/2/2020
 * Time: 4:37 PM
 */
namespace App\Models;
use App\Libraries\SSP;

class UserModel extends BaseModel
{
    /**
     * 테이블명
     */
    protected $table = 'tb_user';
    protected $primaryKey = "uid";
    protected $allowedFields = [
        'id', 'name', 'pwd', 'profile_url', 'profile_url_check', 'access_token', 'dev_type', 'login_time', 'logout', 'dev_token', "backup_url", 'status'
    ];
    protected $returnType    = 'App\Entities\User';
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function initialize()
    {
        parent::initialize();

        $this->builder = $this->db->table($this->table);
    }

    protected function beforeInsert(array $data) {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data) {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    private function getUpdatedDataWithHashedPassword(array  $data) {
        if(isset($data['data']['pwd'])) {
            $plaintextPassword = $data['data']['pwd'];
            $data['data']['pwd'] = $this->hashPassword($plaintextPassword);
        }
        $data['data']['updated_at'] = get_time_stamp_str();
        return $data;
    }

    private function hashPassword($painPassword) {
        return password_hash($painPassword, PASSWORD_BCRYPT);
    }

    public function findUserByEmailAddress($emailAddress) {
        $user = $this->asArray()->where(['id' => $emailAddress])->first();

        if(!$user) {
            throw new \Exception('User does not exist for specified email address');
        }

        return $user;
    }

    public function id_duplicated($id)
    {
        $dup_cnt = $this->builder->select('count(*) as cnt')->getWhere(array('id' => $id))->getRow('cnt');
        return ($dup_cnt > 0);
    }

    public function id_duplicated_1($user_uid, $id)
    {
        $dup_cnt = $this->builder->select('count(*) as cnt')->getWhere(array('uid<>' => $user_uid, 'id' => $id))->getRow('cnt');
        return ($dup_cnt > 0);
    }

    public function name_duplicated($name)
    {
        $dup_cnt = $this->builder->select('count(*) as cnt')->getWhere(array('name' => $name))->getRow('cnt');
        return ($dup_cnt > 0);
    }

    public function name_duplicated_1($user_uid, $name)
    {
        $dup_cnt = $this->builder->select('count(*) as cnt')->getWhere(array('uid<>' => $user_uid, 'name' => $name))->getRow('cnt');
        return ($dup_cnt > 0);
    }


    public function invalid_access_token($access_token)
    {
        return !($this->builder->select('count(*) as cnt')->getWhere(array('access_token' => $access_token))->getRow('cnt') > 0);
    }

    public function get_user_uid_by_access_token($access_token)
    {
        return $this->builder->getWhere(array('access_token' => $access_token))->getRow('uid');
    }

    public function get_row_by_id($email)
    {
        return $this->builder->getWhere(array('id' => $email))->getRow();
    }

    public function get_user_info_by_access_token($access_token)
    {
        return $this->builder->getWhere(array('access_token' => $access_token))->getRow();
    }

    public function get_login_user($access_token)
    {
        return $this->builder->getWhere(array('access_token' => $access_token, 'logout<>'=>STATUS_OFF, ''))->getRow('uid');
    }

    public function datatable_statistic($year, $month, $keyword) {
        if ($month < 10) {
            $month = "0" . $month;
        }
        $last_year = null;

        $start_day = "$year-$month-01";
        $day_count = date('t', strtotime($start_day));
        $total_data_cnt = $day_count + 1;
        $recordsTotal = $total_data_cnt;
        $recordsFiltered = $recordsTotal;

        $return_data = array();

        $row_index = 1;
        $total = array("date" => "합계", "count" => 0, "login" => 0);
        for ($i = 1; $i <= $day_count; $i++) {
            $column_index = 0;
            $day = "$year-$month-$i";
            if ($i < 10) {
                $day = "$year-$month-0$i";
            }

            $temp = array();
            $temp['date'] = $day;
            $temp['count'] = 0;
            $temp['login'] = 0;

            // 알림 개수
            $where = "created_at like '$day%' and status !=" . STATUS_DELETE;
            if ($keyword != null) {
                $where .= " and (title like '%$keyword%' or message like '%$keyword%')";
            }
            $sql = "select sum(status) as sumup from tb_push_his where $where";
            $point = $this->db->query($sql)->getRow("sumup");
            if ($point == null || $point == "") {
                $point = 0;
            }
            $temp['count'] = $point;

            // 가입자수
            $where = "created_at like '$day%' and status !=" . STATUS_DELETE;
            $sql = "select count(*) as cnt from tb_user where $where";
            $login_cnt = $this->db->query($sql)->getRow('cnt');
            $temp['login'] = $login_cnt;


            $temp[$column_index++] = $temp['date'];
            $temp[$column_index++] = $temp['count'];
            $temp[$column_index++] = $temp['login'];
            $return_data[] = $temp;

            $total['count'] += $temp['count'];
            $total['login'] += $temp['login'];

            $row_index++;
        }

        $column_index = 0;
        $total[$column_index++] = $total['date'];
        $total[$column_index++] = $total['count'];
        $total[$column_index++] = $total['login'];
        $return_data[] = $total;

        return SSP::generateOutData($_POST, $return_data, $recordsTotal, $recordsFiltered);
    }

    public function datatable_list($start, $length, $search_name)
    {
        $limit = SSP::limit(["start" => $start, "length" => $length]);

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

        $arr_data = $this->db->query($sql)->getResult();
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

        return SSP::generateOutData($_POST, $return_data, $recordsTotal, $recordsFiltered);
    }


    public function photo_list($page_num, $status) {
        $count_per_page = API_PAGE_CNT;
        $page_start = API_PAGE_CNT * $page_num;
        $where = "H.profile_url_check=".$status." AND H.profile_url<>''";
        $order_by = "H.created_at desc";
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
        $list = $query->getResultArray();

        $sql_count = str_replace($select_list, "count(*) as cnt", $sql);
        $result_total_count = (int)$this->db->query($sql_count)->getRow('cnt');
        $result_total_page = (int)($result_total_count / $count_per_page + 1);
        $is_last = $result_total_page - 1 <= (int)$page_num;

        for ($i = 0; $i < count($list); $i++) {
            $data = $list[$i];
            $new_data = array();
            $new_data = $data;
            $new_data['reg_time'] = $data['created_at'];
            $list[$i] = $new_data;
        }

        return [
            'total_count' => $result_total_count,
            'total_page' => $result_total_page,
            'is_last' => $is_last,
            'list' => $list
        ];
    }
}