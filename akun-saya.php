<?php
    include 'koneksi.php';
    session_start();
    $aksi = $_GET['aksi'];
    $tambah = $_GET['tambah'];
    $id_organisasi = $_SESSION['id_organisasi'];
    $id_anggota = $_SESSION['id_anggota'];
    if(isset($id_organisasi) AND !isset($id_anggota)){
?>
            <center><label>Akun Organisasi</label></center><br><hr><br>
            <form action="index.php?aksi=akun-saya&tambah=simpan-edit" method="post">
                <?php
                    $id_organisasi = $_SESSION['id_organisasi'];
                    $query = mysql_query("SELECT * FROM tbl_organisasi WHERE id_organisasi = '$id_organisasi'");
                    $data = mysql_fetch_array($query);
                ?>
                <input type="text" name="id_organisasi" value="<?php echo $data['id_organisasi'] ?>" hidden>
                <table align="center">
                    <tr>
                        <td>Nama Organisasi</td>
                        <td><input type="text" name="nama_organisasi" value="<?php echo $data['nama'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><textarea name="alamat_organisasi"><?php echo $data['alamat'] ?></textarea></td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td><input type="text" name="no_telepon" value="<?php echo $data['no_telepon'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" value="<?php echo $data['username'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" value="<?php echo $data['password'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password &nbsp&nbsp&nbsp</td>
                        <td><input type="password" name="confirm_password"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit">Simpan</button></td>
                    </tr>
                </table>
            </form><?php


            if($aksi == "akun-saya" AND $tambah == "simpan-edit"){
                    $id_organisasi = $_POST['id_organisasi'];
                    $nama_organisasi = $_POST['nama_organisasi'];
                    $alamat_organisasi = $_POST['alamat_organisasi'];
                    $no_telepon = $_POST['no_telepon'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirm_password'];
                    $id_anggota = $_POST['id_anggota'];
                    if($password == $confirm_password){
                        $query = mysql_query("UPDATE tbl_organisasi SET nama='$nama_organisasi', alamat='$alamat_organisasi', no_telepon='$no_telepon', username='$username', password='$password' WHERE id_organisasi='$id_organisasi'");
                        if($query){
                            echo "<script>alert('Update Organisasi Berhasil')</script>";
                            ?><meta http-equiv="refresh" content="1;url=index.php?aksi=akun-saya&tambah="><?php
                        }else{
                            echo "<script>alert('Update Organisasi Gagal')</script>";
                        }
                    }else{
                        echo "<script>alert('Isi Semua Data Dengan Lengkap')</script>";
                        echo "<script>location='index.php?aksi=akun-saya&tambah='</script>";
                    }
            }

  
    }else if(isset($id_organisasi) AND isset($id_anggota)){
            ?><center><label>Data Akun</label></center><br><hr><br>
            <?php
                $query = mysql_query("SELECT * FROM tbl_anggota WHERE id_anggota = '$id_anggota'");
                $data = mysql_fetch_array($query);
            ?>
            <form action="index.php?aksi=akun-saya&tambah=simpan-edit" method="post">
            <input type="text" name="id_anggota" value="<?php echo $data['id_anggota'] ?>" hidden>
                <table>
                    <tr>
                        <td style="width:150px;">Nama</td>
                        <td><input type="text" name="nama" value="<?php echo $data['nama'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><textarea name="alamat"><?php echo $data['alamat'] ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>

                        <td>
                            <select name="jabatan">
                                <?php
                                    if($data['jabatan'] == "Ketua"){
                                ?>
                                <option value="Ketua">Ketua</option>
                                <option value="Wakil Ketua">Wakil Ketua</option>
                                <?php 
                                    } else{
                                        ?><option value="Wakil Ketua">Wakil Ketua</option>
                                        <option value="Ketua">Ketua</option><?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td><input type="text" name="no_telepon" value="<?php echo $data['no_telepon'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email" value="<?php echo $data['email'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" value="<?php echo $data['username'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" value="<?php echo $data['password'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name="confirm_password"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit">Simpan</button></td>
                    </tr>
                </table>
            </form><?php
            if($aksi == "akun-saya" AND $tambah == "simpan-edit"){
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $jabatan = $_POST['jabatan'];
            $no_telepon = $_POST['no_telepon'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $id_anggota = $_POST['id_anggota'];
            if($password == $confirm_password){
                $query = mysql_query("UPDATE tbl_anggota SET nama='$nama', alamat='$alamat', email='$email', jabatan='$jabatan', no_telepon='$no_telepon', username='$username', password='$password' WHERE id_anggota='$id_anggota'");
                if($query){
                    echo "<script>alert('Update Anggota Berhasil')</script>";
                    ?><meta http-equiv="refresh" content="1;url=index.php?aksi=akun-saya&tambah="><?php
                }else{
                    echo "<script>alert('Update Anggota Gagal')</script>";
                }
            }else{
                echo "<script>alert('Isi Semua Data Dengan Lengkap')</script>";
                echo "<script>location='index.php?aksi=akun-saya&tambah=edit&id_anggota=$id_anggota'</script>";
            }
        }
    }

?>

