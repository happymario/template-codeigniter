<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/2/2020
 * Time: 4:37 PM
 */
namespace App\Models;

class UserModel extends BaseModel
{
    /**
     * 테이블명
     */
    public $_table = 'tb_user';

    public function __construct($_table = "")
    {
        parent::__construct();
    }

    public function id_duplicated($id)
    {
        $dup_cnt = $this->db->select('count(*) as cnt')->get_where($this->_table, array('id' => $id))->row('cnt');
        return ($dup_cnt > 0);
    }

    public function id_duplicated_1($user_uid, $id)
    {
        $dup_cnt = $this->db->select('count(*) as cnt')->get_where($this->_table, array('uid<>' => $user_uid, 'id' => $id))->row('cnt');
        return ($dup_cnt > 0);
    }

    public function name_duplicated($name)
    {
        $dup_cnt = $this->db->select('count(*) as cnt')->get_where($this->_table, array('name' => $name))->row('cnt');
        return ($dup_cnt > 0);
    }

    public function name_duplicated_1($user_uid, $name)
    {
        $dup_cnt = $this->db->select('count(*) as cnt')->get_where($this->_table, array('uid<>' => $user_uid, 'name' => $name))->row('cnt');
        return ($dup_cnt > 0);
    }


    public function invalid_access_token($access_token)
    {
        return !($this->db->select('count(*) as cnt')->get_where($this->_table, array('access_token' => $access_token))->row('cnt') > 0);
    }

    public function get_user_uid_by_access_token($access_token)
    {
        return $this->db->get_where($this->_table, array('access_token' => $access_token))->row('uid');
    }

    public function get_row_by_id($email)
    {
        return $this->db->get_where($this->_table, array('id' => $email))->row();
    }

    public function get_user_info_by_access_token($access_token)
    {
        return $this->db->get_where($this->_table, array('access_token' => $access_token))->row();
    }
}