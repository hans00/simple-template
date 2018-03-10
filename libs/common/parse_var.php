<?php

function parse_var($var_str) {
	$php_var_array = '/(\$[a-zA-Z_]\w*)((?:\.\w+|\[\"\S*\"\]|\[\'\S*\'\]|\[\d+\]|\[\$[a-zA-Z_]\w*(?:\.\w+)?\])*)?/';
	preg_match($php_var_array, $var_str, $matches);
	$varname  = $matches[1];
	$arraystr = $matches[2];
	$code = $varname;
	if ($arraystr != '') {
		$start = 0;
		for ($i=0; $i < strlen($arraystr); $i++) { 
			if (!$start) {
				if ($arraystr[$i] == '.') {
					$code .= '[\'';
					$start = 1;
				} elseif ($arraystr[$i+1] == '$') {
					$code .= '[';
					$start = 2;
				} else {
					$code .= '[\'';
					$start = 3;
				}
			} else {
				switch ($start) {
					case 1:
						if (in_array($arraystr[$i], ['.', '['])) {
							$code .= "']";
							$start = 0;
						}
					break;
					case 2:
						if (in_array($arraystr[$i], ['.', ']'])) {
							$code .= "]";
							$start = 0;
							$i++;
						}
					break;
					case 3:
						if (in_array($arraystr[$i], ['"', "'"])) {
							$code .= "']";
							$start = 0;
							$i++;
						}
					break;
				}
				if ($start) {
					$code .= $arraystr[$i];
				}
			}
		}
		if ($code[strlen($code)-1] != ']') $code .= "']";
	}
	return $code;
}
