<?php

namespace Core;

use App\Config;

/**
 * Base model
 *
 * PHP version 7.0
 */
abstract class Model extends \Medoo\Medoo {

	public function __construct() {
		$dbarr = array(
			'database_type' => Config::DB_TYPE,
			'server' => Config::DB_HOST,
			'database_name' => Config::DB_NAME,
			'username' => Config::DB_USER,
			'password' => Config::DB_PWD,
			'charset' => Config::DB_CHARSET,
			'port' => Config::DB_PORT,
		);
		parent::__construct($dbarr);

	}

}
