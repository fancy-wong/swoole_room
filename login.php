<?php
if(isset($_COOKIE['name'])) 
 { 
  header('Location: index.php');
 }

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/> 
 <title>会员登录</title> 
 <style type="text/css"> 
  ul li{margin:0;padding:0;} 
  form{margin:40px 30px 0;} 
  form li{list-style:none;padding:5px 0;} 
  form li label{float:left;width:70px;text-align:right} 
  form li a{font-size:12px;color:#999;text-decoration:none} 
  .login_btn{border:none;background:#01A4F1;color:#fff;font-size:14px;font-weight:bold;height:28px;line-height:28px;padding:0 10px;cursor:pointer;} 
  form li img{vertical-align:top} 
 </style> 
  
</head> 
<body> 
<form action="index.php" method="POST"> 
 <fieldset> 
  <legend>用户登录</legend> 
  <ul> 
   <li> 
    <label for"">用户名:</label> 
    <input type="text" name="name"/> 
   </li> 
   <li> 
    <label for"">uid:</label> 
    <input type="text" name="uid"/> 
   </li> 
  
   <li> 
    <label for""> </label> 
    <input type="submit" name="login" value="登录" class="login_btn"/> 
   </li> 
  </ul> 
 </fieldset> 
</body> 
  
</html>