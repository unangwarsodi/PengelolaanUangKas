<html>
<head>
<title>LOGIN USER</title>
<link href="css.css" rel="stylesheet">
</head>
<body>
    <center>
    <div id="login">
        <label>Login</label><hr>
        <form action="login.php?aksi=login" method="post">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <button type="submit">LOGIN</button>
            <a href="register.php">Register Organisasi</a>
        </form>
    </div>
    <p>Copyright &copy 2017 By. Blender
</body>
</html>
<?php
    include 'koneksi.php';
    if(isset($_GET['aksi'])){
        if($_GET['aksi'] == 'login'){
           $username = $_POST['username'];
            $password = $_POST['password'];
            $query = mysql_query("SELECT * FROM tbl_organisasi WHERE username = '$username' AND password = '$password'");
            $result = mysql_num_rows($query);
            if($result >= 1){
                session_start();
                $data = mysql_fetch_array($query);
                $_SESSION['id_organisasi'] = $data['id_organisasi'];
                echo "<script>alert('Login Berhasil')</script>";
                ?><meta http-equiv="refresh" content="1;url=index.php?aksi=utama"><?php
            }else{
                $query2 = mysql_query("SELECT * FROM tbl_anggota WHERE username = '$username' AND password = '$password'");
                $result2 = mysql_num_rows($query2);
                if($result2 >= 1){
                    session_start();
                    $data = mysql_fetch_array($query2);
                    $_SESSION['id_anggota'] = $data['id_anggota'];
                    $_SESSION['id_organisasi'] = $data['id_organisasi'];
                    echo "<script>alert('Login Berhasil')</script>";
                    ?><meta http-equiv="refresh" content="1;url=index.php?aksi=utama"><?php
                }
            }
        }
    }
?>
