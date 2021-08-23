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
    protected $allowedFields = ["api_idx", "ai_name", "ai_type", "ai_value", "ai_ness", "ai_exp", "ai_sort", "ai_bigo"];

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