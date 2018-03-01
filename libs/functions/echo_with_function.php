<?php

$content = preg_replace_callback("/\{($php_var_match) *\| *(count|len|leftpad_.\d+)\}/", function ($matches) {
	$var = parse_var($matches[1]);
	switch (true) {
		case $matches[2]=='count':
			return '<?php echo count('.$var.'); ?>';
		case $matches[2]=='len':
			return '<?php echo strlen('.$var.'); ?>';
		case substr($matches[2], 0, 7)=='leftpad':
			$len = substr($matches[2], 9);
			$pad = str_replace('\'', '\\\'', $matches[2][8]);
			return '<?php echo str_pad('.$var.', '.$len.', \''.$pad.'\', STR_PAD_LEFT); ?>';
	}
}, $content);
