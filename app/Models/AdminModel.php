<?php


namespace App\Models;


class AdminModel extends BaseModel
{
    protected $table      = 'tb_admin';
    protected $primaryKey = 'uid';
    protected $allowedFields = ["id", "status"];

    protected function initialize()
    {
        parent::initialize();
    }

    public function checkAdmin($id, $pwd) {
        $adminInfo = $this->where(array('id' => $id, 'pwd' => $pwd, 'status<>' => STATUS_DELETE))->find();
        if($adminInfo != null && count($adminInfo) > 0) {
            return $adminInfo[0]["uid"];
        }
        return null;
    }
}