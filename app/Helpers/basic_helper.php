<?php

function helperTest()
{
    return 'Hey! I\'m working !!';
}

/**
 * type = 0 => 10-03-2022
 * type = 1 => March 03, 2022
 */

function formatDate($date, $type = 0)
{
    if ($date == null) {
        return '-';
    }
    
    if ($type === 1) {
        return date('F d, Y', strtotime($date));
    }

    // default
    return date('d-m-Y', strtotime($date));
}

function download($filePath)
{
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    flush(); // Flush system output buffer
    readfile($filePath);
    exit;
}

function hashPassword($plain_text_password)
{
    return password_hash($plain_text_password, PASSWORD_BCRYPT);
}

function getErrorClass($errorsObject, $field)
{
    return $errorsObject->hasError($field) ? 'is-invalid' : '';
}

function getErrorMessage($errorsObject, $field)
{
    return $errorsObject->hasError($field) ? $errorsObject->getError($field) : '';
}

function odd(...$params)
{
    // echo '<pre>';
    // print_r($params);
    // echo '</pre>';
    // die();

    echo '<pre>';
    foreach ($params as $key => $param) {

        echo "Parameter : " . ($key + 1);
        echo '<br>';
        print_r($param);
        echo '<br><br>';
    }

    echo '</pre>';
    die();
}

function sendEmail($data)
{
    if (getenv('app.mail.smtpPass') && getenv('app.mail.smtpUser')) {
        $email = \Config\Services::email();
        $email->setTo($data['email']);
    
        if (isset($data['cc'])) {
            $email->setCC($data['cc']);
        }
        if (isset($data['bcc'])) {
            $email->setBCC($data['bcc']);
        }
        $email->setSubject($data['subject']);
    
        $view = \Config\Services::renderer();
        $view->setData(['data' => $data['data']]);
        $html = $view->render($data['view']);
    
        $email->setMessage($html);
    
        if ($email->send()) {
            return true;
        }

        return true;
    }

    return true;
}

function getActiveClass($url)
{
    return url_is($url) ? 'active' : '';
}

function base64_encode_url($string) {
    return str_replace(['+','/','='], ['-','_',''], base64_encode($string));
}

function base64_decode_url($string) {
    return base64_decode(str_replace(['-','_'], ['+','/'], $string));
}

function slug($string)
{
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}

function urlFriendlyFileName($string)
{
    return preg_replace('/\W+/', '-', strtolower(trim($string)));
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function checkInputDate($date)
{
    $date = new DateTime($date);
    $current = new DateTime('now'); 

    if($date < $current) {
        return $date->format('Y-m-d H:i:s');
    }
    return $current->format('Y-m-d H:i:s');
}

function dateDiffInDays($date1, $date2) 
{
  $diff = strtotime($date2) - strtotime($date1);

  return abs(round($diff / 86400)) + 1;
}

// generating secure key
// this key will be stored in .env file
// $key = base64_encode(openssl_random_pseudo_bytes(16));

/**
 * Encrypt a string
 * 
 * @param string $string - string to encrypt
 * @return string
 * @throws RangeException
 */
if (!function_exists('encryptString')) {
    function encryptString($string)
    {
        // encryption method
        $ciphering_method = "aes-256-cbc";
        // generating random bytes based on encrption method 
        $iv_length = openssl_cipher_iv_length($ciphering_method);
        $iv = openssl_random_pseudo_bytes($iv_length);

        // getting salt
        $encryption_key = base64_decode(getenv('app.encryptionKey'));
        
        // encrypting with openssl encrypt
        $encrypted = openssl_encrypt($string, $ciphering_method, $encryption_key, OPENSSL_RAW_DATA , $iv);  

        // passing the iv with encrypted string with base64 encoded
        return base64_encode($iv . $encrypted);
    }
}
/**
 * Decrypt a string
 * 
 * @param string $encrypted - string encrypted with encryptString()
 * @return string
 * @throws Exception
 */
if (!function_exists('decryptString')) {
    function decryptString($encrypted_string)
    {
        // base64 decrypting
        $encrypted_string = base64_decode($encrypted_string);

        $ciphering_method = "aes-256-cbc";   
        $iv_length = openssl_cipher_iv_length($ciphering_method);

        // getting the iv which we concatinated while encrypting
        $iv = substr($encrypted_string, 0, $iv_length);

        // getting the encrypted string
        $encrypted_string = substr($encrypted_string, $iv_length);

        // getting base64 encoded random openssl string from .env
        $encryption_key = base64_decode(getenv('app.encryptionKey'));

        return openssl_decrypt($encrypted_string, $ciphering_method, $encryption_key, OPENSSL_RAW_DATA, $iv);

    }
}

function generateKey()
{
    return base64_encode(openssl_random_pseudo_bytes(16));
}

function downloadExcel($filePath)
{
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filePath));
    flush(); // Flush system output buffer
    readfile($filePath);
    exit;
}

function makeDateRange($start, $end, $pattern = 'Y-m-d')
{
    $datesObject = new DatePeriod(
        new DateTime($start),
        new DateInterval('P1D'),
        new DateTime($end . '+1 day')
    );
    $datesArray = array();

    foreach ($datesObject as $key => $date) {
        $datesArray[] = $date->format($pattern);
    }

    return $datesArray;
}

function sanitizeData($str_or_num)
{
    return trim(stripslashes(htmlspecialchars($str_or_num)));
}

function getEndDate($date, $pattern = 'Y-m-d')
{
    $date = str_replace('/', '-', $date);
    $date = new DateTime($date);

    $currentDate = new DateTime(date('Y-m-d'));
    if ($date <= $currentDate) {
        return $date->format($pattern);
    } else {
        return $currentDate->format($pattern);
    }
}

function getDateInMySQLFormat($date)
{
    $date = str_replace('/', '-', $date);
    return date('Y-m-d', strtotime($date));
}

function dp(...$params)
{
    echo '<pre>';

    foreach ($params as $key => $param) {
        echo "Parameter " . ($key + 1);
        echo '<br>';
        print_r($param);
        echo '<br>';
        echo '<br>';
    }

    echo '</pre>';
}

function getMonthsBetweenDates($start_date, $end_date)
{
    $start    = (new DateTime($start_date))->modify('first day of this month');
    $end      = (new DateTime($end_date))->modify('first day of next month');

    $interval = DateInterval::createFromDateString('1 month');
    $period   = new DatePeriod($start, $interval, $end);

    $months = array();
    foreach ($period as $dt) {
        $arr = array(
            'start' => date('Y-m-01', strtotime($dt->format('Y-m-d'))),
            'end' => date('Y-m-t', strtotime($dt->format('Y-m-d'))),
            'month' => $dt->format("F")
        );
        $months[] = (object) $arr;
    }
    
    return $months;
}