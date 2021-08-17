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
    public $_table = 'tb_push_his';

    public function __construct($_table = "")
    {
        parent::__construct();
    }
}