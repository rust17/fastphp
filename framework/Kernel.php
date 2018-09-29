<?php

namespace framework;

// 框架目录
define('CORE_PATH', __DIR__);

class Kernel 
{
	protected $config = [];

	public function __construct($config)
	{
		$this->config = $config;
	}

	/* 框架需要完成的操作
	* 自动加载
	* 环境检查
	* 过滤特殊字符
	* 移除全局变量
	* 路由处理
	*/
	public function run()
	{
		spl_autoload_register(array($this, 'loadClass'));
		$this->setReporting();
		$this->removeMagicQuotes();
		$this->unregisterGlobals();
		$this->setDbConfig();
		$this->route();
	}

	// 自动加载
	public function loadClass($className)
	{
		$classMap = $this->classMap();

		if (isset($classMap[$className])) {
			// 包含内核文件
			$file = $classMap[$className];
		} elseif (strpos($className, '\\') !== false) {
			// 包含应用内的文件
			$file = APP_PATH . str_replace('\\', '/', $className) . '.php';
			if (!is_file($file)) return;
		} else {
			return;
		}

		include $file;
	}

	// 内核文件映射规则
	public function classMap()
	{
		return [
			'framework\base\Controller' => CORE_PATH . '/base/Controller.php',
			'framework\base\Model'      => CORE_PATH . '/base/Model.php',
			'framework\base\View'       => CORE_PATH . '/base/View.php',
			'framework\db\Db'           => CORE_PATH . '/db/Db.php',
			'framework\db\Sql'          => CORE_PATH . '/db/Sql.php',
		];
	}

	// 检查环境
	public function setReporting()
	{
		if (APP_DEBUG === true) {
			error_reporting(E_ALL);
			ini_set('display_errors', 'On');
		} else {
			error_reporting(E_ALL);
			ini_set('display_errors', 'Off');
			ini_set('log_errors', 'On');
		}
	}

	// 检测删除特殊字符
	public function removeMagicQuotes()
	{
		if (get_magic_quotes_gpc()) {
			$_GET = isset($_GET) ? $this->stripSlashesDeep($_GET) : '';
			$_POST = isset($_POST) ? $this->stripSlashesDeep($_POST) : '';
			$_COOKIE = isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
			$_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';
		}
	}

	public function stripSlashesDeep($value)
	{
		$value = is_array($value) ? array_map(array($this, 'stripSlashesDeep'), $value) : stripslashes($value);

		return $value;
	}

	// 移除全局变量
	public function unregisterGlobals()
	{
		if (ini_get('register_globals')) {
			$array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
			foreach ($array as $value) {
				foreach ($GLOBALS[$value] as $key => $val) {
					if ($val === $GLOBALS[$key]) {
						unset($GLOBALS[$key]);
					}
				}
			}
		}
	}

	// 设置数据库信息
	public function setDbConfig()
	{
		if ($this->config['db']) {
			define('DB_HOST', $this->config['db']['host']);
			define('DB_NAME', $this->config['db']['dbname']);
			define('DB_USER', $this->config['db']['username']);
			define('DB_PASS', $this->config['db']['password']);
		}
	}

	// 路由处理
	public function route()
	{
		$controllerName = $this->config['defaultController'];
		$actionName     = $this->config['defaultAction'];
		$params         = array();

		// 获取路由信息
		$url = $_SERVER['REQUEST_URI'];
		// 获取 ? 之后的参数
		$position = strpos($url, '?');
		$url = $position === false ? $url : substr($url, 0, $position);
		// 删 $url 的'/'
		$url = trim($url, '/');

		if ($url) {
			// 使用 '/' 分割字符串，保存在数组中
			$urlArray = explode('/', $url);
			// 删除空数组
			$urlArray = array_filter($urlArray);

			// 获取控制器名
			$controllerName = ucfirst($urlArray[0]);

			// 获取动作名
			array_shift($urlArray);
			$actionName = $urlArray ? $urlArray[0] : $actionName;

			// 获取参数
			array_shift($urlArray);
			$params = $urlArray ? $urlArray : [];
		}

		// 判断控制器和动作是否存在
		$controller = 'app\\controllers\\' . $controllerName . 'Controller';
		if (!class_exists($controller)) {
			exit($controller . '控制器不存在');
		}
		if (!method_exists($controller, $actionName)) {
			exit($actionName . '方法不存在');
		}

		// 如果控制器和方法都存在，则实例化控制器
		$dispatch = new $controller($controllerName, $actionName);
		call_user_func_array(array($dispatch, $actionName), $params);
	}
}