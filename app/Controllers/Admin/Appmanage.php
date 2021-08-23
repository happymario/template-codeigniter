<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 8/17/2020
 * Time: 10:45 AM
 */
namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Appmanage  extends AdminBase
{
    /************************************************************************
     * Overrides
     *************************************************************************/
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->setting_model = model("SettingModel");
        $this->notice_model = model("NoticeModel");
    }


    /************************************************************************
     * View
     *************************************************************************/
    public function notice_list()
    {
        $this->load_view('app/notice_list', array(), array('page_title' => t('menu_notice'), 'menu' => MENU_NOTICE));
    }


    public function setting()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
                'use_agreement' => 'required',
                'client_phone'  => 'required',
            ])) {
            $save_data = $this->request->getPost();
            $this->setting_model->updateData($save_data);
        }

        $setting = $this->setting_model->asObject()->where('status<>', STATUS_DELETE)->first();
        $this->load_view('app/setting', array("setting" => $setting), array('page_title' => t('menu_setting'), 'menu' => MENU_SETTING));
    }


    /************************************************************************
     * AJAX APIs
     *************************************************************************/
    public function ajax_notice_list() {
        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $order = $this->request->getPost('order');
        $keyword = $this->request->getPost('search_keyword');

        $data = $this->notice_model->datatable_list($start, $length, $order, $keyword);

        echo json_encode($data);
    }


    public function ajax_notice_detail($notice_uid)
    {
        $response_data = $this->notice_model->where("uid", $notice_uid)->first();
        die (json_encode($response_data));
    }


    public function ajax_notice_save()
    {
        $uid = $this->request->getPost('uid');
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');

        $save_data = ["admin_uid" => $_SESSION[SESSION_ADMIN_UID], "title"=>$title, "content"=>$content];
        if (isset($_FILES['uploadfile']) == true) {
            $upload_result = $this->upload_file($_FILES['uploadfile']);
            if($upload_result != null) {
                $save_data['image_url'] = $upload_result['file_url'];
            }
        }
        else if($this->request->getPost('img_src') == "") {
            $save_data['image_url'] = '';
        }

        if ($uid > 0) {
            $save_data["uid"] = $uid;
        }
        $this->notice_model->save($save_data);

        die ("success");
    }

    public function ajax_notice_delete() {
        $uid = $this->request->getPost('uid');
        $this->notice_model->deleteById($uid, true);
        die ("success");
    }
}