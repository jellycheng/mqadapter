<?php
/**
 * 适配器工厂
 */
namespace CjsMqAdapter;

class MqAdapterFactory
{
    protected $config = [];

    private function __construct()
    {
    }

    public static function getInstance() {
        static $instance;
        if(!$instance) {
            $instance = new static();
        }
        return $instance;
    }

    public function init($config='') {
        static $isInit = false;
        if($isInit) {
            return $this;
        }
        $isInit = true;
        $this->config = $config;
        return $this;
    }

    /**
     * 发送队列
     * @param $mqName 队列名
     * @param $msg  队列内容
     */
    public function send($mqName, $msg) {
        static $mqInstance = [];
        $b = false;
        $curCfg = $this->getConfig($mqName);
        if($curCfg) {
            if(!isset($mqInstance[$mqName])) {
                $obj = new $curCfg['adapter'];
                if(!$obj instanceof MqAdapterContract) {
                    throw new AdapaterException("适配器错误");
                }
                $obj->setConfig($curCfg['config']);
                $obj->setMqName($mqName);
                $mqInstance[$mqName] = $obj;
            }
            $b = $mqInstance[$mqName]->send($msg);
        }
        return $b;
    }

    /**
     * 从队列中读消息 - 一次
     * @param $msName
     */
    public function receive($mqName) {
        static $mqInstance = [];
        $res = '';
        $curCfg = $this->getConfig($mqName);
        if($curCfg) {
            if(!isset($mqInstance[$mqName])) {
                $obj = new $curCfg['adapter'];
                if(!$obj instanceof MqAdapterContract) {
                    throw new AdapaterException("适配器错误");
                }
                $obj->setConfig($curCfg['config']);
                $obj->setMqName($mqName);
                $mqInstance[$mqName] = $obj;
            }
            $res = $mqInstance[$mqName]->receive();
        }
        return $res;
    }

    public function receiveWait($mqName, $callback) {
        static $waitMqInstance = [];
        $curCfg = $this->getConfig($mqName);
        if($curCfg) {
            if(!isset($mqInstance[$mqName])) {
                $obj = new $curCfg['adapter'];
                if(!$obj instanceof MqAdapterContract) {
                    throw new AdapaterException("适配器错误");
                }
                $obj->setConfig($curCfg['config']);
                $obj->setMqName($mqName);
                $waitMqInstance[$mqName] = $obj;
            }
            $waitMqInstance[$mqName]->receiveWait($callback);
        }
    }


    public function getConfig($key = null) {
        $config = $this->config;
        if(is_null($key)) {
            return $config;
        }
        if(isset($config[$key]) && $config[$key]) {
            return $config[$key];
        }
        return [];
    }

}