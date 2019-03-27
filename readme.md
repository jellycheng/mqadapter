
## 队列适配器
```
队列适配器，方便后续切换其它队列实现方式

1. 提供方法给上层调用，上层调用方不需要关心底层用redis、还是rabbitmq、还是kafka队列
2. 提供2个方法：
    发送队列消息：MqAdapterFactory::getInstance()->send('队列名', '队列内容')
    接收队列消息：
        A）阻塞式消费队列
            MqAdapterFactory::getInstance()->receiveWait('wallet_queue', function($msg){
                echo "接收消息：这里处理业务逻辑 " . $msg . PHP_EOL;
            });
        B）取一条消息就断掉
            $msg = MqAdapterFactory::getInstance()->receive('队列名');

3. 使用哪种配置队列配置示例参考demo/config.php文件

```


## composer
```
安装依赖包但不安装开发依赖包：composer install --no-dev -vvv

```
