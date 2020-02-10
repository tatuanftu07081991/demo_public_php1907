<?php
 
// Kết nối database và thông tin chung
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/core/session.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/model/makeRequest.php';

// Nếu đăng nhập
if (isset($_SESSION['user']))
{
    $machineName = isset($_POST['MachineName']) ? $_POST['MachineName'] : '';
    $dpment      = isset($_POST['Department']) ? $_POST['Department'] : '';
    $machineCode = isset($_POST['MachineCode']) ? $_POST['MachineCode'] : '';
    $category    = isset($_POST['Category']) ? $_POST['Category'] : '';
    $rqProduct   = isset($_POST['Detail']) ? $_POST['Detail'] : '';
    $malTime     = isset($_POST['MalfunctionTime']) ? $_POST['MalfunctionTime'] : '';
    $crTime      = $date_current;
    $dcrtion     = isset($_POST['Discription']) ? $_POST['Discription'] : '';
    $status      = isset($_POST['Status']) ? $_POST['Status'] : '';
    $prPerson    = $data_user['Id'];
    $rqStatus    = 'Proposed';

    $Dpment = new profileCtrl($dpment);
    $dpmentName = $Dpment->departmentName($dpment);

    $request = new Request;
    $id_isr = $request->insertRequest($dpment, $machineCode, $rqProduct, $malTime, $crTime, $dcrtion, $status, $prPerson, $rqStatus);
    $email = $request->insertProcess_step1($id_isr,$category);

    if(isset($id_isr)) {

        // gui email cho ng sua chua
        try {
            include_once $_SERVER['DOCUMENT_ROOT'].'/175em/core/configEmail.php';
            $mail->addAddress($email);
            
            $mail->Subject = 'Machine repair request';

            // Đọc nội dung mail template từ file HTML
            $body = file_get_contents($_DOMAIN.'template/request.html');
            // Gắn giá trị động vào biến tĩnh trong file template
            $body = str_replace('[NAME]', $machineName, $body);
            $body = str_replace('[DEPARTMENT]', $dpmentName, $body);
            $body = str_replace('[MalfunctionTime]', $malTime, $body);
            $body = str_replace('[STATUS]', $status, $body);
            $body = str_replace('[DISCRIPTION]', $dcrtion, $body);
            // Gán nội dung mail cho php mailer
            $mail->Body = $body;

            $mail->send();

            $_SESSION['error'] = 'Make request success! Sent email to the person in charge.';

        } catch (Exception $ex) {
            $_SESSION['error'] = "Cannot send mail!";
        }
    }
    else $_SESSION['error'] = "Error";

    header('Location: ../makeRequest');
}
// Ngược lại chưa đăng nhập
else
{
    header('Location: '.$_DOMAIN);
}
  
?>