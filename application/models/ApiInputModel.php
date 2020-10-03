<?php
/**
 * Created by PhpStorm.
 * User: KGY
 * Date: 2018-01-08
 * Time: 오전 10:24
 */
class ApiInputModel extends MY_Model{
    /**
     * 테이블명
     */
    public $_table = 'tb_api_input';

    public $ai_idx = 0;
    public $api_idx = 0;
    public $ai_name = '';
    public $ai_type = '';
    public $ai_value = '';
    public $ai_ness = '';
    public $ai_exp = '';
    public $ai_sort = 0;
    public $ai_bigo = '';

    /**
     * 사용되는 테이블의 프라이머리키
     */
    public $primary_key = 'ai_idx'; // 사용되는 테이블의 프라이머리키

    function __construct()
    {
        parent::__construct("tb_api_input");
        $this->load->database();
    }

    public function select_max_sort($api_idx)
    {
        $this->db->select_max('ai_sort');
        $this->db->where('api_idx', $api_idx);
        $qry = $this->db->get($this->_table);
        $result = $qry->row_array();
        return $result['ai_sort'];
    }

    public function update_sort($api_idx, $ai_sort)
    {
        $this->db->where('api_idx', $api_idx);
        $this->db->where('ai_sort >=', $ai_sort);
        $this->db->set('ai_sort', 'ai_sort+1', false);
        $result = $this->db->update($this->_table);
        return $result;
    }

    public function save(){
        $insertData = array();
        $insertData['ai_idx'] = $this->ai_idx;
        $insertData['api_idx'] = $this->api_idx;
        $insertData['ai_name'] = $this->ai_name;
        $insertData['ai_type'] = $this->ai_type;
        $insertData['ai_value'] = $this->ai_value;
        $insertData['ai_ness'] = $this->ai_ness;
        $insertData['ai_exp'] = $this->ai_exp;
        $insertData['ai_sort'] = $this->ai_sort;
        $insertData['ai_bigo'] = $this->ai_bigo;

        $inserted_id = $this->insert($insertData);
        return $inserted_id;
    }

    public function update_data(){
        if($this->ai_idx == 0){
            return false;
        }

        $updateData = array();
        $updateData['ai_idx'] = $this->ai_idx;
        $updateData['api_idx'] = $this->api_idx;
        $updateData['ai_name'] = $this->ai_name;
        $updateData['ai_type'] = $this->ai_type;
        $updateData['ai_value'] = $this->ai_value;
        $updateData['ai_ness'] = $this->ai_ness;
        $updateData['ai_exp'] = $this->ai_exp;
        $updateData['ai_sort'] = $this->ai_sort;
        $updateData['ai_bigo'] = $this->ai_bigo;

        $update_status = $this->update($this->ai_idx,$updateData);
        return $update_status;
    }

    public function getListByApiIdx($api_idx){
        $arr_result = array();

        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("api_idx=$api_idx");
        $this->db->order_by("ai_sort","ASC");
        $result = $this->db->get()->result();

        foreach($result as $row){
            $tmp_result = array();
            $tmp_result['ai_idx'] = $row->ai_idx;
            $tmp_result['ai_name'] = $row->ai_name;
            $tmp_result['ai_type'] = $row->ai_type;
            $tmp_result['ai_value'] = $row->ai_value;
            $tmp_result['ai_ness'] = $row->ai_ness;
            $tmp_result['ai_exp'] = $row->ai_exp;
            $tmp_result['ai_sort'] = $row->ai_sort;
            $tmp_result['ai_bigo'] = $row->ai_bigo;
            array_push($arr_result,$tmp_result);
        }
        return $arr_result;
    }

    public function findById($id){
        $this->db->select("*");
        $this->db->from($this->_table);
        $this->db->where("ai_idx=".$id);
        $result = $this->db->get()->result();
        foreach($result as $row){
            $this->setValue($row);
        }
        return $this;
    }

    public function setValue($data){
        $this->ai_idx = $data->ai_idx;
        $this->api_idx = $data->api_idx;
        $this->ai_name = $data->ai_name;
        $this->ai_type = $data->ai_type;
        $this->ai_value = $data->ai_value;
        $this->ai_ness = $data->ai_ness;
        $this->ai_exp = $data->ai_exp;
        $this->ai_sort = $data->ai_sort;
        $this->ai_bigo = $data->ai_bigo;
    }

    public function deleteAll($where=""){
        $sql = "delete from $this->_table where $where";
        return $this->db->query($sql);
    }
}