<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = $_POST['debug_level']; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = $_POST['smtp_server'];   
unset($_POST['smtp_server']); 
$mail->Port = $_POST['smtp_port'];
unset($_POST['smtp_port']);
$mail->SMTPSecure = $_POST['tls'];
$mail->SMTPAutoTLS = false;
$mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => true,
        'verify_peer_name' => true,
        'allow_self_signed' => true
    )
); 
$mail->SMTPAuth = $_POST['smtp_auth'];
$mail->AuthType = $_POST['auth_type'];
$mail->Username = $_POST['username'];
$mail->Password = $_POST['password'];
$mail->setFrom($_POST['from']);
unset($_POST['from']);
$mail->addAddress($_POST['to']);
unset($_POST['to']);
$mail->Subject = ($_POST['subject']);
unset($_POST['subject']);
$mail->msgHTML($_POST['message']);
unset($_POST['message']);
//$mail->AltBody = 'HTML messaging not supported';
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
    echo <<<OUTPUT
<html><body><br/><button onclick="goBack()">Go Back</button> 
<script>
function goBack() {
  window.history.back();
}
</script>
</body></html>
OUTPUT;

}else{

    echo "Message sent!";
    echo <<<OUTPUT
<html><body><br/><button onclick="goBack()">Go Back</button> 
<script>
function goBack() {
  window.history.back();
}
</script>
</body></html>
OUTPUT;

exit();
}

?>
