<?php
    
    //file ajax trả về kết quả tìm kiếm danh sách phòng banrequire_once '../helpers/GeneralFunctions.php';
    require_once 'department.php';

    $departmentType = isset($_POST['departType']) ? $_POST['departType'] : 0;
    $keyword = isset($_POST['kw']) ? $_POST['kw'] : "";
    $parent = isset($_POST['prnt']) ? $_POST['prnt'] : 0;
    // $page=null;
    // $limit=null;

    echo getDepartment($keyword,$departmentType,$parent);
    
?>