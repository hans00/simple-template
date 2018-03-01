<?php

$content = preg_replace_callback("/\{display +(\'\S+\'|\"\S+\")\}/", function ($matches) {
	$file = str_replace(
		['\'', '.tpl'],
		['\\\'', '.phtml'],
		substr($matches[1], 1, strlen($matches[1])-2)
	);
	return '<?php include __DIR__.\'/'.$file.'\'; ?>';
}, $content);
