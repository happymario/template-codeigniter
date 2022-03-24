<?php

namespace App\Controllers\Admin;

use App\Models\PushModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Statistic extends Base_admin
{
    /**
     * @var UserModel
     */
    private $userModel;
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

        $this->userModel = model("UserModel");
        $this->pushModel = model("PushModel");
    }


    /************************************************************************
     * View
     *************************************************************************/

    public function index()
    {
        $this->load_view('home/statistic_daily_list', array(), array('page_title' => t('menu_statistic'), 'menu' => MENU_HOME));
    }


    /************************************************************************
     * AJAX
     *************************************************************************/
    public function ajax_daily_list()
    {
        $this->check_ajax();

        $year = $this->request->getPost("search_year");
        $month = $this->request->getPost("search_month");
        $keyword = $this->request->getPost("search_keyword");

        $data = $this->userModel->datatable_statistic($year, $month, $keyword);

        $this->ajax_result_raw($data);
    }


    public function ajax_daily_total()
    {
        $this->check_ajax();

        $keyword = $this->request->getPost("search_keyword");
        $cnt = $this->pushModel->get_sent_cnt($keyword);

        $this->ajax_result2($cnt);
    }

}