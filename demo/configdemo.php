<?php
/**
 * 配置初始化、存取示例
 */
require_once __DIR__ . '/common.php';

use \CjsMqAdapter\MqAdapterFactory;

//初始化配置
$mqConfig = include __DIR__ . '/config.php';
MqAdapterFactory::getInstance()->init($mqConfig);

//获取所有配置
var_export(MqAdapterFactory::getInstance()->getConfig());
echo PHP_EOL;

//获取某一个队列配置
var_export(MqAdapterFactory::getInstance()->getConfig('wallet_queue'));
echo PHP_EOL;

echo MqAdapterFactory::class;
echo PHP_EOL;


