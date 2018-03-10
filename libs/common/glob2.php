<?php

function glob2($top_path, &$files, $ext, $scanpath='/') {
	$path_list = scandir(realpath($top_path).$scanpath);
	foreach ($path_list as &$path) {
		if ($path[0] != '.') {
			if (is_dir($top_path.$scanpath.$path)) {
				glob2($top_path, $files, $ext, $scanpath.$path.'/');
			} elseif (substr($path, -4) == '.tpl') {
				$files[] = $scanpath.$path;
			}
		}
	}
}
