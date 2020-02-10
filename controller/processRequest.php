<?php
 
// Kết nối database và thông tin chung
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/core/session.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/model/processRequest.php';

// Nếu đăng nhập
if (isset($_SESSION['user']))
{
    $timeReceive = isset($_POST['TimeReceive']) ? $_POST['TimeReceive'] : '';
    $priority    = isset($_POST['Priority']) ? $_POST['Priority'] : '';
    $idRequest   = isset($_POST['IdRequest']) ? $_POST['IdRequest'] : '';
    $checkTime   = isset($_POST['CheckTime']) ? $_POST['CheckTime'] : '';
    $checkingStatus   = isset($_POST['CheckingStatus']) ? $_POST['CheckingStatus'] : '';
    $Causal      = isset($_POST['Causal']) ? $_POST['Causal'] : '';
    $damageLevel = isset($_POST['DamageLevel']) ? $_POST['DamageLevel'] : '';
    $resolveType = isset($_POST['Solution']) ? $_POST['Solution'] : '';
    $conclusion  = isset($_POST['Conclusion']) ? $_POST['Conclusion'] : '';

    //tao mảng rỗng tối đa 2 phần tử lưu đường dẫn ảnh
    $url_img = ["",""];
    // Xử lý upload image
    if (isset($_FILES['img_up'])) 
    {   
        foreach($_FILES['img_up']['name'] as $name => $value)
        {
            $dir = "../images/machineError/"; 
            $name_img = stripslashes($_FILES['img_up']['name'][$name]);
            $source_img = $_FILES['img_up']['tmp_name'][$name];
 
            // Lấy ngày, tháng, năm hiện tại
            $day_current = substr($date_current, 8, 2);
            $month_current = substr($date_current, 5, 2);
            $year_current = substr($date_current, 0, 4);
 
            // Tạo folder năm hiện tại
            if (!is_dir($dir.$year_current))
            {
                mkdir($dir.$year_current.'/');
            } 
 
            // Tạo folder tháng hiện tại
            if (!is_dir($dir.$year_current.'/'.$month_current))
            {
                mkdir($dir.$year_current.'/'.$month_current.'/');
            }   
 
            // Tạo folder ngày hiện tại
            if (!is_dir($dir.$year_current.'/'.$month_current.'/'.$day_current))
            {
                mkdir($dir.$year_current.'/'.$month_current.'/'.$day_current.'/');
            }
 
            $path_img = $dir.$year_current.'/'.$month_current.'/'.$day_current.'/'.$name_img; 

            // Upload file
            move_uploaded_file($source_img, $path_img); 
            // Đường dẫn file
            $url_img[$name] = substr($path_img, 3); 
        }
        echo 'Upload thành công';
    } 
    $process = new Process;
    $process->update_process($timeReceive, $priority, $checkTime, $checkingStatus, $Causal, $url_img[0], $url_img[1], $damageLevel, $resolveType, $conclusion, $idRequest);
    $process->update_request($idRequest, 'Checked');
}

else
{
    header('Location: '.$_DOMAIN);
}
  
?>