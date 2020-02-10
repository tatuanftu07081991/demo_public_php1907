<?php
if(isset($_SESSION['user']) && $_SESSION['user']==true) {
    echo '<script>window.location.href = "'.$_DOMAIN.'"</script>';
} else {
?>

<div class="row start">
    <div class="col-sm-6 col-md-4 offset-md-4 mt-4">
        <div class="card">

            <div class="card-header text-center alert alert-<?php echo (!empty($_SESSION['error'])) ? 'danger' : 'success' ?>">
                        <?php echo (!empty($_SESSION['error'])) ? $_SESSION['error'] : 'Sign in to continue' ?>
            </div>

            <?php
                unset($_SESSION['error']);
            ?>

            <div class="card-body">
                <form role="form" action="controller/signin.php" method="POST">
                    <fieldset>
                        <div class="row mb-3">
                            <div class="mx-auto d-block">
                                <img class="rounded-circle"
                                    src="https://upload.wikimedia.org/wikipedia/vi/e/e3/Benh_vien_175.jpg" alt="" width="96px" height="96px">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-10 offset-md-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                        </div>          
                                        <input class="form-control" placeholder="Username" name="UserName" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i>
                                        </div>
                                        <input class="form-control" placeholder="Password" name="Password" type="password" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in" name="login">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="card-footer">
                Don't have an account! <a href="signup"> Sign Up Here </a>
            </div>
        </div>
    </div>
</div>

<?php

} 



