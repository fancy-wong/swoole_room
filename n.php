<?php
include 'mysql.php';
 $conn = new mysql();
$aa = $conn->getuser(1);
var_dump($aa);


