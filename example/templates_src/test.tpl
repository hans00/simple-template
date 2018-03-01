<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{$title}</title>
</head>
<body>
	{display "menu.tpl"}
	{if $a is array}
		<p>$a is array</p>
	{/if}
	{if $a is empty}
		<p>$a is empty</p>
	{/if}
	{if $a is true}
		<p>$a is true</p>
	{/if}
	{if $a is false}
		<p>$a is false</p>
	{/if}
	{if $a is defined}
		<p>$a isset</p>
	{/if}
	{if $a eq $b}
		<p>$a == $b</p>
	{elif $a ne $b}
		<p>$a != $b</p>
	{/if}
	{* Print var *}
	{$var}
	{$array.var['a'][$a]["a"]}
	{* leftpad  Just using leftpad_<any><length> *}
	{$var|leftpad_05}
	{* array count *}
	{$array|count}
	{* string length *}
	{$str|len}
	<ul>
		{for i=1 to 10}
			<li>{$i|leftpad_02}</li>
		{/for}
	</ul>
	<ul>
		{foreach item in $a}
			<li>{$item}</li>
		{/foreach}
	</ul>
</body>
</html>