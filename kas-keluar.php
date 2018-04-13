<?php
    include 'koneksi.php';
    session_start();
    if(isset($_GET['aksi']) AND isset($_GET['tambah'])){
        $aksi = $_GET['aksi'];
        $tambah = $_GET['tambah'];
        if($aksi == "kas-keluar" AND $tambah == ""){
?>
        <center><label>Data Pengeluaran</label></center><br><hr><br>
        <form action="index.php?aksi=kas-keluar&tambah=insert" method="post">
            <table>
                <tr>
                    <td style="width:150px;">Jumlah Pengeluaran</td>
                    <td><input type="text" name="jumlah"></td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td><input type="text" name="keterangan"></td>
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
                    <th width="6%">No</th>
                    <th width="20%">Tanggal</th>
                    <th width="20%">Jumlah</th>
                    <th>Keterangan</th>
                    <th width="20%">Action</th>
                </tr>
                <?php
                    $id_organisasi = $_SESSION['id_organisasi'];
                    $halaman = 5;  
                    $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                    $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                    $result = mysql_query("SELECT * FROM tbl_uangkaskeluar WHERE id_organisasi = '$id_organisasi'");  
                    $total = mysql_num_rows($result);  
                    $pages = ceil($total/$halaman);
                    $no = $mulai + 1;
                    $query = mysql_query("SELECT * FROM tbl_uangkaskeluar WHERE id_organisasi = '$id_organisasi'");
                    while($data = mysql_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['tanggal']?></td>
                    <td><?php echo $data['jumlah']?></td>
                    <td><?php echo $data['keterangan']?></td>
                    <td>
                        <a href="index.php?aksi=kas-keluar&tambah=edit&id_kas_keluar=<?php echo $data['id_kas_keluar']?>"><button id="tombol-kecil-edit"><i class="fa fa-pencil-square-o"></i>&nbspEdit</button></a>&nbsp&nbsp
                        <a href="index.php?aksi=kas-keluar&tambah=delete&id_kas_keluar=<?php echo $data['id_kas_keluar']?>" onClick ="return confirm('Apakah Yakin Mau di Hapus ?')"><button id="tombol-kecil-hapus"><i class="fa fa-times"></i>&nbspHapus</button></a>
                    </td>
                </tr>
                <?php
                    }
                    $query2 = mysql_query("SELECT * FROM tbl_uangkasmasuk WHERE id_organisasi = '$id_organisasi' ORDER BY id_kas_masuk DESC LIMIT 1");
                    $query3 = mysql_query("SELECT *, SUM(jumlah) AS jml FROM tbl_uangkaskeluar WHERE id_organisasi = '$id_organisasi'");
                    $data = mysql_fetch_array($query2);
                    $data2 = mysql_fetch_array($query3);
                ?>
                <tr>
                    <td colspan="2">Jumlah Pengeluaran</td>
                    <td colspan="3"><?php echo $data2['jml'] ?></td>
                </tr>
                <tr>
                    <td colspan="2">Jumlah Uang Kas Yang Tersisa</td>
                    <td colspan="3"><?php echo $data['total'] ?></td>
                </tr>
            </table><br>
            <?php for ($i=1; $i<=$pages ; $i++){ ?>  <div class="pagging"><a href="index.php?aksi=kas-keluar&tambah=&halaman=<?php echo $i; ?>"><?php echo $i; ?></a></div><?php } ?>&nbsp 
        </center>
<?php
        }else if($aksi == "kas-keluar" AND $tambah == "insert"){
            include 'tgl_indo.php';
            $id_organisasi = $_SESSION['id_organisasi'];
            $query2 = mysql_query("SELECT * FROM tbl_uangkasmasuk WHERE id_organisasi = '$id_organisasi' ORDER BY id_kas_masuk DESC LIMIT 1");
            $data = mysql_fetch_array($query2);
            $jumlah = $_POST['jumlah'];
            $total = $data['total'] - $jumlah;
            $keterangan = $_POST['keterangan'];
            $tanggal = tgl_indo(date('Y-m-d'));
            $query3 = mysql_query("UPDATE tbl_uangkasmasuk SET total = '$total' WHERE id_organisasi='$id_organisasi' ORDER BY id_kas_masuk DESC LIMIT 1");
            $query = mysql_query("INSERT INTO tbl_uangkaskeluar VALUES(null, '$tanggal', '$jumlah', '$keterangan', '$id_organisasi')");
            if($query){
                echo "<script>alert('Simpan Berhasil')</script>";
                ?><meta http-equiv="refresh" content="1;url=index.php?aksi=kas-keluar&tambah="><?php
            }else{
                echo mysql_error();
                echo "<script>alert('Simpan Gagal')</script>";
                ?><meta http-equiv="refresh" content="1;url=index.php?aksi=kas-keluar&tambah="><?php
            }
        }else if($aksi == "kas-keluar" AND $tambah == "edit"){
            $id_kas_keluar = $_GET['id_kas_keluar'];
            $query = mysql_query("SELECT * FROM tbl_uangkaskeluar WHERE id_kas_keluar = '$id_kas_keluar'");
            $data = mysql_fetch_array($query);
            ?><center><label>Data Pengeluaran</label></center><br><hr><br>
            <form action="index.php?aksi=kas-keluar&tambah=simpan-edit" method="post">
                <input type="text" name="id_kas_keluar" value="<?php echo $data['id_kas_keluar']?>" hidden>
                <table>
                    <tr>
                        <td style="width:150px;">Jumlah Pengeluaran</td>
                        <td><input type="text" name="jumlah" value="<?php echo $data['jumlah']?>"></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td><input type="text" name="keterangan" value="<?php echo $data['keterangan']?>"></td>
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
                        <th width="6%">No</th>
                        <th width="20%">Tanggal</th>
                        <th width="20%">Jumlah</th>
                        <th>Keterangan</th>
                        <th width="20%">Action</th>
                    </tr>
                    <?php
                        $id_organisasi = $_SESSION['id_organisasi'];
                        $halaman = 5;  
                        $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                        $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                        $result = mysql_query("SELECT * FROM tbl_uangkaskeluar WHERE id_organisasi = '$id_organisasi'");  
                        $total = mysql_num_rows($result);  
                        $pages = ceil($total/$halaman);
                        $no = $mulai + 1;
                        $query = mysql_query("SELECT * FROM tbl_uangkaskeluar WHERE id_organisasi = '$id_organisasi'");
                        while($data = mysql_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['tanggal']?></td>
                        <td><?php echo $data['jumlah']?></td>
                        <td><?php echo $data['keterangan']?></td>
                        <td>
                            <a href="index.php?aksi=kas-keluar&tambah=edit&id_kas_keluar=<?php echo $data['id_kas_keluar']?>"><button id="tombol-kecil-edit"><i class="fa fa-pencil-square-o"></i>&nbspEdit</button></a>&nbsp&nbsp
                        <a href="index.php?aksi=kas-keluar&tambah=delete&id_kas_keluar=<?php echo $data['id_kas_keluar']?>" onClick ="return confirm('Apakah Yakin Mau di Hapus ?')"><button id="tombol-kecil-hapus"><i class="fa fa-times"></i>&nbspHapus</button></a>
                        </td>
                    </tr>
                    <?php
                        }
                        $query2 = mysql_query("SELECT * FROM tbl_uangkasmasuk WHERE id_organisasi = '$id_organisasi' ORDER BY id_kas_masuk DESC LIMIT 1");
                        $query3 = mysql_query("SELECT *, SUM(jumlah) AS jml FROM tbl_uangkaskeluar WHERE id_organisasi = '$id_organisasi'");
                        $data = mysql_fetch_array($query2);
                        $data2 = mysql_fetch_array($query3);
                    ?>
                    <tr>
                        <td colspan="2">Jumlah Pengeluaran</td>
                        <td colspan="3"><?php echo $data2['jml'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Jumlah Uang Kas Yang Tersisa</td>
                        <td colspan="3"><?php echo $data['total'] ?></td>
                    </tr>
                </table><br>
            <?php for ($i=1; $i<=$pages ; $i++){ ?>  <div class="pagging"><a href="index.php?aksi=kas-keluar&tambah=&halaman=<?php echo $i; ?>"><?php echo $i; ?></a></div><?php } ?>&nbsp 
            </center><?php
        }else if($aksi == "kas-keluar" AND $tambah == "simpan-edit"){
            $id_organisasi = $_SESSION['id_organisasi'];
            $jumlah = $_POST['jumlah'];
            $keterangan = $_POST['keterangan'];
            $id_kas_keluar = $_POST['id_kas_keluar'];
            $query2 = mysql_query("SELECT * FROM tbl_uangkaskeluar WHERE id_kas_keluar = '$id_kas_keluar'");
            $data = mysql_fetch_array($query2);
            $query3 = mysql_query("SELECT * FROM tbl_uangkasmasuk WHERE id_organisasi = '$id_organisasi' ORDER BY id_kas_masuk DESC LIMIT 1");
            $data2 = mysql_fetch_array($query3);
            $selisih = -$jumlah + $data['jumlah'];
            $total = $data2['total'] + $selisih;
            $query = mysql_query("UPDATE tbl_uangkaskeluar SET jumlah = '$jumlah', keterangan = '$keterangan' WHERE id_kas_keluar = '$id_kas_keluar'");
            $query4 = mysql_query("UPDATE tbl_uangkasmasuk SET total = '$total' WHERE id_organisasi='$id_organisasi' ORDER BY id_kas_masuk DESC LIMIT 1");
            if($query AND $query3){
                echo "<script>alert('Update Berhasil')</script>"
                ?><meta http-equiv="refresh" content="1;url=index.php?aksi=kas-keluar&tambah="><?php
            }else{
                echo mysql_error();
                echo "<script>alert('Update Gagal')</script>";
                ?><meta http-equiv="refresh" content="1;url=index.php?aksi=kas-keluar&tambah="><?php
            }
        }else if($aksi == "kas-keluar" AND $tambah == "delete"){
            $id_kas_keluar = $_GET['id_kas_keluar'];
            $id_organisasi = $_SESSION['id_organisasi'];
            $query2 = mysql_query("SELECT * FROM tbl_uangkaskeluar WHERE id_kas_keluar = '$id_kas_keluar'");
            $data = mysql_fetch_array($query2);
            $query3 = mysql_query("SELECT * FROM tbl_uangkasmasuk WHERE id_organisasi = '$id_organisasi' ORDER BY id_kas_masuk DESC LIMIT 1");
            $data2 = mysql_fetch_array($query3);
            $total = $data2['total'] + $data['jumlah'];
            $query = mysql_query("DELETE FROM tbl_uangkaskeluar WHERE id_kas_keluar = '$id_kas_keluar'");
            $query4 = mysql_query("UPDATE tbl_uangkasmasuk SET total = '$total' WHERE id_organisasi='$id_organisasi' ORDER BY id_kas_masuk DESC LIMIT 1");
            if($query AND $query4){
                echo "<script>alert('Delete Berhasil')</script>"
                ?><meta http-equiv="refresh" content="1;url=index.php?aksi=kas-keluar&tambah="><?php
            }else{
                echo mysql_error();
                echo "<script>alert('Delete Gagal')</script>";
                ?><meta http-equiv="refresh" content="1;url=index.php?aksi=kas-keluar&tambah="><?php
            }
        }
    }
?>
