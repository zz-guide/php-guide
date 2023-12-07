<?php
/**
 *
 * @author:  leixu
 * @version: 1.5.0
 * @change:
 *    1. 2019/12/26 leixu: 创建；
 */

$cfg = require("./group.php");

$group = "/student/index";
echo "<pre>";

$groupActions = [];
if (isset($cfg[$group])) {
    $groupActions = getNestingGroupActions($group, $cfg);
}

/**
 * 通过menu文件的一个子menu递归的获取action_group中的权限
 * [
 *      "action1" => [
 *         "action2",
 *         "action3"
 *      ],
 *      "action2" => [
 *         "action4",
 *         "action5"
 *      ],
 *      "action4" => [
 *         "action6"
 *      ]
 * ]
 *
 * @param string $menu 子menu
 * @param array $groupList action_group文件require后的值
 * @return array
 */
function getNestingGroupActions($menu, array $groupList = [])
{
    if (!$groupList || !$menu) {
        return [];
    }

    _getNestingGroupActions($menu, $groupList, $groupActions);
    return array_keys($groupActions);
}

function _getNestingGroupActions($menu, array $groupList = [], &$groupActions = [])
{
    foreach ($groupList[$menu] as $action) {
        // 如果已经查找过该action了，则跳过本次循环
        if (isset($groupActions[$action])) {
            continue;
        }

        // 拥有该权限
        $groupActions[$action] = 1;
        // 如果是嵌套action定义，进行递归处理
        if (isset($groupList[$action])) {
            _getNestingGroupActions($action, $groupList, $groupActions);
        }
    }
}

var_dump($groupActions);