<?php

require_once('Common.php');

class Mails extends Common {



/***********************  Send Password or Verification Code  ************************/

public function SendPasswordByMail($name,$email) {
					$password = md5(uniqid(rand(), true));
					$password = substr($password, 0, 6);
					require "./PHPMailer/PHPMailerAutoload.php";
					require "./PHPMailer/class.phpmailer.php";
					require "./PHPMailer/class.smtp.php";
			    $from = $email;
			    $from_name = 'College project';
			    $subject = 'Verification mail from college project';
			    $body = '<br><br>Hello <span style="text-transform:capitalize">'.$name.'</span>, <br><br> This is a verification mail from carrer project for this mail id <br> <ib>Your Login credentials are given below</ib> <br> <br> <b> Username  : '.$email.' <br> <br> Password : '.$password.'<br>';
			    $to = $email;
			    $mail = new PHPMailer;  // create a new object
			    $mail->IsSMTP(); // enable SMTP   //
			    $mail->SMTPAuth = true;  // authentication enabled
			    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			    $mail->Host = 'smtp.gmail.com';
			    $mail->Port = 465;
			    $mail->Username = "projectatcm@gmail.com";
			    $mail->Password = "[code]magos";
			    $mail->SetFrom($from, $from_name);
			    $mail->addReplyTo($from);
			    $mail->Subject = $subject;
			    $mail->IsHTML(true);
			    $mail->Body = $body;
			    $mail->AddAddress($to);
			    if (!empty($cc)) {
			        $mail->addCC($cc);
			    }
			    if (!empty($bcc)) {
			        $mail->addBCC($bcc);
			    }
			    if (!$mail->Send()) {
			        echo $error = 'Mail error: ' . $mail->ErrorInfo;
			        return false;
			    } else {
			        return $password;
			    }
	}



/***********************  Notification Mail Body  ************************/

public function mailBody($mailsubject,$mailbody,$mailfor) {
				require "./PHPMailer/PHPMailerAutoload.php";
				require "./PHPMailer/class.phpmailer.php";
				require "./PHPMailer/class.smtp.php";
				$from = 'projectatcm@gmail.com';
				$from_name = 'College project';
				$subject = $mailsubject;
				$body = $mailbody;
				$to = $mailfor;
				$mail = new PHPMailer;  // create a new object
				$mail->IsSMTP(); // enable SMTP   //
				$mail->SMTPAuth = true;  // authentication enabled
				$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 465;
				$mail->Username = "projectatcm@gmail.com";
				$mail->Password = "[code]magos";
				$mail->SetFrom($from, $from_name);
				$mail->addReplyTo($from);
				$mail->Subject = $subject;
				$mail->IsHTML(true);
				$mail->Body = $body;
				$mail->AddAddress($to);
				if (!empty($cc)) {
						$mail->addCC($cc);
				}
				if (!empty($bcc)) {
						$mail->addBCC($bcc);
				}
				if (!$mail->Send()) {
						echo $error = 'Mail error: ' . $mail->ErrorInfo;
						return FALSE;
				} else {
						return TRUE;
				}
}



/*********************** Password Change Notification ********************/

public function notificationmail($mailsubject,$name,$notificationtype,$password,$email) {
			$body = ' <br> Hello <span style="text-transform:capitalize">'.$name.'</span>, <br><p>Your '.$notificationtype.' has sucessfully updated as below <br><br><b>'.$password.'</b> </p>';
			$notificationmailsend = $this->mailBody($mailsubject,$body,$email);
			if($notificationmailsend) {
				return TRUE;
			}else{
				return FALSE;
			}
}



/*********************** Login Notification ********************/

public function loginNotification($email,$ip) {
			$mailsubject = 'Account Login Alert';
			$body = '<br><br>Your account for the carrer project has been logged in from the ip address <br> <br> <b>'.$ip.'</b>';
			$notificationmailsend = $this->mailBody($mailsubject,$body,$email);
			if($notificationmailsend) {
				return TRUE;
			}else{
				return FALSE;
			}
}



}

?>
