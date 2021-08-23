<?php
namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class User extends AdminBase
{
    /************************************************************************
     * Overrides
     *************************************************************************/
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->user_model = model("UserModel");
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
        $start = $this->request->getPost('start');
        $length = $this->request->getPost('length');
        $keyword = $this->request->getPost('search_keyword');

        $data = $this->user_model->datatable_list($start, $length, $keyword);

        echo json_encode($data);
    }

    public function ajax_detail($user_uid)
    {
        if($user_uid == null) {
            die(AJAX_RESULT_ERROR);
        }

        $response_data = $this->user_model->findById($user_uid);
        die (json_encode($response_data));
    }

    public function ajax_save()
    {
        $user_uid = $this->request->getPost('user_uid');
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $pwd = $this->request->getPost('pwd');
        $status = $this->request->getPost('status');

        if(!$this->validate(['id' => 'required', 'name '  => 'required', 'pwd '  => 'required', 'status '  => 'required'])) {
            die(AJAX_RESULT_ERROR);
        }

        if($user_uid != null) {
            $is_duplicate = $this->user_model->id_duplicated_1($user_uid, $id);
            if ($is_duplicate == true) {
                die(AJAX_RESULT_DUP);
            }

            $is_duplicate = $this->user_model->name_duplicated_1($user_uid, $name);
            if ($is_duplicate == true) {
                die(AJAX_RESULT_DUP);
            }
        }
        else {
            if($this->user_model->id_duplicated($id)) {
                die(AJAX_RESULT_DUP);
            }
            if($this->user_model->name_duplicated($name)) {
                die(AJAX_RESULT_DUP);
            }
        }

        $save_data = array(
            'id' => $id,
            'name' => $name,
            'pwd' => $pwd,
            'status' => $status
        );
        if (isset($_FILES['uploadfile'])) {
            $upload_result = $this->upload_file($_FILES['uploadfile']);
            if($upload_result != null) {
                $save_data['profile_url'] = $upload_result['file_url'];
                $save_data['profile_url_check'] = STATUS_NORMAL;
            }
        }

        if($user_uid != null) {
            $save_data["uid"] = $user_uid;
        }
        $this->user_model->save($save_data);

        die (AJAX_RESULT_SUCCESS);
    }

    public function ajax_delete()
    {
        $user_uid = $this->request->getPost('user_uid');
        if($user_uid == null) {
            die(AJAX_RESULT_ERROR);
        }

        $this->user_model->deleteById($user_uid);
        die (AJAX_RESULT_SUCCESS);
    }

    public function ajax_photo_list() {
        $page_num = $this->request->getGet('page');
        $status = $this->request->getGet('status');
        if($page_num === null) {
            die(AJAX_RESULT_ERROR);
        }

        $data = $this->user_model->photo_list($page_num, $status);

        die(json_encode($data));
    }

    public function ajax_change_photo_status()
    {
        $user_uid = $this->request->getPost('user_uid');
        $status = $this->request->getPost('status');

        if($user_uid == null) {
            die(AJAX_RESULT_ERROR);
        }

        if($status < STATUS_DELETE  ||  $status > STATUS_CHECK) {
            die(AJAX_RESULT_ERROR);
        }

        $save_data = ["profile_url_check" => $status, "uid" => $user_uid];

        $this->user_model->save($save_data);
        die (AJAX_RESULT_SUCCESS);
    }
}
