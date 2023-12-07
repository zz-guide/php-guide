<?php

//use Zink\Db\DB;
//use Zink\Widget\Json;

ini_set("display_errors", "On");
error_reporting(E_ALL);
ini_set('date.timezone','Asia/Shanghai');
ini_set('memory_limit', '-1');

class diff
{
    public function _read2018BaiDuMapJson()
    {
        $json_string = file_get_contents('./2018baidumap.json');
        return json_decode($json_string, true);
    }

    public function _read2020BaiDuMapJson()
    {
        $json_string = file_get_contents('./2020baidumap.json');
        return json_decode($json_string, true);
    }

    /**
     * 查询2020年数据在2018中不存在的省市区
     */
    public function run1()
    {
        $data2018 = $this->_read2018BaiDuMapJson();
        $data2020 = $this->_read2020BaiDuMapJson();

        $change = [];

        $keyMap2018 = [];
        foreach ($data2018 as $item) {
            $k = "{$item['province']}{$item['city']}{$item['district']}";
            $keyMap2018[$k] = 1;
        }

        $k = "";
        $isExists = [];
        foreach ($data2020 as $item1) {
            if (in_array($item1['province'], ["香港", "澳门", "台湾省"])) {
                continue;
            }

            $k = "{$item1['province']}{$item1['city']}{$item1['district']}";

            if (!isset($keyMap2018[$k]) && !isset($isExists[$k])) {
                $isExists[$k] = 1;
                $change[] = $item1;
            }
        }

        file_put_contents("./data/2020有2018无change.json", json_encode($change, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        echo "2020有2018无数量：" . count($change) . "执行完毕!!!\n";
    }

    /**
     * 查询2018年数据在2020中不存在的省市区
     */
    public function run2()
    {
        $data2018 = $this->_read2018BaiDuMapJson();
        $data2020 = $this->_read2020BaiDuMapJson();

        $change = [];

        $keyMap2020 = [];
        foreach ($data2020 as $item) {
            $k = "{$item['province']}{$item['city']}{$item['district']}";
            $keyMap2020[$k] = 1;
        }

        $k = "";
        $isExists = [];
        foreach ($data2018 as $item1) {
            if (in_array($item1['province'], ["香港", "澳门", "台湾省"])) {
                continue;
            }

            $k = "{$item1['province']}{$item1['city']}{$item1['district']}";

            if (!isset($keyMap2020[$k]) && !isset($isExists[$k])) {
                $isExists[$k] = 1;
                $change[] = $item1;
            }
        }

        file_put_contents("./data/2018有2020无的change.json", json_encode($change, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));

        $sql = "SELECT * FROM `agent_region` where  ";
        foreach ($change as $key => $ci) {
            $p = $this->_filterPC($ci['province']);
            $c = $this->_filterPC($ci['city']);
            $d = $ci['district'];
            if ($key == count($change) - 1) {
                $sql .= "(`province` = '{$p}' and `city` = '{$c}' and `district`= '{$d}')";
            } else {
                $sql .= "(`province` = '{$p}' and `city` = '{$c}' and `district`= '{$d}') OR ";
            }
        }

        file_put_contents("./data/2018有2020无的查询sql.json", json_encode($sql, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        echo "2018有2020无的数量：" . count($change) . "执行完毕!!!\n";
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

    /**
     * 查询2018年数据在2020中不存在的省市
     */
    public function run3()
    {
        $data2018 = $this->_read2018BaiDuMapJson();
        $data2020 = $this->_read2020BaiDuMapJson();

        $change = [];

        $keyMap2020 = [];
        foreach ($data2020 as $item) {
            $k = "{$item['province']}{$item['city']}";
            $keyMap2020[$k] = 1;
        }

        $k = "";
        $isExists = [];
        foreach ($data2018 as $item1) {
            if (in_array($item1['province'], ["香港", "澳门", "台湾省"])) {
                continue;
            }

            $k = "{$item1['province']}{$item1['city']}";

            if (!isset($keyMap2020[$k]) && !isset($isExists[$k])) {
                $isExists[$k] = 1;
                $change[] = $item1;
            }
        }

        file_put_contents("./data/2018有2020省市的省市change.json", json_encode($change, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        echo "2018有2020无省市的数量：" . count($change) . "执行完毕!!!\n";
    }

    /**
     * 查询2020年数据在2018中不存在的省市
     */
    public function run4()
    {
        $data2018 = $this->_read2018BaiDuMapJson();
        $data2020 = $this->_read2020BaiDuMapJson();

        $change = [];

        $keyMap2018 = [];
        foreach ($data2018 as $item) {
            $k = "{$item['province']}{$item['city']}";
            $keyMap2018[$k] = 1;
        }

        $k = "";
        $isExists = [];
        foreach ($data2020 as $item1) {
            if (in_array($item1['province'], ["香港", "澳门", "台湾省"])) {
                continue;
            }

            $k = "{$item1['province']}{$item1['city']}";

            if (!isset($keyMap2018[$k]) && !isset($isExists[$k])) {
                $isExists[$k] = 1;
                $change[] = $item1;
            }
        }

        file_put_contents("./data/2020有2018无省市的change.json", json_encode($change, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        echo "2020有2018无省市的数量：" . count($change) . "执行完毕!!!\n";
    }

    /*public function run()
    {
        $data = Json::json2array(file_get_contents("./logs/2020完整.json"));
        $result = [];
        foreach ($data as $item) {
            $tmp = [
                $item['province'],
                $item['city'],
                $item['district'],
                $item['town'],
                $item['province_code'],
                $item['city_code'],
                $item['district_code'],
                $item['town_code'],
            ];
            $result[] = '("' . implode('","', $tmp) . '")';
        }

        $result = implode(",", $result);
        $sql = "INSERT INTO `pcd` (`province`,`city`,`district`,`town`,`province_code`,`city_code`,`district_code`,`town_code`) VALUES {$result}";
        $db = DB::create("pcd");
        $db->runSql($sql);

        echo "执行成功！！！\n";
    }*/
}



$task = new diff();
//$task->run1();
$task->run2();
//$task->run3();
//$task->run4();



