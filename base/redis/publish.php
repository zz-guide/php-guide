<?php
/**
 * Created by PhpStorm.
 * User: jmsite.cn
 * Date: 2019/1/23
 * Time: 11:59
 */
$channelName = "testPubSub";
$channelName2 = "testPubSub2";
//向指定频道发送消息
try {
    $redis = new Redis();
    $redis->connect('192.168.75.132', 6379);
    for ($i=0;$i<5;$i++){
        $data = array('key' => 'key'.$i, 'data' => 'testdata');
        $ret = $redis->publish($channelName, json_encode($data));
        print_r($ret);
    }
} catch (Exception $e){
    echo $e->getMessage();
}