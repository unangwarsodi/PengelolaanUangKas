<?php
    include 'koneksi.php';
    session_start();
    if(!isset($_SESSION['id_organisasi']) AND !isset($_SESSION['id_anggota'])){
        ?><meta http-equiv="refresh" content="1;url=login.php"><?php
    }else{
?>
<html>
<head>
<title>Dashboard</title>
<link href="css.css" rel="stylesheet">
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>
<body>
    <div class="menu-wrap">
        <ul>
            <li><a href="">Akun Saya</a>
                <ul>
                    <li><a href="index.php?aksi=akun-saya&tambah="><i class="fa fa-user"></i>&nbsp&nbsp&nbsp Akun Saya</a></li>
                    <li><a href="logout.php" onclick="return confirm('Apakah Yakin Mau Logout ?')">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <table id="navigasi" border="1">
        <tr>
            <th>MENU</th>
        </tr>
        <?php
            if(isset($_SESSION['id_organisasi']) AND !isset($_SESSION['id_anggota'])){
        ?>
        <tr>
            <td><a href="index.php?aksi=tambah-akun&tambah=">Tambah Akun</a></td>
        </tr>
        <tr>
            <td><a href="index.php?aksi=kas-masuk&tambah=">Uang Kas Masuk</a></td>
        </tr>
        <tr>
            <td><a href="index.php?aksi=kas-keluar&tambah=">Uang Kas Keluar</td>
        </tr>
        <tr>
            <td><a href="index.php?aksi=laporan-kas-masuk">Laporan Uang Kas Masuk</td>
        </tr>
        <tr>
            <td><a href="index.php?aksi=laporan-kas-keluar">Laporan Uang Kas Keluar</td>
        </tr>
        <?php
            } else if(isset($_SESSION['id_organisasi']) AND isset($_SESSION['id_anggota'])){
        ?>
        <tr>
            <td><a href="index.php?aksi=laporan-kas-masuk">Laporan Uang Kas Masuk</td>
        </tr>
        <tr>
            <td><a href="index.php?aksi=laporan-kas-keluar">Laporan Uang Kas Keluar</td>
        </tr>
        <?php } ?>
    </table>
    <div id="content">
        <?php
            $aksi = $_GET['aksi'];
            if($aksi == "utama"){
                include 'utama.php';
            } else if($aksi == "tambah-akun"){
                include 'tambah-akun.php';
            } else if($aksi == "kas-masuk"){
                include 'kas-masuk.php';
            } else if($aksi == "kas-keluar"){
                include 'kas-keluar.php';
            } else if($aksi == "laporan-kas-keluar"){
                include 'laporan-kas-keluar.php';
            } else if($aksi == "laporan-kas-masuk"){
                include 'laporan-kas-masuk.php';
            } else if($aksi == "akun-saya"){
                include 'akun-saya.php';
            }
        
        ?>
    </div>
</body>
</html>
<?php } ?>
