<?php

function parse_var($var_str) {
	$php_var_array = '/(\$[a-zA-Z_]\w*)((?:\.\w+|\[\"\S*\"\]|\[\'\S*\'\]|\[\d+\]|\[\$[a-zA-Z_]\w*(?:\.\w+)?\])*)?/';
	preg_match($php_var_array, $var_str, $matches);
	$varname  = $matches[1];
	$arraystr = $matches[2];
	$code = $varname;
	if ($arraystr != '') {
		$start = false;
		for ($i=0; $i < strlen($arraystr); $i++) { 
			if (!$start) {
				if ($arraystr[$i] == '.') {
					$start = true;
				} else {
					$start = true;
					$i++;
				}
				$code .= '[\'';
			} else {
				if ($arraystr[$i] == '.') {
					$code .= "']";
					$start = false;
				} elseif (in_array($arraystr[$i], ['"', "'"])) {
					$code .= "']";
					$start = false;
					$i++;
				} else {
					$code .= $arraystr[$i];
				}
			}
		}
		if ($code[strlen($code)-1] != ']') $code .= "']";
	}
	return $code;
}
