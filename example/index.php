<?php

function load_template(string $filename, array $args=[]) {
	if (!is_file('templates/'.$filename)) {
		throw new Exception("The file \"$filename\" does not exist.", 1);
	}
	extract($args);
	include 'templates/'.$filename;
}

load_template('index.phtml', [
	'title' => 'test',
	'a' => [
		'a',
		'b',
		'c'
	],
	'b' => 'a',
	'var' => '11',
	'array' => [
		'a' => [ 'a' => [ 'a' => [ 'a' => 'b' ] ] ]
	],
	'str' => 'a'
]);