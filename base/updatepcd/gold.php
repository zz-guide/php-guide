<?php
/**
 * 将百度更新的省市区信息清洗成业务需要的数据，包含前后端以及数据库
 */
ini_set("display_errors", "On");
error_reporting(E_ALL);
ini_set('date.timezone','Asia/Shanghai');
ini_set('memory_limit', '-1');

class Gold
{
    protected function _createFile($filename, $data)
    {
        file_put_contents("./log/" . $filename, json_encode($data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    }

    protected function _read2018BaiDuMapJson()
    {
        $json_string = file_get_contents('./2018baidumap.json');
        return json_decode($json_string, true);
    }

    protected function _readAssocPcd()
    {
        $json_string = file_get_contents('./log/关联pcd.json');
        return json_decode($json_string, true);
    }

    protected function _readPcdJson()
    {
        $json_string = file_get_contents('./log/province-city-district.json');
        return json_decode($json_string, true);
    }

    protected function _read2020BaiDuMapJson()
    {
        $json_string = file_get_contents('./2020baidumap.json');
        return json_decode($json_string, true);
    }

    protected function _readSort2020BaiDuMapJson()
    {
        //$json_string = file_get_contents('./log/sort2020baidumap.json');
        $json_string = file_get_contents('./data/sort-province-city-district.json');
        return json_decode($json_string, true);
    }

    protected function _readFrontPCJson()
    {
        $json_string = file_get_contents('./log/province-city.json');
        return json_decode($json_string, true);
    }

    protected function _readFrontPCDJson()
    {
        $json_string = file_get_contents('./log/province-city-district.json');
        return json_decode($json_string, true);
    }

    private function _sortArrByManyField()
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

    private function _provinceContinue($province)
    {
        return in_array($province, ["台湾", "香港", "澳门"]);
    }

    /**
     * 格式化成关联数组省市区三级联动数据
     */
    public function toAssocPCD()
    {
        $newData = $this->_readSort2020BaiDuMapJson();
        $data = [];

        $k = [];
        foreach ($newData as $item) {
            $p = $this->_filterPC($item['province']);
            $c = $this->_filterPC($item['city']);
            $d = $item['district'];

            if ($this->_provinceContinue($p) || isset($k["{$p}{$c}{$d}"])) {
                continue;
            }

            $k["{$p}{$c}{$d}"] = 1;

            if (!isset($data[$p])) {
                $data[$p] = [
                    'label' => $p,
                    'value' => $p,
                    'children' => []
                ];
            }

            if (!isset($data[$p]['children'][$c])) {
                $data[$p]['children'][$c] = [
                    'label' => $c,
                    'value' => $c,
                    'children' => []
                ];
            }
            $data[$p]['children'][$c]['children'][] = [
                'label' => $d,
                'value' => $d
            ];
        }

        $this->_createFile('关联pcd.json', $data);

        echo "执行完毕\n";
    }

    /**
     * 格式化成省市区三级联动数据
     */
    public function toPCDJson()
    {
        $newData = $this->_readAssocPcd();
        $data = [];
        foreach ($newData as $provinceItem) {
            $provinceChildren = [];
            foreach ($provinceItem['children'] as $cityItem) {
                $provinceChildren[] = $cityItem;
            }

            $data[] = [
                "label" => $provinceItem["value"],
                "value" => $provinceItem["value"],
                "children" => $provinceChildren
            ];
        }

        $result = [
            "errcode" => 200,
            "errmsg"  => "请求成功",
            "data"    => $data
        ];

        //到此为止，前端的省市区json数据生成完毕,排序的话自己手动修改一下即可，或者一会儿解决
        $this->_createFile('1-province-city-district.json', $result);

        echo "执行完毕\n";
    }

    /**
     * 格式化成省市二级联动数据
     */
    public function toPCJson()
    {
        $newData = $this->_readPcdJson();
        foreach ($newData["data"] as &$provinceItem) {
            foreach ($provinceItem['children'] as &$cityItem) {
                unset($cityItem['children']);
            }
        }

        //到此为止，前端的省市json数据生成完毕
        $this->_createFile('province-city.json', $newData);

        echo "执行完毕\n";
    }

    /***************************************以下代码生成php中需要的数据****************************************/

    /**
     * 生成city_district数据
     */
    public function createPhpCD()
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

$task = new Gold();
//$task->toAssocPCD();
//$task->toPCDJson();
//$task->toPCJson();
//$task->createPhpCD();