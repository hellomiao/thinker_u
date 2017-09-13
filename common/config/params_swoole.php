<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/4/24
 * Time: 下午12:03
 */
return [
        'host'             => '0.0.0.0',      //服务启动IP
        'port'             => '9503',           //服务启动端口
        'process_name'     => 'swooleServ',     //服务进程名
        'open_tcp_nodelay' => '1',              //启用open_tcp_nodelay
        'daemonize'        => 1,              //守护进程化
        'worker_num'       => '2',              //work进程数目
        'task_worker_num'  => '2',              //task进程的数量
        'task_max_request' => '10000',          //work进程最大处理的请求数
        'task_tmpdir'      => '/tmp/task',       //设置task的数据临时目录
        'client_timeout'   => '20',              //client链接服务器时超时时间(s)
        //--以上配置项均来自swoole-server的同名配置，可随意参考swoole-server配置说明自主增删--
        'log_size'         => 204800000,             //运行时日志 单个文件大小
];