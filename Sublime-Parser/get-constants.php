<?php

	//just load at the way WP does
	include dirname(__FILE__) . '/wp-blog-header.php';
	require_once(ABSPATH . 'wp-admin/includes/admin.php');

	$functions = get_defined_constants(true);

	foreach ($functions as $func => $b) {

		echo $b . '<br>';
	}

?>