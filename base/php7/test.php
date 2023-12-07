<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/18
 * Time: 20:07
 */

// 1. 标量类型的声明:强制(默认)和严格模式,参数类型, string,int,float,bool
// 需要注意的地方:传入的类型不对的话会自动隐式转换为合适的值,而且不会报错
// ...运算符

//function test(int ...$ints)
//{
//    var_dump($ints);die;
//    return array_sum($ints);
//}
//
//var_dump(test(2, '3', 4.1));

// 2.返回值类型声明

//function arraysSum(array ...$arrays)
//{
//    return array_map(function(array $array): int {
//        return array_sum($array);
//    }, $arrays);
//}
//
//print_r(arraysSum([1,2,3], [4,5,6], [7,8,9]));


// 3.null合并运算符,由于日常使用中存在大量同时使用三元表达式和 isset()的情况，
// 我们添加了null合并运算符 (??) 这个语法糖。如果变量存在且值不为NULL， 它就会返回自身的值，否则返回它的第二个操作数。
// ?? 适合用于判断数组取值, 判断变量还是利用普通的三元运算符比较好,并且,除了null其他的都会被认为是存在

//$a = ['s' => ''];
//$b = $a['s'] ?? '没有';
//var_dump($b);
//var_dump($a);

// 4.太空船操作符（组合比较符）,太空船操作符用于比较两个表达式。当$a小于、等于或大于$b时它分别返回-1、0或1。 比较的原则是沿用 PHP 的常规比较规则进行的。
// []<=>null 0, [] <=> '' 1, [] <=>0 1, '' <=> 0 0, null <=> 0 0
//$a = null;
//$b = 0;
//echo $a <=> $b;


// 5.通过 define() 定义常量数组
//Array 类型的常量现在可以通过 define() 来定义。在 PHP5.6 中仅能通过 const 定义。也就是说5.6中可以通过const定义常量数组
//define('ANIMALS', [
//    'dog',
//    'cat',
//    'bird'
//]);
//
//var_dump(ANIMALS);

// 6.匿名类,现在支持通过new class 来实例化一个匿名类，这可以用来替代一些“用后即焚”的完整类定义。

//interface Logger {
//    public function log(string $msg);
//}
//
//class Application {
//    private $logger;
//
//    public function getLogger(): Logger
//    {
//        return $this->logger;
//    }
//
//    public function setLogger(Logger $logger) {
//        $this->logger = $logger;
//    }
//}
//
//$app = new Application;
////object(class@anonymous)#2 (0) { }
//$app->setLogger(new class implements Logger {
//    public function log(string $msg) {
//        echo $msg;
//    }
//});
//
//$app->getLogger()->log('我是许磊');


// 7. Unicode codepoint 转译语法
//echo "\u{aa}";
//echo "\u{0000aa}";
//echo "\u{9999}";

// 8.Closure::call()
//class A {private $x = 1;}
//
//// PHP 7 之前版本的代码
//$getXCB = function() {return $this->x;};
//$getX = $getXCB->bindTo(new A, 'A'); // 中间层闭包
//echo $getX();
//echo "<br>";
//// PHP 7+ 及更高版本的代码
//$getX = function() {return $this->x;};
//echo $getX->call(new A);

// 9. 为unserialize()提供过滤,这个特性旨在提供更安全的方式解包不可靠的数据。它通过白名单的方式来防止潜在的代码注入。

// 将所有的对象都转换为 __PHP_Incomplete_Class 对象
//$data = unserialize($foo, ["allowed_classes" => false]);

// 将除 MyClass 和 MyClass2 之外的所有对象都转换为 __PHP_Incomplete_Class 对象
//$data = unserialize($foo, ["allowed_classes" => ["MyClass", "MyClass2"]);

// 默认情况下所有的类都是可接受的，等同于省略第二个参数
//$data = unserialize($foo, ["allowed_classes" => true]);

// 10.IntlChar,新增加的 IntlChar 类旨在暴露出更多的 ICU 功能。这个类自身定义了许多静态方法用于操作多字符集的 unicode 字符。
//printf('%x', IntlChar::CODEPOINT_MAX);
//echo IntlChar::charName('@');
//var_dump(IntlChar::ispunct('!'));

// 11.assert
//ini_set('assert.exception', 1);

//class CustomError extends AssertionError {}
//
//assert(false, new CustomError('Some error message'));


// 12.Group use declarations
//从同一 namespace 导入的类、函数和常量现在可以通过单个 use 语句 一次性导入了。

// PHP 7 之前的代码
//use some\namespace\ClassA;
//use some\namespace\ClassB;
//use some\namespace\ClassC as C;
//
//use function some\namespace\fn_a;
//use function some\namespace\fn_b;
//use function some\namespace\fn_c;
//
//use const some\namespace\ConstA;
//use const some\namespace\ConstB;
//use const some\namespace\ConstC;
//
//// PHP 7+ 及更高版本的代码
//use some\namespace\{ClassA, ClassB, ClassC as C};
//use function some\namespace\{fn_a, fn_b, fn_c};
//use const some\namespace\{ConstA, ConstB, ConstC};

// 13.生成器可以返回表达式

//$gen = (function() {
//    yield 1;
//    yield 2;
//
//    return 3;
//})();
//
//foreach ($gen as $val) {
//    echo $val, PHP_EOL;
//}

//echo $gen->getReturn(), PHP_EOL;

//在生成器中能够返回最终的值是一个非常便利的特性， 因为它使得调用生成器的客户端代码可以直接得到生成器（或者其他协同计算）的返回值， 相对于之前版本中客户端代码必须先检查生成器是否产生了最终的值然后再进行响应处理 来得方便多了。

// 14.Generator delegation 生成器委派,现在，只需在最外层生成其中使用 yield from， 就可以把一个生成器自动委派给其他的生成器， Traversable 对象或者 array。
//function gen()
//{
//    yield 1;
//    yield 2;
//
//    yield from gen2();
//}
//
//function gen2()
//{
//    yield 3;
//    yield 4;
//}
//
//foreach (gen() as $val)
//{
//    echo $val, PHP_EOL;
//}

// 15.新加的函数 intdiv() 用来进行 整数的除法运算。目前不清楚这样做的目的是什么
//var_dump(intdiv(10, 4));
//var_dump(10 % 4);

// 16. 会话选项,session_start() 可以接受一个 array 作为参数， 用来覆盖 php.ini 文件中设置的 会话配置选项。
//在调用 session_start() 的时候， 传入的选项参数中也支持 session.lazy_write 行为， 默认情况下这个配置项是打开的。它的作用是控制 PHP 只有在会话中的数据发生变化的时候才 写入会话存储文件，如果会话中的数据没有发生改变，那么 PHP 会在读取完会话数据之后， 立即关闭会话存储文件，不做任何修改，可以通过设置 read_and_close 来实现。
//
//例如，下列代码设置 session.cache_limiter 为 private，并且在读取完毕会话数据之后马上关闭会话存储文件。

//session_start([
//    'cache_limiter' => 'private',
//    'read_and_close' => true,
//]);

// 17. preg_replace_callback_array()
//在 PHP 7 之前，当使用 preg_replace_callback() 函数的时候， 由于针对每个正则表达式都要执行回调函数，可能导致过多的分支代码。 而使用新加的 preg_replace_callback_array() 函数， 可以使得代码更加简洁。
//现在，可以使用一个关联数组来对每个正则表达式注册回调函数， 正则表达式本身作为关联数组的键， 而对应的回调函数就是关联数组的值。


// 18.新加入两个跨平台的函数： random_bytes() 和 random_int() 用来产生高安全级别的随机字符串和随机整数。
//laravel框架中用于生产随机字符串的函数就是用的这个

// 19.可以使用 list() 函数来展开实现了 ArrayAccess 接口的对象
//在之前版本中，list() 函数不能保证 正确的展开实现了 ArrayAccess 接口的对象， 现在这个问题已经被修复。

// 20.允许在克隆表达式上访问对象成员，例如： (clone $foo)->bar()。之前在5.6测试过不可以这样写


// 21. 重点同时也是不想后兼容的部分:异常处理
//在之前版本中，如果内部类的构造器出错，会返回 NULL或者一个不可用的对象。 从 PHP 7 开始，如果内部类构造器发生错误， 那么会抛出异常
//解析错误会抛出 ParseError 异常
//解析错误会抛出 ParseError 异常。 对于 eval() 函数，需要将其包含到一个 catch 代码块中来处理解析错误。
//原有的 E_STRICT 警告都被迁移到其他级别。 E_STRICT 常量会被保留，所以调用 error_reporting(E_ALL|E_STRICT) 不会引发错误。

//Error 异常层次结构
//◦Throwable◦Error◦ArithmeticError
//◦AssertionError
//◦DivisionByZeroError
//◦ParseError
//◦TypeError
//
//◦Exception

//PHP 7 改变了大多数错误的报告方式。不同于 PHP 5 的传统错误报告机制，现在大多数错误 被作为 Error 异常抛出。
//
//这种 Error 异常可以像普通异常一样被 try / catch块所捕获。如果没有匹配的 try / catch 块， 则调用异常处理函数（由 set_exception_handler() 注册）进行处理。 如果尚未注册异常处理函数，则按照传统方式处理：被报告为一个致命错误（Fatal Error）。
//
//Error 类并不是从 Exception 类 扩展出来的，所以用 catch (Exception $e) { ... } 这样的代码是捕获不 到 Error 的。你可以用 catch (Error $e) { ... } 这样的代码，或者通过注册异常处理函数（ set_exception_handler()）来捕获 Error。

















































// 22.foreach的变化
//php7之后foreach不再改变内部数组指针

//$array = [0, 1, 2];
//foreach ($array as &$val) {
//    var_dump(current($array));
//}
//foreach 通过值遍历时，操作的值为数组的副本
//当默认使用通过值遍历数组时，foreach 实际操作的是数组的迭代副本，而非数组本身。这就意味着，foreach 中的操作不会修改原数组的值。
//当使用引用遍历数组时，现在 foreach 在迭代中能更好的跟踪变化。例如，在迭代中添加一个迭代值到数组中，参考下面的代码

//在PHP5版本中是不可以在迭代的时候添加值的
//$array = [0];
//foreach ($array as &$val) {
//    var_dump($val);
//    $array[1] = 1;
//}



// 23.十六进制字符串不再被认为是数字,着与5版本有着很大的不同
//var_dump("0x123" == "291");
//var_dump(is_numeric("0x123"));
//var_dump("0xe" + "0x1");
//var_dump(substr("foo", "0x1"));

//filter_var() 函数可以用于检查一个 string 是否含有十六进制数字,并将其转换为integer:
//$str = "0xffff";
//$int = filter_var($str, FILTER_VALIDATE_INT, FILTER_FLAG_ALLOW_HEX);
//if (false === $int) {
//    throw new Exception("Invalid integer!");
//}
//var_dump($int); // int(65535)

//24.被移除的函数
//call_user_method() and call_user_method_array(),这两个函数从PHP 4.1.0开始被废弃，应该使用call_user_func() 和 call_user_func_array()。 你也可以考虑使用 变量函数 或者 ...操作符。
//
//mcrypt aliases
//
//已废弃的 mcrypt_generic_end() 函数已被移除，请使用mcrypt_generic_deinit()代替。
//
//此外，已废弃的 mcrypt_ecb(), mcrypt_cbc(), mcrypt_cfb() 和 mcrypt_ofb() 函数已被移除，请配合恰当的MCRYPT_MODE_* 常量来使用 mcrypt_decrypt()进行代替。
//
//
//intl aliases
//
//已废弃的 datefmt_set_timezone_id() 和 IntlDateFormatter::setTimeZoneID() 函数已被移除，请使用 datefmt_set_timezone() 与 IntlDateFormatter::setTimeZone()代替。
//
//
//set_magic_quotes_runtime()
//
//set_magic_quotes_runtime(), 和它的别名 magic_quotes_runtime()已被移除. 它们在PHP 5.3.0中已经被废弃,并且 在in PHP 5.4.0也由于魔术引号的废弃而失去功能。
//
//
//set_socket_blocking()
//
//已废弃的 set_socket_blocking()函数已被移除，请使用stream_set_blocking()代替。
//
//
//dl() in PHP-FPM
//
//dl()在 PHP-FPM 不再可用，在 CLI 和 embed SAPIs 中仍可用。

// 25.new 操作符创建的对象不能以引用方式赋值给变量
//class C {}
//$c =& new C;

// 26.从不匹配的上下文发起调用

//在不匹配的上下文中以静态方式调用非静态方法， 在 PHP 5.6 中已经废弃， 但是在 PHP 7.0 中， 会导致被调用方法中未定义 $this 变量，以及此行为已经废弃的警告。
//
//class A {
//    public function test() { var_dump($this); }
//}
//
//// 注意：并没有从类 A 继承
//class B {
//    public function callNonStaticMethodOfA() { A::test(); }
//}
//
//(new B)->callNonStaticMethodOfA();


// 27.yield 变更为右联接运算符

//在使用 yield 关键字的时候，不再需要括号， 并且它变更为右联接操作符，其运算符优先级介于 print 和 => 之间。 这可能导致现有代码的行为发生改变：
//echo yield -1;
//// 在之前版本中会被解释为：
//echo (yield) - 1;
//// 现在，它将被解释为：
//echo yield (-1);
//
//yield $foo or die;
//// 在之前版本中会被解释为：
//yield ($foo or die);
//// 现在，它将被解释为：
//(yield $foo) or die;

// 28.变更的函数
//debug_zval_dump() 现在打印 "int" 替代 "long", 打印 "float" 替代 "double"
//◦dirname() 增加了可选的第二个参数, depth, 获取当前目录向上 depth 级父目录的名称。
//◦getrusage() 现在支持 Windows.
//◦mktime() and gmmktime() 函数不再接受 is_dst 参数。
//◦preg_replace() 函数不再支持 "\e" (PREG_REPLACE_EVAL). 应当使用 preg_replace_callback()替代。
// ◦setlocale() 函数不再接受 category传入字符串。 应当使用 LC_* 常量。
//◦exec(), system() and passthru()函数对 NULL 增加了保护.


// 29.新增加的函数
//Math
//◦intdiv()

//Closure
//◦Closure::call()
//
//
//CSPRNG
//◦random_bytes()
//◦random_int()
//
//
//Error Handling and Logging
//◦error_clear_last()

//Reflection
//◦ReflectionParameter::getType()
//◦ReflectionParameter::hasType()
//◦ReflectionFunctionAbstract::getReturnType()
//◦ReflectionFunctionAbstract::hasReturnType()


// 30.移除的Removed Extensions and SAPIs


//Removed Extensions
//◦ ereg
//◦ mssql
//◦ mysql
//◦ sybase_ct
//
//
//Removed SAPIs
//◦ aolserver
//◦ apache
//◦ apache_hooks
//◦ apache2filter
//◦ caudium
//◦ continuity
//◦ isapi
//◦ milter
//◦ nsapi
//◦ phttpd
//◦ pi3web
//◦ roxen
//◦ thttpd
//◦ tux
//◦ webjames

