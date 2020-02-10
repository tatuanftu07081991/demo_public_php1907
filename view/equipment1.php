<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/core/pagination.php';

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
//var_dump($current_page);

$limit = 10;

$result = pagination('equipment',$current_page,$limit);

$listEq = $result[0];

$total_page = $result[1];
  

if(!isset($_SESSION['user'])) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/175em/view/signin.php';
} 
else {
    echo '<div class="col-md-9 my-4">';
    if(isset($data_user['UserName']) && $data_user['UserName'] == 'hungdn') {
        // thanh công cụ
        echo
            '
                <a href="' . $_DOMAIN . 'equipment" class="btn btn-warning">
                    <i class="fas fa-redo-alt"></i> Reload
                </a>
            ';
        // bảng các Equipment
        echo
            '
                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped list" id="list_eq">
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><strong>ID</strong></td>
                            <td><strong>Tên máy</strong></td>
                            <td><strong>SN</strong></td>
                            <td><strong>Model</strong></td>
                            <td><strong>Tình trạng</strong></td>
                        </tr>
            ';
        // In danh sách tài khoản
        if(!empty($listEq)){
            foreach ($listEq as $key => $data_acc)
            {
         
                echo
                '
                    <tr>
                        <td><input type="checkbox" name="id_eq[]" value="' . $data_acc['ID'] .'"></td>
                        <td>' . $data_acc['ID'] .'</td>
                        <td>' . $data_acc['Name'] . '</td>
                        <td>' . $data_acc['SN'] . '</td>
                        <td>' . $data_acc['Model'] . '</td>
                        <td><span class="badge badge-success">Hoạt động</span></td>
                    </tr>
                ';
            }
         
            echo
            '
                    </table>
                </div>
            ';

            showPagi('equipment',$current_page,$total_page);
            
         
            echo '
                </div>
            ';
        } else {
            echo '<br><br><div class="alert alert-info">Chưa có tài khoản nào.</div>';
        }

    }
    else {
        echo '<div class="alert alert-danger">Bạn không có quyền truy cập.</div>';
    }
}

echo '</div>';