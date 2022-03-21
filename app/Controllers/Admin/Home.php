<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Home extends Base_admin
{
    /************************************************************************
     * Overrides
     ***********************************************************************
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }

    public function index()
    {
        $this->load_view('home/index', array(), array('page_title' => t('menu_home'), 'menu' => MENU_USER));
    }
}