<?php

namespace App\App\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendEmail
{
	private $configuration;
	private $provider;
	private $mailer;
	private $current;
	public function __construct()
	{
		$this->configuration = require __dir__ . '/PhpMailer.config.php';
		$this->mailer = new PHPMailer(true);
		$this->current = $this->configuration['currentProvider'];
		switch ($this->current) {
			case 'mailtrap':
				$this->provider = $this->configuration['mailtrap'];
				$this->mailer->isSMTP();
				$this->mailer->Host = $this->provider['host'];
				$this->mailer->SMTPAuth = $this->provider['smtpAuth'];
				$this->mailer->Username = $this->provider['username'];
				$this->mailer->Password = $this->provider['password'];
				$this->mailer->CharSet = PHPMailer::CHARSET_UTF8;
				$this->mailer->Port = $this->provider['port'];
				break;
			case 'gmail':
				$this->provider = $this->configuration['gmail'];
				$this->mailer->isSMTP();
				// $this->mailer->SMTPDebug = $this->provider['smtpdebug'];
				$this->mailer->Host = $_ENV['PROVIDER_HOST'];
				$this->mailer->SMTPAuth = true;
				$this->mailer->Username = $_ENV['PROVIDER_USERNAME'];
				$this->mailer->Password = $_ENV['PROVIDER_PASSWORD'];
				$this->mailer->CharSet = PHPMailer::CHARSET_UTF8;
				$this->mailer->Port = $_ENV['PROVIDER_PORT'];
				break;
		}
	}
	public function sendEmailConfirmation($destino, $subject)
	{
		$this->mailer->setFrom('alvarosenacs.c@gmail.com', 'Equipe de suporte');
		if (!isset($destino['email']) && empty($destino['email']) || empty($destino['name']) && empty($destino['name'])) {
			return "Email not set";
		}

		try {
			$this->mailer->addAddress($destino['email'], $destino['name']);

			// assunto e corpo do email
			$this->mailer->isHTML(true);
			$this->mailer->Subject = $subject;
			$this->mailer->Body = EmailBody::verifyEmailBody(["name" => $destino['name'], "id" => $destino['id'], "URL" => $_ENV['APP_URL']]);
			$emailSen = $this->mailer->send();

			if (!$emailSen) {
				return "Failed: " . $this->mailer->ErrorInfo;
			}

			return "Success";
		} catch (Exception $th) {
			return $th->getMessage();
		}
	}
	public function sendInvite($destino, $subject) {
		$this->mailer->setFrom('alvarosenacs.c@gmail.com', 'Fluxora | Equipe de suporte');
		
		if (!isset($destino)) {
			return "Email not set";
		}

		$this->mailer->addAddress($destino, 'Convite');

		$this->mailer->isHTML(true);
		$this->mailer->Subject = $subject;
		$this->mailer->Body = EmailBody::inviteBody();
		$emailSen = $this->mailer->send();

	}

	public function verifyAccount($destino, $subject) {}
}
