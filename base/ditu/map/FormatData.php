<?php

ini_set("display_errors", "On");
error_reporting(E_ALL);
ini_set('date.timezone','Asia/Shanghai');
ini_set('memory_limit', '-1');

class FormatData
{
    protected $_name = './test/';
    public function _readAgentRegionJson()
    {
        $json_string = file_get_contents("{$this->_name}agent_region.json");
        return json_decode($json_string, true);
    }

    public function _readAgentJson()
    {
        $json_string = file_get_contents("{$this->_name}agent.json");
        return json_decode($json_string, true);
    }

    public function _readStoreJson()
    {
        $json_string = file_get_contents("{$this->_name}store.json");
        return json_decode($json_string, true);
    }


    public function _readBaiDuMapJson()
    {
        $json_string = file_get_contents('./2018baidumap.json');
        return json_decode($json_string, true);
    }

    public function handle($type)
    {
        $map = null;
        $baiduMap = $this->_readBaiDuMapJson();
        if ($type == 'agent_region') {
            $map = $this->_readAgentRegionJson();
        } else if ($type == 'agent') {
            $map = $this->_readAgentJson();
        } else if ($type == 'store'){
            $map = $this->_readStoreJson();
        }

        $baiduProvince = array_unique(array_column($baiduMap,'province'));
        $baiduCity = array_unique(array_column($baiduMap,'city'));
        $baiduDistrict = array_unique(array_column($baiduMap,'district'));

        foreach ($baiduProvince as &$province) {
            $lastItem = mb_substr($province, -1, 1, 'UTF-8');
            if ($lastItem == '省') {
                $province = mb_substr($province, 0, -1, 'UTF-8');
            } else if ($lastItem == '市') {
                $province = mb_substr($province, 0, -1, 'UTF-8');
            }
        }

        foreach ($baiduCity as &$city) {
            $lastItem = mb_substr($city, -1, 1, 'UTF-8');
            if ($lastItem == '省') {
                $city = mb_substr($city, 0, -1, 'UTF-8');
            } else if ($lastItem == '市') {
                $city = mb_substr($city, 0, -1, 'UTF-8');
            }
        }

        $flag = true;
        foreach ($map as $key => &$agentRegion) {
            if ($agentRegion['province'] && !in_array($agentRegion['province'], $baiduProvince)) {
                $agentRegion['province_not_exists'] = '不存在省';

                $flag = false;
            }

            if ($agentRegion['city'] && !in_array($agentRegion['city'], $baiduCity)) {
                $agentRegion['city_not_exists'] = '不存在市';
                $flag = false;
            }

            if ($agentRegion['district'] && !in_array($agentRegion['district'], $baiduDistrict)) {
                $agentRegion['district_not_exists'] = '不存在区';
                $flag = false;
            }

            if ($flag) {
                unset($map[$key]);
            }

            $flag = true;
        }

        return $map;
    }

    public function run($type)
    {

        if ($type == 'agent_region') {
            file_put_contents('./new_agent_region.json', json_encode($this->handle($type),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        } else if ($type == 'agent') {
            file_put_contents('./new_agent.json', json_encode($this->handle($type),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        } else if ($type == 'store'){
            file_put_contents('./new_store.json', json_encode($this->handle($type),JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        }
    }
}



$task = new FormatData();
$task->run('agent_region');
$task->run('agent');
$task->run('store');



