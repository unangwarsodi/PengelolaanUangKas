    <?php
    include 'koneksi.php';
    session_start();
    ?>
        <center><label>Data Organisasi</label></center><br><hr><br>
        <?php
            $query = mysql_query("SELECT * FROM tbl_organisasi WHERE id_organisasi = '$_SESSION[id_organisasi]'");
            $data = mysql_fetch_array($query);
        ?>
        <table cellspacing="10">
            <tr>
                <td>Nama Organisasi</td>
                <td><?php echo $data['nama'] ?></td>
            </tr>
            <tr>
                <td>Alamat Organisasi</td>
                <td><?php echo $data['alamat'] ?></td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td><?php echo $data['no_telepon'] ?></td>
            </tr>
        </table>
