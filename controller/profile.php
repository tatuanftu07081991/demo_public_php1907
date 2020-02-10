<?php
    session_start();
    require_once 'infoUser.php';
    require_once 'user.php';

    // check loại user là loại nào
    if(isset($_SESSION['user']) && $_SESSION['user']['UserType'] != 3 ) {
                $FullName = $_POST['FullName'];
                $Title = $_POST['Title'];  
                $Email = $_POST['Email'];
                $Phone = $_POST['Phone'];
                $Phone1 = $_POST['Phone1'];

                $user = new userCtrl($_SESSION['user']['UserName'], null, $FullName, $Title, null, $Email, null, $Phone, $Phone1);
                $error = $user->editInfo($_SESSION['user']['UserName'], null, $FullName, $Title, null, $Email, null, $Phone, $Phone1);

                $_SESSION['user']['FullName'] = $FullName;
                $_SESSION['user']['Title'] = $Title;
                $_SESSION['user']['Email'] = $Email;
                $_SESSION['user']['Phone'] = $Phone;
                $_SESSION['user']['Phone1'] = $Phone1;
    }
                
    header('Location: ../profile');