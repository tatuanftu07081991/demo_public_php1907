<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/controller/equipment.php';

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
//var_dump($current_page);

$limit = 10;

$list = new EqCtrl($current_page,$limit);

$listEq = $list->EqList($current_page,$limit);

$total_page = ceil($list->EqCount() / $limit); // Tổng trang

// Nếu số trang hiện tại > tổng trang
if ($current_page > $total_page) {
    echo '<script>location.href="'.$_DOMAIN . 'equipment&page=' . $total_page.'";</script>';
// Nếu số trang hiện tại < 1
} else if ($current_page < 1){
    echo '<script>location.href="'.$_DOMAIN . 'equipment&page=1";</script>';
}   

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

            // Nút phân trang
            //echo '<div class="btn-group" id="paging_post">';
            echo '<nav aria-label="Page navigation example">
                    <ul class="pagination">';
            // Nếu trang hiện tại > 1 và tổng trang > 1 thì hiển thị nút prev
            if ($current_page > 1 && $total_page > 1){
                echo '<li class="page-item"><a class="page-link" href="' . $_DOMAIN . 'equipment&page=' . ($current_page - 1) . '">Prev</a></li>';
                //echo '<a class="btn btn-secondary" href="' . $_DOMAIN . 'accounts&page=' . ($current_page - 1) . '"> Prev</a>';
            }
            
            if($current_page < 6) {
                $begin = 1;
                $end = 9;
            } else if($current_page > $total_page - 8) {
                $begin = $total_page - 8;
                $end = $total_page;
            } else {
                $begin = $current_page - 4;
                $end = $current_page + 4;
            }
            // In số nút trang
            for ($i = $begin; $i <= $end; $i++){
                // Nếu trùng với trang hiện tại thì active
                if ($i == $current_page){
                    echo '<li class="page-item active">
                            <a class="page-link" href="#">' . $i . ' 
                            <span class="sr-only">(current)</span></a>
                          </li>';
                    //echo '<a class="btn btn-success" style="height:30px">' . $i . '</a>';
                // Ngược lại
                } else {
                    echo '<li class="page-item"><a class="page-link" href="' . $_DOMAIN . 'equipment&page=' . $i . '">' . $i . '</a></li>';
                    //echo '<a class="btn btn-secondary" href="' . $_DOMAIN . 'accounts&page=' . $i . '">' . $i . '</a>';
                }
            }
              
            // Nếu trang hiện tại < tổng số trang > 1 thì hiển thị nút next
            if ($current_page < $total_page && $total_page > 1){
                echo '<li class="page-item"><a class="page-link" href="' . $_DOMAIN . 'equipment&page=' . ($current_page + 1) . '">Next</a></li>';
                // echo '<a class="btn btn-secondary" href="' . $_DOMAIN . 'accounts&page=' . ($current_page + 1) . '">Next <span class="glyphicon glyphicon-chevron-right"></span></a>';
            }
            echo '</ul>
                </nav>';
         
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