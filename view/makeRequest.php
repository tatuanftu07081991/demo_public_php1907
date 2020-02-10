<?php
if(!isset($_SESSION['user'])) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/175em/view/signin.php';
} else {
?>

<div class="col-md-8 my-4 mx-auto">
	<div class="alert alert-<?php if(isset($_SESSION['error'])&&$_SESSION['error']=='Error'){ echo "danger";}else echo "success";?> text-center">
		<?php if(isset($_SESSION['error']) && $_SESSION['error'] != null){ echo $_SESSION['error'];}else echo "Xin mời nhập thông tin";?>
	</div>
	
	<form method="POST" id="formAdd" action="controller/makeRequest.php">


		<div class="form-group">
			<label for="MachineName">Tên máy:</label>
			<input type="text" class="form-control" id="MachineName" name="MachineName">	
		</div>
		<div class="form-group d-none">
			<label for="MachineCode">Mã máy:</label>
			<input type="text" class="form-control" id="MachineCode" name="MachineCode">	
		</div>
		<div class="form-group d-none">
			<label for="Category">Category:</label>
			<input type="text" class="form-control" id="Category" name="Category">	
		</div>
		<div class="form-group d-none" id="Detail_input">
			<label for="Detail">Chi tiết (áp dụng với sửa chữa nhỏ lẻ):</label>
			<input type="text" class="form-control" id="Detail" name="Detail">	
		</div>

		<div class="form-row">
			<div class="form-group col-md-4" id="Model_input">
				<label for="Model">Ký hiệu:</label>
				<input type="text" class="form-control" id="Model" name="Model">
			</div>
			<div class="form-group col-md-4" id="SN_input">
				<label for="SN">Số máy:</label>
				<input type="text" class="form-control" id="SN" name="SN">
			</div>
			<div class="form-group col-md-4" id="Country_input">
				<label for="Country">Nước sản xuất:</label>
				<input type="text" class="form-control" id="Country" name="Country">
			</div>
		</div>

		<div class="form-group d-none">
			<label for="Department">Department:</label>
			<input type="text" class="form-control" id="Department" name="Department">	
		</div>

		<div class="form-row">						
			<div class="form-group col-md-4">
				<label for="MalfunctionTime">Ngày hư hỏng</label>
				<input type="datetime-local" class="form-control" id="MalfunctionTime" name="MalfunctionTime">
			</div>
			<div class="form-group col-md-8">
				<label for="Status">Hiện trạng</label>
				<input type="text" class="form-control" id="Status" name="Status">
			</div>
		</div>

		<div class="form-group">
		    <label for="Discription">Mô tả chi tiết hư hỏng</label>
		    <textarea class="form-control" id="Discription" rows="3" name="Discription"></textarea>
		</div>

		<div class="form-group">
            <button type="submit" class="btn btn-primary mb-3" name="btnSubmit">Submit</button>
            <button class="btn btn-success mb-3" type="reset">Reset</button>
        </div>

	</form>
</div>

<?php
unset($_SESSION['error']);
}
?>