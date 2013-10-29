<?php


// grab the while function output file and compare it with the depreciated function file

$good = file('wp-functions.json');
$bad = file('wp-deprected.json');

$output = array_diff($good, $bad);
file_put_contents('WP-Functions-Completions.sublime-completions', implode($output));

?>