<?php

ini_set("display_errors", "On");
error_reporting(E_ALL);
ini_set('date.timezone','Asia/Shanghai');
ini_set('memory_limit', '-1');

class DiffPCD
{

    protected $_flag = false;
    public function _readBaiDuMapJson()
    {
        $json_string = file_get_contents('./baidumap.json');
        return json_decode($json_string, true);
    }

    public function _readDistrictAliasJson()
    {
        $json_string = file_get_contents('./alias.json');
        return json_decode($json_string, true);
    }

    public function _readNewFrontedJsonData()
    {
        $json_string = file_get_contents('./newprovince-city-district.json');
        return json_decode($json_string, true);
    }

    public function _readSortBaiDuMapJson()
    {
        $json_string = file_get_contents('./sort_baidu.json');
        return json_decode($json_string, true);
    }

    public function _readSortNewFrontedJsonData()
    {
        $json_string = file_get_contents('./sort_my.json');
        return json_decode($json_string, true);
    }

    public function _readFrontedJsonData()
    {
        $json_string = file_get_contents('./province-city-district.json');
        return json_decode($json_string, true);
    }

    public function run()
    {
        $frontedJsonData = $this->_readFrontedJsonData();
        $newData = [];
        foreach ($frontedJsonData['data'] as $key1 => $value1) {

            if ($value1['children']) {
                foreach ($value1['children'] as $key2 => $value2) {

                    if ($value2['children']) {
                        foreach ($value2['children'] as $key3 => $value3) {
                            $newData[] = [
                              'province'    => $value1['value'],
                              'city'        => $value2['value'],
                              'district'    => $value3['value'],
                            ];
                        }
                    }
                }
            }
        }

        $newFrontedData = json_encode($newData,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        file_put_contents('./newprovince-city-district.json', $newFrontedData);
    }

    public function testRun1()
    {
        $baiDuData = $this->_readSortBaiDuMapJson();
        $newFrontedJsonData = $this->_readSortNewFrontedJsonData();

        $cityList = [
            '北京', '天津', '上海', '重庆'
        ];

        $inMyNotInBaiDu = [];

        foreach ($newFrontedJsonData as $key => $data1) {
            $tmpData = $data1;
            if (in_array($tmpData['province'], $cityList)) {
                $tmpData['province'] .= '市';
            } else {
                $tmpData['province'] .= '省';
            }

            if (in_array($data1['city'], $cityList)) {
                $tmpData['city'] .= '市';
            } else {
                $tmpData['city'] .= '市';
            }


            foreach ($baiDuData as $item) {
                if ($item['province'] == $item['city'] && $item['city'] == $item['district']) {
                    continue;
                }

                if ($tmpData['province'] != $item['province'] ||
                    $tmpData['city'] != $item['city'] ||
                    $tmpData['district'] != $item['district']
                ) {
                    continue;
                }

                $this->_flag = true;
                break;
            }

            if ($this->_flag == true) {
                $this->_flag = false;
                continue;
            } else {
                $inMyNotInBaiDu[] = [
                    'my_province'   => $tmpData['province'],
                    'my_city'       => $tmpData['city'],
                    'my_district'   => $tmpData['district'],
                ];
            }
        }

        $inMyNotInBaiDu = json_encode($inMyNotInBaiDu,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        file_put_contents('./inMyNotInBaiDu.json', $inMyNotInBaiDu);die;
    }

    public function testRun2()
    {
        $baiDuData = $this->_readSortBaiDuMapJson();
        $newFrontedJsonData = $this->_readSortNewFrontedJsonData();

        $cityList = [
            '北京', '天津', '上海', '重庆'
        ];

        $inBaiDuNotInMy = [];

        foreach ($baiDuData as $item) {

            if ($item['province'] == $item['city'] && $item['city'] == $item['district']) {
                continue;
            }

            foreach ($newFrontedJsonData as $key => $data1) {
                $tmpData = $data1;
                if (in_array($tmpData['province'], $cityList)) {
                    $tmpData['province'] .= '市';
                } else {
                    $tmpData['province'] .= '省';
                }

                if (in_array($data1['city'], $cityList)) {
                    $tmpData['city'] .= '市';
                } else {
                    $tmpData['city'] .= '市';
                }

                if ($tmpData['province'] != $item['province'] ||
                    $tmpData['city'] != $item['city'] ||
                    $tmpData['district'] != $item['district']
                ) {
                    continue;
                }

                $this->_flag = true;
                break;
            }

            if ($this->_flag == true) {
                $this->_flag = false;
                continue;
            } else {
                $inBaiDuNotInMy[] = [
                    'baidu_province'   => $item['province'],
                    'baidu_city'       => $item['city'],
                    'baidu_district'   => $item['district'],
                ];
            }
        }

        $inBaiDuNotInMy = json_encode($inBaiDuNotInMy,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        file_put_contents('./inBaiDuNotInMy.json', $inBaiDuNotInMy);die;
    }

    public function sortArrByManyField()
    {
        $args = func_get_args();
        if (empty($args)) {
            return null;
        }

        $arr = array_shift($args);
        if (!is_array($arr)) {
            throw new Exception("第一个参数不为数组");
        }

        foreach ($args as $key => $field) {
            if (is_string($field)) {
                $temp = array();
                foreach ($arr as $index => $val) {
                    $temp[$index] = $val[$field];
                }
                $args[$key] = $temp;
            }
        }
        $args[] = &$arr;//引用值
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }

    public function handleSort()
    {
        $baiDuData = $this->_readBaiDuMapJson();
        $newFrontedJsonData = $this->_readNewFrontedJsonData();

        $arr1 = $this->sortArrByManyField($baiDuData,'province',SORT_ASC,'city',SORT_ASC,'district',SORT_ASC);

        $json_string = file_get_contents('./baiduzimupaixu.json');
        $data = json_decode($json_string, true);
        $arr2 = $this->sortArrByManyField($data,'province_s');

        file_put_contents('./sort_baidu.json', json_encode($arr2,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
//        file_put_contents('./sort_my.json', json_encode($arr2,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));die;
    }

    public function handleAlias()
    {
        $alias = $this->_readDistrictAliasJson();
        foreach ($alias as $key => &$item) {
            if ($item['district_alias'] == '') {
                unset($alias[$key]);
            }

            $lastKey = mb_substr($item['city'], -1, 1, 'UTF-8');
            if ($lastKey == '市') {
                $item['city'] = mb_substr($item['city'], 0, -1, 'UTF-8');
            }
        }

        unset($item);
        unset($key);
        $str = "";
        foreach ($alias as $key => $item) {
            $str .= "\"" . $item['city'] . '_' . $item['district'] . '" => ["' . $item['district'] . '","' . $item['district_alias'] . '"],' . "\n\t\t";
        }

        file_put_contents('./alias.txt', $str);
    }
}



$task = new DiffPCD();
$task->handleAlias();



