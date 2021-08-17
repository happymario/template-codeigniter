<?php
namespace App\Controllers\Admin;

class Statistic extends AdminBase
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("session");
        $this->load->library('form_validation');
        $this->load->database();
    }

    public function index()
    {
        $this->load_view('statistic/daily_list', array(), array('page_title' => t('menu_statistic'), 'menu' => MENU_STATISTIC));
    }

    public function ajax_daily_list(){
        $year = $this->input->post("search_year");
        $month = $this->input->post("search_month");
        $keyword = $this->input->post("search_keyword");

        if($month < 10) {
            $month = "0".$month;
        }
        $cur_year = date('Y');
        $last_year = null;

        $start_day = "$year-$month-01";
        $day_count = date('t', strtotime($start_day));
        $total_data_cnt = $day_count+1;
        $recordsTotal = $total_data_cnt;
        $recordsFiltered = $recordsTotal;

        $return_data = array();

        $row_index = 1;
        $total = array("date" => "합계", "count" => 0, "login" => 0);
        for ($i = 1; $i  <= $day_count; $i++) {
            $column_index = 0;
            $day = "$year-$month-$i";
            if($i < 10) {
                $day = "$year-$month-0$i";
            }

            $temp = array();
            $temp['date'] = $day;
            $temp['count'] = 0;
            $temp['login'] = 0;

            // 알림 개수
            $where = "reg_time like '$day%' and status !=".STATUS_DELETE;
            if($keyword != null) {
                $where .= " and (title like '%$keyword%' or message like '%$keyword%')";
            }
            $sql = "select sum(status) as sumup from tb_push_his where $where";
            $point = $this->db->query($sql)->row("sumup");
            if($point == null || $point == "") {
                $point = 0;
            }
            $temp['count'] = $point;
            
            // 가입자수
            $where = "reg_time like '$day%' and status !=".STATUS_DELETE;
            $sql = "select count(*) as cnt from tb_user where $where";
            $login_cnt = $this->db->query($sql)->row('cnt');
            $temp['login'] = $login_cnt;


            $temp[$column_index++] = $temp['date'];
            $temp[$column_index++] = $temp['count'];
            $temp[$column_index++] = $temp['login'];
            $return_data[] = $temp;

            $total['count'] +=  $temp['count'];
            $total['login'] +=  $temp['login'];

            $row_index++;
        }

        $column_index = 0;
        $total[$column_index++] = $total['date'];
        $total[$column_index++] = $total['count'];
        $total[$column_index++] = $total['login'];
        $return_data[] = $total;

        echo json_encode(SSP::generateOutData($_POST, $return_data, $recordsTotal, $recordsFiltered));
    }


    public function ajax_daily_total() {
        $keyword = $this->input->post("search_keyword");
        $where = "status !=".STATUS_DELETE;
        if($keyword != null) {
            $where .= " and (title like '%$keyword%' or message like '%$keyword%')";
        }
        $sql = "select sum(status) as sumup from tb_push_his where $where";
        $point = $this->db->query($sql)->row("sumup");
        if($point == null || $point == "") {
            $point = 0;
        }

        echo $point;
    }

}