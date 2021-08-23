<?php
/**
 * Created by PhpStorm.
 * User: happymario
 * Date: 10/3/2020
 * Time: 11:10 AM
 */

namespace App\Controllers\Api;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Push extends ApiBase
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
    function push_list() {
        $this->set_api_params([
            new ApiParamModel('access_token', 'required'),
            new ApiParamModel('page', 'required')
        ]);

        $page_num = $this->request->getPost("page");
        $access_token = $this->request->getPost("access_token");

        $this->_check_access_token($access_token);

        $receiver_uid = $this->_get_user_uid($access_token);

        $push_model = model("PushModel");
        $list = $push_model->api_list($page_num, $receiver_uid);

        $this->_response_success($list);
    }
}