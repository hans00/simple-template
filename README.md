# Simple Template

Very simple template using regex.

---

## Precompile (convert)

Very simple command.
If syntax error, will tell line number.

```
./compile_template
```

## Requirements

PHP 7+

## Implemented function

### Print var

```
{$var}
```

### Print var array

```
{$var.a['b']["c"][$d]}
```

### pass variable to function

- leftpad_ `any` `length`
- count
- len

```
{$var|leftpad_010} //if $var is 1, will show 0000000001
```

### if-else

There no `and` and `or`.

```
{if $a eq $b}
	$a == $b
{elif $a gt $b}
	$a > $b
{elseif $a lt $b}
	$a < $b
{else}
	other
{/if}
```

### if var is / not

- array
- empty
- defined (this will convert to isset)
- true (TRUE)
- false (FALSE)

```
{if $a is array}
	is_array($a)
{if $a not array}
	!is_array($a)
{if $a is true}
	$a === true
{/if}
```

### for

```
{for i=10 to 1 step=-1}
	{$i}
{/for}
{for i=1 to 10}
	{$i}
{/for}
```

### foreach

```
{foreach item in $array}
	{$item}
{/foreach}
```
