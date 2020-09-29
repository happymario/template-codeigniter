<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function getUniqueString($ext = '')
{
    $returnVar = "" . round(microtime(true) * 1000) . mt_rand(1000, 9999);
    if (!empty($ext)) {
        $returnVar .= "." . $ext;
    }
    return $returnVar;
}

function make_directory($path)
{
    $dirs = explode(DIRECTORY_SEPARATOR, $path);
    $mkpath = UPLOAD_PATH;
    if (!file_exists($mkpath)) {
        mkdir($mkpath, 0777);
    }
    foreach ($dirs as $dirname) {
        if ($dirname !== '') {
            $mkpath .= DIRECTORY_SEPARATOR . $dirname;
            if (!file_exists($mkpath)) {
                mkdir($mkpath, 0777);
            }
        } else
            break;
    }
    return $mkpath;
}

function _send_email($target_email, $subject, $mail_description = '', $mail_important_string = '', $mail_footer = '') {
    //TODO: 테스트중 이메일 발송 막기
//    return true;
    $CI = & get_instance();
    $CI->load->library('email');
    $CI->email->from(SMTP_EMAIL_ADDRESS, 'ALGOBADA');
    $CI->email->subject($subject);

    $data['mail_title'] = $subject;
    $data['mail_description'] = $mail_description;
    $data['mail_important_string'] = $mail_important_string;
    $data['mail_footer'] = $mail_footer;
    $email_content = $CI->load->view('layout/mail_template', $data, true);

    $CI->email->message($email_content);
    $CI->email->to(trim($target_email));
    return $CI->email->send();
}


function getTimeStampString($deltaTimeString = null, $is_date = false) {
    $format_string = 'Y-m-d H:i ';
    if ($is_date)
        $format_string = 'Y-m-d';
    if ($deltaTimeString === null)
        return date($format_string);
    else
        return date($format_string, strtotime($deltaTimeString));
}

function send_push($fcm_key, $push_type = 0, $dev_token = '', $dev_type = 'android', $title = '', $content = '', $target_url = '')
{

    if (empty($dev_token)) {
        return true;
    }

    $fields = [
        'content_available' => true,
        'mutable_content' => true,
        'priority' => 'high',
        'to' => $dev_token
    ];

    $fields['data'] = [
        'type' => $push_type,
        'body' => $content,
        'title' => $title,
        'targetUrl' => $target_url
    ];
    if ($dev_type === 'ios') {
        $fields['notification'] = [];
        $fields['notification']['title'] = $title;
        $fields['notification']['body'] = $content;
        $fields['notification']['sound'] = 'default';
        $fields['notification']['targetUrl'] = $target_url;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Authorization:key=' . $fcm_key)
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POST, 'post');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

function t($line) {
    $CI = &get_instance();
    return $CI->lang->line($line);
}
