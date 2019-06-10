<?php
 if(isset($_POST['name'])){
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";
$name = $_COOKIE['name'];
$uid = $_COOKIE['uid'];
$roomid = rand(1000,9999);
$roomname = $_POST['name'];
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
 
$sql = "insert into room (room_id,creater_id,creater_name,room_name) values (".$roomid.",".$uid.",'".$name."','".$roomname."')";
$result = $conn->query($sql);

$conn->close();
if($result){
echo 1;
}else{
echo 0;
}

 }
 
?>
