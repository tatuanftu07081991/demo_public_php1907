<?php
require_once 'core/session.php';
session_destroy();
Header('Location: index.php');
 
?>