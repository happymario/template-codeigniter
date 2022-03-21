<?php
/**
 * Created by HappyMario
 * 2019-07-24 11:17:33
 */

namespace App\Controllers\Api;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Purchase extends ApiBase
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
    public function android()
    {
        $this->set_api_params([
            new ApiParamModel('uuid', 'required'),
            new ApiParamModel('purchase_data', ''),
            new ApiParamModel('data_signature', ''),
        ]);

        $uuid = $this->api_params->uuid;
        $purchase_data = $this->api_params->purchase_data;
        $data_signature = $this->api_params->data_signature;

        /*$this->db->insert('tb_dev_log', [
            'uuid' => $uuid,
            'log1' => $purchase_data,
            'log2' => $data_signature,
            'memo' => 'Android Purchase',
        ]);*/

        $purchase_info_arr = json_decode($purchase_data, true);
        if ($purchase_info_arr === null || !is_array($purchase_info_arr)) {
            $insert_data = [
                'reg_time' => get_time_stamp_str(),
                'uuid' => $uuid,
                'order_id' => '',
                'package_name' => '',
                'product_id' => '',
                'price' => 0,
                'purchase_state' => 2,
                'purchase_wtime' => time(),
                'purchase_token' => '',
                'signature' => '',
                'memo' => '',
                'ip_addr' => $this->input->ip_address()
            ];
            $this->_response_error(API_RESULT_ERROR_PURCHASE);
        }

        $order_id = $purchase_info_arr['orderId'];
        $package_name = $purchase_info_arr['packageName'];
        $product_id = $purchase_info_arr['productId'];
        $purchase_wtime = substr($purchase_info_arr['purchaseTime'], 0, 10);
        $purchase_state = (int)$purchase_info_arr['purchaseState'];    //0 : 성공, 1 : 실패
        $purchase_token = $purchase_info_arr['purchaseToken'];

        $insert_data = [
            'reg_time' => getTimeStampString(),
            'uuid' => $uuid,
            'order_id' => $order_id,
            'package_name' => $package_name,
            'product_id' => $product_id,
            'price' => $this->_get_price_from_inappid($product_id),
            'purchase_state' => $purchase_state,
            'purchase_wtime' => $purchase_wtime,
            'purchase_token' => $purchase_token,
            'signature' => $data_signature,
            'memo' => '',
            'ip_addr' => $this->input->ip_address()
        ];

        $this->load->helper('purchase');
        $google_rsa_key = $this->db->get_where('tb_app_setting', ['ind' => 1])->row('setting');
        if (!verify_google_payment_in_app($purchase_data, $data_signature, $google_rsa_key)) {
            $insert_data['purchase_state'] = 2;// 해킹

            $this->_response_error(API_RESULT_ERROR_PURCHASE);
        }

        $this->db->insert('tb_purchase_log', $insert_data);

        $this->_response_success();
    }

    public function ios()
    {
        $this->set_api_params([
            new ApiParamModel('uuid', 'required'),
            new ApiParamModel('receipt', ''),
        ]);

        $uuid = $this->api_params->uuid;
        $receipt = $this->api_params->receipt;

        /*$this->db->insert('tb_dev_log', [
            'uuid' => $uuid,
            'log1' => $receipt,
            'memo' => 'iOS Purchase',
        ]);*/

        $this->load->helper('purchase');
        $ios_response = verify_apple_payment_in_app($receipt, false);
        if ($ios_response === false) {
            $ios_response = verify_apple_payment_in_app($receipt, true);
        }

        if ($ios_response === false) {
            $insert_data = [
                'reg_time' => getTimeStampString(),
                'uuid' => $uuid,
                'order_id' => '',
                'package_name' => '',
                'product_id' => '',
                'price' => 0,
                'purchase_state' => 2,
                'purchase_wtime' => time(),
                'purchase_token' => '',
                'signature' => $receipt,
                'memo' => '',
                'ip_addr' => $this->input->ip_address()
            ];
            //$this->db->insert('tb_purchase_log', $insert_data);
            $this->_response_error(API_RESULT_ERROR_PURCHASE);
        }

        $purchase_info_arr = json_decode($ios_response, true);
        $package_name = $purchase_info_arr['receipt']['bundle_id'];
        $purchase_token = $ios_response;
        if (!isset($purchase_info_arr['receipt']['in_app'][0])) {
            $insert_data = [
                'reg_time' => getTimeStampString(),
                'uuid' => $uuid,
                'order_id' => '',
                'package_name' => $package_name,
                'product_id' => '',
                'price' => 0,
                'purchase_state' => 2,
                'purchase_wtime' => time(),
                'purchase_token' => $purchase_token,
                'signature' => $receipt,
                'memo' => '',
                'ip_addr' => $this->input->ip_address()
            ];
            $this->db->insert('tb_purchase_log', $insert_data);

            $this->_response_error(API_RESULT_ERROR_PURCHASE);
        }

        $inapp_info_arr = $purchase_info_arr['receipt']['in_app'][0];
        $product_id = $inapp_info_arr['product_id'];
        $order_id = $inapp_info_arr['transaction_id'];
        $purchase_wtime = substr($inapp_info_arr['purchase_date_ms'], 0, 10);
        $purchase_state = 0;    //0 : 성공, 1 : 실패

        $insert_data = [
            'reg_time' => getTimeStampString(),
            'uuid' => $uuid,
            'order_id' => $order_id,
            'package_name' => $package_name,
            'product_id' => $product_id,
            'price' => $this->_get_price_from_inappid($product_id),
            'purchase_state' => $purchase_state,
            'purchase_wtime' => $purchase_wtime,
            'purchase_token' => $purchase_token,
            'signature' => $receipt,
            'memo' => '',
            'ip_addr' => $this->input->ip_address()
        ];

        $this->db->insert('tb_purchase_log', $insert_data);

        $this->_response_success();
    }

    private function _get_price_from_inappid($inappid) {
        switch ($inappid) {
            case '5000w':
                return 0.99;
            case 'item_2':
                return 2.99;
            case 'item_3':
                return 3.99;
            case 'item_4':
                return 5.99;
            case 'item_5':
                return 9.99;
            case 'item_6':
            case 'item_7':
                return 1.99;
            default:
                return 0;
        }
    }
}