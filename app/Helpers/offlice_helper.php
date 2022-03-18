<?php


use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

function get_ids_from_excel($file)
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