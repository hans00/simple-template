<?php

$content = preg_replace_callback("/\{display +(\'\S+\'|\"\S+\")\}/", function ($matches) use ($display) {
	$file = str_replace(
		['\'', '.tpl'],
		['\\\'', '.phtml'],
		substr($matches[1], 1, strlen($matches[1])-2)
	);
	if ($display == 'include')
		return '<?php include __DIR__.\'/'.$file.'\'; ?>';
	else
		return '<?php '.$display.'('.$file.'\'); ?>';
}, $content);
