<?php

$data = json_decode(file_get_contents('data.txt'), true) ?: [];
$upload_directory = 'upload/';

 if ($_POST) {
 	$buah = $_POST['buah'];
 	$gambar = $_FILES['gambare'];


 	if (! empty($buah) && file_exists($gambar['tmp_name'])) {
 		$data[$buah] = $upload_directory . $gambar['name'];
 		file_put_contents('data.txt', json_encode($data));

 		if (move_uploaded_file($gambar['tmp_name'], $upload_directory . $gambar['name'])) {
 			print 'file tersimpan';
 		} else {
 			print 'gagal menyimpan file';
 		}
 	} else {
 		die('pastikan form terisi');
 	}

 }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
</head>
<body>
<h1>Mengunggah Berkas</h1>
<hr/>

<form method="POST" enctype="multipart/form-data">
	<p>
		<label for="buah">Buah kesukaanmu</label>
		<input name="buah" type="text">
	</p>

	<p>
		<label for="gambar">Gambar buah</label>
		<input type="file" name="gambare">
	</p>

	<p>
		<button type="submit">Kirimkan</button>
	</p>
</form>

<hr/>

<?php if (! empty($data)): ?>
	<table border="1">
		<tr>
			<th>Nama Buah</th>
			<th>Gambar</th>
			<th></th>
		</tr>

		<?php foreach ($data as $fruit => $path): ?>
			<tr>
				<td><?php print $fruit ?></td>
				<td><img src="<?php print $path ?>"></td>
				<th><a href="hapus.php?fruit=<?php echo $fruit ?>" onclick=" return confirm('are you sure?') ">hapus</a></th>
			</tr>
		<?php endforeach ?>
	</table>
<?php endif ?>
</body>
</html>