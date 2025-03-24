<?php

use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    if(isset($_POST['send'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $msg = $_POST['message'];
        // $mobile = $_POST['mobile'];
        $subject = $_POST['subject'];
    
        //Load Composer's autoloader
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';
    
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
    
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'Your email';                 //SMTP username
            $mail->Password   = 'Your email app password';                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to
    
            //Recipients
            $mail->setFrom('Your Email', 'Profile Form');        //Your email and name
            $mail->addAddress('Recipients email', 'Recipients name'); //Recipient's email and name
            $mail->addReplyTo($email, $name);                          //User's email and name
    
            //Content
            $mail->isHTML(true);                                        //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = "Sender Name - $name <br> Sender Email - $email  <br> Subject - $subject <br> Message - $msg";
    
            $mail->send();
            echo 'Message has been sent';
            echo "<script>window.location.href = 'index.html'</script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    ?>
