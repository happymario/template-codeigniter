<?php


use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

function import_from_excel($file)
{
    $id_arr = [];

    $reader = new Xlsx();
    $objPHPExcel = $reader->load($file);

    try {
        $total_rows = $objPHPExcel->getSheet(0)->getHighestRow();
        for ($i = 2; $i <= $total_rows; $i++) {

            $user_id = $objPHPExcel->getSheet(0)->getCell('B' . $i)->getValue();
            if (!empty($user_id)) {
                array_push($id_arr, $user_id);
            }
        }
    } catch (Exception $e) {

    }

    return implode(",", $id_arr);
}

function export_to_excel() {
    $start = $this->input->post('page_start');
    $length = $this->input->post('page_length');
    $search_name = $this->input->post('page_keyword');
    $menu = $this->input->post('menu');

    if($menu == MENU_SELLER) {
        $data = $this->userModel->get_datatable_data($start, $length, USER_SELLER, $search_name);
    }
    else {
        $data = $this->userModel->get_datatable_data($start, $length, USER_CLIENT, $search_name);
    }
    $objPHPExcel = new Spreadsheet();

    try {
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        if($menu == MENU_SELLER) {
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        }

        $objPHPExcel->getActiveSheet()->setTitle('보고서');
        $objPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '회원번호')
            ->setCellValue('B1', '이름')
            ->setCellValue('C1', '전화번호')
            ->setCellValue('D1', '가입일')
            ->setCellValue('E1', '탈퇴일');
        if($menu == MENU_SELLER) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('F1', '메이커')
                ->setCellValue('G1', '매장코드')
                ->setCellValue('H1', '노출이름')
                ->setCellValue('I1', '실명')
                ->setCellValue('J1', '승인여부');
        }

        $index = 1;
        foreach ($data['return_data'] as $item) {
            $index++;

            $objPHPExcel->getActiveSheet()
                ->setCellValue('A' . $index, ($item['type'] == USER_SELLER? "P":"C").$item['uid'])
                ->setCellValue('B' . $index, $item['nickname'])
                ->setCellValue('C' . $index, $item['id'])
                ->setCellValue('D' . $index, $item['reg_time'])
                ->setCellValue('E' . $index, $item['exit_time'] == null ? "-": $item['exit_time']);

            if($menu == MENU_SELLER) {
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('F' . $index, $item['brand_name'])
                    ->setCellValue('G' . $index, $item['market'])
                    ->setCellValue('H' . $index, $item['company'])
                    ->setCellValue('I' . $index, $item['name'])
                    ->setCellValue('J' . $index, $item['review'] == 1 ? 'Y' : 'N');
            }
        }

        $filepath = 'uploads/회원정보.xlsx';
        $writer = new Xlsx($objPHPExcel);
        $writer->save("$filepath");
        force_download(FCPATH."/".$filepath, null);
    } catch (PHPExcel_Exception $e) {
        echo ('<script>alert("엑셀 다운로드에 실패했습니다.");</script>');
    }
}