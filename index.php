<?php
if(!isset($_COOKIE['name'])) 
 { 
  header('Location: login.php');
 }
 if(isset($_POST['name'])){

  setcookie("name", $_POST['name'], time()+60*60*24*30);
setcookie("uid", $_POST['uid'], time()+60*60*24*30);
 }
 $servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
 
$sql = "SELECT room.room_name,room.room_img,room.room_id,room.creater_name,COUNT(`user`.id) AS nums FROM `user` right JOIN room ON `user`.room=room.room_id GROUP BY room.room_name";
$result = $conn->query($sql);
$rooms = array();
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        $rooms[]=$row;
    }
} 


$conn->close();
?>

       <html data-dpr="1" style="font-size: 50px;"><head>
    <meta charset="UTF-8">
    <title>List - theme5</title>
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <link rel="stylesheet" href="css/ydui.css">
  <script src="js/ydui.flexible.js"></script>
  <script src="js/ydui.js"></script>
  <style type="text/css">
.list-mes{
  height: 6rem;
    
    background-repeat: no-repeat;
    background-size: 100%;
}
.list_item{
  position: absolute;
  bottom: 0.2rem;
  width: 100%;
      padding-left: .3rem;
}
.logo{
      width: 10%;
    float: left;
    border-radius: 1rem;
}
.fang{
      line-height: 0.2rem;
    padding: 0.1rem;
    float: left;
    margin-left: 0.2rem;
    color: #ffffff;
}
</style>
</head>
<body>
<section class="g-flexview">

    <header class="m-navbar">
        <a href="list.html" class="navbar-item"><i class="back-ico"></i></a>
        <div class="navbar-center"><span class="navbar-title">直播房间</span></div>
    </header>

    <section class="g-scrollview">

        <article class="m-list list-theme5">
          <?php
        foreach ($rooms as $key => $value) {
         
        echo '<a href="zhibo.php?roomid='.$value["room_id"].'" class="list-item"><div class="list-mes" style="background-image: url('.$value["room_img"].');"><h5 class="list-title"><span class="badge badge-radius badge-danger">直播中</span><span class="badge badge-radius badge-primary">'.$value["nums"].'观看</span></h5><div class="list_item"><img src="/img/2013.jpg" width="30" class="logo" ><span class="fang"><h3>'.$value["creater_name"].'</h3><br>'.$value["room_name"].'</span></div></div></a>';
        }
       ?>
            
        </article>

    </section>

</section>
<script type="text/javascript">

</script>

</body></html>