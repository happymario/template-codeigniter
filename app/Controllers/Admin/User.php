<?php
namespace App\Controllers\Admin;

use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class User extends Base_admin
{
    /**
     * @var UserModel
     */
    private $userModel;

    /************************************************************************
     * Overrides
     ************************************************************************
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->userModel = model("UserModel");
    }

    /************************************************************************
     * View
     *************************************************************************/
    public function index()
    {
        $this->load_view('user/index', array(), array('page_title' => t('menu_users'), 'menu' => MENU_USER));
    }


    public function photo_list()
    {
        $this->load_view('user/photo_list', array(), array('page_title' => t('menu_photo_check'), 'menu' => MENU_PHOTO_CHECK));
    }


    /************************************************************************
     * Ajax
     *************************************************************************/
    public function ajax_table()
    {
        $this->check_ajax();

        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $keyword = $this->request->getPost('search_keyword');

        $data = $this->userModel->datatable_list($start, $length, $keyword);

        $this->ajax_result2($data);
    }

    public function ajax_detail($user_uid)
    {
        $this->check_ajax();

        if($user_uid == null) {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }

        $response_data = $this->userModel->findById($user_uid);
        $this->ajax_result2($response_data);
    }

    public function ajax_save()
    {
        $this->check_ajax();

        $user_uid = $this->request->getPost('user_uid');
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $pwd = $this->request->getPost('pwd');
        $status = $this->request->getPost('status');

        if(!$this->validate(['id' => 'required', 'name '  => 'required', 'pwd '  => 'required', 'status '  => 'required'])) {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }

        if($user_uid != null) {
            $is_duplicate = $this->userModel->id_duplicated_1($user_uid, $id);
            if ($is_duplicate == true) {
                $this->ajax_result(AJAX_RESULT_DUP);
            }

            $is_duplicate = $this->userModel->name_duplicated_1($user_uid, $name);
            if ($is_duplicate == true) {
                $this->ajax_result(AJAX_RESULT_DUP);
            }
        }
        else {
            if($this->userModel->id_duplicated($id)) {
                $this->ajax_result(AJAX_RESULT_DUP);
            }
            if($this->userModel->name_duplicated($name)) {
                $this->ajax_result(AJAX_RESULT_DUP);
            }
        }

        $save_data = array(
            'id' => $id,
            'name' => $name,
            'pwd' => $pwd,
            'status' => $status
        );
        if (isset($_FILES['uploadfile'])) {
            $upload_result = $this->uploadFile($_FILES['uploadfile']);
            if($upload_result != null) {
                $save_data['profile_url'] = $upload_result['file_url'];
                $save_data['profile_url_check'] = STATUS_NORMAL;
            }
        }

        if($user_uid != null) {
            $save_data["uid"] = $user_uid;
        }
        $this->userModel->save($save_data);

        $this->ajax_result(AJAX_RESULT_SUCCESS);
    }

    public function ajax_delete()
    {
        $this->check_ajax();

        $user_uid = $this->request->getPost('user_uid');
        if($user_uid == null) {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }

        $this->userModel->deleteById($user_uid);

        $this->ajax_result(AJAX_RESULT_SUCCESS);
    }

    public function ajax_photo_list() {
        $this->check_ajax();

        $page_num = $this->request->getGet('page');
        $status = $this->request->getGet('status');

        if($page_num === null) {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }

        $data = $this->userModel->photo_list($page_num, $status);

        $this->ajax_result2($data);
    }

    public function ajax_change_photo_status()
    {
        $this->check_ajax();

        $user_uid = $this->request->getPost('user_uid');
        $status = $this->request->getPost('status');

        if($user_uid == null) {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }

        if($status < STATUS_DELETE  ||  $status > STATUS_CHECK) {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }

        $save_data = ["profile_url_check" => $status, "uid" => $user_uid];

        $this->userModel->save($save_data);

        $this->ajax_result(AJAX_RESULT_SUCCESS);
    }
}
