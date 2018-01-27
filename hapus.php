<?php
include "koneksi.php";
echo "<script>alert('Data Telah Di Hapus');document.location='index.php'</script>";
$a="DELETE from mhsasia WHERE id='$_GET[id]'";
$b=mysqli_query($koneksi,$a);
?>