<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/2/2020
 * Time: 4:37 PM
 */
namespace App\Models;

class PushModel extends BaseModel
{
    /**
     * 테이블명
     */
    public $table = 'tb_push_his';


    protected function initialize()
    {
        parent::initialize();
    }
}