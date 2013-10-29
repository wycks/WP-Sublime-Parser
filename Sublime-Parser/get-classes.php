<?php

	//just load at the way WP does
	include dirname(__FILE__) . '/wp-blog-header.php';
	require_once(ABSPATH . 'wp-admin/includes/admin.php');

	$classes = get_declared_classes();

	foreach ($classes as $key) {
		echo '"' . $key . '",<br>';
	}

?>