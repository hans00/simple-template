<?php

class Parser
{
	const OPTION   = 1;
	const VARIABLE = 2;
	private $short_options = 'h';
	private $long_options  = ['help'];
	private $options = [];

	function add($short, $long, $type, &$variable, $description='', $var_name='var')
	{
		if ($type == self::OPTION) {
			$this->short_options .= $short;
			$this->long_options[] = $long;
		}
		if ($type == self::VARIABLE) {
			$this->short_options .= $short.':';
			$this->long_options[] = $long.':';
		}
		$this->options[] = [
			's' => $short,
			'l' => $long,
			'v' => &$variable,
			't' => $type,
			'd' => $description,
			'vn' => $var_name
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
			if ($param['t'] == self::OPTION) {
				$param['v'] = isset($val);
			} else if ($param['t'] == self::VARIABLE) {
				$param['v'] = $val;
			}
		}
	}

	function help()
	{
		echo 'Usage: ', $GLOBALS['argv'][0], ' [options]', PHP_EOL;
		echo 'Options:', PHP_EOL;
		$tpl1 = "    -%1s, --%-10s\t\t%-50s".PHP_EOL;
		$tpl2 = "    -%1s, --%s <%s>\t\t%-50s".PHP_EOL;
		printf($tpl1, 'h', 'help', 'Show this message');
		foreach ($this->options as &$param) {
			if ($param['t'] == self::OPTION)
				printf($tpl1, $param['s'], $param['l'], $param['d']);
			else
				printf($tpl2, $param['s'], $param['l'], $param['vn'], $param['d']);
		}
		echo PHP_EOL;
	}
}
