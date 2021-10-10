<?php
function pr($v,$n) {
	// echo '<h1>$n '.count($v).'</h1><pre>'; print_r($v); echo '</pre>';
	$c = count($v);
	$p = print_r($v, true);
	echo "<h1>{$n} {$c}</h1><pre>{$p}</pre>";
}