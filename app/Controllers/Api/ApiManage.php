<?php

namespace App\Controllers\Api;

use App\Controllers\Admin\Base_admin;
use App\Models\ApiInputModel;
use App\Models\ApiListModel;
use App\Models\ApiOutputModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Created by PhpStorm.
 * User: HappyMario
 * Date: 2018-01-09
 */
class ApiManage extends Base_admin
{
    /**
     * @var ApiListModel
     */
    private $api_list_model;
    /**
     * @var ApiInputModel
     */
    private $api_input_model;
    /**
     * @var ApiOutputModel
     */
    private $api_output_model;


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

        $this->api_list_model = model("ApiListModel");
        $this->api_input_model = model("ApiInputModel");
        $this->api_output_model = model("ApiOutputModel");
    }


    /************************************************************************
     * Views
     *************************************************************************/
    public function apimanage()
    {
        $arr_list = $this->api_list_model->getTotalApiList();
        $result = array();
        $result['apilist'] = $arr_list;
        $this->load_view("apimanage/apimanage", $result);
    }

    public function apierrors()
    {
        $this->load_view("apimanage/apierrors");
    }

    public function draw_apilist_table()
    {
        $arr_list = $this->api_list_model->getTotalApiList();
        $result = array();
        $result['apilist'] = $arr_list;
        $this->load_view_without_layout("apimanage/list_table", $result);
    }

    public function write()
    {
        $data = array();
        $data['api_idx'] = 0;
        $data['api_name'] = "";
        $data['api_exp'] = "";
        $data['api_method'] = "";
        $data['api_use'] = "";
        $data['api_status'] = "";
        $data['api_bigo'] = "";
        if ($this->request->getPost("api_idx") != null) {
            $data['api_idx'] = $this->request->getPost("api_idx");

            $api_model = $this->api_list_model->findById($data['api_idx']);
            $data = $api_model;
        }

        $this->load_view("apimanage/write", $data);
    }


    public function api_input_list()
    {
        $api_idx = $this->request->getGet("id");
        $api_model = $this->api_list_model->findById($api_idx);

        $data['api_idx'] = $api_idx;
        $data['api_name'] = $api_model["api_name"];

        $arr_input_list = $this->api_input_model->getListByApiIdx($api_idx);
        $data['arr_input'] = $arr_input_list;

        $this->load_view("apimanage/api_input_list", $data);
    }

    public function edit_api_input_data()
    {
        $ai_idx = 0;
        $api_idx = $this->request->getGet("api_idx");
        $data['api_idx'] = $api_idx;
        $data['ai_name'] = "";
        $data['ai_type'] = "";
        $data['ai_value'] = "";
        $data['ai_ness'] = "";
        $data['ai_exp'] = "";
        $data['ai_sort'] = "";
        $data['ai_bigo'] = "";

        $request_ai_idx = $this->request->getGet("ai_idx");
        if ($request_ai_idx != null && $request_ai_idx != '0') {
            $ai_idx = $this->request->getGet("ai_idx");
            $input_data = $this->api_input_model->findById($ai_idx);
            $data = $input_data;
        }

        $data['ai_idx'] = $ai_idx;
        $data['api_idx'] = $api_idx;
        $this->load_view("apimanage/edit_api_input_data", $data);
    }

    public function draw_api_input_list()
    {
        $api_idx = $this->request->getPost("api_idx");
        $api_model = $this->api_list_model->findById($api_idx);

        $data['api_idx'] = $api_idx;
        $data['api_name'] = $api_model["api_name"];
        $arr_input_list = $this->api_input_model->getListByApiIdx($api_idx);
        $data['arr_input'] = $arr_input_list;

        $this->load_view_without_layout("apimanage/api_input_table", $data);
    }

    public function api_output_list()
    {
        $api_idx = $this->request->getGet("id");
        $api_model = $this->api_list_model->findById($api_idx);


        $data['api_idx'] = $api_idx;
        $data['api_name'] = $api_model["api_name"];

        $arr_output_list = $this->api_output_model->getListByApiIdx($api_idx);
        $data['arr_output'] = $arr_output_list;

        $this->load_view("apimanage/api_output_list", $data);
    }

    public function edit_api_output_data()
    {
        $ai_idx = 0;
        $api_idx = $this->request->getGet("api_idx");
        $data['api_idx'] = $api_idx;
        $data['ai_name'] = "";
        $data['ai_type'] = "";
        $data['ai_value'] = "";
        $data['ai_ness'] = "";
        $data['ai_exp'] = "";
        $data['ai_sort'] = "";
        $data['ai_bigo'] = "";

        if ($this->request->getGet("ai_idx") != null && $this->request->getGet("ai_idx") != '0') {
            $ai_idx = $this->request->getGet("ai_idx");
            $data = $this->api_output_model->findById($ai_idx);
        }

        $data['ai_idx'] = $ai_idx;
        $data['api_idx'] = $api_idx;
        $this->load_view("apimanage/edit_api_output_data", $data);
    }

    public function draw_api_output_list()
    {
        $api_idx = $this->request->getPost("api_idx");

        $data['api_idx'] = $api_idx;
        $arr_output_list = $this->api_output_model->getListByApiIdx($api_idx);
        $data['arr_output'] = $arr_output_list;

        $this->load_view_without_layout("apimanage/api_output_table", $data);
    }

    public function apidocument()
    {
        $arr_list = $this->api_list_model->getTotalApiList(true);
        $result = array();
        $result['apilist'] = $arr_list;
        $this->load_view("apimanage/apidocument", $result);
    }

    public function view()
    {
        $api_idx = $this->request->getGet("api_idx");
        $data = array();
        $data['info']['api_idx'] = $api_idx;
        $api_model = $this->api_list_model->findById($api_idx);

        $data['info'] = $api_model;

        //output목록
        $arr_output_list = $this->api_output_model->getListByApiIdx($api_idx);
        $data['arr_output'] = $arr_output_list;

        //input목록
        $arr_input_list = $this->api_input_model->getListByApiIdx($api_idx);
        $data['arr_input'] = $arr_input_list;

        $this->load_view("apimanage/view", $data);
    }

    /************************************************************************
     * AJAX_APIS
     *************************************************************************/
    public function api_write()
    {
        $data = $this->request->getPost();
        $index = $this->api_list_model->save($data);
        if ($index > 0) {
            $this->ajax_result(AJAX_RESULT_SUCCESS);
        } else {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }
    }

    public function delete_api_list()
    {
        $arr_id = $this->request->getPost("id");
        if ($this->api_list_model->deleteAll($arr_id)) {
            $this->ajax_result(AJAX_RESULT_SUCCESS);
        } else {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }
    }


    public function api_input_edit()
    {
        $data = $this->request->getPost();
        $result = $this->api_input_model->save($data);

        if ($result == true) {
            $this->ajax_result(AJAX_RESULT_SUCCESS);
        } else {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }
    }

    public function delete_api_input_data()
    {
        $arr_id = $this->request->getPost("id");
        $api_idx = $this->request->getPost('api_idx');
        if ($this->api_input_model->deleteAllByApiIdx($api_idx, $arr_id)) {
            $this->ajax_result(AJAX_RESULT_SUCCESS);
        } else {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }
    }


    public function api_output_edit()
    {
        $ai_idx = $this->request->getPost("ai_idx");
        $data = $this->request->getPost();
        $result = $this->api_output_model->save($data);

        if ($result == true) {
            $this->ajax_result(AJAX_RESULT_SUCCESS);
        } else {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }
    }

    public function delete_api_output_data()
    {
        $arr_id = $this->request->getPost("id");
        $api_idx = $this->request->getPost('api_idx');
        if ($this->api_output_model->deleteAllByApiIdx($api_idx, $arr_id)) {
            $this->ajax_result(AJAX_RESULT_SUCCESS);
        } else {
            $this->ajax_result(AJAX_RESULT_ERROR);
        }
    }
}