<?php
/**
 * 
 */
function pagination($tableName, $current_page, $limit){

	 $_DOMAIN = 'http://'.$_SERVER['HTTP_HOST'].'/175em/';
	require_once $_SERVER['DOCUMENT_ROOT'].'/175em/controller/pagination.php';

	$list = new PaginationCtrl($tableName, $current_page,$limit);

	$listEq = $list->List($tableName, $current_page,$limit);

	$total_page = ceil($list->Count() / $limit); // Tổng trang

	if ($current_page > $total_page) {
    	echo '<script>location.href="'.$_DOMAIN . $tableName.'&page=' . $total_page.'";</script>';
	// Nếu số trang hiện tại < 1
	} else if ($current_page < 1){
	    echo '<script>location.href="'.$_DOMAIN . $tableName. '&page=1";</script>';
	}

	$result[0] = $listEq;
	$result[1] = $total_page;

	return $result;
}

function showPagi($tableName, $current_page, $total_page) {

	$_DOMAIN = 'http://'.$_SERVER['HTTP_HOST'].'/175em/';
	echo '<nav aria-label="Page navigation example">
                    <ul class="pagination">';
            // Nếu trang hiện tại > 1 và tổng trang > 1 thì hiển thị nút prev
        if ($current_page > 1 && $total_page > 1){
            echo '<li class="page-item"><a class="page-link" href="' . $_DOMAIN . $tableName. '&page=' . ($current_page - 1) . '">Prev</a></li>';
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
                echo '<li class="page-item"><a class="page-link" href="' . $_DOMAIN . $tableName.  '&page=' . $i . '">' . $i . '</a></li>';
                //echo '<a class="btn btn-secondary" href="' . $_DOMAIN . 'accounts&page=' . $i . '">' . $i . '</a>';
            }
        }
          
        // Nếu trang hiện tại < tổng số trang > 1 thì hiển thị nút next
        if ($current_page < $total_page && $total_page > 1){
            echo '<li class="page-item"><a class="page-link" href="' . $_DOMAIN . $tableName.  '&page=' . ($current_page + 1) . '">Next</a></li>';
            // echo '<a class="btn btn-secondary" href="' . $_DOMAIN . 'accounts&page=' . ($current_page + 1) . '">Next <span class="glyphicon glyphicon-chevron-right"></span></a>';
        }
        echo '</ul>
            </nav>';
     
        echo '
            </div>
        ';
    
}   