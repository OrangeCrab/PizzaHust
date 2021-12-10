<?php

      require '../homepage/Exception.php';
      require '../homepage/PHPMailer.php';
      require '../homepage/SMTP.php';

      use PHPMailer\PHPMailer\Exception;
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\SMTP;
      // the message
      $mail = new PHPMailer();

      $mail->isSMTP();
      $mail->Host = "smtp.gmail.com";
      $mail->SMTPAuth = "true";
      $mail->SMTPSecure = "ssl";
      $mail->Port = "465";
      $mail->Username = "cuonglemanh352001@gmail.com";
      $mail->Password = "lenhi0936247421";
      $mail->Subject = "your password of PizzaHust account";
      $mail->setFrom("cuonglemanh352001@gmail.com");
      $mail->Body = "Mật khẩu : $123";
      $mail->addAddress("minhcachtien123@gmail.com");
      if(!$mail->send()){
         echo '
             <script>
                  alert("Please, turn off security of your gmail to accept our mail !");
               </script>
           ';
        };


      $mail->smtpClose();      

?>