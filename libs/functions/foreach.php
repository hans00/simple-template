<?php

$content = preg_replace_callback("/\{foreach ($tpl_var) +in *($php_var_match)}/", function ($matches) {
	return '<?php foreach('.parse_var($matches[2]).' as &$'.$matches[1].'): ?>';
}, $content);
