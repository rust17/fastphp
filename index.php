<?php
// 应用目录未为当前目录
define('APP_PATH', __DIR__ . '/');

// 调试模式
define('APP_DEBUG', true);

// 加载框架
require(APP_PATH . 'framework/Kernel.php');

// 加载配置文件
$config = require(APP_PATH . 'config/config.php');

(new framework\Kernel($config))->run();