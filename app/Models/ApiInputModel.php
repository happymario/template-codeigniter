<?php

namespace App\Models;

/**
 * Created by PhpStorm.
 * User: KGY
 * Date: 2018-01-08
 * Time: 오전 10:24
 */
class ApiInputModel extends BaseModel {
    /**
     * 테이블명
     */
    protected $table = 'tb_api_input';
    protected $primaryKey = 'ai_idx';


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

    public function getListByApiIdx($api_idx){
        $this->select("*");
        $this->where("api_idx", $api_idx);
        $this->orderBy("ai_sort","ASC");
        $result = $this->findAll();
        return $result;
    }


    public function deleteAllByApiIdx($api_idx, $arr_id){
        $this->where("api_idx", $api_idx);
        return $this->doDelete($arr_id);
    }
}