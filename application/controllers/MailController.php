<?php
namespace application\controllers;
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends \MY_Controller{
    
    public function index(){
        
        $this->load->database();
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'jems.0830@gmail.com';                 // SMTP username
            $mail->Password = 'teac1983';                           // SMTP password
            $mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            
            //Recipients
            $mail->setFrom('jems.0830@gmail.com', 'Mailer');
            $mail->addAddress('ijose@aol.es', 'Joe User');     // Add a recipient
            $mail->addAddress('jems_0830@yahoo.es');               // Name is optional
            $mail->addReplyTo('jems.0830@gmail.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Ofertas Origen Organico';
            $mail->Body    = 'Cuerpo del mail tipo 1  <b>Con tags html se puede formatear el texto</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
            $mail->send();
            echo 'El mail se ha enviado con exito';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        
    }
    
    public function send_mail_type_2(){
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'jems.0830@gmail.com';                 // SMTP username
            $mail->Password = 'teac1983';                           // SMTP password
            $mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            
            //Recipients
            $mail->setFrom('jems.0830@gmail.com', 'Mailer');
            $mail->addAddress('ijose@aol.es', 'Joe User');     // Add a recipient
            $mail->addAddress('jems_0830@yahoo.es');               // Name is optional
            $mail->addReplyTo('jems.0830@gmail.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Ofertas Origen Organico';
            $mail->Body    = 'Cuerpo del mail tipo 2  <b>Con tags html se puede formatear el texto</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
            $mail->send();
            echo 'El mail se ha enviado con exito';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        
    }
    
}

