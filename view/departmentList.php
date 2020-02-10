<?php 
    require_once $_SERVER["DOCUMENT_ROOT"].'/175em/model/generalData.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/175em/controller/department/department.php';
    if(!isset($_SESSION['user'])) {
        require_once $_SERVER["DOCUMENT_ROOT"].'/175em/view/signin.php';
    } else {
?>

<div class="col-md-9 my-4 mx-auto">
    <div class="text-center mb-3">
        <h3>Danh sách Khoa - Phòng - Ban - Trung tâm - Viện</h3>
    </div>

    <form>
        <div class="form-row">
            <div class="col-3">
                <label>Khối:</label>
                <?php
                    $depType = new DepartmentType; 
                    echo $depType->getAsList('slDepartmentType');
                ?>
                <small class="text-muted"></small>
            </div>
            <div class="col-3">
                <label>Khoa:</label>
                <input type="text" id="txtSearch" class="form-control" autocomplete="off" placeholder="Tên hoặc ký hiệu Khoa...">
            </div>
            <div class="col-6">
                <label>Đơn vị cấp trên:</label>
                <?php
                    // $depParent = new DepartmentType; //Chú ý chỗ này
                    echo makeDepList('slDepartmentParent');
                    // echo $depParent->('slDepartmentParent');
                ?>
                <small class="text-muted"></small>
            </div> 
        </div>              
        
    </form>
    

    <!-- Hiện/ẩn mục AddNew -->
    <div class="mt-3" id="dvAddNew" style="display:none">
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
                <button type="button" class="btn btn-success btnSave">Save</button>&nbsp;
                <button type="button" class="btn btn-secondary btnClear">Hide</button>
            </div>
        </form>
    </div>

    <!--Click chỗ này để ẩn hiện mục AddNew  -->
    <div class="mt-2">
        <a href="javascript:void(0)" class="addNew">Thêm Khoa mới</a>
    </div>

    <!-- Hiện bảng Danh sách Phòng ban -->
    <div id="divDepartment" class="mt-3">
        <?php
            echo getDepartment("",0,0);
           
        ?>
    </div>
    
</div>
<?php
}
?>