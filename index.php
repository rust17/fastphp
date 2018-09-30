<?php
// 应用目录未为当前目录
define('APP_PATH', __DIR__ . '/');

// 调试模式
define('APP_DEBUG', true);

// 加载框架
require(APP_PATH . 'framework/Kernel.php');

// 加载配置文件
$config = require(APP_PATH . 'config/config.php');

// 加载 composer 项目依赖
require __DIR__ . '/vendor/autoload.php';

// 加载 Eloquent
require __DIR__ . '/third_part/eloquent.php';

(new framework\Kernel($config))->run();