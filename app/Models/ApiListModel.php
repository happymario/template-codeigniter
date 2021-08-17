<?php

namespace App\Models;

/**
 * Created by PhpStorm.
 * User: KGY
 * Date: 2018-01-08
 * Time: 오전 10:32
 */
class ApiListModel extends BaseModel {
    /**
     * 테이블명
     */
    public $_table = 'tb_api_list';

    public $api_idx = '';
    public $api_name = '';
    public $api_exp = '';
    public $api_url = '';
    public $api_method = '';
    public $api_use = 0;
    public $api_status = '';
    public $api_bigo = '';
    public $api_ver = API_CURRENT_VERSION;
    /**
     * 사용되는 테이블의 프라이머리키
     */
    public $primary_key = 'api_idx'; // 사용되는 테이블의 프라이머리키

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save() {
        $insertData = array();
        $insertData['api_idx'] = $this->api_idx;
        $insertData['api_name'] = $this->api_name;
        $insertData['api_exp'] = $this->api_exp;
        $insertData['api_url'] = $this->api_url;
        $insertData['api_method'] = $this->api_method;
        $insertData['api_use'] = $this->api_use;
        $insertData['api_status'] = $this->api_status;
        $insertData['api_bigo'] = $this->api_bigo;
        $insertData['api_ver'] = API_CURRENT_VERSION;

        $inserted_id = $this->insert($insertData);
        return $inserted_id;
    }

    public function update_data() {
        if ($this->api_idx == 0) {
            return false;
        }

        $updateData = array();
        $updateData['api_idx'] = $this->api_idx;
        $updateData['api_name'] = $this->api_name;
        $updateData['api_exp'] = $this->api_exp;
        $updateData['api_url'] = $this->api_url;
        $updateData['api_method'] = $this->api_method;
        $updateData['api_use'] = $this->api_use;
        $updateData['api_status'] = $this->api_status;
        $updateData['api_bigo'] = $this->api_bigo;
        $updateData['api_ver'] = API_CURRENT_VERSION;

        $update_status = $this->update($this->api_idx, $updateData);
        return $update_status;
    }

    public function getTotalApiList($usable_only = false) {
        $return_result = array();
        $this->db->select("*");
        $this->db->from($this->_table);
        if ($usable_only) {
            $this->db->where('api_use', 1);
        }
        $this->db->order_by("api_name", "asc");
        $result = $this->db->get()->result();

        foreach ($result as $row) {
            $tmp_result = array();
            $tmp_result['api_idx'] = $row->api_idx;
            $tmp_result['api_name'] = $row->api_name;
            $tmp_result['api_exp'] = $row->api_exp;
            $tmp_result['api_url'] = $row->api_url;
            $tmp_result['api_method'] = $row->api_method;
            $tmp_result['api_use'] = $row->api_use;
            $tmp_result['api_status'] = $row->api_status;
            $tmp_result['api_bigo'] = $row->api_bigo;
            $tmp_result['api_ver'] = $row->api_ver;
            array_push($return_result, $tmp_result);
        }
        return $return_result;
    }

    public function findById($id) {
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("api_idx=" . $id);
        $result = $this->db->get()->result();
        foreach ($result as $row) {
            $this->setValue($row);
        }
        return $this;
    }

    public function setValue($data) {
        $this->api_idx = $data->api_idx;
        $this->api_name = $data->api_name;
        $this->api_exp = $data->api_exp;
        $this->api_url = $data->api_url;
        $this->api_method = $data->api_method;
        $this->api_use = $data->api_use;
        $this->api_status = $data->api_status;
        $this->api_bigo = $data->api_bigo;
        $this->api_ver = $data->api_ver;
    }

    public function deleteAll($where = "") {
        $sql = "delete from $this->_table where $where";
        return $this->db->query($sql);
    }
}