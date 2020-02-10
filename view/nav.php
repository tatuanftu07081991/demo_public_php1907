<div id="header">
		<div class="web-header">
				<div class="logo">
						<a href="<?php echo $_DOMAIN; ?>">

								<img src="<?php echo $_DOMAIN?>images/logo.png" alt="#">
						</a>
				</div>
				<div class="adr">
						<p>786 Nguyễn Kiệm, P.3
						<br>
						Q.Gò Vấp, Hồ Chí Minh</p>
				</div>
				<div class="social">
						<ul>
								<li>
										<a href="#"><i class="fab fa-facebook-messenger"></i></a>
								</li>
								<li>
										<a href="#"><i class="fab fa-twitter-square"></i></a>
								</li>
						</ul>
				</div>
		</div>
</div>
<nav class="navbar navbar-expand-lg navbar-light"> 
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#abc "> 
				<span class="navbar-toggler-icon"></span> 
		</button>
		<!-- Menu chính-->
		<div class="collapse navbar-collapse" id="abc">
				<ul class="navbar-nav <?php 
				echo (isset($_SESSION['user']) && $_SESSION['user']) ? "mx-auto" : "mr-auto";
				 ?> mt-2 mt-lg-0">
						<li class="nav-item active"> 
								<a class="nav-link" href="#">Trang chủ <span class="sr-only">(current)</span></a> 
						</li>
						<li class="nav-item"> 
								<a class="nav-link" href="#">Giới thiệu</a> 
						</li>

						<li class="nav-item"> 
								<a class="nav-link" href="#">Blog</a> 
						</li>

						<!-- 1 -->

						<li class="nav-item dropdown"> 
								<a class="nav-link dropdown-toggle" href="# " id="navbarDropdown" role="button" data-toggle="dropdown">
										Dropdown
								</a>
								<div class="dropdown-menu"> 
										<a class="dropdown-item" href="#">Action</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Another action</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Something else here</a> 
								</div>
						</li>

						<li class="nav-item"> 
								<a class="nav-link" href="#">Liên hệ</a> 
						</li>
				</ul>
				<!-- Menu chính-->
				<?php 
				if (isset($_SESSION['user']) && $_SESSION['user']){

				}
				else {
						echo '
						<form class="form-inline mr-2 ml-auto login">
								<a class="btn btn-secondary my-sm-0 mr-2" role="button" href="'.$_DOMAIN.'signin">Đăng Nhập</a>
								<a class="btn btn-secondary my-sm-0" role="button" href="'.$_DOMAIN.'signup">Đăng Ký</a>
						</form>
						';
				}
				?>
				<!-- Hết Search form-->
		</div>
</nav>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="<?php echo $_DOMAIN?>images/slider/1.jpg" alt="First slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="<?php echo $_DOMAIN?>images/slider/2.jpg" alt="Second slide">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="<?php echo $_DOMAIN?>images/slider/3.jpg" alt="Third slide">
		</div>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
