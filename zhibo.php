<?php
if(!isset($_COOKIE['name'])) 
 { 
  header('Location: http://site2.com/login.php');
 }
$roomid = $_GET['roomid'];
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";
 
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>直播间</title>
  <link rel="stylesheet" href="css/ydui.css">
  <script src="js/ydui.flexible.js"></script>
  <script src="js/ydui.js"></script>
  <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
  <style type="text/css">
.center{
  -webkit-box-ordinal-group: 3;
    -webkit-order: 2;
    -ms-flex-order: 2;
    order: 2;
    display: flex;
    
    height: .9rem;
    width: 50%;
    margin-left: 15%;
    padding: .15rem;
}
.tabbaritem{
  -webkit-box-flex: 1;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    /* -webkit-flex-direction: column; */
    -ms-flex-direction: column;
    /* flex-direction: column; */
    -webkit-box-pack: center;

    -ms-flex-pack: center;

    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    color: #979797;
    margin-left: .15rem;
}
#text{
 position: fixed;
    bottom: 1rem;
    left: 0;
    z-index: 49;
    color: #ffffff;
    /* height: 2rem; */
    margin-left: 0.2rem;
    line-height: 0.4rem;
}
.g-scrollview{
  background-image: url(img/bak.jpg);
  background-size:100% 100%;
  background-repeat: no-repeat;
}
.fadein{
        border-radius: 0.2rem;

    left: 0;
    z-index: 49;
    color: #101010;
    /* height: 2rem; */
    background-color: #efbb88;
    margin-left: 0.5rem;
    line-height: 0.3rem;
    padding: .1rem;
    display: none;
}
.list{
  height: 2rem;
    overflow-y: scroll;
    overflow-x: hidden;

}
.list::-webkit-scrollbar {
        display: none;
    }
</style>
<script type="text/javascript">
        function getCookie(cname)
{
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i=0; i<ca.length; i++) 
  {
    var c = ca[i].trim();
    if (c.indexOf(name)==0) return c.substring(name.length,c.length);
  }
  return "";
}
            if ("WebSocket" in window)
            {
               
               var username = getCookie('name');
               var uid = getCookie('uid');
               // 打开一个 web socket
               var ws = new WebSocket("ws://192.168.241.128:9501?roomid="+<?php echo $roomid; ?>+"&name="+username+"&uid="+uid);
                
               ws.onopen = function()
               {
                // $("#tip").text("欢迎"+username+"进入直播室");
                //   $("#tip").fadeToggle();
                  setInterval(function(){ ws.send(1); }, 30000);
               };
                
               ws.onmessage = function (evt) 
               { 
                  var received_msg = evt.data;

                  var obj = JSON.parse(received_msg);
                  if (obj.code==2) {
                    $("#tip").text(obj.msg);
                    $("#tip").fadeToggle(1000);
                    $("#tip").fadeToggle(1000);
                  }else{
                    $('#test').append("<div><i class='icon-ucenter'></i>"+obj.msg+"</br></div>");
                  }
                  
                 // var t = document.getElementById("test");
                 //  t.innerHTML=t.innerHTML+received_msg+"</br>";
                
                  var div = document.getElementsByClassName('list')[0];
                   div.scrollTop = div.scrollHeight;
               };
                
               ws.onclose = function()
               { 
                  // 关闭 websocket
                  alert("连接已关闭..."); 
               };
            }
            
            else
            {
               // 浏览器不支持 WebSocket
               alert("您的浏览器不支持 WebSocket!");
            }
         function WebSocketTest(){
            var txt = document.getElementById("textarea");
            var txts = '{"code":1,"msg":"'+decodeURIComponent(username)+'说：'+txt.value+'","room":"<?php echo $roomid; ?>"}';
         
            ws.send(txts);
                  txt.value="";
         }
       
      </script>
</head>
<body>
  <header class="m-navbar navbar-fixed">
    <a href="#" class="navbar-item">
        <i class="back-ico"></i><span><img src="/img/2013.jpg" width="30" ></span>
    </a>

    <div class="center">
        <span class="navbar-title">名字<br>321人观看&nbsp;12万 粉丝</span>
    </div>
   
</header>
<div class="g-scrollview">
       
    </div>
   
<div class="chat01_content" id="text">
   <div style="margin-bottom: 0.2rem;"><span  class="fadein" id="tip"></span></div>
  <div class="list" id="test"></div>
                       <div style="display: none;"><img src="img/2021.jpg"></div>
                    </div>
                    
<footer class="m-tabbar tabbar-fixed">
    <a href="javascript:WebSocketTest();" class="tabbaritem">
        <span class="tabbar-icon">
            <i class="icon-feedback"></i>
        </span>
       
    </a>
  <textarea value="aa" id="textarea" style="width: 3rem;"></textarea>
    <a href="#" class="tabbaritem" style="margin-left: 1rem;">
        <span class="tabbar-icon">
           <i class="icon-weibo"></i>
        </span>
        
    </a>
    <a href="#" class="tabbaritem">
        <span class="tabbar-icon">
           <i class="icon-weixin"></i>
        </span>
       
    </a>
     <a href="#" class="tabbaritem">
        <span class="tabbar-icon">
          <i class="icon-good"></i>
        </span>
       
    </a>
</footer>
</body>
</html>