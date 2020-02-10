<?php
$tab = isset($_GET['tab']) ? $_GET['tab'] : '';

if(!isset($_SESSION['user'])) {
	require_once $_SERVER["DOCUMENT_ROOT"].'/175em/view/signin.php';
} else {
    echo '<div class="col-md-8 my-4 mx-4">';
	// nếu userType là 1 hoặc 2 thì là user được fix sẵn
	if($_SESSION['user']['UserType'] != 3 ) {
        // nếu không tồn tại tab
		if(empty($tab)) {	
    		echo
                '                
                    <a href="' . $_DOMAIN . 'profile/edit" class="btn btn-primary">
                        <i class="fas fa-user-edit"></i> Sửa
                    </a> 
                    
                    <div class="table-responsive mt-2">
                        <table class="table table-striped list" id="list_cate">
                            <tr>
                                <td><strong>UserName</strong></td>
                                <td>'.$data_user['UserName'].'</td>
                            </tr>
                            <tr>
                                <td><strong>FullName</strong></td>
                                <td>'.$data_user['FullName'].'</td>
                            </tr>
                            <tr>
                                <td><strong>Title</strong></td>
                                <td>'.$data_user['Title'].'</td>
                            </tr>
                            <tr>
                                <td><strong>Department</strong></td>
                                <td>'.$data_user['Department'].'</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>'.$data_user['Email'].'</td>
                            </tr>
                            <tr>
                                <td><strong>Phone</strong></td>
                                <td>'.$data_user['Phone'].'</td>
                            </tr>
                            <tr>
                                <td><strong>Phone1</strong></td>
                                <td>'.$data_user['Phone1'].'</td>
                            </tr>
                        </table>
                    </div>
                '
            ;
        } 
        // Nếu tồn tại tab.
        else {
            echo
                '
                    <a href="' . $_DOMAIN . 'profile" class="btn btn-primary">
                        <i class="fas fa-user-edit"></i> Back
                    </a> 

                    <form role="form" action="../controller/profile.php" method="POST">                   
                        <div class="table-responsive mt-2">
                            <table class="table table-striped list" id="list_cate">';
            if(isset($error)) {
                echo
                                '<tr>
                                    <td colspan="2" class="text-center">
                                        '.$error.'
                                    </td>
                                </tr>';
            }
                                
            echo
                                '<tr>
                                    <td><strong>UserName</strong></td>
                                    <td>'.$data_user['UserName'].'</td>
                                </tr>
                                <tr class="form-group">
                                    <td><strong>FullName</strong></td>
                                    <td><input type="text" class="form-control" name="FullName" value="'.$data_user['FullName'].'"></td>
                                </tr>
                                <tr>
                                    <td><strong>Title</strong></td>
                                    <td><input type="text" class="form-control" name="Title" value="'.$data_user['Title'].'"></td>
                                </tr>
                                <tr>
                                    <td><strong>Department</strong></td>
                                    <td>'.$data_user['Department'].'</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td><input type="text" class="form-control" name="Email" value="'.$data_user['Email'].'"></td>
                                </tr>
                                <tr>
                                    <td><strong>Phone</strong></td>
                                    <td><input type="text" class="form-control" name="Phone" value="'.$data_user['Phone'].'"></td>
                                </tr>
                                <tr>
                                    <td><strong>Phone1</strong></td>
                                    <td><input type="text" class="form-control" name="Phone1" value="'.$data_user['Phone1'].'"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <input type="submit" class="btn btn-primary" value="Save" name="save">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                '
            ;
        }
	} else 
	{
        if(isset($company)) {
            echo
                '
                    <a href="' . $_DOMAIN . 'profile/edit" class="btn btn-primary">
                        <i class="fas fa-user-edit"></i> Sửa
                    </a> 
                    
                    <div class="table-responsive mt-2">
                        <table class="table table-striped list" id="list_cate">
                            <tr>
                                <td><strong>UserName</strong></td>
                                <td>'.$data_user['UserName'].'</td>
                            </tr>';

                    foreach ($company as $key => $value) {
                        echo '<tr>
                                <td><strong>'.$key.'</strong></td>
                                <td>'.$value.'</td>
                            </tr>';
                    }
                            
            echo'        </table>
                    </div>
                ';
     
    	} else {
            echo '
                    <a href="' . $_DOMAIN . 'insertCpn" class="btn btn-primary">
                        <i class="fas fa-user-edit"></i> Thêm
                    </a> ';
        }
    }
}
?>
</div>