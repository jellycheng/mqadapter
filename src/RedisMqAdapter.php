<?php
namespace CjsMqAdapter;
/**
 * redis队列适配器编写参考示例
 */

class RedisMqAdapter implements MqAdapterContract {

    protected $config = [];
    protected $mq_name = '';

    public function setConfig($cfg)
    {
        $this->config = $cfg;
    }

    public function setMqName($mqName)
    {
       $this->mq_name = $mqName;
    }


    public function send($message)
    {
        $config = $this->config;
        $obj = new \CjsRedis\RedisStore($config);
        $subKey = $config['prefix'] . $this->mq_name;
        $res = $obj->LPUSH($subKey, $message);
        if($res) {
            return true;
        }
        return false;
    }

    public function receive()
    {
        $config = $this->config;
        $obj = new \CjsRedis\RedisStore($config);
        $subKey = $config['prefix'] . $this->mq_name;
        $res = $obj->RPOP($subKey);
        return $res;
    }


    public function receiveWait($callback) {
        $config = $this->config;
        $subKey = $config['prefix'] . $this->mq_name;
        $i = 0;
        while (true) {
            ++$i;
            try {
                $obj = new \CjsRedis\RedisStore($config);
                $res = $obj->RPOP($subKey);
                $callback($res);
            } catch (\Exception $e) {

            }
            if($i%10 == 0) {
                sleep(1);
            }
            if($i%100 == 0) {
                sleep(5);
                $i=0;
            }

        }
    }


}