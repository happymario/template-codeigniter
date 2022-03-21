<?php
/**
 * Created by HappyMario
 * 2019-07-24 11:17:33
 */

namespace App\Controllers\Api;

use App\Models\PayHisModel;
use App\Models\SettingModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Purchase extends Base_api
{
    /**
     * @var SettingModel
     */
    private $settingModel;

    /**
     * @var PayHisModel
     */
    private $payHisModel;

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

        \helper(['purchase']);

        $this->settingModel = new SettingModel();
        $this->payHisModel = new PayHisModel();
    }


    /************************************************************************
     * APIs
     *************************************************************************/
    public function android()
    {
        $rules = [
            'uuid' => 'required',
            'purchase_data' => 'min_length[1]',
            'data_signature' => 'min_length[0]'
        ];
        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->response_error_status(
                    ResponseInterface::HTTP_BAD_REQUEST,
                    $this->validator->getErrors()
                );
        }

        $user_uid = $input['uuid'];
        $dev_type = $input['dev_type'];
        $purchase_data = $input['purchase_data'];
        $data_signature = $input['data_signature'];
        $pay_method = 'phone';

        $purchase_info_arr = json_decode($purchase_data, true);
        if ($purchase_info_arr === null || !is_array($purchase_info_arr)) {
            return $this->response_error_code(API_RESULT_ERROR_PURCHASE);
        }

        $order_id = $purchase_info_arr['orderId'];
        $package_name = $purchase_info_arr['packageName'];
        $product_id = $purchase_info_arr['productId'];
        $purchase_wtime =$purchase_info_arr['purchaseTime'];
        $purchase_state = ((int)$purchase_info_arr['purchaseState'] == 0) ? 1: 0;
        $purchase_token = $purchase_info_arr['purchaseToken'];

        $setting = $this->settingModel->where("status!=", STATUS_DELETE)->first();

        // mario.taxi.com
        //$google_rsa_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlQLuDxWMncbOWesGcjnbAA57gO3xP9JL0xczwqIQuaCNJFLQGeLbJYzyxjfd17DEqVv0Ht66gJq3RhFFLL35u+BqLjQs51j+CRkESY1wQv9cKHhTrjhleoUszFeHoq3QddRmZePf1KGcjYtxqPVBZbvWjhaoecdoooHFz3uWuenU1sITn8KrAtYJPfJurXRiazsb4l5MYgdK7A/EukHPlQzcmfBnCoenBCKg1vHNho2tArbig9Is0e3D1J7Lu2VIob/xVwd3sG+CvEAYMFzgY/IDxUgvYD5tqC1uOBNpTzqRplgzsUbwOdbCvMLEYhMRzY+zat0HDVuhfJ/1sS6W8wIDAQAB";
        // semari.com
        $google_rsa_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAip4ouOKCsDd3PDO6qpr2wk9JTn3SHwxJx1pwGI67oySejcXyP5WMYR+jljJNz0Ab8+wl1dHogVYW/CWOnfFVftkzq0+5fL3PDrjhZx2PbFwy/QjeKM+S5CEsyzDPQAVS6qPBQ01gJhJtRwCiZdJTKZz2z9eciGMUdZc+QgC/iMRyNPpCBHM/URFddKhFj5ODk8Jb3tOUqCKoOzyVFzeVILfB42mmQUMzMvHIOsox+hxwbTprYYOdh05YBEaHyidT5ewfEv5YTqBG4MhHC/spJ2JGZ/h/63dnrveWRoHQrEWNF9XhXEsPOA850UYMs236sKXepurpgFRpDPtcQuJJmQIDAQAB";
        // 유효성 검증
        if (!verify_google_payment_in_app($purchase_data, $data_signature, $setting)) {
            $purchase_state = 2;
            return $this->response_error_code(API_RESULT_ERROR_PURCHASE);
        }

        // 중복검증
        $pay_list = $this->payHisModel->where(['order_id' => $order_id])->findAll();
        if($pay_list != null && count($pay_list) > 0) {
            return $this->response_error_code(API_RESULT_ERROR_PURCHASE_DUPLICATED);
        }

        $startDate =   date('Y-m-d h:i:s', $purchase_wtime/1000);
        $endDate = new \DateTime($startDate);
        $interval = new \DateInterval('P1M');
        $endDate->add($interval);
        $curDate = get_time_stamp_str();

        // 결제 이력 남기기
        $insert_data = [
            'reg_time' => $startDate,
            'end_time' => $endDate->format('Y-m-d H:i:s'),
            'user_uid' => $user_uid,
            'pay_method' => $pay_method,
            'update_time' => $curDate,
            'order_id' => $order_id,
            'product_id' => $product_id,
            'money' => $this->_get_price_from_inappid($product_id),
            'dev_type' => $dev_type,
            'pkg_nm' => $package_name,
            'purchase_token' => $purchase_token,
            'pay_status' => $purchase_state,
            'reserve1' => $purchase_data,
            'reserve2' => $data_signature,
        ];
        $insert_uid = $this->payHisModel->insert($insert_data);

        return $this->response_success();
    }

    public function ios()
    {
        $rules = [
            'uuid' => 'required',
            'purchase_data' => 'min_length[1]',
            'data_signature' => 'min_length[0]'
        ];
        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this
                ->response_error_status(
                    ResponseInterface::HTTP_BAD_REQUEST,
                    $this->validator->getErrors()
                );
        }

        $user_uid = $input['uuid'];
        $dev_type = $input['dev_type'];
        $purchase_data = $input['purchase_data'];
        $data_signature = $input['data_signature'];
        $pay_method = 'phone';

        $receipt = $purchase_data;

        $app_specified_shared_key = '6b95c660e52745b8b545fdde83b36e12'; // 구독인 경우 영수중 확인에 필요
        $ios_response = verify_apple_payment_in_app($receipt, false, $app_specified_shared_key);
        if ($ios_response === false) {
            $ios_response = verify_apple_payment_in_app($receipt, true, $app_specified_shared_key);
        }

        //echo json_encode($ios_response);
        if ($ios_response === false) {
            $this->response_error(API_RESULT_ERROR_PURCHASE);
        }

        $purchase_info_arr = json_decode($ios_response, true);

        if (count($purchase_info_arr['receipt']['in_app']) == 0 || !isset($purchase_info_arr['receipt']['in_app'][0])) {
            return $this->response_error(API_RESULT_ERROR_PURCHASE);
        }

        $inapp_info_cnt = count($purchase_info_arr['receipt']['in_app']);
        $inapp_info_arr = $purchase_info_arr['receipt']['in_app'][$inapp_info_cnt-1];

        $order_id = $inapp_info_arr['transaction_id'];
        $package_name = $purchase_info_arr['receipt']['bundle_id'];
        $product_id = $inapp_info_arr['product_id'];
        $purchase_wtime = $inapp_info_arr['purchase_date_ms'];
        $purchase_state = 1; // 정상
        $curDate = get_time_stamp_str();

        // 만료일이 지났다면
        $expire_date =   date('Y-m-d h:i:s', $inapp_info_arr['expires_date_ms']/1000);
        if($expire_date < $curDate) {
            $purchase_state = 0;
        }

        // 중복검증
        $pay_list = $this->payHisModel->where(['order_id' => $order_id])->findAll();
        if($pay_list != null && count($pay_list) > 0) {
            return $this->response_error_code(API_RESULT_ERROR_PURCHASE_DUPLICATED);
        }

        $purchase_token = $ios_response;

        $startDate =   date('Y-m-d h:i:s', $purchase_wtime/1000);
        $endDate = new \DateTime($startDate);
        $interval = new \DateInterval('P1M');
        $endDate->add($interval);

        // 결제 이력 남기기
        $insert_data = [
            'reg_time' => $startDate,
            'end_time' => $endDate->format('Y-m-d H:i:s'),
            'user_uid' => $user_uid,
            'pay_method' => $pay_method,
            'update_time' => $curDate,
            'order_id' => $order_id,
            'product_id' => $product_id,
            'money' => $this->_get_price_from_inappid($product_id),
            'dev_type' => $dev_type,
            'pkg_nm' => $package_name,
            'purchase_token' => $purchase_token,
            'pay_status' => $purchase_state,
            'reserve1' => $purchase_data,
            'reserve2' => $data_signature,
        ];
        $insert_uid = $this->payHisModel->insert($insert_data);

        return $this->response_success();
    }


    /************************************************************************
     * Helper
     *************************************************************************/
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