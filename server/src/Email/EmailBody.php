<?php
namespace App\App\Email;

class EmailBody {
    public static function verifyEmailBody($userParams) {
			$name = $userParams['name'];
			$id = $userParams['id'];
			$appURL = $userParams['URL'];
			return "
				<div style='font-family: Arial, sans-serif; color: #333; line-height: 1.6; padding: 24px;'>
					<div style='text-align: center; margin-bottom: 20px;'>
							<h1 style='color: #1E293B;'>Olá, $name</h1>
							<p style='font-size: 18px; color: #9CA3AF;'>
								Confirme sua identidade clicando aqui!
								<a href='$appURL/nutritionists/confirm/$id' style='font-weight: bold; color: #EC4899;'>Confirmar</a>
							</p>
					</div>
				</div>
			";
    }

		public static function inviteBody() {
			return "
				<div style='font-family: Arial, sans-serif; color: #333; line-height: 1.6; padding: 24px;'>
					<div style='text-align: center; margin-bottom: 20px;'>
							<h1 style='color: #1E293B;'>Você recebeu um convite! 🎉</h1>
							<p style='font-size: 18px; color: #9CA3AF;'>
								Você foi convidado(a) para finalizar seu cadastro na Fluxora.
								<a href='http://localhost:8080/finish' style='font-weight: bold; color: #EC4899;'>Finalizar cadastro</a>
							</p>
					</div>
				</div>
			";
		}

    public static function notifyBody($event, $subject, $content, $destination) {}
}
