<?php

    require_once $_SERVER["DOCUMENT_ROOT"].'/175em/model/department/department.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/175em/model/generalData.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/175em/helpers/GeneralFunctions.php';

 
 //--------------------------------------------------------------------------------------------
    //  Lấy danh sách phòng ban dưới dạng bảng

    // function getDepartment($nameOrCode,$type,$parent,$page,$limit){
        
    //     //Khởi tạo với name và code
    //     $department = new DepartmentModel($nameOrCode,$nameOrCode,$type,$parent);  
    //     $result = $department->getDepartmentList($page,$limit);
    //     $header = array('ID','Tên Khoa','Ký hiệu','Khối');
    //     $depType = new DepartmentType;
    //     return TableRendering($header, $result, $depType, 'Type');
    // }

    function getDepartment($nameOrCode,$type,$parent){
        
        //Khởi tạo với name và code
        $department = new DepartmentModel($nameOrCode,$nameOrCode,$type,$parent);  
        $result = $department->getDepartmentList();
        $header = array('ID','Tên Khoa','Ký hiệu','Khối');
        $depType = new DepartmentType;
        return TableRendering($header, $result, $depType, 'Type');
    }


    // function countDepartment($nameOrCode,$type,$parent){
        
    //     //Khởi tạo với name và code
    //     $department = new DepartmentModel($nameOrCode,$nameOrCode,$type,$parent);  
    //     $result = $department->getDepartmentCount();
    //     return $result;
    // }


//-----------------------------------------------------------------------------------------------
    //Tạo list từ danh sách phòng ban
    function makeDepList($name){
        $department = new DepartmentModel("","",0,0);  
        $result = $department->getDepartmentList(true);
        $selectList = '<select id="'.$name.'" class="form-control ">';
        $selectList .= '<option value="0">Bệnh viện</option>';
        foreach($result as $row){
            $selectList .= '<option value="';
            foreach($row as $key => $value){  
                switch($key){
                    case 'ID':
                        $selectList .= $value.'">';
                    break;
                    case 'Name':
                        $selectList .= $value;
                    break;
                }
            }  
            $selectList .= '</option>';  
        }
        $selectList .= '</select>';  
        return $selectList;
    }

//--------------------------------------------------------------------------------------------------
    function checkDepExist($name = null, $code = null, $type = null, $parent = null, $id =null){
        //Khởi tạo với name và code
        $department = new DepartmentModel($name,$code,$type,$parent,$id);
        return $department->checkExist();
    }

    
//--------------------------------------------------------------------------------------------------    
    function deleteDep($name = null, $code = null, $type = null, $parent = null, $id =null){
        //Khởi tạo với name và code
        $department = new DepartmentModel($name,$code,$type,$parent,$id);
        return $department->deleteDepartment();
    }

    
?>