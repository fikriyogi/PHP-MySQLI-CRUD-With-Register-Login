<?php
include "../koneksi.php";
$propinsi = $_GET['propinsi'];
$kota = mysql_query("SELECT * FROM kabupaten WHERE id_provinsi='$propinsi' order by id_kabupaten");
echo "<option>-- Pilih Kabupaten/Kota --</option>";
while($k = mysql_fetch_array($kota)){
     echo "<option value=\"".$k['id_kabupaten']."\">".$k['nama_kabupaten']."</option>\n";
}
?>
