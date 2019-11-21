<?php
include_once('config/config-email.php');

date_default_timezone_set('Etc/UTC');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$nome_destinatario = $_POST['nome'];
$email_destinatario = $_POST['email'];
$assunto = $_POST['assunto'];
$body = $_POST['body'];
$de = $_POST['de'];
$como = $_POST['como'];
$senha = $_POST['senha'];

if(!$como){
  $como=$de;
}

function enviaEmail($email_destinatario, $nome_destinatario, $assunto, $body, $de, $senha, $como){
  $mail = new PHPMailer;
  $mail->isSMTP();
  //$mail->SMTPDebug = 4;
  $mail->Host = HOST;
  $mail->Port = PORT;
  $mail->SMTPSecure = SMTP_SECURE;
  $mail->SMTPAuth = SMTP_AUTH;
  $mail->Username = $de;
  $mail->Password = $senha;
  $mail->setFrom($como, SET_FROM_NAME);
  $mail->addAddress($email_destinatario, $nome_destinatario);
  $mail->CharSet = CHARSET;
  $mail->Subject = $assunto;
  $mail->msgHTML($body);

  for ($ct = 0; $ct < count($_FILES['arquivo']['tmp_name']); $ct++) {
        $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['arquivo']['name'][$ct]));
        $filename = $_FILES['arquivo']['name'][$ct];
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'][$ct], $uploadfile)) {
            $mail->addAttachment($uploadfile, $filename);
        } else {
            $msg = 'Falha ao mover no' . $uploadfile;
        }
  }
  
  if (!$mail->send()) {
    echo  "<script>alert('Email não enviado, verifique seus dados.');</script>";
    echo  "<script>javascript:history.back(-2)</script>";
  } else {
      echo  "<script>alert('Email enviado com sucesso!');</script>";
      echo "<script>document.location='../telas/Index.php'</script>";
  }
}
enviaEmail($email_destinatario, $nome_destinatario, $assunto, $body, $de, $senha, $como);
?>