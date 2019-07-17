<?php
	namespace models;

	require_once 'models/phpmailer/PHPMailer.php';
	require_once 'models/phpmailer/SMTP.php';
	require_once 'models/phpmailer/Exception.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception as MailerException;

	class SendingMail
	{
		
		/**
		 * Method using PHPMailer to send email
		 *
		 * @method SendMail
		 *
		 * @param  string   $recipient     [description]
		 * @param  string   $letter_header [description]
		 * @param  string   $letter_body   [description]
		 */

		public static function SendMail(string $recipient, string $letter_header, string $letter_body)
		{
			$mail = new PHPMailer();

			try {
				$mail->isSMTP();
				$mail->CharSet = 'UTF-8';
				$mail->SMTPAuth = true;

				$mail_config_path = '../config/mail_config.php';
				if (!file_exists($mail_config_path))
					throw new MailerException("Mail configuration file not found.");
				$mail_config = require_once $mail_config_path;

				$mail->Host = $mail_config['host'];
				$mail->Username = $mail_config['username'];
				$mail->Password = $mail_config['password'];
				$mail->SMTPSecure = $mail_config['secure'];
				$mail->Port = $mail_config['port'];
				$mail->setFrom($mail_config['username'], $mail_config['sender_name']);

				$mail->addAddress($recipient);

				$mail->isHTML(true);

				$mail->Subject = $letter_header;
				$mail->Body = $letter_body;

				if (!$mail->send())
					die(\json_encode(['error' => 'Message has not been sent!']));

			} catch (MailerException $e) {
				die(\json_encode(['error' => "Message has not been sent! Error: {$e->errorMessage()}"]));
			}
		}
	}
