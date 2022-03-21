<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SSP;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;


class Base_admin extends BaseController
{
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

        helper(['form', 'download']);
        $this->ssp = new SSP();
    }

    /************************************************************************
     * Public
     *************************************************************************/
    public function set_my_uid($uid) {
        $session = session();
        $session->set(SESSION_ADMIN_UID, $uid);
    }

    public function remove_my_uid() {
        $session = session();
        $session->remove(SESSION_ADMIN_UID);
    }


    /************************************************************************
     * Views
     ************************************************************************/
     /**
     * @param string $view_name
     * @param array $response_data
     * @param array $menu_data
     */
    protected function load_view($view_name = '', $response_data = array(), $menu_data = array())
    {
        echo view('layout/header', $menu_data);
        echo view($view_name, $response_data);
        echo view('layout/footer');
    }

    protected function load_view_without_layout($view_name = '', $data = array())
    {
        echo view($view_name, $data);
    }


    /************************************************************************
     * Ajax API
     *************************************************************************/
    protected function check_ajax() {
        if($this->request->isAJAX() == false) {
            $this->ajax_result(AJAX_RESULT_ERROR);
            return false;
        }

        return true;
    }

    protected function ajax_result($error = null, $message = '')
    {
        $this->_ajax_result(($error == null? AJAX_RESULT_SUCCESS: $error), $message);
    }

    protected function ajax_result2($data = array())
    {
       $this->_ajax_result(AJAX_RESULT_SUCCESS, '', $data);
    }


    /************************************************************************
     * Helpers
     *************************************************************************/
    private function _ajax_result($error = null, $message = '', $data=array())
    {
        $result = [
            "result" => ($error == null? AJAX_RESULT_SUCCESS: $error),
            "msg" => $message,
            'data' => $data
        ];

        die(json_encode($result, true));
    }
}