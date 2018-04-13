<?php
include 'koneksi.php';
session_start();
// memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF();
// membuat halaman baru
$pdf->AddPage('P', 'A4');
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
$query5 = mysql_query("SELECT * FROM tbl_organisasi WHERE id_organisasi = '$_SESSION[id_organisasi]'");
$data5 = mysql_fetch_array($query5);
// mencetak string 
$organisasi = $data5['nama'];
$pdf->Cell(0,20,'LAPORAN DATA PENGELUARAN UANG KAS','0',1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0,"Organisasi ".$organisasi,'0',0,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,15,'',0,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(20,7,'No',1,0,'C');
$pdf->Cell(45,7,'Tanggal',1,0,'C');
$pdf->Cell(40,7,'Jumlah',1,0,'C');
$pdf->Cell(85,7,'Keterangan',1,1,'C');

$pdf->SetFont('Arial','',12);

$id_organisasi = $_SESSION['id_organisasi'];
$no = 1;
$query = mysql_query("SELECT * FROM tbl_uangkaskeluar WHERE id_organisasi = '$id_organisasi'");
while ($data = mysql_fetch_array($query)){
	$pdf->Cell(20,7,$no++,1,0,'C');
    $pdf->Cell(45,7,$data['tanggal'],1,0,'C');
    $pdf->Cell(40,7,$data['jumlah'],1,0,'C');
    $pdf->Cell(85,7,$data['keterangan'],1,1,'C');
}
$query2 = mysql_query("SELECT *, SUM(jumlah) AS total FROM tbl_uangkaskeluar WHERE id_organisasi = '$id_organisasi'");
$data2 = mysql_fetch_array($query2);
$query3 = mysql_query("SELECT *, SUM(jumlah) AS total FROM tbl_uangkasmasuk WHERE id_organisasi = '$id_organisasi'");
$data3 = mysql_fetch_array($query3);
$query4 = mysql_query("SELECT * FROM tbl_uangkasmasuk WHERE id_organisasi = '$id_organisasi' ORDER BY id_kas_masuk DESC LIMIT 1");
$data4 = mysql_fetch_array($query4);
$pdf->Cell(0,20,'Jumlah Pemasukkan Uang Kas Rp.'.$data3['total'],'0',1);
$pdf->Cell(0,1,'Jumlah Pengeluaran Uang Kas Rp.'.$data2['total'],'0',1);
$pdf->Cell(0,20,'Sisa Uang Kas Rp.'.$data4['total'],'0',1);
$pdf->Output();
?>
