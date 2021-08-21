<?php


namespace App\Entities;


use CodeIgniter\Entity\Entity;

class BaseEntity extends Entity
{
    public function set_api_params($controller, $data = array(), $params = array()) {
        $validation =  \Config\Services::validation();

        $config = config( 'App' );
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
            $controller->_response_error(API_RESULT_ERROR_PARAM, '', $validation->getErrors(''));
        }

        $this->fill($data);
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