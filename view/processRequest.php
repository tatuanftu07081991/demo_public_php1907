<?php
//require_once $_SERVER['DOCUMENT_ROOT'].'/175em/view/viewRequest.php';
if(isset($_SESSION['result_request'])) {
	$result = $_SESSION['result_request'];

	$tab = isset($_GET['tab']) ? $_GET['tab'] : '';
    //if(!empty($tab) || $tab == 0) {
?>

<div class="col-md-9 my-4 mx-auto">
	<div class="request">
	    <div class="row mb-2">
	        <div class="col-md-12 text-center"><h4>Tổng quan thông tin Request:</h4></div>
	    </div>
	    <div class="row bs-wizard">	        
	        <div class="table-responsive mx-5">
                <table class="table table-striped list">
                    <tr>
                        <td><strong>Tên máy</strong></td>
                        <td><?php echo $result[$tab]['NameEq'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Bộ phận</strong></td>
                        <td><?php echo $result[$tab]['NameDp'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Ngày hư hỏng</strong></td>
                        <td><?php echo $result[$tab]['MalTime'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Hiện trạng</strong></td>
                        <td><?php echo $result[$tab]['Status'];?></td>
                    </tr>
                       <td><strong>Mô tả chi tiết hư hỏng</strong></td>
                        <td><?php echo $result[$tab]['Discription'];?></td>
                    </tr>
                </table>
            </div>	        
	    </div>
	</div>
<?php
if($data_user['UserType'] == 1) {	
?>
	<form method="POST" id="formAdd" action="../controller/processRequest.php">
		
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="TimeReceive">Thời gian tiếp nhận:</label>
				<input type="datetime-local" class="form-control" id="TimeReceive" name="TimeReceive">
			</div>
			<div class="form-group col-md-4">
				<label for="Priority">Mức độ ưu tiên:</label>
				<select id="Priority" class="form-control" name="Priority">
					<option id="M1" value="1">M1</option>
					<option id="M2" value="2">M2</option>
					<option id="M3" value="3">M3</option>
				</select>
			</div>
			<div class="form-group col-md-4 d-none">
				<input type="text" class="form-control" name="IdRequest" value="<?php echo $result[$tab]['Id'];?>">
			</div>
		</div>

		<div class="form-row">						
			<div class="form-group col-md-4">
				<label for="CheckingTime">Thời gian xác nhận hư hỏng:</label>
				<input type="datetime-local" class="form-control" id="CheckTime" name="CheckTime">
			</div>
			<div class="form-group col-md-8">
				<label for="CheckingStatus">Tình trạng</label>
				<input type="text" class="form-control" id="CheckingStatus" name="CheckingStatus">
			</div>
		</div>

		<div class="form-group">
		    <label for="Causal">Nguyên nhân hỏng</label>
		    <textarea class="form-control" id="Causal" rows="3" name="Causal"></textarea>
		</div>

		<div class="form-group">
			<label for="DamageLevel">Mức độ hư hỏng</label>
			<select id="DamageLevel" class="form-control" name="DamageLevel">
				<option id="HH1" value="1">HH1</option>
				<option id="HH2" value="2">HH2</option>
				<option id="HH3" value="3">HH3</option>
			</select>
		</div>

		<div class="form-group">
		 	<p class="form-up-img">
                <div class="alert alert-info">Mỗi lần upload tối đa 2 file ảnh. Mỗi file có dung lượng không vượt quá 5MB và có đuôi định dạng là .jpg, .png.gif., </div>

                <div class="form-group">
                    <label>Upload hình ảnh Trang thiết bị lỗi</label>
                    <input type="file" class="form-control upload-img" accept="image/*" name="img_up[]" multiple="true" id="img_up">
                </div>
                <div class="form-group box-pre-img d-none">
                    <p><strong>Ảnh xem trước</strong></p>
                </div>
                <div class="form-group d-none box-progress-bar">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar"></div>
                    </div>
                </div>
                <div class="alert alert-danger d-none upload"></div>
            </p>
		</div>
		
		<div class="form-group">
			<table class="table table-striped table-bordered text-center note">
			   <thead>
			      <tr>
			         <th width="5%">No</th>
			         <th width="30%">Tên cụm chi tiết hư hỏng</th>
			         <th width="12%">Đvt</th>
			         <th width="10%">SL</th>
			         <th>Phương án SC</th>
			         <th width="18%">Khả năng cung ứng vật tư</th>
			      </tr>
			   </thead>
			   <tbody>
			      <tr>
			         <td>1</td>
			         <td>
						<textarea class="form-control" id="" rows="4" name="">
						</textarea>
			         </td>
			         <td><input type="text" class="form-control" id="" name=""></td>
			         <td><input type="text" class="form-control" id="" name=""></td>
			         <td style="text-align: left">
			         	<div class="form-check">
						  	<label><input class="form-check-input" type="radio" value="1" name="Solution">
						    Mất
						  	</label>
						</div>
						<div class="form-check">
						  	<label><input class="form-check-input" type="radio" value="2" name="Solution">
						    Hỏng thay mới
						  	</label>
						</div>
						<div class="form-check">
						  	<label><input class="form-check-input" type="radio" value="3" name="Solution">
						    Sửa chữa
						  	</label>
						</div>
						<div class="form-check">
						  	<label><input class="form-check-input" type="radio" value="4" name="Solution">
						    Bảo dưỡng
						  	</label>
						</div>
			         </td>
			         <td style="text-align: left">
			         	<div class="form-check">
						  	<label><input class="form-check-input" type="radio" value="U1" name="procurement">
						    U1
						  	</label>
						</div>
						<div class="form-check">
						  	<label><input class="form-check-input" type="radio" value="U2" name="procurement">
						    U2
						  	</label>
						</div>
						<div class="form-check">
						  	<label><input class="form-check-input" type="radio" value="U3" name="procurement">
						    U3
						  	</label>
						</div>
						<div class="form-check">
						  	<label><input class="form-check-input" type="radio" value="U4" name="procurement">
						    U4
						  	</label>
						</div>
			         </td>
			      </tr>
			   </tbody>
			</table>
		</div>

		<div class="form-group">
		    <label for="Conclusion">Kết luận</label>
		    <textarea class="form-control" id="Conclusion" rows="3" name="Conclusion"></textarea>
		</div>

		<div class="form-group">
            <button type="submit" class="btn btn-primary mb-3" name="btnSubmit">Submit</button>
            <button class="btn btn-success mb-3" type="reset">Reset</button>
        </div>

	</form>
<?php
}
echo '</div>';
} else {
	require_once $_SERVER["DOCUMENT_ROOT"].'/175em/view/signin.php';
}

unset($_SESSION['result_request']);
?>
