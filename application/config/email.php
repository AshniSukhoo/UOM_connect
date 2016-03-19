<?php

/**
 * SMTP Email server configuration
 */

$config = [
    'protocol'  => env('MAIL_UOM_DRIVER'),
    'smtp_host' => env('MAIL_UOM_HOST'),
    'smtp_port' => env('MAIL_UOM_PORT'),
    'smtp_user' => env('MAIL_UOM_USERNAME'),
    'smtp_pass' => env('MAIL_UOM_PASSOWRD'),
    'mailtype'  => 'html',
    'charset'   => 'utf-8',
    'crlf'      => "\r\n",
    'newline'   => "\r\n",
];
