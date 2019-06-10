<?php
class Mysql{
 
public function adduser($name,$uid,$fd,$room){
go(function () use ($name,$uid,$fd,$room) {

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
return $res;
});
    
   
}
public function getuser($fid){
go(function () use ($fid) {
   $swoole_mysql = new Swoole\Coroutine\MySQL();
$swoole_mysql->connect([
    'host' => '192.168.10.135',
    'port' => 3306,
    'user' => 'root',
    'password' => 'root',
    'database' => 'test',
]);
$sql = 'select fd from user where room in (select room from user where fd='.$fid.')';

$res = $swoole_mysql->query($sql);
if($res === false) {
    return;
}


});

    }
}
