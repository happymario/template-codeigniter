<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 * MY_Model class
 */

class BaseModel extends Model
{
    public function findById($uid) {
        return $this->where($this->primaryKey, $uid)->first();
    }

    public function deleteAll($arr_id) {
        return $this->doDelete($arr_id);
    }
}
