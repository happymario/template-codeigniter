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

    public function deleteAll($arr_id, $with_status = false) {
        if($with_status == true) {
            $this->update($arr_id, ["status" => STATUS_DELETE]);
        }
        return $this->doDelete($arr_id);
    }

    public function deleteById($id, $with_status = false) {
        if($with_status == true) {
            $this->update($id, ["status" => STATUS_DELETE]);
        }
        return $this->doDelete(array($id));
    }

    public function saveById($id, $data) {
        if($id == null) {
            $this->insert($data);
        }
        else {
            $this->where("uid", $id)->update($id, $data);
        }
    }
}
