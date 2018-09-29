<?php

namespace framework\base;

use framework\db\Sql;

/**
 * 模型基类
 */
class Model extends Sql
{
	protected $model;

	public function __construct()
	{
		// 获取数据库名
		if (!$this->table) {
			// 获取模型名
			$this->model = get_class($this);

			// 删除类最后的 model 字符
			$this->model = substr($this->model, 0, -5);

			// 默认数据库名和类名一致
			$this->table = strtolower($this->model);
		}
	}
}