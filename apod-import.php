<?php

$apod_base_url = "http://apod.nasa.gov/apod/";
$apod_archive_page = "archivepix.html";

$apod_archive = file($apod_base_url . $apod_archive_page);
$apod_archive = preg_grep("/:  </", $apod_archive);

$link_regexp = '/<a\s+[^>]*href="([^"]*)"[^>]*>(.*)<\/a>/';

foreach ($apod_archive as $apod_item) {
	preg_match($link_regexp, $apod_item, $matches);
	$item_href = $apod_base_url . $matches[1];
	$item_dd = substr($matches[1], 6, 2);
	$item_mm = substr($matches[1], 4, 2);
	$item_yy = substr($matches[1], 2, 2);
	$item_yyyy = ($item_yy >= '95') ? '19' . $item_yy : '20' . $item_yy;
	$item_title = $matches[2];
	echo $item_title . ": " . $item_yyyy . '-' . $item_mm . '-' . $item_dd . ' 00:00:00 ' . $item_href . PHP_EOL;
}

?>
