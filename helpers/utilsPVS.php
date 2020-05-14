<?php 

/**
 * 
 */
class UtilsPVS
{

	function configMailer() {
		require 'lib/mailer/class.phpmailer.php';
		$mail = new PHPMailer;
		$mail->IsSMTP();								//Sets Mailer to send message using SMTP
		$mail->Host = 'smtp.gmail.com';					//Sets the SMTP hosts of your Email hosting, this for Godaddy
		$mail->Port = '587';							//Sets the default SMTP server port
		$mail->SMTPAuth = true;					//Sets SMTP authentication. Utilizes the Username and Password variables
		$mail->Username = 'minhphuongitech@gmail.com';					//Sets SMTP username
		$mail->Password = 'iwantyouback150290';					//Sets SMTP password
		$mail->SMTPSecure = 'tls';							//Sets connection prefix. Options are "", "ssl" or "tls"
		$mail->From = 'minhphuongitech@gmail.com';					//Sets the From email address for the message
		$mail->FromName = 'Phuong Nguyen';				//Sets the From name of the message
		$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
		$mail->IsHTML(true);							//Sets message type to HTML			
		$mail->CharSet = 'UTF-8';	
		return $mail;
	}

	function notifyUserRegistrationComplete($to, $password, $name, $language)
	{
		$mail = $this->configMailer();
		$subject = "";
		$body = "";
		switch ($language) {
			case 'japanese':
				$subject = "【新規登録完了お知らせ】あなたの登録が完了致しました。";
				$body = $name."様". "<br>" . "<br>" .
						"ご登録頂き、ありがとうございました。". "<br>" .
						"下記情報でごログインください。". "<br>" .
						"ユーザ名：".$to. "<br>" .
						"パスワード：". $password . "<br>" . "<br>" .
						"よろしくお願いいたします。";
				break;
			
			default:
				$subject = "[Notice of new registration completion] Your registration is complete.";
				$body = "Dear ". $name."<br>" . "<br>" .
						"Thanks for your registration". "<br>" .
						"Please use information below to login website". "<br>" .
						"Username：".$to. "<br>" .
						"Password：". $password . "<br>" . "<br>" .
						"Thanks And Best Regards";
				break;
		}
		$mail->Subject = $subject;				//Sets the Subject of the message
		$mail->AddAddress('minhphuongitech@gmail.com', $name);		//Adds a "To" address
		// $mail->AddCC($_POST["email"], $_POST["name"]);	//Adds a "Cc" address
		$mail->Body = $body;				//An HTML or plain text message body
		if($mail->Send())								//Send an Email. Return true on success or false on error
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function notifyUserResetPassword($to, $name, $language, $newPassword, $id)
	{
		$mail = $this->configMailer();
		$subject = "";
		$body = "";
		switch ($language) {
			case 'japanese':
				$subject = "【パスワード更新お知らせ】新たなパスワードをご更新お願いいたします。";
				$body = $name."様". "<br>" . "<br>" .
						"ご更新依頼頂き、ありがとうございました。". "<br>" .
						"新たなパスワード：".$newPassword. "<br>" .
						"<a href='".WEB_URL."/updatepassword.php?id=".$id."'>こちら</a>をクリックして、更新お願いいたします。<br><br>".
						"よろしくお願いいたします。";
				break;
			
			default:
				$subject = "[Password update notice] Please update your password.";
				$body = "Dear ". $name."<br>" . "<br>" .
						"Thanks for your change password request". "<br>" .
						"New Password：".$newPassword. "<br>" .
						"Click <a href='".WEB_URL."/updatepassword.php?id=".$id."'>Here</a> to update new password.<br><br>".
						"Thanks And Best Regards";
				break;
		}
		$mail->Subject = $subject;				//Sets the Subject of the message
		$mail->AddAddress('minhphuongitech@gmail.com', $name);		//Adds a "To" address
		// $mail->AddCC($_POST["email"], $_POST["name"]);	//Adds a "Cc" address
		$mail->Body = $body;				//An HTML or plain text message body
		if($mail->Send())								//Send an Email. Return true on success or false on error
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
}
?>