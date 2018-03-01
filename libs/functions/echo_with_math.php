<?php

$content = preg_replace_callback("/\{($php_var_match)((?: +[\+\-\*\/] +-?\d+)*)\}/", function ($matches) {
	return '<?php echo '.parse_var($matches[1]).$matches[2].'; ?>';
}, $content);
