<?php

    require_once '../../model/department/department.php';

    //file ajax thêm phòng ban
    $departmentName = $_POST['departname'];
    $departmentCode = $_POST['departcode'];
    $departmentType = $_POST['departtype'];
    $departmentParent = $_POST['departparent'];

    $department = new DepartmentModel($departmentName,$departmentCode,$departmentType,$departmentParent);  
    if($department->checkExist()){      //EXIST
        echo("Phòng ban đã tồn tại");
    }else{                              //NOT EXIST
        if($department->insertDepartment()){
            echo("Thêm thành công");
        }else{
            echo("Thêm không thành công");
        }
    }

?>