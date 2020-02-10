<?php
    session_start();
    //PHP Mailer
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;

    require_once 'user.php';

        // --------------------------------------------
        // ----------------- Validate Form ------------
        $validate = new validateFrom;

        $UserName = $validate->test_input($_POST['UserName']);
        $Password = $validate->test_input($_POST['PassWord']);
        $FullName = $validate->test_input($_POST['FullName']);
        $Title    = $validate->test_input($_POST['Title']);
        $DpId     = isset($_POST['DpId']) ? $validate->test_input($_POST['DpId']) : null;
        $UserType = isset($_POST['UserType']) ? $validate->test_input($_POST['UserType']) : null;
        $Email    = $validate->test_input($_POST['Email']);
        $Phone    = $validate->test_input($_POST['Phone']);
        $Phone1   = $validate->test_input($_POST['Phone1']);

        if($UserName && $Password && $Email){

            //Validate Username
            if (!$validate->is_username($UserName)) {
                $_SESSION['error'] = "Username not correct format";
            } else {

            //Validate Password
                if (!$validate->is_password($Password)) {
                    $_SESSION['error'] = "Password not correct format";
                } else {

            //Validate Email
                    if (!$validate->is_email($Email)) {
                        $_SESSION['error'] = "Email not correct format";
                    } else {

                        // ---------------------------------------------
                        // ----------------- Xử lý với DB --------------
                        $user = new userCtrl($UserName, $Password, $FullName, $Title, $DpId, $Email, $UserType, $Phone, $Phone1);
        
                        $id_insert = $user->signUp($UserName, $Password, $FullName, $Title, $DpId, $Email, $UserType, $Phone, $Phone1);

                        if($id_insert == null) {
                            $_SESSION['error'] = "USER EXIST";
                        }   else {
                            $code = implode("", $user->CodeActive($id_insert));

                            // ---------------------------
                            // bắt đầu gửi email register
                            // ---------------------------
                            
                            try {
                                include_once $_SERVER['DOCUMENT_ROOT'].'/175em/core/configEmail.php';
                                $mail->addAddress($Email);
                                $mail->Subject = '175 hospital Sign Up';

                                $_DOMAIN = 'http://'.$_SERVER['HTTP_HOST'].'/175em/';

                                $link = $_DOMAIN."controller/active.php?id=".$id_insert."&code=".$code;

                                // Đọc nội dung mail template từ file HTML
                                $body = file_get_contents($_DOMAIN.'template/registered.html');
                                // Gắn giá trị động vào biến tĩnh trong file template
                                $body = str_replace('[LINK]', $link, $body);
                                $body = str_replace('[NAME]', $FullName, $body);
                                $body = str_replace('[EMAIL]', $Email, $body);
                                $body = str_replace('[PHONE]', $Phone, $body);
                                // Gán nội dung mail cho php mailer
                                $mail->Body = $body;

                                $mail->send();

                                $_SESSION['error'] = 'Successfully! Please check your email for activation.';

                            } catch (Exception $ex) {
                                $_SESSION['error'] = "Cannot send mail!";
                            }
                        } 

                    } 
                }
            }


             
        }
        else $_SESSION['error'] = "Fill the infor of user and pass and email";

    header('Location: ../signup');

?>