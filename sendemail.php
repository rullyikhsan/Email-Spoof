<?php
require('csv.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'formpengisiancsf@gmail.com';                     // SMTP username
    $mail->Password   = 'Csfjuni2019';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('formpengisiancsf@gmail.com', 'CS Finance');
    
    //kirim sesuai button
    if(isset($_POST['multi_send'])){
        for ($x = 1; $x <  sizeof($the_big_array); $x++){
            $email = $the_big_array[$x][3];
            $mail->addAddress($email,$email);
            $mail->Subject = 'Here is the subject';
            $message = $the_big_array[$x][1];
            $mail->Body    = $message;
            $bcc = $_POST['bcc'.$x];
            
            echo $mail->Body;
            echo '<br>';
            echo $email;
            echo '<br>';
            echo $bcc;
            echo '<br>';
            echo '------------------------------';
            echo '<br>';
            
            //$mail->addBCC('bcc@example.com');
            $mail->send();
            $mail->clearAllRecipients();
        }
    }

    if(isset($_POST['single_send'])){
        $penerima = $_POST['penerima'];
        $subjek = $_POST['subjek'];
        $pesan = $_POST['isi_pesan'];
        $bcc = $_POST['bcc'];
        $array = array($bcc);
        $mail->addReplyTo('formpengisiancsf@gmail.com', 'CS Finance');
        $mail->addAddress($penerima,$penerima);
        // Menambahkan cc atau bcc , keduanya tidak boleh dengan alamat email yang sama
        $mail->addCC('datakhusus41@gmail.com');
        $mail->addBCC('datakhusus40@gmail.com');
        //$mail->addCC($penerima);
        //$mail->addReplyTo('formpengisiancsf@gmail.com', 'Information');
        $mail->Subject = $subjek;
        //if message normal
        //$mail->Body    = $pesan;
        //if message html
        $mail->MsgHTML($pesan);
        $mail->IsHTML(true); 
        
        $mail->send();
        try{
            /*echo '<script type="text/javascript">';
            echo 'alert("Pesan berhasil dikirim !")';
            echo '</script>';
            echo "<script>location='./';</script>";*/
        }catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
    }

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}






// Attachments
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

// Content
//$mail->isHTML(true);                                  // Set email format to HTML
//$mail->Subject = 'Here is the subject';
//$mail->Body    = 'This is the HTML message body <b>in bold!</b>';

//$mail->send();
//echo 'Message has been sent';
?>
