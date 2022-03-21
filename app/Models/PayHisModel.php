<?php

namespace App\Models;

use CodeIgniter\Model;

class PayHisModel extends Model
{
    protected $table = 'tb_pay_his';
    protected $primaryKey = 'uid';
    protected $protectFields = false;
    protected $returnType = 'object';

    public function isSubscribed($user_uid) {
        $db = \Config\Database::connect();

        $sql = <<<SQL
                SELECT
                    count(*) as cnt
                FROM
                    tb_pay_his 
                WHERE
                    user_uid = ($user_uid) 
                AND DATE( reg_time ) <= CURDATE() AND DATE( end_time ) >= CURDATE()
SQL;
        $query = $db->query($sql);
        $result = $query->getResultObject();

        if($result != null && count($result) > 0 && $result[0]->cnt > 0) {
            return true;
        }

        return false;
    }
}