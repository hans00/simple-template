<?php

$content = preg_replace("/\{\/(if|for|foreach)\}/", '<?php end$1; ?>', $content);
