<?php
ob_start(); //ditambahkan untuk mengabaikan pengiriman header, berlaku juga untuk mengabaikan pesan error header
$host="localhost";
$user="root";
$pass="";
$db="crud_mysqli";
$koneksi=mysqli_connect($host,$user,$pass,$db);
?>

<?php 
mysql_connect("localhost","root","");
mysql_select_db("crud_mysqli");
?>