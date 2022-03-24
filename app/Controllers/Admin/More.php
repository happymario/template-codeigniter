<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 8/17/2020
 * Time: 10:45 AM
 */
namespace App\Controllers\Admin;

use App\Models\NoticeModel;
use App\Models\SettingModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;


class More  extends Base_admin
{
    /**
     * @var SettingModel
     */
    private $settingModel;

    /**
     * @var NoticeModel
     */
    private $noticeModel;

    /************************************************************************
     * Overrides
     ************************************************************************/
     /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->settingModel = model("SettingModel");
        $this->noticeModel = model("NoticeModel");
    }


    /************************************************************************
     * View
     *************************************************************************/
    public function notice_list()
    {
        $this->load_view('more/notice/index', array(), array('page_title' => t('menu_notice'), 'menu' => MENU_NOTICE));
    }

    public function notice_add() {
        $this->notice_detail(null);
    }

    public function notice_detail($id) {
        $item = array();
        if($id != null) {
            $response_data = $this->noticeModel->where("uid", $id)->first();
            if($response_data != null) {
                $item = $response_data;
            }
        }

        $this->load_view('more/notice/detail', array(), array('page_title' => t('menu_notice'), 'menu' => MENU_NOTICE, 'item' => $item));
    }

    public function setting()
    {
        $setting = $this->settingModel->asObject()->where('status<>', STATUS_DELETE)->first();
        $this->load_view('more/setting', array("setting" => $setting), array('page_title' => t('menu_setting'), 'menu' => MENU_SETTING));
    }


    /************************************************************************
     * AJAX APIs
     *************************************************************************/
    public function ajax_notice_list() {
        $this->check_ajax();

        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $order = $this->request->getPost('order');
        $keyword = $this->request->getPost('search_keyword');

        $data = $this->noticeModel->datatable_list($start, $length, $order, $keyword);

        //$this->ajax_result2($data);
        die(json_encode($data, true));
    }


    public function ajax_notice_detail($notice_uid)
    {
        $this->check_ajax();

        $response_data = $this->noticeModel->where("uid", $notice_uid)->first();

        $this->ajax_result2($response_data);
    }


    public function ajax_notice_save()
    {
        $this->check_ajax();

        $uid = $this->request->getPost('uid');
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');

        $save_data = ["admin_uid" => $_SESSION[SESSION_ADMIN_UID], "title"=>$title, "content"=>$content];
        if (isset($_FILES['uploadfile']) == true) {
            $upload_result = $this->uploadFile($_FILES['uploadfile']);
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
        $this->noticeModel->save($save_data);

        $this->ajax_result(AJAX_RESULT_SUCCESS);
    }


    public function ajax_notice_delete() {
        $this->check_ajax();

        $uid = $this->request->getPost('uid');
        $this->noticeModel->deleteById($uid, true);

        $this->ajax_result(AJAX_RESULT_SUCCESS);
    }

    public function ajax_setting_save() {
        $this->check_ajax();

        if ($this->request->getPost() == null && !$this->validate([
                'use_agreement' => 'required',
                'client_phone'  => 'required',
            ])) {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }

        $save_data = $this->request->getPost();
        $this->settingModel->updateData($save_data);

        $this->ajax_result(AJAX_RESULT_SUCCESS);
    }
}