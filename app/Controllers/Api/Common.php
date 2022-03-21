<?php
/**
 * Created by HappyMario
 * 2019-07-24 11:17:33
 */

namespace App\Controllers\Api;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Common extends ApiBase
{
    /************************************************************************
     * Overrides
     *************************************************************************/
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }


    /************************************************************************
     * APIs
     *************************************************************************/
    public function upload_file()
    {
        $this->set_api_params();

        if (!isset($_FILES['uploadfile'])) {
            $this->_response_error(API_RESULT_ERROR_PARAM);
        }

        $upload_file_name_only = get_unique_str();
        $upload_file_name_ext = pathinfo($_FILES['uploadfile']["name"], PATHINFO_EXTENSION);
        $file_name = $upload_file_name_only . '.' . $upload_file_name_ext;

        $file_path = make_directory('temp') . DIRECTORY_SEPARATOR . $file_name;

        if (!move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file_path)) {
            $this->_response_error(API_RESULT_ERROR_UPLOAD);
        }

        $this->_response_success([
            'file_name' => $file_name,
            'file_url' => get_temp_image_url($file_name)
        ]);
    }


    public function multi_upload_file()
    {
        $this->set_api_params([
            new ApiParamModel('uploadfile', '')
        ]);
        if (isset($_FILES['uploadfile']) == false) {
            $this->_response_error(API_RESULT_ERROR_PARAM);
        }

        $dateYm = date('Ym');
        $result = array();
        for ($i = 0; $i < count($_FILES['uploadfile']['name']); $i++) {
            $upload_file_name_only = get_unique_str();
            $upload_file_name_ext = pathinfo($_FILES['uploadfile']["name"][$i], PATHINFO_EXTENSION);

            $file_name = $upload_file_name_only . '.' . $upload_file_name_ext;
            $file_path = make_directory($dateYm) . DIRECTORY_SEPARATOR . $file_name;

            if (!move_uploaded_file($_FILES['uploadfile']['tmp_name'][$i], $file_path)) {
                $this->_response_error(API_RESULT_ERROR_UPLOAD);
            }
            $temp = array(
                'file_url' => get_real_image_url($dateYm . '/' . $file_name),
                'file_name' => $dateYm . '/' . $file_name
            );
            array_push($result, $temp);
        }

        $this->_response_success(array("result" => $result));
    }


    public function app_info() {
        $this->set_api_params([
            new ApiParamModel('dev_type', 'required|in_list[android,web]')
        ]);

        $info = array();
        $info["api_ver"] = API_VERSION;

        $setting_model = model("SettingModel");
        $setting = $setting_model->where("status!=", STATUS_DELETE)->first();
        $info["client_center"] = $setting["client_phone"];

        $this->_response_success($info);
    }
}