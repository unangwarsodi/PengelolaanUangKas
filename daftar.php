<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>a</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php
	function create_random($length)
	{
	    $data = 'ABCDEFGHIJKLMNOPQRSTU1234567890';
	    $string = '';
	    for($i = 0; $i < $length; $i++) {
	        $pos = rand(0, strlen($data)-1);
	        $string .= $data{$pos};
	    }
	    return $string;
	}
	echo create_random(6);
	?>
	<form action="daftar-act.php" method="POST">
		<input type="text" name="nama" placeholder="Nama"><br>
		<input type="text" name="kode" placeholder="Kode"><br>
		<input type="submit" name="submit" value="Daftar">
	</form>
</body>
</html>