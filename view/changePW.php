
<?php
if(!isset($_SESSION['user'])) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/175em/view/signin.php';
} else {
?>
    <div class="col-md-6 my-4 mx-auto">
		<div class="card">
            <div class="card-header text-center alert alert-<?php echo (!empty($_SESSION['error'])) ? 'danger' : 'success' ?>">
                        <?php echo (!empty($_SESSION['error'])) ? $_SESSION['error'] : 'Xin mời đổi mật khẩu' ?>
            </div>
            <?php
                unset($_SESSION['error']);
            ?>

            <div class="card-body">
			    <form action="controller/changePW.php" method="POST" id="changePWForm">
                    <div class="row">
                        <div class="col-sm-12 col-md-10 offset-md-1">
                        	<!-- ------------ Pass Cũ -------------- -->
					    	<div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i>
                                    </div>
                                    <input class="form-control" placeholder="PassWord cũ" name="PwOld" type="password" value="">
                                </div>
                            </div>
                            <!-- ------------ Pass Mới -------------- -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i>
                                    </div>
                                    <input class="form-control" placeholder="PassWord mới" name="PwNew" type="password" value="">
                                </div>
                            </div>
							<!-- ------------ Password -------------- -->
							<div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i>
                                    </div>
                                    <input class="form-control" placeholder="Re-PassWord" name="RePw" type="password" value="">
                                </div>
                            </div>
                            <!-- ------------ Submit -------------- -->
							<div class="form-group">
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Submit" name="changePw_submit">
                            </div>
                        </div>
                    </div>				    
			    </form>
			</div>
        </div>
	</div>
<?php
}
?>

    