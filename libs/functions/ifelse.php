<?php

$content = preg_replace_callback("/\{(el(?:se)?)?if +($php_var_match)(?: +((?:eq|ne|gt|lt|gte|lte) +($php_var_match|-?\d+|\'\S*\'|\"\S*\")|is +(defined|array|empty|file|true|TRUE|false|FALSE)|not +(defined|array|empty|file|true|TRUE|false|FALSE)))?\}/", function ($matches) {
	$code = '<?php '.(($matches[1]!='')?'else ':'').'if ('.parse_var($matches[2]);
	$comp = substr($matches[3], 0, 3);
	switch ($comp) {
		case 'eq ':
			$code .= ' == ';
			if ($matches[4][0] == '$') $code .= parse_var($matches[4]);
			else $code .= $matches[4];
			break;
		case 'ne ':
			$code .= ' != ';
			if ($matches[4][0] == '$') $code .= parse_var($matches[4]);
			else $code .= $matches[4];
			break;
		case 'gt ':
			$code .= ' > ';
			if ($matches[4][0] == '$') $code .= parse_var($matches[4]);
			else $code .= $matches[4];
			break;
		case 'lt ':
			$code .= ' < ';
			if ($matches[4][0] == '$') $code .= parse_var($matches[4]);
			else $code .= $matches[4];
			break;
		case 'gte':
			$code .= ' >= ';
			if ($matches[4][0] == '$') $code .= parse_var($matches[4]);
			else $code .= $matches[4];
			break;
		case 'lte':
			$code .= ' <= ';
			if ($matches[4][0] == '$') $code .= parse_var($matches[4]);
			else $code .= $matches[4];
			break;
		case 'is ':
			switch ($matches[4]) {
				case 'defined':
					$code = substr($code,0,10) . 'isset(' . substr($code,10) . ')';
					break;
				case 'array':
					$code = substr($code,0,10) . 'is_array(' . substr($code,10) . ')';
					break;
				case 'empty':
					$code = substr($code,0,10) . 'empty(' . substr($code,10) . ')';
					break;
				case 'file':
					$code = substr($code,0,10) . 'is_file(' . substr($code,10) . ')';
					break;
				case 'true':
				case 'TRUE':
					$code .= ' === true';
					break;
				case 'false':
				case 'FALSE':
					$code .= ' === true';
					break;
			}
			break;
		case 'not':
			switch ($matches[4]) {
				case 'defined':
					$code = substr($code,0,10) . '!isset(' . substr($code,10) . ')';
					break;
				case 'array':
					$code = substr($code,0,10) . '!is_array(' . substr($code,10) . ')';
					break;
				case 'empty':
					$code = substr($code,0,10) . '!empty(' . substr($code,10) . ')';
					break;
				case 'file':
					$code = substr($code,0,10) . '!is_file(' . substr($code,10) . ')';
					break;
				case 'true':
				case 'TRUE':
					$code .= ' !== true';
					break;
				case 'false':
				case 'FALSE':
					$code .= ' !== false';
					break;
			}
			break;
	}
	return $code.'): ?>';
}, $content);

$content = preg_replace("/\{else\}/", '<?php else: ?>', $content);
