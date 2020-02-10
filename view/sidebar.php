
<div class="col-md-3 sidebar mt-4">


<!-- --------------------- -->
<!--         Slide bar     -->
<!-- --------------------- -->
    <ul class="list-group slide-bar">
        <li class="list-group-item">
            <div class="media">
                <a class="pull-left">
                    <img class="media-object" src="
                    <?php
                    // URL ảnh đại diện tài khoản                        
                    echo $_DOMAIN.'images/profile.png';
                    ?>
                    " alt="Ảnh đại diện" width="64" height="64">
                </a>
                <?php
                if($data_user['UserType'] != 3){
                    echo '<div class="media-body ml-3">
                            <h4 class="media-heading">'.$data_user['FullName'].'</h4>
                            <span class="label label-primary">'.$data_user['Title'].'</span>
                        </div>';
                } else {
                    echo '<div class="media-body ml-3">
                            <span class="label label-primary">'.$data_user['Title'].'</span>
                        </div>';
                }
                ?>
            </div>
        </li>
        <a class="list-group-item active" href="<?php echo $_DOMAIN; ?>">
            <i class="fas fa-home"></i> Trang chủ
        </a>
        <a class="list-group-item" href="<?php echo $_DOMAIN; ?>profile">
            <i class="fas fa-user"></i> Hồ sơ cá nhân
        </a>
        <a class="list-group-item" href="<?php echo $_DOMAIN; ?>changePW">
            <i class="fas fa-sync-alt"></i> Đổi mật khẩu
        </a>

        <?php
 
        // Phân quyền sidebar
        // Nếu tài khoản là A Hưng
        if($data_user['UserName'] == 'hungdn')
            echo
            '
                <a class="list-group-item" href="' . $_DOMAIN . 'signup">
                    <i class="fas fa-tools"></i> Tạo User mới
                </a> 
                <a class="list-group-item" href="' . $_DOMAIN . 'accounts">
                    <i class="far fa-user-circle"></i> Tài Khoản
                </a>
                <a class="list-group-item" href="' . $_DOMAIN . 'departmentList">
                    <i class="fas fa-list"></i> Danh sách phòng ban
                </a>  
                <a class="list-group-item" href="' . $_DOMAIN . 'equipment">
                    <i class="fas fa-list"></i> Trang thiết bị
                </a> 
            ';
        ?>
        <a class="list-group-item" href="<?php echo $_DOMAIN; ?>signout.php">
            <i class="fas fa-power-off"></i> Thoát
        </a>
    </ul>
    <!-- ul.list-group -->

    <!-- --------------------- -->
    <!--                       -->
    <!-- --------------------- -->

    <div id="webique_760d6b998c" class="webique_featured_links">
        <ul>
        <?php
        if($data_user['UserType'] == 2){
        ?>
            <li>
                <a href="<?php echo $_DOMAIN; ?>makeRequest">
                    <div id="webique_760d6b998c_1" class="webique_featured_link">
                        <figure class="webique_featured_link_icon">
                            <img class="" src="<?php echo $_DOMAIN?>images/icon_4.png" width="38" height="37" alt="icon_4" title="icon_4">
                        </figure>
                        <span class="webique_featured_link_title">Make a request</span>
                    </div>
                </a>
            </li>
        <?php } ?>
            <li>
                <a href="<?php echo $_DOMAIN; ?>viewRequest" title="">
                    <div id="webique_760d6b998c_2" class="webique_featured_link">
                        <figure class="webique_featured_link_icon">
                            <img class="" src="<?php echo $_DOMAIN?>images/icon_5.png" width="38" height="37" alt="icon_5" title="icon_5">
                        </figure>
                        <span class="webique_featured_link_title">View request</span>
                        <span class="badge badge-pill badge-primary"></span>
                    </div>
                </a>
            </li>
        </ul>
    </div>

</div><!-- div.sidebar -->