<?php

$content = preg_replace_callback("/\{($php_var_match)\}/", function ($matches) {
	return '<?php echo '.parse_var($matches[1]).'; ?>';
}, $content);
