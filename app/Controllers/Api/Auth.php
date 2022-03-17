<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends ApiBase
{
    use ResponseTrait;


    /**
     * Register a new user
     * @return Response
     * @throws \ReflectionException
     */
    public function register() {
        $rules = [
          'id' => 'required|min_length[6]|max_length[50]|valid_email', // |is_unique[tb_user.id]
          'pwd' => 'required|min_length[8]|max_length[255]',
          'name' => 'required',
          'profile_url' =>'max_length[2048]'
        ];

        $input = $this->getRequestInput($this->request);
        if(!$this->validateRequest($input, $rules)) {
            return $this->_response_error_status(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }

        $userModel = new UserModel();
        $id = $this->request->getPost("id");

        $duplicate = $userModel->id_duplicated($id);
        if ($duplicate == true) {
            $this->_response_error(API_RESULT_ERROR_EMAIL_DUPLICATE);
        }

        $user = new \App\Entities\User();
        $user->fill($this->request->getPost());
        $userModel->save($user);

        return $this->getJWTForUser($input['id'], ResponseInterface::HTTP_CREATED);
    }


    /**
     * Authenticate Existing User
     * @return Response
     */
    public function login() {
        $rules = [
            'id' => 'required|min_length[6]|max_length[50]|valid_email',
            'pwd' => 'required|min_length[6]|max_length[255]|validateUser[id, pwd]',
            'dev_type' => 'required|in_list[android,web]',
            'push_token' => 'max_length[2048]'
        ];
        $errors = [
            'pwd' => [
                'validateUser' => 'Invalid login credentials provided'
            ]
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules, $errors)) {
            return $this
                ->_response_error_status(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }
        return $this->getJWTForUser($input['id']);
    }



    /**
     * @param $email
     * @param int $responseCode
     * @return mixed
     */
    private function getJWTForUser($email, $responseCode = ResponseInterface::HTTP_OK) {
        try {
            $model = new UserModel();
            $user = $model->findUserByEmailAddress($email);
            unset($user['pwd']);
            helper('jwt');

            $user['access_token'] = getSignedJWTForUser($email);

            // 로그인 시도일시
            if($responseCode == ResponseInterface::HTTP_OK) {
                $cur_time = get_time_stamp_str();
                $save_data = array(
                    'access_token' =>  $user['access_token'],
                    'dev_type' => $this->request->getPost("dev_type"),
                    'login_time' => $cur_time,
                    'logout' => STATUS_OFF
                );
                $push_token = $this->request->getPost("push_token");
                if (!empty($push_token)) {
                    $save_data['dev_token'] = $push_token;
                }
                $model->saveById($user['uid'], $save_data);
            }

            return  $this->_response_success_status($user);
        }
        catch (\Exception $exception) {
            return $this->_response_error_status([
                'error' => $exception->getMessage()
            ], $responseCode);
        }
    }
}