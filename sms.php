<?php
$query2 = mysql_query("SELECT * FROM tbl_organisasi WHERE id_organisasi = '$id_organisasi'");
$data = mysql_fetch_array($query2);
$userkey = "9znxk5"; //userkey lihat di zenziva
$passkey = "uhn10071999"; // set passkey di zenziva
$message = "Anda Telah ditambahkan di Pengelolaan Uang Kas Online\nOrganisasi : ".$data['nama']."\nJabatan Anda : ".$jabatan."\nUsername : ".$username."\nPassword : ".$password."\n";
$no = $no_telepon;
$url = "https://reguler.zenziva.net/apps/smsapi.php";
$curlHandle = curl_init();
curl_setopt($curlHandle, CURLOPT_URL, $url);
curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$no.'&pesan='.urlencode($message));
curl_setopt($curlHandle, CURLOPT_HEADER, 0);
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
curl_setopt($curlHandle, CURLOPT_POST, 1);
$results = curl_exec($curlHandle);
curl_close($curlHandle);

$XMLdata = new SimpleXMLElement($results);
$status = $XMLdata->message[0]->text;
	echo "<script>alert('Notifikasi Tidak Dikirimkan'<?php echo $status; ?>)</script>";
	?><meta http-equiv="refresh" content="1;url=index.php?aksi=tambah-akun&tambah="><?php


?>