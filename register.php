<html>
<head>
<title>Register Organisasi</title>
<link href="css.css" rel="stylesheet">
</head>
<body>
    <center>
    <div id="register">
        <label>Register Organisasi</label><hr>
       <form action="register.php?aksi=register" method="post">
        <table align="center">
            <tr>
                <td>Nama Organisasi</td>
                <td><input type="text" name="nama_organisasi"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat_organisasi"></textarea></td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td><input type="text" name="no_telepon"></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Confirm Password &nbsp&nbsp&nbsp</td>
                <td><input type="password" name="confirm_password"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">Register</button></td>
            </tr>
        </table>
    </form>
    </div>
    <p>Copyright &copy 2017 By. Blender
</body>
</html>
<?php
    include 'koneksi.php';
    if(isset($_GET['aksi'])){
        $aksi = $_GET['aksi'];
        if($aksi == "register"){
            $nama_organisasi = $_POST['nama_organisasi'];
            $alamat_organisasi = $_POST['alamat_organisasi'];
            $no_telepon = $_POST['no_telepon'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            if($password == $confirm_password){
                $query = mysql_query("INSERT INTO tbl_organisasi VALUES(null, '$nama_organisasi', '$alamat_organisasi', '$no_telepon', '$username', '$password')");
                if($query){
                    echo "<script>alert('Register Berhasil')</script>";
                    ?><meta http-equiv="refresh" content="1;url=login.php"><?php
                }else{
                    echo "<script>alert('Register Gagal')</script>";
                    ?><meta http-equiv="refresh" content="1;url=register.php"><?php
                }
            }
        }
    }
?>
