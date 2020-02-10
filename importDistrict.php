<?php
require_once 'controller/infoUser.php';

if(isset($_POST['province'])){
    $province = $_POST['province'];
    $districtList = new addressCtrl($province);
    echo '<label for="districtName">District/Ward</label>';
    echo $districtList->getAsList('districtName');
}