<?php
/**
 * Created by PhpStorm.
 * User: jmsite.cn
 * Date: 2019/1/23
 * Time: 11:29
 */
//设置php脚本执行时间
set_time_limit(0);
//设置socket连接超时时间
ini_set('default_socket_timeout', -1);
//声明测试频道名称
$channelName = "testPubSub";
$channelName2 = "testPubSub2";
try {
    $redis = new Redis();
    //建立一个长链接
    $redis->pconnect('192.168.75.132', 6379);
    //阻塞获取消息
    $redis->subscribe(array($channelName, $channelName2), function ($redis, $chan, $msg){
        echo "channel:".$chan.",message:".$msg."\n";
    });
} catch (Exception $e){
    echo $e->getMessage();
}