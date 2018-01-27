<?php
include "../koneksi.php";
$kota = $_GET['kota'];
$kec = mysql_query("SELECT * FROM kecamatan WHERE id_kabupaten='$kota' order by id_kecamatan");
echo "<option>-- Pilih Kecamatan --</option>";
while($k = mysql_fetch_array($kec)){
    echo "<option value=\"".$k['id_kecamatan']."\">".$k['nama_kecamatan']."</option>\n";
}
?>
