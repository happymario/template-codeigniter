<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Statistic extends AdminBase
{
    /************************************************************************
     * Overrides
     *************************************************************************/
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->user_model = model("UserModel");
        $this->push_model = model("PushModel");
    }


    /************************************************************************
     * View
     *************************************************************************/

    public function index()
    {
        $this->load_view('statistic/daily_list', array(), array('page_title' => t('menu_statistic'), 'menu' => MENU_STATISTIC));
    }

    public function ajax_daily_list()
    {
        $year = $this->request->getPost("search_year");
        $month = $this->request->getPost("search_month");
        $keyword = $this->request->getPost("search_keyword");

        $data = $this->user_model->datatable_statistic($year, $month, $keyword);
        echo json_encode($data);
    }


    public function ajax_daily_total()
    {
        $keyword = $this->request->getPost("search_keyword");
        $cnt = $this->push_model->get_sent_cnt($keyword);
        echo $cnt;
    }

}