<?php
require_once __DIR__ . '/common.php';

use \CjsMqAdapter\MqAdapterFactory;

$mqConfig = include __DIR__ . '/config.php';
MqAdapterFactory::getInstance()->init($mqConfig);

$b = MqAdapterFactory::getInstance()->send('wallet_queue', '你好，钱包' . mt_rand(1, 999));
if($b) {
    echo "send success" . PHP_EOL;
} else {
    echo "send fail" . PHP_EOL;
}

