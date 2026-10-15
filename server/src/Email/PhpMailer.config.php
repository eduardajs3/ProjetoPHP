<?php
namespace App\App\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

return [
	"currentProvider" => "gmail",
	"mailtrap" => [
		"host" => "sandbox.smtp.mailtrap.io",
		"smtpAuth" => true,
		"smtpSecure" => PHPMailer::ENCRYPTION_STARTTLS,
		"username" => $_ENV["PROVIDER_USERNAME"],
		"password"=>  $_ENV["PROVIDER_PASSWORD"],
		"port" => 2525
	],
	"gmail" => [
		"smtpdebug" => SMTP::DEBUG_CONNECTION,
		"host"=> "smtp.gmail.com",
		"smtpSecure" => PHPMailer::ENCRYPTION_STARTTLS,
		"username" => $_ENV["PROVIDER_USERNAME"],
		"password"=>  $_ENV["PROVIDER_PASSWORD"],
		"port" => 587
	]
];
