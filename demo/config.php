<?php
/**
 * 配置示例,一个队列一个配置
 * type队列方式值有：redis、rabbitmq、kafka、activemq、mysql 等
 */

return [
    //'队列名'=>['type'=>'队列方式','config'=>[],'adapter'=>'适配器类名','desc'=>'队列用途说明，选填']
    'user_queue'=>['type'=>'redis',
                    'config'=>[
                        'host'     => '127.0.0.1',
                        'port'     => 6379,
                        'database' => 1,
                        'prefix'   => 'cjs:user:',
                    ],
                    'adapter'=>\CjsMqAdapter\RedisMqAdapter::class, //适配器类，且该类必须实现CjsMqAdapter\MqAdapterContract接口
                    'desc'=>'用户基本信息数据变更放入队列'
                ],
    'wallet_queue'=>['type'=>'redis',
                    'config'=>[
                        'host'     => '127.0.0.1',
                        'port'     => 6379,
                        'database' => 2,
                        'prefix'   => 'cjs:wallet:',
                    ],
                    'adapter'=>\CjsMqAdapter\RedisMqAdapter::class,
                    'desc'=>'用户钱包数据变更放入队列'
                ],
    'order_queue'=>['type'=>'redis',
                    'config'=>[
                            'host'     => '127.0.0.1',
                            'port'     => 6379,
                            'database' => 3,
                            'prefix'   => 'cjs:order:',
                        ],
                    'adapter'=>\CjsMqAdapter\RedisMqAdapter::class,
                    'desc'=>'订单数据变更放入队列'
                    ],

];
