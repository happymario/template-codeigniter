<?php
/**
 * @author    Star_Man
 * @date 2019-07-30
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @param $signed_data
 * @param $signature
 * @param $public_key_base64
 * @return bool   true이면 성공, false면 실패
 */
function verify_google_payment_in_app($signed_data, $signature, $public_key_base64)
{
    $key = "-----BEGIN PUBLIC KEY-----\n" .
        chunk_split($public_key_base64, 64, "\n") .
        '-----END PUBLIC KEY-----';
    //using PHP to create an RSA key
    $o_key = openssl_pkey_get_public($key);
    //$signature should be in binary format, but it comes as BASE64.
    //So, I'll convert it.
    $dec_signature = base64_decode($signature);
    //using PHP's native support to verify the signature
    $result = openssl_verify($signed_data, $dec_signature, $o_key);

    return $result === 1;
}

/**
 * @param $signed_data
 * @param $signature
 * @param $public_key_base64
 * @return bool   true이면 성공, false면 실패
 */
function verify_onestore_payment_in_app($signed_data, $signature, $public_key_base64)
{
    $key = "-----BEGIN PUBLIC KEY-----\n" .
        chunk_split($public_key_base64, 64, "\n") .
        '-----END PUBLIC KEY-----';
    //using PHP to create an RSA key
    $o_key = openssl_pkey_get_public($key);
    //$signature should be in binary format, but it comes as BASE64.
    //So, I'll convert it.
    $dec_signature = base64_decode($signature);
    //using PHP's native support to verify the signature
    $result = openssl_verify($signed_data, $dec_signature, $o_key, OPENSSL_ALGO_SHA512);

    return $result === 1;
}

/**
 * @param $receipt
 * @param bool $isSandbox
 * @return bool|string false면 실패, 아니면 결제결과데이터
 */
function verify_apple_payment_in_app($receipt, $isSandbox = false) {
    // determine which endpoint to use for verifying the receipt
    if ($isSandbox) {
        $endpoint = 'https://sandbox.itunes.apple.com/verifyReceipt';
    } else {
        $endpoint = 'https://buy.itunes.apple.com/verifyReceipt';
    }

    $postData = json_encode(
        array('receipt-data' => $receipt)
    );

    // create the cURL request
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // execute the cURL request and fetch response data
    $response = curl_exec($ch);
    $errno = curl_errno($ch);
    $errmsg = curl_error($ch);
    curl_close($ch);

    // ensure the request succeeded
    if ($errno != 0) {
        //throw new Exception($errmsg, $errno);
        return false;
    }

    // parse the response data
    $data = json_decode($response);

    // ensure response data was a valid JSON string
    if (!is_object($data)) {
        //throw new Exception('Invalid response data');
        return false;
    }

    // ensure the expected data is present
    if (!isset($data->status) || $data->status != 0) {
        //throw new Exception('Invalid receipt');
        return false;
    }

    return $response;
}
