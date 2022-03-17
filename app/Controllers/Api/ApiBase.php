<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Created by Star_Man
 * 2019-07-24 10:09:32
 */
class ApiBase extends BaseController
{
    use ResponseTrait;

    protected $api_params;
    protected $count_per_page = 20;

    /**
     * ApiBase constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->api_params = new \stdClass();
        $this->userModel = model("UserModel");
    }

    public function set_api_params($params = array())
    {
        $data = $this->request->getPost();
        $validation = \Config\Services::validation();

        $config = config('App');
        if (array_key_exists("lang", $data) == true && 'english' !== $data['lang']) {
            $config->defaultLocale = "Kr";
        } else {
            $config->defaultLocale = DEFAULT_LOCATION;
        }

        if (array_key_exists("pretty", $data) == true && '1' === $data['pretty']) {
            define('API_RESPONSE_PRETTY', true);
        }

        $params = is_array($params) ? $params : array($params);
        $required_params = [];
        $validation_flag = false;
        foreach ($params as $param) {
            if (!is_a($param, 'App\Entities\ApiParamModel')) {
                continue;
            }

            if (!empty($param->rules)) {
                if (strpos($param->rules, 'required') !== false) {
                    $required_params[] = $param->variable_name;
                    $validation->setRule($param->variable_name, $param->variable_name, $param->rules);
                    $validation_flag = true;
                } else if ($data[$param->variable_name] !== null || trim($data[$param->variable_name]) !== '') {
                    $validation->setRule($param->variable_name, $param->variable_name, $param->rules);
                    $validation_flag = true;
                }
            }
        }

        if ($validation_flag && $validation->run($data) === FALSE) {
            $this->_response_error(API_RESULT_ERROR_PARAM, '', $validation->getErrors(''));
        }
    }


    public function _response_error($error_code, $msg = '', $reason = '', $status = ResponseInterface::HTTP_OK)
    {
        $config = config('App');
        $iskorean = $config->defaultLocale === 'Kr';
        if (empty($msg)) {
            $msg = $this->_get_error_msg($error_code, $iskorean);
        }

        $result = array('result' => $error_code, 'msg' => $msg, 'reason' => $reason);

        if (!defined('API_RESPONSE_PRETTY')) {
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        exit(0);
    }

    public function _response_error_status($error, $status)
    {
        $config = config('App');
        $iskorean = $config->defaultLocale === 'Kr';
        $error_code = API_RESULT_SUCCESS;

        if ($status != ResponseInterface::HTTP_OK) {
            $error_code = API_RESULT_ERROR_DB;
            if ($status == ResponseInterface::HTTP_INTERNAL_SERVER_ERROR) {
                $error_code = API_RESULT_ERROR_SYSTEM;
            } else if ($status == ResponseInterface::HTTP_BAD_REQUEST) {
                $error_code = API_RESULT_ERROR_PARAM;
            } else if ($status == ResponseInterface::HTTP_UNAUTHORIZED) {
                $error_code = API_RESULT_ERROR_ACCESS_TOKEN;
            }
        }

        if (empty($msg)) {
            $msg = $this->_get_error_msg($error_code, $iskorean);
        }

        $result = array('result' => $error_code, 'msg' => $msg, 'reason' => $error);

        return $this->respond(
            $result,
            $status,
            $msg
        );
    }

    public function _response_success($responseArray = null)
    {
        $config = config('App');
        $iskorean = $config->defaultLocale === 'Kr';

        $responseArray = empty($responseArray) ? new \stdClass() : $responseArray;
        $result = array('data' => $responseArray);
        $result['result'] = API_RESULT_SUCCESS;
        $result['msg'] = $iskorean ? '성공' : 'Success';
        $result['reason'] = '';

        if (!defined("API_RESPONSE_PRETTY")) {
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        exit(0);
    }

    public function _response_success_status($responseArray = null)
    {
        $config = config('App');
        $iskorean = $config->defaultLocale === 'Kr';

        $responseArray = empty($responseArray) ? new \stdClass() : $responseArray;
        $result = array('data' => $responseArray);
        $result['result'] = API_RESULT_SUCCESS;
        $result['msg'] = $iskorean ? '성공' : 'Success';
        $result['reason'] = '';

        return $this->respond($result);
    }

    public function _get_user_from_user_uid($user_uid)
    {
        $sql = 'select * from tb_user where uid = ? and status <> ' . STATUS_DELETE . ' limit 1';
        $usr_row = $this->db->query($sql, [$user_uid])->row();
        if ($usr_row === null) {
            $this->_response_error(API_RESULT_ERROR_USER_NO_EXIST);
        }

        return $usr_row;
    }

    public function _check_access_token($access_token)
    {
        if ($this->userModel->invalid_access_token($access_token)) {
            $this->_response_error(API_RESULT_ERROR_ACCESS_TOKEN);
        }
    }

    public function _get_user_uid($access_token)
    {
        return $this->userModel->get_user_uid_by_access_token($access_token);
    }

    public function _get_user_info($access_token)
    {
        return $this->userModel->get_user_info_by_access_token($access_token);
    }


    private function _get_error_msg($error_code, $iskorean)
    {
        $msg = '';
        switch ($error_code) {
            default:
            case API_RESULT_ERROR_SYSTEM:
                $msg = $iskorean ? '서버처리중 오류가 발생했습니다.' : 'Server Internal Error';
                break;
            case API_RESULT_ERROR_DB:
                $msg = $iskorean ? 'DB와의 연동에 실패했습니다.' : 'Failed to connect DB';
                break;
            case API_RESULT_ERROR_PRIVILEGE:
                $msg = $iskorean ? '해당 조작에 대한 권한이 없습니다.' : 'You have no permission of this operation.';
                break;
            case API_RESULT_ERROR_PARAM:
                $msg = $iskorean ? '파라미터 오류입니다.' : 'The parameter is not correct.';
                break;
            case API_RESULT_ERROR_UPLOAD:
                $msg = $iskorean ? '업로드에 실패하였습니다. 다시 시도해 주세요.' : 'Upload failed. Please try again.';
                break;
            case API_RESULT_ERROR_ACCESS_TOKEN:
                $msg = $iskorean ? '기기 인증기간이 만료되었습니다. 다시 로그인해주세요.' : 'Your device verification period has expired. Please login again.';
                break;
            case API_RESULT_ERROR_CERT_KEY:
                $msg = $iskorean ? '잘못된 인증번호입니다.' : 'Cert key is wrong';
                break;
            case API_RESULT_ERROR_LOGIN_FAILED:
                $msg = $iskorean ? '아이디 혹은 비밀번호 오류입니다.' : 'Invalid user name or password.';
                break;
            case API_RESULT_ERROR_LOGIN_PASSWORD:
                $msg = $iskorean ? '잘못된 비밀번호 입니다.' : 'Invalid password.';
                break;
            case API_RESULT_ERROR_USER_NO_EXIST:
                $msg = $iskorean ? '가입하지 않은 사용자 입니다.' : 'This user is not a subscribed member.';
                break;
            case API_RESULT_ERROR_EMAIL_DUPLICATE:
                $msg = $iskorean ? '사용중인 이메일 주소 입니다.' : 'This e-mail is taken by another account.';
                break;
            case API_RESULT_ERROR_EMAIL_NO_EXIST:
                $msg = $iskorean ? '해당 이메일로 가입한 회원이 없습니다.' : 'This e-mail is not valid.';
                break;
            case API_RESULT_ERROR_USER_PAUSED:
                $msg = $iskorean ? '회원님의 계정은 일시정지되었습니다.' : 'Your account was paused.';
                break;
            case API_RESULT_ERROR_NICKNAME_DUPLICATE:
                $msg = $iskorean ? '사용중인 닉네임입니다.' : 'This nickname is taken by another account.';
                break;
            case API_RESULT_ERROR_NICKNAME_LENGTH:
                $msg = $iskorean ? '이름은 2자이상이어야 합니다.' : 'The valid length is at least 2.';
                break;
            case API_RESULT_ERROR_PURCHASE:
                $msg = $iskorean ? '결제오류입니다.' : 'It is purchased error.';
        }

        return $msg;
    }
}


class ApiParamModel
{
    public $variable_name = '';

    /**
     * http://www.ciboard.co.kr/user_guide/kr/libraries/form_validation.html#rule-reference
     */
    public $rules = '';

    /**
     * ApiParamModel constructor.
     * @param $variable_name
     * @param $description
     * @param $rules
     */
    public function __construct($variable_name, $rules)
    {
        $this->variable_name = $variable_name;
        $this->rules = $rules;
    }
}