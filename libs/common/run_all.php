<?php

function offset2linenum(string $content, int $offset) {
	return substr_count(mb_substr($content, 0, $offset), PHP_EOL) + 1;
}

function tpl_lost_syntax_check(string $code, callable $error_processor) {
	preg_match_all('/\{([^}\r\n\t]+)\}/', $code, $matches, PREG_OFFSET_CAPTURE);
	if (!count(current($matches))) return;
	foreach (current($matches) as &$match) {
		$error_processor('Syntax error, at line: '.offset2linenum($code, $match[1]));
	}
	exit(1);
}

function run_all_functions_parser(string $content, callable $error_processor) {
	$tpl_var = '(?:[a-zA-Z_]\w*)';
	$php_var_match = '(?:\$[a-zA-Z_]\w*)(?:(?:\.\w+|\[\"\S*\"\]|\[\'\S*\'\]|\[\d+\]|\[\$[a-zA-Z_]\w*(?:\.\w+)?\])*)?';
	$functions = glob(__LIBS__ . '/functions/*.php');
	foreach ($functions as &$function) {
		include $function;
	}
	tpl_lost_syntax_check($content, $error_processor);
	return $content;
}
