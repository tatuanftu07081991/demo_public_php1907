<div class="col-md-6 my-4 mx-auto">
		<div class="card">
			<div class="card-header text-center alert alert-<?php echo (!empty($_SESSION['error'])) ? 'danger' : 'success' ?>">
                        <?php echo (!empty($_SESSION['error'])) ? $_SESSION['error'] : 'Sign Up' ?>
            </div>

            <div class="card-body">
			    <form action="controller/signup.php" method="POST" id="signUpForm">
                    <div class="row">
                        <div class="col-sm-12 col-md-10 offset-md-1">
                        	<!-- ------------ UserName -------------- -->
					    	<div class="form-group">
					    		<div class="input-group">
		                            <div class="input-group-prepend">
		                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
		                            </div> 
									<input type="text" class="form-control" id="UserName" placeholder="Input your user name" name="UserName" data-toggle="tooltip" data-placement="right" title="User chứa từ 6 - 12 kí tự">
								</div>
							</div>
							<!-- ------------ Password -------------- -->
							<div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i>
                                    </div>
                                    <input class="form-control" placeholder="PassWord" name="PassWord" type="password" value="" data-toggle="tooltip" data-placement="right" title="Pass chứa từ 5 - 18 kí tự">
                                </div>
                            </div>
                            <!-- ------------ FullName -------------- -->
							<div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control" id="FullName" name="FullName" placeholder= "<?php echo isset($data_user['UserName']) ? "Nhập họ và tên" :"nhập tên thường gọi của công ty"?>" >
                                </div>
                            </div>
							<!-- ------------ Title -------------- -->
							<div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control" id="Title" placeholder="<?php echo isset($data_user['UserName']) ? "Nhập Title" :"nhập tên đầy đủ của công ty"?>" name="Title">
                                </div>
                            </div>
                            <?php
                                if(isset($data_user['UserName']) && $data_user['UserName'] == 'hungdn') {
                            ?>
                            <!-- ------------ Department -------------- -->
                            <div class="form-group d-none">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="far fa-building"></i>
                                    </div>
                                    <input type="text" class="form-control" id="DpName" placeholder="nhập Department" name="DpName">
                                </div>
                            </div>
                            <!-- ------------ Department -------------- -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="far fa-building"></i>
                                    </div>
                                    <input type="text" class="form-control" id="DpId" placeholder="nhập Department Id" name="DpId">
                                </div>
                            </div>

                            
                            <!-- ------------ UserType -------------- -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="far fa-id-badge"></i>
                                    </div>
                                    <input type="text" class="form-control" id="UserType" placeholder="nhập UserType" name="UserType">
                                </div>
                            </div>
                            <?php } ?>
                            <!-- ------------ Email -------------- -->
							<div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="far fa-envelope"></i>
                                    </div>
                                    <input type="email" class="form-control" id="Email" placeholder="Input your email" name="Email">
                                </div>
                            </div>
                            <!-- ------------ Phone -------------- -->
							<div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i>
                                    </div>
                                    <input type="text" class="form-control" id="Phone" placeholder="Input your phone" name="Phone">
                                </div>
                            </div>
							<!-- ------------ Other Phone -------------- -->
							<div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i>
                                    </div>
                                    <input type="text" class="form-control" id="Phone" placeholder="Input your other phone" name="Phone1">
                                </div>
                            </div>
                            <!-- ------------ Submit -------------- -->
							<div class="form-group">
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign up" name="signUp">
                            </div>
                        </div>
                    </div>				    
			    </form>
			</div>
			<div class="card-footer">
                 Hãy liên lạc với admin nếu bạn không phải là công ty
            </div>
        </div>
	</div>

    <?php
        unset($_SESSION['error']);
    ?>