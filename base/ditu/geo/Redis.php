<?php

class RedisLbs
{
    /** @var Redis */
    private $redis;

    public function __construct($config = array())
    {
        $host = isset($config['host']) ? $config['host'] : '127.0.0.1';
        $port = isset($config['port']) ? $config['port'] : '6379';
        $redis = new Redis();
        $redis->connect($host, $port);
        if (isset($config['auth'])) {
            $redis->auth($config['auth']);
        }

        $this->setRedis($redis);
    }

    public function getRedis()
    {
        return $this->redis;
    }

    public function setRedis($redis)
    {
        $this->redis = $redis;
    }

    public function geoAdd($uid, $lon, $lat)
    {
        $redis = $this->getRedis();
        $redis->geoAdd('store_list', $lon, $lat, $uid);
        return true;
    }
}


$lbs = new RedisLbs([
    'host' => '47.105.50.31',
    'port' => 6379,
    'auth' => 'hqyx_redis@2016_ui'
]);

//$lbs->geoAdd(1, 116.328294, 39.981612);
//$lbs->geoAdd(2, 116.328294, 39.981612);
//$lbs->geoAdd(3, 116.291317, 40.026918);
//$lbs->geoAdd(4, 116.324348, 39.981865);

//$meters = $lbs->getRedis()->geoDist("store_list", "1", "4", 'm');
//var_dump($meters);

//$options = ['WITHDIST'];
//var_dump($lbs->getRedis()->geoRadius("store_list", 116.328294, 39.981612, 2000, 'm', $options));

var_dump($lbs->getRedis()->geoPos('store_list', 1));
