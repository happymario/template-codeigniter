<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/3/2020
 * Time: 11:10 AM
 */

namespace App\Controllers\Api;

use App\Models\PushModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Push extends Base_api
{
    /**
     * @var PushModel
     */
    private $pushModel;

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

        $this->pushModel = new PushModel();
    }


    /************************************************************************
     * APIs
     *************************************************************************/
    function push_list() {
        $access_token = $this->get_access_token();

        $user_uid = $this->userModel->get_user_uid_by_access_token($access_token);
        if($user_uid == null) {
            return $this->response_error_code(API_RESULT_ERROR_ACCESS_TOKEN);
        }

        $rules = [
            'page' => 'required'
        ];
        $input = $this->request->getGet();

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->response_error_status(
                    ResponseInterface::HTTP_BAD_REQUEST,
                    $this->validator->getErrors()
                );
        }

        $page_num = $input['page'];
        $access_token = $this->get_access_token();
        $receiver_uid = $this->userModel->get_user_uid_by_access_token($access_token);

        $list = $this->pushModel->api_list($page_num, $receiver_uid);

        return $this->response_success($list);
    }
}