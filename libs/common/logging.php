<?php

/**
* Logging
*/
class logging
{
	const RESET = "\033[39m";
	const INFO_COLOR  = "\033[37m";
	const WARN_COLOR  = "\033[33m";
	const ERROR_COLOR = "\033[31m";
	static $colorful = true;

	function __construct($colorful = false)
	{
		self::$colorful = $colorful;
	}

	static function info(string $msg)
	{
		if (self::$colorful) echo self::INFO_COLOR;
		echo "[INFO]\t", $msg;
		if (self::$colorful) echo self::RESET;
		echo PHP_EOL;
	}

	static function warn(string $msg)
	{
		if (self::$colorful) echo self::WARN_COLOR;
		echo "[WARR]\t", $msg;
		if (self::$colorful) echo self::RESET;
		echo PHP_EOL;
	}

	static function error(string $msg)
	{
		if (self::$colorful) echo self::ERROR_COLOR;
		echo "[ERROR]\t", $msg;
		if (self::$colorful) echo self::RESET;
		echo PHP_EOL;
	}
}
