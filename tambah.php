<?php
session_start();
include 'koneksi.php';
include 'assets/function.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
$res=mysqli_query($koneksi, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_assoc($res);
?>
<?php
//include file koneksi ke mysql

if(isset($_POST['tblIsi'])){
	$id = $_POST['id'];
	$nama = $_POST['nama'];
  $panggilan = $_POST['panggilan'];
	$no_kk = $_POST['no_kk'];
	$nik = $_POST['nik'];
  $tempat = $_POST['tempat'];
  $tgl_lahir = $_POST['tgl_lahir'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $ayah = $_POST['ayah'];
  $ibu = $_POST['ibu'];
	$email = $_POST['email'];
	$gol_darah = $_POST['gol_darah'];
	$kewarganegaraan = $_POST['kewarganegaraan'];
	$prov = $_POST['prov'];
	$kab = $_POST['kab'];
	$kec = $_POST['kec'];
	$desa = $_POST['desa'];
	$dusun = $_POST['dusun'];
	$rt = $_POST['rt'];
	$rw = $_POST['rw'];
	$alamat = $_POST['alamat'];
	$kd_pos = $_POST['kd_pos'];
  $tps = $_POST['tps'];
	$agama = $_POST['agama'];
	$status_nikah = $_POST['status_nikah'];
	$status_warga = $_POST['status_warga'];
	$pendidikan = $_POST['pendidikan'];
	$pekerjaan = $_POST['pekerjaan'];
	$no_telpon = $_POST['no_telpon'];
	@$photo = $_POST['photo'];
  @$photo_rumah = $_POST['photo_rumah'];
  @$lat = $_POST['lat'];
  @$lng = $_POST['lng'];
	$admin = $_POST['admin'];



	if (empty($nama))
	{ 
		die("<script>alert('Isikan Nama');document.location='tambah.php'</script>");
	} 
  elseif (empty($nik))
  { 
    die("<script>alert('Isikan NIK');document.location='tambah.php'</script>");
  } 
	else
	{
		$query = mysqli_query($koneksi, "SELECT * FROM mhsasia WHERE nama='".$nama."'");

		if (!$query)
		{
			die('Error: ' . mysqli_error($koneksi));
		}

		if(mysqli_num_rows($query) > 0){

			die("<script>alert('Nama Sudah ada');document.location='tambah.php'</script>");

		}else{

    // do something

		}
	}
	
	
	
	if (!empty($_FILES["photo"]["tmp_name"]))
	{
    $namafolder="photo/profil/";  //tempat menyimpan file
    $jenis_gambar=$_FILES['photo']['type'];
    if($jenis_gambar=="image/jpeg"  || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png")
    {           
    	$photo  = $namafolder . basename($_FILES['photo']['name']);       
    	if  (!move_uploaded_file($_FILES['photo']['tmp_name'], $photo))
    		{ die("Gambar gagal dikirim"); }
    } else  { die("Jenis gambar yang anda kirim salah. Harus .jpg .gif .png"); }
  }  //end if cek file upload
  if (!empty($_FILES["photo_rumah"]["tmp_name"]))
  {
    $namafolder="photo/rumah/";  //tempat menyimpan file
    $jenis_gambar=$_FILES['photo_rumah']['type'];
    if($jenis_gambar=="image/jpeg"  || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png")
    {           
      $photo_rumah  = $namafolder . basename($_FILES['photo_rumah']['name']);       
      if  (!move_uploaded_file($_FILES['photo_rumah']['tmp_name'], $photo_rumah))
        { die("Gambar gagal dikirim"); }
    } else  { die("Jenis gambar yang anda kirim salah. Harus .jpg .gif .png"); }
  }  //end if cek file upload

  

  @$a="insert into mhsasia values  ('$id','$nama','$panggilan','$no_kk','$nik','$tempat','$tgl_lahir','$jenis_kelamin','$ayah','$ibu','$email','$gol_darah','$kewarganegaraan','$prov','$kab','$kec','$desa','$dusun','$rt','$rw','$alamat','$kd_pos','$tps','$agama','$status_nikah','$status_warga','$pendidikan','$pekerjaan','$no_telpon','$photo','$photo_rumah','$lat','$lng','$admin')";
  $b=mysqli_query($koneksi,$a);
  echo "<script>alert('Data Disimpan');document.location='index.php'</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="assets/jquery.min.js"></script>
<script type="text/javascript">
				var htmlobjek;
				$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#propinsi").change(function(){
  	var propinsi = $("#propinsi").val();
  	$.ajax({
  		url: "data/ambilkota.php",
  		data: "propinsi="+propinsi,
  		cache: false,
  		success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });
  $("#kota").change(function(){
  	var kota = $("#kota").val();
  	$.ajax({
  		url: "data/ambilkecamatan.php",
  		data: "kota="+kota,
  		cache: false,
  		success: function(msg){
  			$("#kec").html(msg);
  		}
  	});
  });

  $("#kec").change(function(){
  	var kec = $("#kec").val();
  	$.ajax({
  		url: "data/ambilkelurahan.php",
  		data: "kec="+kec,
  		cache: false,
  		success: function(msg){
  			$("#kel").html(msg);
  		}
  	});
  });
});

</script>
<title>Tambah Data</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
  <table align="center" frame="box">
    <tr>
      <td><img src="assets/instansi-logo.png" width="150" height="150" /></td>
      <td><span id="ministry-title">INSPEKTORAT JENDERAL&nbsp;</span> <br />
      <span id="country-ministry">KEMENTERIAN LUAR NEGERI REPUBLIK INDONESIA</span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#CCCCCC">Identitas Pribadi </td>
    </tr>
    <tr>
      <td width="159">ID</td>
      <td width="885"><input type="text" name="id" size="8" /></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><input type="text" name="nama" size="20" /></td>
    </tr>
    <tr>
      <td>Panggilan</td>
      <td><input type="text" name="panggilan" size="20" /></td>
    </tr>
    <tr>
      <td>No. KK </td>
      <td><input type="text" name="no_kk" size="10" /></td>
    </tr>
    <tr>
      <td>NIK</td>
      <td><input type="text" name="nik" size="18" /></td>
    </tr>
    <tr>
      <td>Tempat</td>
      <td><input type="text" name="tempat" size="18" /></td>
    </tr>
    <tr>
      <td>Tanggal Lahir</td>
      <td><input type="date" name="tgl_lahir" /></td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td><input type="text" name="jenis_kelamin" /></td>
    </tr>
    <tr>
      <td>Ayah</td>
      <td><input type="text" name="ayah" /></td>
    </tr>
    <tr>
      <td>Ibu</td>
      <td><input type="text" name="ibu" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input type="text" name="email" size="28" /></td>
    </tr>
    <tr>
      <td>Golngan Darah </td>
      <td><label>
        <select name="gol_darah">
          <option value="">.: Pilih Golngan Darah :.</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="AB">AB</option>
          <option value="O">O</option>
        </select>
        </label></td>
    </tr>
    <tr>
      <td>Kewarganegaraan</td>
      <td><select name="kewarganegaraan">
          <option>.: Pilih Kewarganegaraan :.</option>
          <option value="IN">Indonesia</option>
        </select></td>
    </tr>
    <tr>
      <td>Provinsi</td>
      <td><select name="prov" id="propinsi">
          <option>--Pilih Provinsi--</option>
          <?php
//mengambil nama-nama propinsi yang ada di database
											$propinsi = mysql_query("SELECT * FROM provinsi ORDER BY id_provinsi");
											while($p=mysql_fetch_array($propinsi)){
												echo "<option value=\"$p[id_provinsi]\">$p[nama_provinsi]</option>\n";
											}
											?>
        </select></td>
    </tr>
    <tr>
      <td>Kabupaten</td>
      <td><select name="kab" id="kota">
          <option>--Pilih Kabupaten/Kota--</option>
          <?php
//mengambil nama-nama kabupaten/kota yang ada di database
												$kota = mysql_query("SELECT * FROM kabupaten ORDER BY id_kabupaten");
												while($p=mysql_fetch_array($propinsi)){
													echo "<option value=\"$p[id_kabupaten]\">$p[nama_kabupaten]</option>\n";
												}
												?>
        </select></td>
    </tr>
    <tr>
      <td>Kecamatan</td>
      <td><select name="kec" id="kec">
          <option>--Pilih Kecamatan--</option>
          <?php
//mengambil nama-nama kecamatan yang ada di database
													$kec = mysql_query("SELECT * FROM kecamatan ORDER BY id_kecamatan");
													while($p=mysql_fetch_array($kota)){
														echo "<option value=\"$p[id_kecamatan]\">$p[nama_kecamatan]</option>\n";
													}
													?>
        </select></td>
    </tr>
    <tr>
      <td>Desa</td>
      <td><select name="desa" id="kel">
          <option>--Pilih Kelurahan--</option>
          <?php
														$kel = mysql_query("SELECT * FROM kelurahan ORDER BY id_kelurahan");
														while($p=mysql_fetch_array($kec)){
															echo "<option value=\"$p[id_kelurahan]\">$p[nama_dusun]</option>\n";
														}
														?>
        </select></td>
    </tr>
    <tr>
      <td>Dusun</td>
      <td><select name="dusun">
          <option>.: Pilih Dusun :.</option>
          <option value="IN">Indonesia</option>
        </select></td>
    </tr>
    <tr>
      <td>RT / RW </td>
      <td><input type="text" name="rt" size="5" />
        /
        <input type="text" name="rw" size="5" /></td>
    </tr>
    <tr>
      <td>Alamat </td>
      <td><input type="text" name="alamat" size="30" /></td>
    </tr>
    <tr>
      <td>Kode Pos </td>
      <td><input name="kd_pos" type="text" size="5" maxlength="5" /></td>
    </tr>
    <tr>
      <td>TPS </td>
      <td><input name="tps" type="number" size="5" maxlength="5" /></td>
    </tr>
    <tr>
      <td>Agama</td>
      <td><select name="agama">
          <option value="0">.: Pilih Agama :.</option>
          <option value="1">Islam</option>
          <option value="2">Kristen</option>
          <option value="3">Hindu</option>
          <option value="4">Budha</option>
          <option value="5">Konghucu</option>
        </select></td>
    </tr>
    <tr>
      <td>Status Nikah </td>
      <td><select name="status_nikah">
          <option >.: Pilih Status Nikah :.</option>
          <option value="B">Belum</option>
          <option value="S">Sudah</option>
          <option value="D">Duda</option>
          <option value="J">Janda</option>
        </select></td>
    </tr>
    <tr>
      <td>Status Warga </td>
      <td><select name="status_warga">
          <option>.: Pilih Status Warga :.</option>
          <option value="1">Belum</option>
          <option value="2">Sudah</option>
          <option value="3">Duda</option>
          <option value="4">Janda</option>
        </select></td>
    </tr>
    <tr>
      <td>Pendidikan</td>
      <td><select name="pendidikan">
          <option>.: Pilih Pendidikan :.</option>
          <option value="1">Tidak sekolah</option>
          <option value="2"> Putus SD</option>
          <option value="3">SD Sederajat</option>
          <option value="4">SMP Sederajat</option>
          <option value="5">SMA Sederajat</option>
          <option value="6">D1</option>
          <option value="7">D2</option>
          <option value="8">D3</option>
          <option value="9">D4 / S1</option>
          <option value="10">S2</option>
          <option value="11">S3</option>
        </select></td>
    </tr>
    <tr>
      <td>Pekerjaan</td>
      <td><select name="pekerjaan">
          <option>.: Pilih Pekerjaan :.</option>
          <option value="1">Tidak bekerja</option>
          <option value="2">Nelayan</option>
          <option value="3">Petani</option>
          <option value="4">Peternak</option>
          <option value="5">PNS/TNI/POLRI </option>
          <option value="6">Karyawan Swasta </option>
          <option value="7">Pedagang Kecil</option>
          <option value="8">Pedagang Besar</option>
          <option value="9">Wiraswasta</option>
          <option value="10">Wirausaha</option>
          <option value="11">Buruh</option>
          <option value="12">Pensiunan</option>
        </select></td>
    </tr>
    <tr>
      <td>No Telp</td>
      <td><input type="number" name="no_telpon" size="18" /></td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><label>
        <input name="photo" type="file" id="photo" />
        <input type="text" name="admin" hidden size="18" value="<?php echo $userRow['user_id']; ?>" />
        </label></td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><label>
        <input name="photo_rumah" type="file" id="photo" />
        </label></td>
    </tr>

    <tr>
      <td>Latitude</td>
      <td><input type="number" name="lat" size="18" /></td>
    </tr>

    <tr>
      <td>lngitude</td>
      <td><input type="number" name="lng" size="18" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Tinggi / Berat </td>
      <td><input type="text" name="rt2" size="5" />
/
  <input type="text" name="rw2" size="5" /></td>
    </tr>
    <tr>
      <td>Jenis Kelamin </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Penghasilan</td>
      <td><select name="select">
        <option>.: Pilih Penghasilan :.</option>
        <option value="1">Kurang dari 500,000</option>
        <option value="2">500.000 - 999.9999</option>
        <option value="3">1 juta - 1.999.999</option>
        <option value="4">2 juta - 4.999.999</option>
        <option value="5">5 juta - 20 juta</option>
        <option value="6"> lebih dari 20 juta</option>
        <option value="7">Tidak Berpenghasilan</option>
                        </select></td>
    </tr>
    <tr>
      <td>Bekebutuhan Khusus</td>
      <td><select name="select2">
        <option>.: Pilih Kebutuhan Khusus :.</option>
        <option value="1">Tidak</option>
        <option value="2"> Netra (A)</option>
        <option value="3">Rungu (B)</option>
        <option value="4">Grahita ringan (C)</option>
        <option value="5">Grahita Sedang (C1) </option>
        <option value="6">Daksa Ringan (D)</option>
        <option value="7">Daksa Sedang (D1)</option>
        <option>Laras</option>
        <option>Wicara (F)</option>
        <option>Tuna ganda (G) </option>
        <option> Hiper aktif (H)</option>
        <option> Cerdas Istimewa (i) </option>
        <option>Bakat Istimewa (J)</option>
        <option> Kesulitan Belajra (K) </option>
        <option>Narkoba (N)</option>
        <option> Indigo (O) </option>
        <option> Down Sindrome (P)</option>
        <option>Autis (Q)</option>
                  </select></td>
    </tr>
    <tr>
      <td>Username </td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>Password </td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>No. KKS </td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>No. KPS </td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>No. KIP </td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>No. PIP </td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>No. KIS </td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>No. BPJS </td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>No. ASKES </td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>No. Akta Kelahiran </td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>No. SIM </td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>No. NPWP </td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>No. Paspor </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>TPS</td>
      <td><input type="text" name=""></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="tblIsi" type="submit" id="tblIsi" value="Simpan" />
        <input type="reset" name="reset" value="Reset" /></td>
    </tr>
  </table>
</form>
</body>
</html>
