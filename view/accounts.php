<?php
require_once 'controller/user.php';

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
//var_dump($current_page);

$limit = 10;

$list = new UserCtrl($current_page,$limit);

$listUser = $list->userList($current_page,$limit);

$total_page = ceil($list->userCount() / $limit); // Tổng trang

// Nếu số trang hiện tại > tổng trang
if ($current_page > $total_page) {
    echo '<script>location.href="'.$_DOMAIN . 'accounts&page=' . $total_page.'";</script>';
// Nếu số trang hiện tại < 1
} else if ($current_page < 1){
    echo '<script>location.href="'.$_DOMAIN . 'accounts&page=1";</script>';
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
                <a href="' . $_DOMAIN . 'accounts" class="btn btn-secondary">
                    <i class="fas fa-redo-alt"></i> Reload
                </a>
                <a class="btn btn-warning" id="lock_acc_list">
                    <i class="fas fa-lock"></i> khoá
                </a>
                <a class="btn btn-success" id="unlock_acc_list">
                    <i class="fas fa-unlock-alt"></i> Mở khoá
                </a> 
            ';
        // bảng các user
        echo
            '
                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped list" id="list_acc">
                        <tr>
                            <td><input type="checkbox"></td>
                            <td><strong>ID</strong></td>
                            <td><strong>Tên đăng nhập</strong></td>
                            <td><strong>Họ tên</strong></td>
                            <td><strong>Trạng thái</strong></td>
                            <td><strong>Tools</strong></td>
                        </tr>
            ';
        // In danh sách tài khoản
        if(!empty($listUser)){
            foreach ($listUser as $key => $data_acc)
            {
                // Trạng thái tài khoản
                if ($data_acc['AvailableId'] == 1) {
                    $stt_acc = '<span class="badge badge-success">Hoạt động</span>';
                } else if ($data_acc['AvailableId'] == 0) {
                    $stt_acc = '<span class="badge badge-warning">Khoá</span>';
                }
         
                echo
                '
                    <tr>
                        <td><input type="checkbox" name="id_acc[]" value="' . $data_acc['Id'] .'"></td>
                        <td>' . $data_acc['Id'] .'</td>
                        <td>' . $data_acc['UserName'] . '</td>
                        <td>' . $data_acc['FullName'] . '</td>
                        <td>' . $stt_acc . '</td>
                        <td>
                            <a data-id="' . $data_acc['Id'] . '" class="btn btn-sm btn-warning lock-acc-list">
                                <i class="fas fa-lock"></i>
                            </a>
                            <a data-id="' . $data_acc['Id'] . '" class="btn btn-sm btn-success unlock-acc-list">
                                <i class="fas fa-unlock-alt"></i>
                            </a>
                            
                        </td>
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
                echo '<li class="page-item"><a class="page-link" href="' . $_DOMAIN . 'accounts&page=' . ($current_page - 1) . '">Prev</a></li>';
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
                    echo '<li class="page-item"><a class="page-link" href="' . $_DOMAIN . 'accounts&page=' . $i . '">' . $i . '</a></li>';
                    //echo '<a class="btn btn-secondary" href="' . $_DOMAIN . 'accounts&page=' . $i . '">' . $i . '</a>';
                }
            }
              
            // Nếu trang hiện tại < tổng số trang > 1 thì hiển thị nút next
            if ($current_page < $total_page && $total_page > 1){
                echo '<li class="page-item"><a class="page-link" href="' . $_DOMAIN . 'accounts&page=' . ($current_page + 1) . '">Next</a></li>';
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