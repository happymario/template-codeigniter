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
    protected $table = 'tb_api_list';
    protected $primaryKey = 'api_idx';
    protected $allowedFields = ["api_name", "api_exp", "api_url", "api_use", "api_status", "api_bigo", "api_ver", "api_method"];

    public function getTotalApiList($usable_only = false) {
        $this->select("*");
        if ($usable_only) {
            $this->where('api_use', 1);
        }
        $this->orderBy("api_name", "asc");
        $result = $this->findAll();
        return $result;
    }
}