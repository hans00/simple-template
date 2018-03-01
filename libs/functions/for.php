<?php

$content = preg_replace_callback("/\{for ($tpl_var) *= *($php_var_match|-?\d+) +to +($php_var_match|-?\d+)(?: +step=(-?\d+))?\}/", function ($matches) {
	$i    = '$'.$matches[1];
	$from = ($matches[2][0] == '$') ? parse_var($matches[2]) : intval($matches[2]);
	$to   = ($matches[3][0] == '$') ? parse_var($matches[3]) : intval($matches[3]);
	$step = isset($matches[4])      ? intval   ($matches[4]) : '++';
	$comp = ($from < $to) ? '<=' : '>=';
	if ($step != '++') {
		if ($step ==  1) $step = '++';
		if ($step == -1) $step = '--';
		else $step = '+='.$step;
	}
	return '<?php for ('.$i.'='.$from.'; '.$i.$comp.$to.'; '.$i.$step.'): ?>';
}, $content);
