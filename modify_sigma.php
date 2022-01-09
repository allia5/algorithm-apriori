<?php

session_start();
$_SESSION['sigma']=$_POST['min_supp'];

echo json_encode($_SESSION['sigma']);








?>