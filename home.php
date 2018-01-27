<?php
session_start();
include_once 'koneksi.php';

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
	$alamat = $_POST['alamat'];
	$no_kk = $_POST['no_kk'];
	$email = $_POST['email'];
	$dusun = $_POST['dusun'];
	$rt = $_POST['rt'];
	$rw = $_POST['rw'];
	$no_telpon = $_POST['no_telpon'];
	$nik = $_POST['nik'];
	$admin = $_POST['admin'];



	if (empty($nama))
	{ 
		die("<script>alert('Isikan Nama');document.location='home.php'</script>");
	} 
	else
	{
		$query = mysqli_query($koneksi, "SELECT * FROM mhsasia WHERE nama='".$nama."'");

		if (!$query)
		{
			die('Error: ' . mysqli_error($koneksi));
		}

		if(mysqli_num_rows($query) > 0){

			die("<script>alert('Nama Sudah ada');document.location='home.php'</script>");

		}else{

    // do something

		}
	}
	
	
	
	if (!empty($_FILES["photo"]["tmp_name"]))
	{
    $namafolder="photo/";  //tempat menyimpan file
    $jenis_gambar=$_FILES['photo']['type'];
    if($jenis_gambar=="image/jpeg"  || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png")
    {           
    	$photo  = $namafolder . basename($_FILES['photo']['name']);       
    	if  (!move_uploaded_file($_FILES['photo']['tmp_name'], $photo))
    		{ die("Gambar gagal dikirim"); }
    } else  { die("Jenis gambar yang anda kirim salah. Harus .jpg .gif .png"); }
  }  //end if cek file upload
  

  @$a="insert into mhsasia values  ('$id','$nama','$alamat','$no_kk','$email','$dusun','$rt','$rw','$no_telpon','$photo','$nik','$admin')";
  $b=mysqli_query($koneksi,$a);
  echo "<script>alert('Data Disimpan');document.location='index.php'</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet'  href='style.css' type='text/css' media='all' />
	<title>Daftar Penduduk</title>
</head>
<body>
	Selamat Datang <?php echo $userRow['username']; ?>&nbsp;<a href="logout.php?logout">Sign Out</a>
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
	<form class="form-inline" method="get">
		<div class="form-group">
			<select name="dusun" class="form-control" onchange="form.submit()">
				<option value="">rt dusun</option>
				<?php $dusun = (isset($_GET['dusun']) ? strtolower($_GET['dusun']) : NULL);  ?>
				<option value="1" <?php if($dusun == '1'){ echo 'selected'; } ?>>Lereng</option>
				<option value="2" <?php if($dusun == '2'){ echo 'selected'; } ?>>Sopang</option>
				<option value="3" <?php if($dusun == '3'){ echo 'selected'; } ?>>Sei Deras</option>
				<option value="4" <?php if($dusun == '4'){ echo 'selected'; } ?>>Rimbo Tampui</option>
			</select>
		</div>
	</form>
	<form class="form-inline" method="get">
		<div class="form-group">
			<select name="rt" class="form-control" onchange="form.submit()">
				<option value="0">rt RT</option>
				<?php $rt = (isset($_GET['rt']) ? strtolower($_GET['rt']) : NULL);  ?>
				<option value="01" <?php if($rt == '01'){ echo 'selected'; } ?>>001</option>
				<option value="02" <?php if($rt == '02'){ echo 'selected'; } ?>>002</option>
				<option value="03" <?php if($rt == '03'){ echo 'selected'; } ?>>003</option>
				<option value="04" <?php if($rt == '04'){ echo 'selected'; } ?>>004</option>
			</select>
		</div>
	</form>
	<!-- end rt -->
	<table class="table table-striped table-hover">
		<tr>
			<th>No</th>
			<th>NIM</th>
			<th>Nama</th>
			<th>Nama</th>
			<th>Jenis Kelamin</th>
			<th>Tempat Lahir</th>
			<th>Fakultas</th>
			<th>Tools</th>
		</tr>
		<?php
		if($dusun){
						$sql = mysqli_query($koneksi, "SELECT * FROM mhsasia WHERE  dusun='$dusun' ORDER BY no_kk ASC"); // query jika rt dipilih
					}elseif($rt){
						$sql = mysqli_query($koneksi, "SELECT * FROM mhsasia WHERE rt='$rt' ORDER BY no_kk ASC"); // query jika rt dipilih
					}else{
						$sql = mysqli_query($koneksi, "SELECT * FROM mhsasia ORDER BY no_kk ASC"); // jika tidak ada rt maka tampilkan semua entri
					}
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
					}else{ // jika terdapat entri maka tampilkan datanya
						$no = 1; // mewakili data dari nomor 1
						while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
							echo '
							<tr>
							<td>'.$no.'</td>
							<td>'.$row['no_kk'].'</td>
							<td><a href="profile.php?no_kk='.$row['no_kk'].'">'.$row['nama'].'</a></td>
							<td>'.$row['alamat'].'</td>
							<td>';
							if($row['dusun'] == '1'){
								echo '<span class="label label-success">Dusun Lereng</span>';
							}
							else if ($row['dusun'] == '2' ){
								echo '<span class="label label-success">Dusun Sopang</span>';
							}
							else if ($row['dusun'] == '3' ){
								echo '<span class="label label-success">Dusun Sei Deras</span>';
							}
							else if ($row['dusun'] == '4' ){
								echo '<span class="label label-success">Dusun Rimbo Tampui</span>';
							}
							echo '</td>
							<td>'.$row['rt'].'</td>
							<td>';
							if($row['rt'] == '001'){
								echo '<span class="label label-success">MIPA</span>';
							}
							else if ($row['rt'] == '002' ){
								echo '<span class="label label-success">Pertanian</span>';
							}
							else if ($row['rt'] == '003' ){
								echo '<span class="label label-success">Biologi</span>';
							}
							else if ($row['rt'] == '004' ){
								echo '<span class="label label-success">Ekonomi</span>';
							}
							echo '
							</td>
							<td>
							
							<a href="edit.php?no_kk='.$row['no_kk'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
							<a href="password.php?no_kk='.$row['no_kk'].'" title="Ganti Password" data-toggle="tooltip" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
							<a href="index.php?aksi=delete&no_kk='.$row['no_kk'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
							</tr>
							';
							$no++; // mewakili data kedua dan seterusnya
						}
					}
					?>
				</table>
				<hr />
				<!-- Trigger/Open The Modal -->
				<button id="myBtn">Open Modal</button>
				<table width="100%" border="1" align="center" id="myTable">
					<caption align="top">&nbsp;
					</caption>
					<tr class="header">
						<th width="73" scope="col">id</th>
						<th width="217" scope="col">Nama </th>
						<th width="179" scope="col">Alamat</th>
						<th width="80" scope="col">Telepon</th>
						<th width="80" scope="col">NIK</th>
						<th width="80" scope="col">Photo</th>
						<th width="80" scope="col">Rumah</th>
						<th width="80" scope="col">Perintah </th>
					</tr>
					<?php
					$a="SELECT * FROM  mhsasia";
					$b=mysqli_query($koneksi,$a);
					while($data=mysqli_fetch_array($b)){
						@$nomor++;
						?>
						<tr>
							<td><div align="center"> <?PHP echo $nomor;?></div></td>
							<td><div align="center"><?PHP echo $data['nama']?></div></td>
							<td><div align="center"><?PHP echo $data['alamat']?></div></td>
							<td><div align="center"><?PHP echo $data['no_telpon']?></div></td>
							<td><div align="center"><?PHP echo $data['nik']?></div></td>
							<td><img src="<?PHP echo $data['photo']?>"  width="50" /></td>
							<td><img src="<?PHP echo $data['photo_rumah']?>"  width="50" /> <br> Lat. <?PHP echo $data['lat']?> <br> Long. <?PHP echo $data['lng']?></td>
							<td><a href="edit.php?id=<?php echo $data['id']?>">Edit</a> <a href="hapus.php?id=<?php echo $data['id']?>">Hapus</a></td>
						</tr>
						<?PHP
					}
					?>
				</table>
				<hr>
				<!-- ############################################### -->
				<?php
				ini_set('display_errors', 1);
				error_reporting(~0);

				$strKeyword = null;

				if(isset($_POST["txtKeyword"]))
				{
					$strKeyword = $_POST["txtKeyword"];
				}
				if(isset($_GET["txtKeyword"]))
				{
					$strKeyword = $_GET["txtKeyword"];
				}
				?>
				<form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
					<table width="100%" border="0">
						<tr>
							<th>Keyword
								<input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>">
								<input type="submit" value="Search"></th>
							</tr>
						</table>
					</form>
					<?php


					$sql = "SELECT * FROM mhsasia WHERE nama LIKE '%".$strKeyword."%' ";
					$query = mysqli_query($koneksi,$sql);

					$num_rows = mysqli_num_rows($query);

  $per_page = 5;   // Per Page
  $page  = 1;
  
  if(isset($_GET["Page"]))
  {
  	$page = $_GET["Page"];
  }

  $prev_page = $page-1;
  $next_page = $page+1;

  $row_start = (($per_page*$page)-$per_page);
  if($num_rows<=$per_page)
  {
  	$num_pages =1;
  }
  else if(($num_rows % $per_page)==0)
  {
  	$num_pages =($num_rows/$per_page) ;
  }
  else
  {
  	$num_pages =($num_rows/$per_page)+1;
  	$num_pages = (int)$num_pages;
  }
  $row_end = $per_page * $page;
  if($row_end > $num_rows)
  {
  	$row_end = $num_rows;
  }

  $sql .= " ORDER BY id ASC LIMIT $row_start ,$row_end ";
  $query = mysqli_query($koneksi,$sql);

  ?>
  <table width="100%" border="1">
  	<tr>
  		<th width="91"> <div align="center">id </div></th>
  		<th width="98"> <div align="center">nama </div></th>
  		<th width="198"> <div align="center">alamat </div></th>
  		<th width="97"> <div align="center">no_kk </div></th>
  		<th width="59"> <div align="center">email </div></th>
  		<th width="71"> <div align="center">no_telpon </div></th>
  	</tr>
  	<?php
  	while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
  	{
  		@$no++;
  		?>
  		<tr>
  			<td><div align="center"><?php echo $no;?></div></td>
  			<td><?php echo $result["nama"];?></td>
  			<td><?php echo $result["alamat"];?></td>
  			<td><div align="center"><?php echo $result["no_kk"];?></div></td>
  			<td align="right"><?php echo $result["email"];?></td>
  			<td align="right"><?php echo $result["no_telpon"];?></td>
  		</tr>
  		<?php
  	}
  	?>
  </table>
  <br>
  Total <?php echo $num_rows;?> Record : <?php echo $num_pages;?> Page :
  <?php
  if($prev_page)
  {
  	echo " <a href='$_SERVER[SCRIPT_NAME]?Page=$prev_page&txtKeyword=$strKeyword'><< Back</a> ";
  }

  for($i=1; $i<=$num_pages; $i++){
  	if($i != $page)
  	{
  		echo "[ <a href='$_SERVER[SCRIPT_NAME]?Page=$i&txtKeyword=$strKeyword'>$i</a> ]";
  	}
  	else
  	{
  		echo "<b> $i </b>";
  	}
  }
  if($page!=$num_pages)
  {
  	echo " <a href ='$_SERVER[SCRIPT_NAME]?Page=$next_page&txtKeyword=$strKeyword'>Next>></a> ";
  }
  $koneksi = null;
  ?>
  <!-- The Modal -->
  <div id="myModal" class="modal">
  	<form action="" method="post" enctype="multipart/form-data">
  		<!-- Modal content -->
  		<div class="modal-content">
  			<div class="modal-header"> <span class="close">&times;</span>
  				<h2>Modal Header</h2>
  			</div>
  			<div class="modal-body">
  				<table align="center" frame="box">
  					<tr>
  						<td width="59">ID</td>
  						<td width="885"><input type="text" name="id" size="8" /></td>
  					</tr>
  					<tr>
  						<td>Nama</td>
  						<td><input type="text" name="nama" size="20" /></td>
  					</tr>
  					<tr>
  						<td>Alamat </td>
  						<td><input type="text" name="alamat" size="30" /></td>
  					</tr>
  					<tr>
  						<td>NIM</td>
  						<td><input type="text" name="no_kk" size="10" /></td>
  					</tr>
  					<tr>
  						<td>Email</td>
  						<td><input type="text" name="email" size="28" /></td>
  					</tr>
  					<tr>
  						<td>Dusun</td>
  						<td><input type="text" name="dusun" size="28" /></td>
  					</tr>
  					<tr>
  						<td>RT</td>
  						<td><input type="text" name="rt" size="28" /></td>
  					</tr>
  					<tr>
  						<td>RW</td>
  						<td><input type="text" name="rw" size="28" /></td>
  					</tr>
  					<tr>
  						<td>No Telp</td>
  						<td><input type="text" name="no_telpon" size="18" /></td>
  					</tr>
  					<tr>
  						<td>NIK</td>
  						<td><input type="text" name="nik" size="18" /></td>
  						<input type="text" name="admin" hidden size="18" value="<?php echo $userRow['user_id']; ?>" />
  					</tr>
  					<tr>
  						<td>photo</td>
  						<td><label>
  							<input name="photo" type="file" id="photo" />
  						</label></td>
  					</tr>
  				</table>
  			</div>
  			<div class="modal-footer">
  				<input name="tblIsi" type="submit" id="tblIsi" value="Simpan">
  				<input type="reset" name="reset" value="Reset">
  			</div>
  		</div>
  	</form>
  </div>



  <script>
  	function myFunction() {
  		var input, rt, table, tr, td, i;
  		input = document.getElementById("myInput");
  		rt = input.value.toUpperCase();
  		table = document.getElementById("myTable");
  		tr = table.getElementsByTagName("tr");
  		for (i = 0; i < tr.length; i++) {
  			td = tr[i].getElementsByTagName("td")[0];
  			td = tr[i].getElementsByTagName("td")[1];
  			if (td) {
  				if (td.innerHTML.toUpperCase().indexOf(rt) > -1) {
  					tr[i].style.display = "";
  				} else {
  					tr[i].style.display = "none";
  				}
  			}       
  		}
  	}
  </script>
  <script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
	modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}
</script>
</body>
</html>
