<?php
use Fabiang\Xmpp\Protocol\Message;
use Fabiang\Xmpp\Options;
use Fabiang\Xmpp\Client;
use Fabiang\Xmpp\Protocol\Roster;
use Fabiang\Xmpp\Protocol\Presence;

function send_email($target_email, $subject, $mail_description = '', $mail_important_string = '', $mail_footer = '') {
    if(TEST_LOCAL_MODE == true) {
        return true;
    }
    $CI = & get_instance();
    $CI->load->library('email');

    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = SMTP_EMAIL_ADDRESS;
    $config['smtp_pass']    = SMTP_EMAIL_PASSWORD;
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html, text
    $config['validation'] = TRUE; // bool whether to validate email or not

    $CI->email->initialize($config);
    $CI->email->from(SMTP_EMAIL_ADDRESS, 'Makeup');
    $CI->email->subject($subject);

    $data['mail_title'] = $subject;
    $data['mail_description'] = $mail_description;
    $data['mail_important_string'] = $mail_important_string;
    $data['mail_footer'] = $mail_footer;
    $email_content = $CI->load->view('layout/mail_template', $data, true);

    $CI->email->message($email_content);
    $CI->email->to(trim($target_email));
    $result = $CI->email->send();  // TRUE/FALSE Parameter 줄수 있는데 이메일발송후 mail초기화여부 결정
    if($result == false) {
        echo $CI->email->print_debugger(); // 오유찍기
    }
    return $result;
}

function send_sms($phone, $text) {
    if(TEST_LOCAL_MODE == true) {
        return true;
    }

    $url = "http://link.smsceo.co.kr/sendsms_utf8.php?userkey=" . SMS_USER_KEY;
    $url .= "&userid=" . SMS_USER_ID;
    $url .= "&phone=" . $phone;
    $url .= "&callback=" . SMS_CALLBACK_PHONE_NUMBER;
    $url .= "&msg=" . urlencode($text);

    $result = file_get_contents($url);
    $result = trim($result);
    parse_str($result, $result_var);

    if ($result_var['result_code'] == "1") // 전송성공
    {
//            echo "결과코드 : " . $result['result_code'];
//            echo "메세지 : " . $result['result_msg'];
//            echo "총 접수건수 : " . $result['total_count'];
//            echo "성공건수 : " . $result['succ_count'];
//            echo "실패건수 : " . $result['fail_count'];
//            echo "잔액 : " . $result['money'];

        /*$CI = &get_instance();
        $CI->load->model("Usermodel");
        $CI->load->database();

        $data= array();
        $data['phone'] = $phone;
        $data['user_id'] = $user_id;
        $data['content'] = $message;
        $data['surplus'] = $result['money'];
        $data['add_time'] = date('Y-m-d H:i:s');

        $CI->Usermodel->addSmsLog($data);*/
        return true;
    } else {
//            echo "결과코드 : " . $result['result_code'];
//            echo "메세지 : " . $result['result_msg'];
        return false;
    }
}


function send_push($fcm_key, $dev_type = 'android', $dev_token = '', $push_type = 0, $title = '', $content = '', $target_url = '', $data=null)
{
    if (empty($dev_token)) {
        return false;
    }

    if(empty($fcm_key)) {
        return false;
    }

    if(TEST_LOCAL_MODE == true) {
        return false;
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
    if ($data != null) {
        $fields['data'] = array_merge($fields['data'], $data);
    }
    if ($dev_type === 'ios') {
        $fields['notification'] = [];
        $fields['notification']['title'] = $title;
        $fields['notification']['body'] = $content;
        $fields['notification']['sound'] = 'default';
        $fields['notification']['targetUrl'] = $target_url;

        if ($data != null) {
            $fields['notification'] = array_merge($fields['notification'], $data);
        }
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

    return true;
}


function send_push_gotify($push_key, $dev_type = 'android', $dev_token = '', $push_type = 0, $title = '', $content = '', $target_url = '', $data=null)
{
//    if (empty($dev_token)) {
//        return false;
//    }

    if(empty($push_key)) {
        return false;
    }

    $fields = [
        'client_token' => $dev_token,
        'title' => $title,
        'message' => $content,
        'priority' => 5
    ];

    $fields['extras'] = [
        'type' => $push_type,
        'message' => $content,
        'title' => $title,
        'targetUrl' => $target_url,
        'dev_type' => $dev_type
    ];
    if ($data != null) {
        $fields['extras'] = array_merge($fields['data'], $data);
    }

    $url = "http://192.168.0.13/message?token=$push_key";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Authorization:key=' . $push_key)
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

function send_push_openfire($server_addr, $domain, $room_name, $dev_type = 'android', $push_type = 0, $title = '', $content = '', $target_url = '', $data=null)
{
    $port = 5222;
    $id = null;
    try {
        $options = new Options("tcp://{$server_addr}:{$port}");

        $options->setAuthenticated(false)
            ->setUsername("admin")
            ->setPassword("root")
            ->setTimeout(1000)
            ->setPeerVerification(false);

        $client = new Client($options);
        // optional connect manually
        $client->connect();
        // fetch roster list; users and their groups
        $client->send(new Roster);
        // set status to online
        $client->send(new Presence);

        //        $message = new Message;
        //        $message->setMessage($title."\n".$content)->setTo('tester1@happymario');
        //        $client->send($message);

        $channel = new Presence;
        $channel->setTo("{$room_name}@conference.{$domain}")
                ->setNickName('admin');
        $client->send($channel);

        $fields['extras'] = [
            'type' => $push_type,
            'message' => $content,
            'title' => $title,
            'targetUrl' => $target_url,
            'dev_type' => $dev_type
        ];
        if ($data != null) {
            $fields['extras'] = array_merge($fields['data'], $data);
        }

        $message = new Message;
        $message->setMessage(json_encode($fields))
            ->setTo("{$room_name}@conference.{$domain}")
            ->setType(Message::TYPE_GROUPCHAT);
        $client->send($message);

        return json_encode([
            "id" => $channel
        ]);
    }
    catch (Exception $e) {
        echo 'Message: ' .$e->getMessage();
    }


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

function get_temp_image_url($file_name, $dir="temp")
{
    if (is_http_url($file_name))
        return $file_name;

    $file_path = make_directory($dir) . DIRECTORY_SEPARATOR . $file_name;

    return (file_exists($file_path) && is_file($file_path)) ? base_url(UPLOAD_URL_PATH . $dir.'/' . $file_name) : get_default_image_url();
}

function get_real_image_url($image_url)
{
    if (is_http_url($image_url))
        return $image_url;

    $file_path = make_directory('') . $image_url;

    return (file_exists($file_path) && is_file($file_path)) ? base_url(UPLOAD_URL_PATH . $image_url) : base_url('/assets/admin/images/img_photo_default.png');
}

/**
 * temp폴더의 파일을 목적폴더로 전송하는 API
 * @param $table_name string 테이블명 예 usr
 * @param $uid int 해당테이블 primary key
 * @param $file_name string 업로드된 이미지파일
 */
function move_target_folder($table_name, $uid, $file_name)
{
    if (empty($file_name))
        return;
    $file_path = make_directory($table_name . DIRECTORY_SEPARATOR . $uid);
    $temp_path = make_directory('temp');
    if (file_exists($temp_path . DIRECTORY_SEPARATOR . $file_name))
        rename($temp_path . DIRECTORY_SEPARATOR . $file_name, $file_path . DIRECTORY_SEPARATOR . $file_name);
}

/**
 *
 * @param $table_name
 * @param $uid
 * @param $file_name
 * @param string $default_image_path
 * @return string
 */
function get_target_image_url($table_name, $uid, $file_name, $default_image_path = '/assets/admin/images/img_photo_default.png')
{
    if (strpos($file_name, "http://") === 0 || strpos($file_name, "https://") === 0)
        return $file_name;
    $file_path = make_directory($table_name . DIRECTORY_SEPARATOR . $uid) . DIRECTORY_SEPARATOR . $file_name;
    return (file_exists($file_path) && is_file($file_path)) ? base_url(UPLOAD_URL_PATH . $table_name . "/" . $uid . "/" . $file_name) : $default_image_path;
}

/**
 *
 * @param $table_name
 * @param $uid
 * @param $file_name
 * @return bool
 */
function delete_target_image($table_name, $uid, $file_name) {
    if (empty($file_name)) {
        return true;
    }
    $file_path = make_directory($table_name . DIRECTORY_SEPARATOR . $uid) . DIRECTORY_SEPARATOR . $file_name;
    if (file_exists($file_path) && is_file($file_path))
        return unlink($file_path);
    else
        return true;
}

function get_unique_str($ext = '')
{
    $returnVar = "" . round(microtime(true) * 1000) . mt_rand(1000, 9999);
    if (!empty($ext)) {
        $returnVar .= "." . $ext;
    }
    return $returnVar;
}

function get_time_stamp_str($deltaTimeString = null, $is_date = false) {
    $format_string = 'Y-m-d H:i:s';
    if ($is_date)
        $format_string = 'Y-m-d';
    if ($deltaTimeString === null)
        return date($format_string);
    else
        return date($format_string, strtotime($deltaTimeString));
}

/* 문자열 변환
// $str : 문자열(html, text)
// 반환 : trim() + text 형태 + <br> 처리
*/
function str_to_html($str)
{
    $str = trim($str);
    $str = htmlspecialchars($str);
    $str = stripslashes($str);
    $str = str_replace(array("\n", " "), array("<br>", "&nbsp;"), $str);
    return $str;
}


/**
 * 랜덤 알파벳문자열 생성
 * @param int $length
 * @return string
 */
function generate_random_string($length = 10) {
    //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * prefix 체크
 * @param string $haystack
 * @param string $needle
 * @return string
 */
function start_with_string($haystack, $needle) {
    return (strpos($haystack, $needle) === 0);
}

/**
 * suffix 체크
 * @param string $haystack
 * @param string $needle
 * @return string
 */
function end_with_string($haystack, $needle) {
    $length = strlen($needle);
    if ($length === 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

/**
 * HTTP URL 체크
 * @param string $haystack
 * @param string $needle
 * @return string
 */
function is_http_url($url) {
    return start_with_string($url, 'http://') || start_with_string($url, 'https://');
}

/**
 * 시간차이문자열 얻기
 * @param string $time
 * @return string
 */
function get_diff_time_string($time) {
    $date1 = date_create($time);
    $date2 = date_create(getTimeStampString());

    $date3 = date_diff($date1, $date2);
    if ($date3->y > 0) $before = $date3->y . "년전";
    else if ($date3->m > 0) $before = $date3->m . "개월전";
    else if ($date3->days > 0) $before = $date3->days . "일전";
    else if ($date3->h > 0) $before = $date3->h . "시간전";
    else if ($date3->i > 0) $before = $date3->i . "분전";
    else $before = $date3->s . "초전";

    return $before;
}


function valid_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL);
}


function log_txt($title = "", $data = "") {
    $now = date("Y-m-d H:i:s.v");
    $log_txt = json_encode($data);

    $log_dir = UPLOAD_PATH; // 777 permission필요.
    $log_file = fopen($log_dir . "/log.txt", "a");
    fwrite($log_file, $now." ".$title . "\r\n");
    fwrite($log_file, $log_txt . "\r\n\r\n");
    fclose($log_file);
}

function t($key, $args = [], $file_name = DEFAULT_LANGUAGE_FILE_NAME)
{
    if (empty($key))
        return "";

    return lang(join(".", [$file_name, $key]), $args);

}
function is_empty($var) {
    if($var == null || $var == '') {
        return true;
    }

    return false;
}