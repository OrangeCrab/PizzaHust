<?php
    require '../forget/Exception.php';
    require '../forget/PHPMailer.php';
    require '../forget/SMTP.php';

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    session_start();

    
           $email = getPost('email');
           $sql_email = "select email from user_account where email = '$email'";
           $check_email = executeResult($sql_email);
           if(!empty($check_email)){
              // check password
              $sql_pass = "select password from user_account where email = '$email'";
              $password = array(executeResult($sql_pass));
              $pass = $password[0][0]['password'];
            

               // gui mk
               $mail = new PHPMailer();

               $mail->isSMTP();
               $mail->Host = "smtp.gmail.com";
               $mail->SMTPAuth = "true";
               $mail->SMTPSecure = "ssl";
               $mail->Port = "465";
               $mail->Username = "pizzahust123@gmail.com";
               $mail->Password = "cnpmnhom6";
               $mail->Subject = "your password of PizzaHust account";
               $mail->setFrom("pizzahust123@gmail.com");
               $mail->Body = "Mật khẩu : $pass";
               $mail->addAddress($email);
               if(!$mail->send()){
                  echo '
                      <script>
                           window.alert("Please, turn off security of your gmail to accept our mail !");
                        </script>
                    ';
                }
                else{
                    $_SESSION['password-changed'] = $email;
                    $_SESSION['count_for_changepassword'] = 0;
                   header("location: ../login/login_user.php");
                }
                $mail->smtpClose();                        
            }
            else{
               echo '
                   <script>
                        window.alert("Email không đúng !");
                   </script>
                ';
            }

     
        
    }
?>
