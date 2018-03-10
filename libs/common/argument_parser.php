<?php

class Parser
{
	const OPTION   = 1;
	const VARIABLE = 2;
	private $short_options = 'h';
	private $long_options  = ['help'];
	private $options = [];

	function add($short, $long, $type, &$variable, $description='', $default=NULL, $var_name='var')
	{
		if ($type == self::OPTION) {
			$this->short_options .= $short;
			$this->long_options[] = $long;
		}
		if ($type == self::VARIABLE) {
			$this->short_options .= $short.':';
			$this->long_options[] = $long.':';
		}
		$variable = $default;
		$this->options[] = [
			's' => $short,
			'l' => $long,
			'v' => &$variable,
			't' => $type,
			'd' => $description,
			'vn' => $var_name,
		];
	}

	function parse()
	{
		$options = getopt($this->short_options, $this->long_options);
		if (isset($options['h']) or isset($options['h'])) {
			$this->help();
			exit(0);
		}
		foreach ($this->options as &$param) {
			$val = NULL;
			if (isset($options[$param['s']])) {
				$val = $options[$param['s']];
			} else if (isset($options[$param['l']])) {
				$val = $options[$param['l']];
			}
			if (isset($val)) {
				if ($param['t'] == self::OPTION) {
					$param['v'] = true;
				} else if ($param['t'] == self::VARIABLE) {
					$param['v'] = $val;
				}
			}
		}
	}

	function help()
	{
		echo 'Usage: ', $GLOBALS['argv'][0], ' [options]', PHP_EOL;
		echo 'Options:', PHP_EOL;
		$tpl = "    -%1s, --%-20s %-50s".PHP_EOL;
		printf($tpl, 'h', 'help', 'Show this message');
		foreach ($this->options as &$param) {
			if ($param['t'] == self::OPTION)
				printf($tpl, $param['s'], $param['l'], $param['d']);
			else
				printf($tpl, $param['s'], $param['l'].' <'.$param['vn'].'>', $param['d']);
		}
		echo PHP_EOL;
	}
}
