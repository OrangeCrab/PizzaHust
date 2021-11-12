<?php
    require '../homepage/Exception.php';
    require '../homepage/PHPMailer.php';
    require '../homepage/SMTP.php';

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    if(!empty($_POST)){
        $gmail = getPost('username');
        $sql = "select gmail from user_account where gmail = '$gmail'";
        $check = executeResult($sql);
        if(!empty($check)){
            $mail_check = $check[0]['gmail'];
       
            

            // kiem tra va gui mk
            $sql = "select password from user_account where gmail = '$gmail'";
            $password = array(executeResult($sql));
            $pass = $password[0][0]['password'];
            

            // gui mk
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = "true";
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";
            $mail->Username = "minhcachtien123@gmail.com";
            $mail->Password = "minhtien25062019";
            $mail->Subject = "your password of PizzaHust account";
            $mail->setFrom("minhcachtien123@gmail.com");
            $mail->Body = "Mật khẩu : $pass";
            $mail->addAddress($gmail);
            if(!$mail->send()){
                echo '
                    <script>
                        alert("retry");
                    </script>
                ';
            }
            else{
                header("location: homepageDraft.php");
                die();
            }
            $mail->smtpClose();                      
            
            
           
        }
        else{
            echo '
               <script>
                   alert("gmail did not exist !");
              </script>
            ';
        }
    }
?>