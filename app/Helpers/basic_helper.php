<?php

function helperTest()
{
    return 'Hey! I\'m working !!';
}

function formatDate($date)
{
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