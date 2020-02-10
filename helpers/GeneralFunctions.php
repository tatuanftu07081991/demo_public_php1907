<?php

    require_once $_SERVER["DOCUMENT_ROOT"].'/175em/model/generalData.php';

    //Hàm thêm Edit | Delete cuối mỗi dòng
    function ActionLinks(){
        $links = "<td>";
        $links .= "<a class='edit btn btn-sm btn-success' href='javascript:void(0)'><i class='fas fa-pen'></i></a>";
        $links .= " <a class='delete btn btn-sm btn-danger' href='javascript:void(0)'><i class='fas fa-trash'></i></a>";
        $links .= "</td>";
        return $links;
    }

    
//---------------------------------------------------------------------------------------------------------------
    /*Hàm tạo header của bảng
    $header: array chứa các chuỗi là tên các cột trong Database cần lấy lên bảng
    */
    function HeaderRendering($header){   
        $returnedheader = '<tr><thead>';
        foreach($header as $title){
            $returnedheader .= '<th>'.$title.'</th>';
        }   
        $returnedheader .= '<th></th>';
        $returnedheader .= '</thead></tr>';
        return $returnedheader;
    }

    
//---------------------------------------------------------------------------------------------------------------
    /*Hàm render bảng: 
    $header: array chứa các chuỗi là tên các cột trong Database cần lấy lên bảng
    $contents: kết quả của lệnh truy vấn cần show
    $conversion1: tên hàm cần gọi trong model/GeneralData.php để chuyển đổi nội dung của 1 cột
    $col1: số thứ tự cột cần chuyển đổi, bắt đầu từ 0
    */
    function TableRendering($header, $contents, $conversion1 = null, $col1 = null, $conversion2 = null, $col2 =null){
        $table = '<table class="table table-striped">';
        $table .= HeaderRendering($header);
        foreach($contents as $row){
            $table .= '<tr>';
            foreach($row as $key => $value){    
                if($key == $col1){
                    $table .= '<td>'.$conversion1->GetName($value).'</td>';
                }else{
                    $table .= '<td>'.$value.'</td>';
                }
            }    
            $table .= ActionLinks();    
            $table .= '</tr>';     
        }     
        $table .= '</table>';
    return $table;
    }   

//---------------------------------------------------------------------------------------------------------------
    /*Hàm render Dropdown list
    */
    function DropdownRendering(){

        
    }


?>