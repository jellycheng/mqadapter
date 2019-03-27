<?php
require_once __DIR__ . '/common.php';

use \CjsMqAdapter\MqAdapterFactory;

//初始化配置
$mqConfig = include __DIR__ . '/config.php';
MqAdapterFactory::getInstance()->init($mqConfig);



echo "接收消息： " . MqAdapterFactory::getInstance()->receive('wallet_queue') . PHP_EOL;


