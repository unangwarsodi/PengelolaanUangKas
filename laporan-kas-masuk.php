        <center><label>Data Pemasukkan</label></center><br><hr><br>
        <center>
            <table align="center" border="1" cellpadding="3" cellspacing="0" width="100%" id="tabel">
                <tr>
                    <th width="6%">No</th>
                    <th width="20%">Tanggal</th>
                    <th width="20%">Jumlah</th>
                    <th>Keterangan</th>
                </tr>
                <?php
                    include 'koneksi.php';
                    session_start();
                    $id_organisasi = $_SESSION['id_organisasi'];
                    $halaman = 10;  
                    $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                    $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                    $result = mysql_query("SELECT * FROM tbl_uangkasmasuk WHERE id_organisasi = '$id_organisasi'");  
                    $total = mysql_num_rows($result);  
                    $pages = ceil($total/$halaman);
                    $no = $mulai + 1;
                    $query = mysql_query("SELECT * FROM tbl_uangkasmasuk WHERE id_organisasi = '$id_organisasi'");
                    while($data = mysql_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['tanggal'] ?></td>
                    <td><?php echo $data['jumlah'] ?></td>
                    <td><?php echo $data['keterangan'] ?></td>
                </tr>
                <?php
                    }
                    $query2 = mysql_query(("SELECT * FROM tbl_uangkasmasuk WHERE id_organisasi = '$id_organisasi' ORDER BY id_kas_masuk DESC LIMIT 1"));
                    $data = mysql_fetch_array($query2);
                ?>
                <tr>
                    <td colspan="2">Sisa Uang Kas</td>
                    <td colspan="3"><?php echo $data['total'] ?></td>
                </tr>
            </table><br>
            <?php for ($i=1; $i<=$pages ; $i++){ ?>  <div class="pagging"><a href="index.php?aksi=laporan-kas-masuk&halaman=<?php echo $i; ?>"><?php echo $i; ?></a></div><?php } ?>&nbsp 
        </center>
        <a href="convert-kas-masuk.php"><button id="tombol-sedang-kanan">Convert</button></a>
