<?php
/**
 *
 * 该类用于快速生成mysql测试数据，可自行添加需要的测试数据种类，经过测试，5分钟3000万数据，要求本地需要安装mysql-client
 * select PARTITION_NAME as "分区",TABLE_ROWS as "行数" from information_schema.partitions where table_schema="test" and table_name="test_11";
 *
 * @author:  leixu
 * @version: 1.0.0
 * @change:
 *    1. 2019/10/23 leixu: 创建；
 */

ini_set('memory_limit', '-1');
set_time_limit(0);
ini_set("display_errors", "On");
ini_set('date.timezone', 'Asia/Shanghai');
error_reporting(E_ALL);

require('./RandChinaName.php');

/*
 * 步骤：
 *      1.创建存放sql的目录：表名+collections
 *      2.设置sql最大传输包，防止被mysql cli截断，max_allowed_packet=
 *      3.设定多少行数据一个文件，比如100万
 *      4.可以利用多goroutine 创建文件并写入sql,加快速度
 *      5.执行mysql cli导入
 *      6.字段映射采取配置文件，灵活多变
 *      7.再加一个生成mysql表创建语句的方法，放在一个目录下
 *      8.
 *
 *
 * */
class BatchCreateInsert
{
    const USER = 'root';
    const PASSWORD = '123456';
    const DB_NAME = 'test';
    const TABLE_NAME = 'student1';                   //表名
    const COUNT = 1000000;                           //一次多少条记录

    const SQL_FILE_PATH = "./" . self::TABLE_NAME . "_collections/"; //sql文件路径
    const MAX_ALLOWED_PACKET = 1024 * 1024 * 1024;    //1G

    const FILE_NAME = self::TABLE_NAME;              //sql文件表名
    const SUFFIX = ".sql";                           //sql文件后缀

    protected $_baseSql = '';
    protected $_errMsg = '成功';

    protected $_currentIndex = 1;
    protected $_currentSqlArray = [];
    protected $_fieldConfig = [];

    //第三方生成数据的类
    protected $_randNameInstance = null;

    public function __construct()
    {
        $this->_fieldConfig = $this->getFieldConfig();
        $this->_randNameInstance = new RandChinaName();
        $this->_baseSql = sprintf("INSERT INTO `%s`(`%s`) VALUES", self::TABLE_NAME, implode('`,`', $this->getColumnName()));
    }

    protected function _setErrMsg($msg = '')
    {
        $this->_errMsg = $msg;
        echo "\033[31m 信息：，{$this->_errMsg} \033[0m";
        return false;
    }

    public function getErrMsg()
    {
        return $this->_errMsg;
    }

    public function getFieldConfig()
    {
        return require_once("./field.php");
    }

    public function getColumnName()
    {
        return array_keys($this->_fieldConfig);
    }

    public function run($num)
    {
        $num = $num <= 0 ? 1 : $num;
        if (!$this->_createSqlDir()) {
            return false;
        }

        for ($i = 1; $i <= $num; $i++) {
            $this->_currentIndex = $i;
            $this->_buildSqlContent();
        }

        return $this->importSqlFile();
    }

    public static function getRandInt()
    {
        $ageArray = [21, 22, 23, 24, 25, 26, 27, 28, 29];
        return $ageArray[array_rand($ageArray, 1)];
    }

    public function getRandVarchar($pad = true)
    {
        $name = $this->_randNameInstance->rndChinaName(2);
        return $pad ? "'{$name}'" : $name;
    }

    protected function _buildSqlContent()
    {
        $this->_currentSqlArray = [];
        $range = range(1, self::COUNT);
        foreach ($range as $key => $value) {
            $this->_currentSqlArray[] = $this->_createRowData();
        }

        $this->_createSqlFile($this->_createSqlFileName(), $this->_createSqlContent());
    }

    protected function _createRowData()
    {
        $tmp = [];
        foreach ($this->_fieldConfig as $column => $config) {
            if ($config['type'] == 'varchar') {
                $tmp[] = $this->getRandVarchar();
            } else if ($config['type'] == 'int') {
                $tmp[] = self::getRandInt();
            }
        }

        return "(" . implode(',', $tmp) . ")";
    }

    protected function _createSqlFileName()
    {
        return self::SQL_FILE_PATH . self::FILE_NAME . $this->_currentIndex . self::SUFFIX;
    }

    protected function _createSqlContent()
    {
        return $this->_baseSql . implode(',', $this->_currentSqlArray) . ";";
    }

    protected function _createSqlFile($fileName, $content)
    {
        file_put_contents($fileName, "SET GLOBAL max_allowed_packet=" . self::MAX_ALLOWED_PACKET . ";\n", FILE_APPEND);
        file_put_contents($fileName, "SET character set utf8;\n", FILE_APPEND);
        file_put_contents($fileName, $content, FILE_APPEND);
    }

    protected function _createSqlDir()
    {
        if (is_dir(self::SQL_FILE_PATH)) {
            return $this->_setErrMsg("对不起！目录" . self::SQL_FILE_PATH . "已经存在！请更换目录");
        }

        $res = mkdir(self::SQL_FILE_PATH, 0777, true);
        if (!$res) {
            return $this->_setErrMsg("目录" . self::SQL_FILE_PATH . "创建失败");
        }

        return true;
    }

    public function getImportSqlFileNameArray()
    {
        $fileArray = scandir(self::SQL_FILE_PATH);
        if (!$fileArray) {
            $this->_setErrMsg('解析目录文件名失败');
            return [];
        }

        $fileArray = array_filter($fileArray, function ($v, $k) {
            return $v != '.' && $v != '..' && $v != '';
        }, ARRAY_FILTER_USE_BOTH);

        return $fileArray;
    }

    public function importSqlFile()
    {
        $fileArray = $this->getImportSqlFileNameArray();
        foreach ($fileArray as $fileName) {
            $this->_importLocalDocker(self::SQL_FILE_PATH . $fileName);
        }

        return true;
    }

    protected function _importLocalDocker($filePath)
    {
        $containerName = 'laradock_mysql_1';
        $cmd = sprintf("docker exec -i %s mysql -u%s -p%s -D %s < %s 2>/dev/null", $containerName, self::USER, self::PASSWORD, self::DB_NAME, $filePath);
        echo "\033[33m 当前正在执行{$filePath}中！请等待。。。\n \033[0m";
        shell_exec($cmd);
    }
}

/**
 * 计算程序执行时间
 * @param callable $callback
 */
function traceTime(callable $callback)
{
    $startTime = explode(' ', microtime());
    $callback();
    $endTime = explode(' ', microtime());
    $diffTime = ($endTime[0] + $endTime[1]) - ($startTime[0] + $startTime[1]);
    echo "\e[31m 本网页执行耗时：" . round($diffTime, 3) . " 秒。" . time() . "\e[0m";
}


$num = 100;
$task = new BatchCreateInsert();
traceTime(function () use ($task, $num) {
    $task->run($num);
});