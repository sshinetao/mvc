<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config {
	const DB_TYPE = 'mysql';
	/**
	 * Database host
	 * @var string
	 */
	const DB_HOST = 'localhost';

	/**
	 * Database name
	 * @var string
	 */
	const DB_NAME = 'myframe';

	/**
	 * Database user
	 * @var string
	 */
	const DB_USER = 'root';

	/**
	 * Database password
	 * @var string
	 */
	const DB_PWD = '123456';

	/**
	 * Show or hide error messages on screen
	 * @var boolean
	 */
	const SHOW_ERRORS = true;
	const DB_PORT = '3306';
	const DB_CHARSET = 'utf8';
}
