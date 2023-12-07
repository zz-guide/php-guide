<?php
/**
 * Created by PhpStorm.
 * User: xulei
 * Date: 2018/11/2
 * Time: 13:02
 */

class HandlePCD
{
    public function _readBaiDuMapJson()
    {
        $json_string = file_get_contents('./2018baidumap.json');
        return json_decode($json_string, true);
    }

    public function filterProvince($province)
    {
        return in_array($province, ["台湾省", "澳门", "香港"]);
    }

    public function handle()
    {
        $originData = $this->_readBaiDuMapJson();
        $allProvince = array_unique(array_column($originData, 'province'));

        $provinceAndCityData = [];
        foreach ($originData as $data) {
            if ($data['province'] == $data['city']) {
               continue;
            }

            $provinceAndCityData[] = "{$data['province']}{$data['city']}";
        }

        $provinceAndCityData = array_unique($provinceAndCityData);
        unset($data);

        $provinceAndCityAndDistrictData = [];
        foreach ($originData as $data) {
            $provinceAndCityAndDistrictData[] = "{$data['province']}{$data['city']}{$data['district']}";
        }

        $provinceAndCityAndDistrictData = array_unique($provinceAndCityAndDistrictData);
        unset($data);

        $newData = array_merge($allProvince, $provinceAndCityData, $provinceAndCityAndDistrictData);

        file_put_contents('newData.json', json_encode($newData, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    }
}

$task = new HandlePCD();
$task->handle();