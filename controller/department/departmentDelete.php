<?php
    
    //file ajax trả về kết quả tìm kiếm danh sách phòng banrequire_once '../helpers/GeneralFunctions.php';
    require_once 'department.php';



    $departmentId = isset($_POST['departId']) ? $_POST['departId'] : 0;
    
    //Kiểm tra xem có nhân viên hoặc thiết bị nào thuộc khoa Phòng này không
    
    
    echo deleteDep(null,null,null,null,$departmentId);
    
    //checkDepExist("","",0,0,$departmentId);

    //Xóa thiết bị nếu có thể
    
    //echo getDepartment($keyword,$departmentType,$parent);
    
?>