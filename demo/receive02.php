<?php
require_once __DIR__ . '/common.php';

use \CjsMqAdapter\MqAdapterFactory;

//初始化配置
$mqConfig = include __DIR__ . '/config.php';
MqAdapterFactory::getInstance()->init($mqConfig);

//阻塞式消费队列
MqAdapterFactory::getInstance()->receiveWait('wallet_queue', function($msg){
    echo "接收消息： " . $msg . PHP_EOL;
});


