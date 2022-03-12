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
    if ($type === 0) {
        return date('d-m-Y', strtotime($date));
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
    echo '<pre>';
    print_r($params);
    echo '</pre>';
    die();
}

function sendEmail($data)
{
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
    return false;
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