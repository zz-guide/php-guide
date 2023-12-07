<?php
/**
 * 清洗顺丰地区数据内容
 */
ini_set("display_errors", "On");
error_reporting(E_ALL);
ini_set('date.timezone','Asia/Shanghai');
ini_set('memory_limit', '-1');

class Test
{
    protected function _createFile($filename, $data)
    {
        file_put_contents("./log1/" . $filename, json_encode($data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    }

    protected function _readPcd()
    {
        $json_string = file_get_contents('./pcd.json');
        return json_decode($json_string, true);
    }

    protected function _readMyPcd()
    {
        $json_string = file_get_contents('./my-pcd.json');
        return json_decode($json_string, true);
    }

    public function run()
    {
        $newData = $this->_readMyPcd();

        $cdData = [];
        foreach ($newData["data"] as $provinceItem) {
            foreach ($provinceItem['children'] as $cityItem) {
                foreach ($cityItem["children"] as $city) {
                    $key = "{$provinceItem['value']}-{$cityItem['value']}-{$city['value']}";
                    $cdData[$key] = ['province' => $provinceItem['value'], 'city' => $cityItem['value'], 'district' => $city['value']];
                }
            }
        }

        $newData1 = $this->_readPcd();
        $cdData1 = [];
        foreach ($newData1 as $provinceItem) {
            foreach ($provinceItem['city'] as $cityItem) {
                foreach ($cityItem["county"] as $city) {

                    $p = $this->_filterPC($provinceItem['fullName']);
                    $c = $this->_filterPC($cityItem['fullName']);

                    $key = "{$p}-{$c}-{$city['fullName']}";
                    $cdData1[$key] = 1;
                    $cdData1[$key] = ['province' => $p, 'city' => $c, 'district' => $city['fullName']];
                }
            }
        }


        $diff1 = [];
        foreach ($cdData1 as $a => $b) {
            if (!isset($cdData[$a])) {
                $diff1[] = $b;
            }
        }

        $diff2 = [];
        foreach ($cdData as $a => $b) {
            if (!isset($cdData1[$a])) {
                $diff2[] = $b;
            }
        }


        print_r(count($diff1));
//        $this->_createFile('顺丰有-咱无.json', $diff1);
//        $this->_createFile('顺丰无-咱有.json', $diff2);
    }

    public function run1()
    {
        $newData = $this->_readMyPcd();

        $cdData = [];
        foreach ($newData["data"] as $provinceItem) {
            foreach ($provinceItem['children'] as $cityItem) {
                foreach ($cityItem["children"] as $city) {
                    $key = "{$provinceItem['value']}-{$cityItem['value']}}";
                    $cdData[$key] = ['province' => $provinceItem['value'], 'city' => $cityItem['value']];
                }
            }
        }

        $newData1 = $this->_readPcd();
        $cdData1 = [];
        foreach ($newData1 as $provinceItem) {
            foreach ($provinceItem['city'] as $cityItem) {
                foreach ($cityItem["county"] as $city) {

                    $p = $this->_filterPC($provinceItem['fullName']);
                    $c = $this->_filterPC($cityItem['fullName']);

                    $key = "{$p}-{$c}}";
                    $cdData1[$key] = 1;
                    $cdData1[$key] = ['province' => $p, 'city' => $c];
                }
            }
        }


        $diff1 = [];
        foreach ($cdData1 as $a => $b) {
            if (!isset($cdData[$a])) {
                $diff1[] = $b;
            }
        }

        $diff2 = [];
        foreach ($cdData as $a => $b) {
            if (!isset($cdData1[$a])) {
                $diff2[] = $b;
            }
        }

        $this->_createFile('顺丰有-咱无.json', $diff1);
        $this->_createFile('顺丰无-咱有.json', $diff2);
    }

    /**
     * 过滤'省'和'市'字样
     * @param $value
     * @return string
     */
    private function _filterPC($value)
    {
        $name = mb_substr($value, -1, 1, 'UTF-8');
        if ($name == '省' || $name == '市') {
            return mb_substr($value, 0, -1, 'UTF-8');
        }

        return $value;
    }

    public function createNewPCD()
    {
        $newData1 = $this->_readPcd();
        $data = [];
        foreach ($newData1 as $key => &$provinceItem) {
            $data[$key] = [
                'label' => $this->_filterPC($provinceItem['fullName']),
                'value' => $this->_filterPC($provinceItem['fullName']),
                'children' => []
            ];
            foreach ($provinceItem['city'] as $key1 => &$cityItem) {
                $data[$key]['children'][$key1] = [
                    'label' => $this->_filterPC($cityItem['fullName']),
                    'value' => $this->_filterPC($cityItem['fullName']),
                    'children' => []
                ];
                foreach ($cityItem["county"] as $key2 => $city) {
                    $data[$key]['children'][$key1]['children'][$key2] = [
                        'label' => $city['fullName'],
                        'value' => $city['fullName'],
                    ];
                }
            }
        }

        $result = [
            "errcode" => 200,
            "errmsg"  => "请求成功",
            "data"    => $data
        ];

        //到此为止，前端的省市区json数据生成完毕,排序的话自己手动修改一下即可，或者一会儿解决
        $this->_createFile('1-province-city-district.json', $result);
    }

    protected function _readFrontPCDJson()
    {
        $json_string = file_get_contents('./log1/1-province-city-district.json');
        return json_decode($json_string, true);
    }

    public function createCity2DistrictData()
    {
        $newData = $this->_readFrontPCDJson();

        $cdData = [];
        foreach ($newData["data"] as $provinceItem) {
            foreach ($provinceItem['children'] as $cityItem) {
                foreach ($cityItem["children"] as $city) {
                    $cdData[$cityItem["value"]][] = $city["value"];
                }
            }
        }

        $str = "";
        foreach ($cdData as $key => $item) {
            $tmp = "\"" . join("\",\"", $item) . "\"";
            $str .= "\"" . $key . '" => [' . $tmp . '],' . "\n\t\t";
        }

        file_put_contents("./log/cityCounties.txt", $str);
        echo "执行完毕\n";
    }
}

$task = new Test();
//$task->run();
//$task->run1();
//$task->createNewPCD();
$task->createCity2DistrictData();