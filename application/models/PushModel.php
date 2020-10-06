<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/2/2020
 * Time: 4:37 PM
 */

class PushModel extends MY_Model
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