<?php
include 'mysql.php';
 $conn = new mysql();
$server = new Swoole\WebSocket\Server("0.0.0.0", 9501);
$server->set(array(
    'worker_num' => 2,
    'daemonize' => true,
    'backlog' => 128,
'heartbeat_check_interval' => 30,
    'heartbeat_idle_time' => 60,
'log_file' => 'swoole.log',
));
$server->on('open', function (Swoole\WebSocket\Server $server, $request) {

   go(function () use ($server,$request) {
$name = $request->get['name'];
$uid = $request->get['uid'];
$fd = $request->fd;
$room = $request->get['roomid'];
   $swoole_mysql = new Swoole\Coroutine\MySQL();
$swoole_mysql->connect([
    'host' => '192.168.10.135',
    'port' => 3306,
    'user' => 'root',
    'password' => 'root',
    'database' => 'test',
]);
$sql = 'INSERT INTO user (name,uid,fd,room) VALUE ("'.$name.'",'.$uid.','.$fd.','.$room.') ON DUPLICATE KEY UPDATE name= "'.$name.'",uid='.$uid.',fd='.$fd.',room='.$room.'';
$res = $swoole_mysql->query($sql);
if($res === false) {
    return;
}
$sql1 = 'select fd,name from user where room='.$room;

$res1 = $swoole_mysql->query($sql1);

foreach ($res1 as $fd) {

        
        if ($server->isEstablished($fd['fd'])) {
		$msg = array("code"=>2,"msg"=>"欢迎".$name."进入");
            $server->push($fd['fd'], json_encode($msg,JSON_UNESCAPED_UNICODE));
        }
    }
});
   
});

$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {

if($frame->data==1){
return;
}
    go(function () use ($frame,$server) {
$fid = $frame->fd;
$r = $frame->data;
$room = json_decode($r,true);
$roomid=$room['room'];
   $swoole_mysql = new Swoole\Coroutine\MySQL();
$swoole_mysql->connect([
    'host' => '192.168.10.135',
    'port' => 3306,
    'user' => 'root',
    'password' => 'root',
    'database' => 'test',
]);
$sql = 'select fd,name from user where room='.$roomid;

$res = $swoole_mysql->query($sql);
if($res === false) {
    return;
}
     foreach ($res as $fd) {

        
        if ($server->isEstablished($fd['fd'])) {
            $server->push($fd['fd'], $frame->data);
        }
    }

});


    
});

$server->on('close', function ($ser, $fd) {
      go(function () use ($fd) {

   $swoole_mysql = new Swoole\Coroutine\MySQL();
$swoole_mysql->connect([
    'host' => '192.168.10.135',
    'port' => 3306,
    'user' => 'root',
    'password' => 'root',
    'database' => 'test',
]);
$sql = 'update user set room=0,fd=0 where fd='.$fd;

$res = $swoole_mysql->query($sql);
if($res === false) {
    return;
}
    

});
});

$server->start();
