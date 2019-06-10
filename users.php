<?php
 if(isset($_GET['roomid'])){
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";

$roomid = $_GET['roomid'];

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
 
$sql = "select name from user where room = ".$roomid;
$result = $conn->query($sql);
$users = array();
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        $users[]=$row;
    }
} 
$conn->close();
echo json_encode($users);

 }
 
?>
