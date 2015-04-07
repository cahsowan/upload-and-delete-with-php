<?php

$data = json_decode(file_get_contents('data.txt'), true) ?: [];
$upload_directory = 'upload/';

if (isset($_GET['fruit'])) {
	$buah = $_GET['fruit'];
	
	if (array_key_exists($buah, $data)) {
		unlink($data[$buah]);
		unset($data[$buah]);
		file_put_contents('data.txt', json_encode($data));

		header('Location: index.php');
	} else {
		echo 'buah tidak ditemukan';
	}
}
