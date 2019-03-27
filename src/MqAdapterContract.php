<?php
namespace CjsMqAdapter;

/**
 * 队列适配器接口
 */

interface MqAdapterContract {

    //设置连接配置
    public function setConfig($cfg);

    //设置队列名
    public function setMqName($mqName);

    //发送消息
    public function send($message);

    //接收消息-取一次就断
    public function receive();

    //循环取，没取到会等待,阻塞式
    public function receiveWait($callback);

}

