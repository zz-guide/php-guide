<?php
/**
 *
 * @author:  leixu
 * @version: 1.0.0
 * @change:
 *    1. 2021/12/19 leixu: 创建；
 */

$q = new SplQueue();
$q->enqueue(1);
$q->enqueue(2);
$q->dequeue();
print_r($q);