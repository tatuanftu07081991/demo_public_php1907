<?php 
$_DOMAIN = 'http://'.$_SERVER['HTTP_HOST'].'/175em/';
require_once $_SERVER["DOCUMENT_ROOT"].'/175em/includes/header.php' ;
?>
<body>
    <?php 
        require_once $_SERVER["DOCUMENT_ROOT"].'/175em/model/generalData.php';
        require_once $_SERVER["DOCUMENT_ROOT"].'/175em/controller/department/department.php';
    ?>

    <div class="container mt-4">
        <div class="row">
            <h4 class="text-primary align-middle" >Tìm kiếm theo:</h4>
        </div>
        <div class="row">
            <form class="form form-inline">
                <div class="form-group m-2">
                    <label class="mr-2">Khối</label>
                    <?php
                        $depType = new DepartmentType; 
                        echo $depType->getAsList('slDepartmentType');
                    ?>
                    <small class="text-muted"></small>
                </div>
                <div class="form-group m-2">
                    <label class="mr-2">Khoa</label>
                    <input type="text" id="txtSearch" class="form-control" autocomplete="off" placeholder="Tên hoặc ký hiệu Khoa...">
                </div>
                <div class="form-group m-2">
                    <label class="mr-2">Đơn vị cấp trên</label>
                    <?php
                        // $depParent = new DepartmentType; //Chú ý chỗ này
                        echo makeDepList('slDepartmentParent');
                        // echo $depParent->('slDepartmentParent');
                    ?>
                    <small class="text-muted"></small>
                </div>               
                <div class="form-group m-2">
                    <button type="button" class="btn btn-primary btnSearch">Search</button>
                </div>
            </form>
        </div>
        <div class="row">
            <h3 class="text-primary align-middle" >Danh sách Khoa - Phòng - Ban - Trung tâm - Viện</h3>
        </div>

        <!-- Hiện/ẩn mục AddNew -->
        <div class="row mt-3" id="dvAddNew" style="display:none">
            <form class="form form-inline">
                <div class="form-group mr-2">
                    <input type="text" id="txtNewDepartmentName" class="form-control" placeholder="Nhập tên Khoa mới...">
                </div>
                <div class="form-group mr-2">
                    <input type="text" id="txtNewDepartmentCode" class="form-control" placeholder="Nhập mã Khoa mới...">   
                </div>
                <div class="form-group mr-2">
                    <?php 
                        $depType = new DepartmentType; 
                        echo $depType->getAsList('slDepartmentTypeNew'); 
                    ?>
                </div>
                <div class="form-group mr-2">
                    <button type="button" class="btn btn-primary btnSave">Save</button>&nbsp;
                    <button type="button" class="btn btn-secondary btnClear">Hide</button>
                </div>
            </form>
        </div>

        <!--Click chỗ này để ẩn hiện mục AddNew  -->
        <div class="row mt-3">
            <a href="javascript:void(0)" class="addNew">Thêm Khoa mới</a>
        </div>

        <!-- Hiện bảng Danh sách Phòng ban -->
        <div id="divDepartment" class="row mt-3">
            <?php
                echo getDepartment("",0,0);
            ?>
        </div>
    </div>
    <link rel="stylesheet" href="../../css/department.css">
    <script src="../../scripts/department.js"></script>
</body>
</html>