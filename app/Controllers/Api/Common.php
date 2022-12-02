<?php
/**
 * Created by HappyMario
 * 2019-07-24 11:17:33
 */

namespace App\Controllers\Api;

use App\Models\SettingModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Common extends Base_api
{
    /**
     * @var SettingModel
     */
    private $settingModel;

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

        $this->settingModel = new SettingModel();
    }


    /************************************************************************
     * APIs
     *************************************************************************/
    public function upload_file()
    {
        if (!isset($_FILES['uploadfile'])) {
            return $this->response_error_code(API_RESULT_ERROR_PARAM);
        }

        $upload_file_name_only = get_unique_str();
        $upload_file_name_ext = pathinfo($_FILES['uploadfile']["name"], PATHINFO_EXTENSION);
        $file_name = $upload_file_name_only . '.' . $upload_file_name_ext;

        $file_path = make_directory('temp') . DIRECTORY_SEPARATOR . $file_name;

        if (!move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file_path)) {
            return $this->response_error_code(API_RESULT_ERROR_UPLOAD);
        }

        return $this->response_success([
            'file_name' => $file_name,
            'file_url' => get_temp_image_url($file_name)
        ]);
    }


    public function multi_upload_file()
    {
        if (isset($_FILES['uploadfile']) == false) {
            $this->response_error_code(API_RESULT_ERROR_PARAM);
        }

        $dateYm = date('Ym');
        $result = array();
        for ($i = 0; $i < count($_FILES['uploadfile']['name']); $i++) {
            $upload_file_name_only = get_unique_str();
            $upload_file_name_ext = pathinfo($_FILES['uploadfile']["name"][$i], PATHINFO_EXTENSION);

            $file_name = $upload_file_name_only . '.' . $upload_file_name_ext;
            $file_path = make_directory($dateYm) . DIRECTORY_SEPARATOR . $file_name;

            if (!move_uploaded_file($_FILES['uploadfile']['tmp_name'][$i], $file_path)) {
                $this->response_error_code(API_RESULT_ERROR_UPLOAD);
            }
            $temp = array(
                'file_url' => get_real_image_url($dateYm . '/' . $file_name),
                'file_name' => $dateYm . '/' . $file_name
            );
            array_push($result, $temp);
        }

        $this->response_success(array("result" => $result));
    }


    public function app_info() {
        $rules = ['dev_type' => 'required|in_list[android,web]'];
        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->response_error_status(
                ResponseInterface::HTTP_BAD_REQUEST,
                $this->validator->getErrors()
            );
        }

        $info = array();
        $info["api_ver"] = API_VERSION;

        $setting = $this->settingModel->where("status!=", STATUS_DELETE)->first();
        $info["client_center"] = $setting["client_phone"];

        return $this->response_success($info);
    }

    public function get_repos() {
        $rules = [
            'page' => 'required',
            'q' => 'required'
        ];

        $input = $this->getRequestInput($this->request);
        $list = [];
        for($i = 0; $i < 100; $i++) {
            $list[] = array("id"=>$i, "name"=> (string)$i);
        }

        return $this->respond(
            [
                'total' => 10,
                'list' => $list
            ]
        );
    }
}
