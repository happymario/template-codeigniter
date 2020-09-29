<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by Star_Man
 * 2019-07-24 10:09:32
 */
class ApiBase extends CI_Controller {

    protected $api_params;
    protected $count_per_page = 20;

    /**
     * ApiBase constructor.
     * @param $api_params
     */
    public function __construct() {
        parent::__construct();
        $this->api_params = new stdClass();
        $this->load->database();
        $this->lang->load('admin', LANGUAGE);
    }

    protected function _set_api_params($params = array()) {
        $this->load->library('form_validation');
//        if ('english' !== $this->input->post('lang')) {
            $this->config->set_item('language', 'korean');
//        } else {
//            $this->config->set_item('language', 'english');
//        }

        if ('1' === $this->input->post('pretty')) {
            define('API_RESPONSE_PRETTY', true);
        }

        $params = is_array($params) ? $params : array($params);
        $required_params = [];
        $validation_flag = false;
        foreach ($params as $param) {
            if (!is_a($param, 'ApiParamModel')) {
                continue;
            }

            $this->api_params->{$param->variable_name} = $this->input->post($param->variable_name);

            if (!empty($param->rules)) {
                if (strpos($param->rules, 'required') !== false) {
                    $required_params[] = $param->variable_name;
                    $this->form_validation->set_rules($param->variable_name, $param->variable_name, $param->rules);
                    $validation_flag = true;
                } else if ($this->input->post($param->variable_name) !== null || trim($this->input->post($param->variable_name)) !== '') {
                    $this->form_validation->set_rules($param->variable_name, $param->variable_name, $param->rules);
                    $validation_flag = true;
                }
            }
        }

        if ($validation_flag && $this->form_validation->run() === FALSE) {
            $this->_response_error(API_RESULT_ERROR_PARAM, '', trim($this->form_validation->error_string(' ', ' ')));
        }
    }

    protected function _response_error($error_code, $msg = '', $reason = '') {
        $iskorean = $this->config->item('language') === 'korean';
        if (empty($msg)) {
            switch ($error_code) {
                default:
                case API_RESULT_ERROR_SYSTEM:
                    $msg = $iskorean ? '서버처리중 오류가 발생했습니다.' : 'Server Internal Error';
                    $reason = empty($reason) ? $msg : $reason;
                    break;
                case API_RESULT_ERROR_DB:
                    $msg = $iskorean ? 'DB와의 연동에 실패했습니다.' : 'Failed to connect DB';
                    $reason = empty($reason) ? $msg : $reason;
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
                    $msg = $iskorean ? '이름 혹은 비밀번호 오류입니다.' : 'Invalid user name or password.';
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

    protected function _response_success($responseArray = null) {
        $iskorean = $this->config->item('language') === 'korean';

        $responseArray = empty($responseArray) ? new stdClass() : $responseArray;
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

    protected function _get_user_from_user_uid($user_uid) {
        $sql = 'select * from tb_user where user_uid = ? and user_status > 0 limit 1';
        $usr_row = $this->db->query($sql, [$user_uid])->row();
        if ($usr_row === null) {
            $this->_response_error(API_RESULT_ERROR_ACCESS_TOKEN);
        }

        return $usr_row;
    }

    protected function _get_today_date() {
        if (isset($_POST['curdate']) && !empty($_POST['curdate']) &&
            preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $_POST['curdate'])) {
            return $_POST['curdate'];
        }

        return getTimeStampString(null, true);
    }
}

class ApiParamModel {
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
    public function __construct($variable_name, $rules) {
        $this->variable_name = $variable_name;
        $this->rules = $rules;
    }
}