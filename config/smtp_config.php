<?php
//Codado por Miguel Luiz Sommerfeld - 3°F Turma B
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

define("SMTP_HOST", "smtp.gmail.com");
define("SMTP_PORT", 587);
define("SMTP_USER", "feiratecnologica2025@gmail.com");
define("SMTP_PASSWORD", "inckldcxyzdbpqqn");

$email = new PHPMailer();

// Configurações do servidor
$email->isSMTP();
$email->Host = SMTP_HOST;
$email->SMTPAuth = true;
$email->Username = SMTP_USER;
$email->Password = SMTP_PASSWORD;
$email->Port = SMTP_PORT;
$email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$email->CharSet = 'UTF-8';