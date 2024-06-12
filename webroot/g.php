<?php
require_once('../vendor/autoload.php');

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Output\QROutputInterface;

$data = $_GET['d'];
$data = validation($data);
Header('Content-Type: image/png');
echo generate($data);
exit;

// functions. ------------------------------------------------------------------
function generate($data)
{
    $qrcode = new QRCode(getQROptions());
    $out = $qrcode->render($data);
    return $out;
}

function getQROptions()
{
    $options = new QROptions;
    $options->version = 7;
    $options->outputType = QROutputInterface::GDIMAGE_PNG;
    $options->scale  = 5;
    $options->outputBase64 = false;

    return $options;
}

function validation($data)
{
    if (strlen($data) > 1024) {
        header('414 URI Too Long');
        exit;
    }

    return $data;
}