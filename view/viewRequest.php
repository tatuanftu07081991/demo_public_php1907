<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/controller/viewRequest.php';
if(!isset($_SESSION['user'])) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/175em/view/signin.php';
} else {
    if($data_user['UserType'] != 3) {

        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        $limit = 4;

        $list = new RequestCtrl();

        $result = $list->requestList($data_user['Id'], $data_user['UserType'], $current_page,$limit);
        $_SESSION['result_request'] = $result;

        $total_page = ceil($list->requestCount($data_user['Id'], $data_user['UserType']) / $limit); // Tổng trang

        // Nếu số trang hiện tại > tổng trang
        if ($current_page > $total_page && !empty($result)) {
            echo '<script>location.href="'.$_DOMAIN . 'viewRequest&page=' . $total_page.'";</script>';
        // Nếu số trang hiện tại < 1
        } else if ($current_page < 1 && !empty($result)){
            echo '<script>location.href="'.$_DOMAIN . 'viewRequest&page=1";</script>';
        }  

        echo  '<div class="col-md-9 my-4 mx-auto m_request">';

// --------------------------------------------------
// ----- xử lý giao diện tình trạng Request ---------
// --------------------------------------------------

    for ($i=0; $i < count($result) ; $i++) { 
        $showStep = '<script>$(".bs-wizard #'.$result[$i]['RequestStatus'].$i.'").addClass("complete");</script>';

?>
    <div class="request" id="<?php echo $result[$i]['Id'];?>">
        <div class="row status">
                <div class="col-md-12 text-center"><a href="<?php echo $_DOMAIN.'processRequest/'.$i; ?>">Request Code: <?php echo $result[$i]['Id'];?></a></div>
                <div class="col-md-12 text-center">Tình trạng Request: <span><?php echo $result[$i]['RequestStatus'];?></span></div>
        </div>

        <div class="row bs-wizard">
            <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 bs-wizard-step complete" id="Proposed">
                <div class="text-center bs-wizard-stepnum">
                    <span>Proposed</span>
                </div>
                <div class="progress"><div class="progress-bar"></div></div>
                <span class="bs-wizard-dot">1</span>
            </div>

            <div class="col-lg-3 col-md-3 col-xs-3 col-sm-34 bs-wizard-step" id="Checked<?php echo $i;?>">
                <div class="text-center bs-wizard-stepnum">
                    <span class="hidden-xs">Checked</span>
                </div>
                <div class="progress"><div class="progress-bar"></div></div>
                <span class="bs-wizard-dot">2</span>
            </div>

            <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 bs-wizard-step" id="Fixed<?php echo $i;?>">
                <div class="text-center bs-wizard-stepnum">  
                    <span class="hidden-xs">Fixed</span>                 
                </div>
                <div class="progress"><div class="progress-bar"></div></div>
                <span class="bs-wizard-dot">3</span>
            </div>

            <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3 bs-wizard-step" id="Complete<?php echo $i;?>">
                <div class="text-center bs-wizard-stepnum">
                    <span class="hidden-xs">Complete</span>                   
                </div>
                <div class="progress"><div class="progress-bar"></div></div>
                <span class="bs-wizard-dot">4</span>
            </div>
        </div>
    </div>
<?php
    echo $showStep;
    }

    echo '<nav aria-label="Page navigation example">
                    <ul class="pagination">';
            
            if ($current_page > 1 && $total_page > 1){
                echo '<li class="page-item"><a class="page-link" href="' . $_DOMAIN . 'viewRequest&page=' . ($current_page - 1) . '">Prev</a></li>';
            }
            
            if($total_page < 6) {
                $begin = 1;
                $end = $total_page;
            }  else if($current_page < 5) {
                $begin = 1;
                $end = 5;
            }
                else if($current_page > $total_page - 5) {
                $begin = $total_page - 5;
                $end = $total_page;
            } else {
                $begin = $current_page - 2;
                $end = $current_page + 2;
            }
            // In số nút trang
            for ($i = $begin; $i <= $end; $i++){
                // Nếu trùng với trang hiện tại thì active
                if ($i == $current_page){
                    echo '<li class="page-item active">
                            <a class="page-link" href="#">' . $i . ' 
                            <span class="sr-only">(current)</span></a>
                          </li>';
                // Ngược lại
                } else {
                    echo '<li class="page-item"><a class="page-link" href="' . $_DOMAIN . 'viewRequest&page=' . $i . '">' . $i . '</a></li>';
                }
            }
              
            // Nếu trang hiện tại < tổng số trang > 1 thì hiển thị nút next
            if ($current_page < $total_page && $total_page > 1){
                echo '<li class="page-item"><a class="page-link" href="' . $_DOMAIN . 'viewRequest&page=' . ($current_page + 1) . '">Next</a></li>';
            }
            echo '</ul>
                </nav>';
         
            echo '
                </div>
            ';
?>

</div>
<?php
}
}