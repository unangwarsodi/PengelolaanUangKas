<?php
    include 'koneksi.php';
    session_start();
    $aksi = $_GET['aksi'];
    $tambah = $_GET['tambah'];
    if(isset($aksi) AND isset($tambah)){
        if($aksi == "tambah-akun" AND $tambah == ""){
?>
            <center><label>Data Akun</label></center><br><hr><br>
            <form action="index.php?aksi=tambah-akun&tambah=insert" method="post">
                <table>
                    <tr>
                        <td style="width:150px;">Nama</td>
                        <td><input type="text" name="nama"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><textarea name="alamat"></textarea></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td><select name="jabatan"><option value="Ketua">Ketua</option><option value="Wakil Ketua">Wakil Ketua</option></select></td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td><input type="text" name="no_telepon"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email"></td>
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
                        <td>Confirm Password</td>
                        <td><input type="password" name="confirm_password"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit">Simpan</button></td>
                    </tr>
                </table>
            </form><br><br><br>

            <center>
                <table align="center" border="1" cellpadding="3" cellspacing="0" width="100%" id="tabel">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jabatan</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                        $id_organisasi = $_SESSION['id_organisasi'];
                        $halaman = 3;  
                        $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                        $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                        $result = mysql_query("SELECT * FROM tbl_anggota WHERE id_organisasi = '$id_organisasi'");  
                        $total = mysql_num_rows($result);  
                        $pages = ceil($total/$halaman);
                        $no = $mulai + 1;
                        $query = mysql_query("SELECT * FROM tbl_anggota WHERE id_organisasi = '$id_organisasi'");
                        while($data = mysql_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['nama'] ?></td>
                        <td><?php echo $data['alamat'] ?></td>
                        <td><?php echo $data['jabatan']?></td>
                        <td><?php echo $data['username'] ?></td>
                        <td><?php echo $data['password'] ?></td>
                        <td>
                            <a href="index.php?aksi=tambah-akun&tambah=edit&id_anggota=<?php echo $data['id_anggota'] ?>"><button id="tombol-kecil-edit"><i class="fa fa-pencil-square-o"></i>&nbspEdit</button></a>&nbsp&nbsp
                            <a href="index.php?aksi=tambah-akun&tambah=delete&id_anggota=<?php echo $data['id_anggota'] ?>" onClick ="return confirm('Apakah Yakin Mau di Hapus ?')"><button id="tombol-kecil-hapus"><i class="fa fa-times"></i>&nbspHapus</button></a>
                        </td>
                    </tr>
                    <?php } ?>
                </table><br>
            <?php for ($i=1; $i<=$pages ; $i++){ ?>  <div class="pagging"><a href="index.php?aksi=tambah-akun&tambah=&halaman=<?php echo $i; ?>"><?php echo $i; ?></a></div><?php } ?>&nbsp 
            </center>

<?php   } 
    
        else if($aksi == "tambah-akun" AND $tambah == "insert"){
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $jabatan = $_POST['jabatan'];
            $no_telepon = $_POST['no_telepon'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $id_organisasi = $_SESSION['id_organisasi'];
            if($password == $confirm_password){
                $query = mysql_query("INSERT INTO tbl_anggota VALUES (null, '$nama', '$alamat', '$email', '$jabatan', '$no_telepon', '$username', '$password', '$id_organisasi')");
                if($query){
                    include 'sms.php';
                    echo "<script>alert('Tambah Data Anggota Berhasil')</script>";
                    ?><meta http-equiv="refresh" content="1;url=index.php?aksi=tambah-akun&tambah="><?php
                }else{
                    echo "<script>alert('Tambah Data Anggota Gagal')</script>";
                    ?><meta http-equiv="refresh" content="1;url=index.php?aksi=tambah-akun&tambah="><?php
                }
            }
        }else if($aksi == "tambah-akun" AND $tambah == "edit"){
            $id_anggota = $_GET['id_anggota'];
            ?><center><label>Data Akun</label></center><br><hr><br>
            <?php
                $query = mysql_query("SELECT * FROM tbl_anggota WHERE id_anggota = '$id_anggota'");
                $data = mysql_fetch_array($query);
            ?>
            <form action="index.php?aksi=tambah-akun&tambah=simpan-edit" method="post">
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
            </form><br><br><br>

            <center>
                <table align="center" border="1" cellpadding="3" cellspacing="0" width="100%" id="tabel">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jabatan</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                        $id_organisasi = $_SESSION['id_organisasi'];
                        $halaman = 3;  
                        $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                        $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                        $result = mysql_query("SELECT * FROM tbl_anggota WHERE id_organisasi = '$id_organisasi'");  
                        $total = mysql_num_rows($result);  
                        $pages = ceil($total/$halaman);
                        $no = $mulai + 1;
                        $query = mysql_query("SELECT * FROM tbl_anggota WHERE id_organisasi = '$id_organisasi'");
                        while($data = mysql_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['nama'] ?></td>
                        <td><?php echo $data['alamat'] ?></td>
                        <td><?php echo $data['jabatan']?></td>
                        <td><?php echo $data['username'] ?></td>
                        <td><?php echo $data['password'] ?></td>
                        <td>
                            <a href="index.php?aksi=tambah-akun&tambah=edit&id_anggota=<?php echo $data['id_anggota'] ?>"><button id="tombol-kecil-edit"><i class="fa fa-pencil-square-o"></i>&nbspEdit</button></a>&nbsp&nbsp
                            <a href="index.php?aksi=tambah-akun&tambah=delete&id_anggota=<?php echo $data['id_anggota'] ?>" onClick ="return confirm('Apakah Yakin Mau di Hapus ?')"><button id="tombol-kecil-hapus"><i class="fa fa-times"></i>&nbspHapus</button></a>
                        </td>
                    </tr>
                    <?php } ?>
                </table><br>
            <?php for ($i=1; $i<=$pages ; $i++){ ?>  <div class="pagging"><a href="index.php?aksi=tambah-akun&tambah=&halaman=<?php echo $i; ?>"><?php echo $i; ?></a></div><?php } ?>&nbsp 
            </center><?php
        }else if($aksi == "tambah-akun" AND $tambah == "delete"){
            $id_anggota = $_GET['id_anggota'];
            $query = mysql_query("DELETE FROM tbl_anggota WHERE id_anggota = '$id_anggota'");
            if($query){
                ?><meta http-equiv="refresh" content="1;url=index.php?aksi=tambah-akun&tambah="><?php
                echo "<script>alert('Delete Anggota Berhasil')</script>";
            }else{
                echo "<script>alert('Delete Anggota Gagal')</script>";
                ?><meta http-equiv="refresh" content="1;url=index.php?aksi=tambah-akun&tambah="><?php
            }
        }else if($aksi == "tambah-akun" AND $tambah == "simpan-edit"){
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
                    ?><meta http-equiv="refresh" content="1;url=index.php?aksi=tambah-akun&tambah="><?php
                }else{
                    echo "<script>alert('Update Anggota Gagal')</script>";
                }
            }else{
                echo "<script>alert('Isi Semua Data Dengan Lengkap')</script>";
                echo "<script>location='index.php?aksi=tambah-akun&tambah=edit&id_anggota=$id_anggota'</script>";
            }
        }
    }
?>

