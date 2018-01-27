<?php
include "../koneksi.php";
$kec = $_GET['kec'];
$kel = mysql_query("SELECT * FROM kelurahan WHERE id_kecamatan='$kec' order by id_kelurahan");
echo "<option>-- Pilih Kelurahan/Desa --</option>";
while($k = mysql_fetch_array($kel)){
     echo "<option value=\"".$k['id_kelurahan']."\">".$k['nama_kelurahan']."</option>\n";
}
?>
