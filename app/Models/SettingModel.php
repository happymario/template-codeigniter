<?php


namespace App\Models;


class SettingModel extends BaseModel
{
    protected $table = 'tb_setting';
    protected $primaryKey = 'uid';
    protected $allowedFields = ["client_phone", "use_agreement"];

    protected function initialize()
    {
        parent::initialize();
    }

    public function updateData($data) {
        $this
            ->where('status<>', STATUS_DELETE)
            ->set($data)
            ->update();
    }
}