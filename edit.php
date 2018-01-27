<?php
   include_once "koneksi.php";
  $id=$_GET['id'];
  $a="select * from mhsasia where id='$id' LIMIT 1";
  $qrykoreksi=mysqli_query($koneksi,$a);
  $data=mysqli_fetch_object($qrykoreksi);
    
?>
<?PHP
if(isset($_POST['tblIsi'])){

$id = $_POST['id'];
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_kk = $_POST['no_kk'];
$email = $_POST['email'];
$no_telpon = $_POST['no_telpon'];


    //proses upload photo jika ada
    if (!empty($_FILES["photo"]["tmp_name"]))
    {
        $namafolder="photo/profil/"; //tempat menyimpan file
        $jenis_gambar=$_FILES['photo']['type'];
        if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")
        {          
            $photo = $namafolder . basename($_FILES['photo']['name']);      
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photo))
            {
               die("Gambar gagal dikirim");
            }
            //Hapus photo yang lama jika ada
                   
            $res = "select photo from mhsasia where id='$id' LIMIT 1";
            
            @$d=mysqli_fetch_object($koneksi,$res);
            if (strlen(@$d->photo)>3)
            {
                if (file_exists($d->photo)) unlink($d->photo);
            }                   
            //update photo dengan yang baru
            

            
            
           $a= "UPDATE mhsasia SET photo='$photo' WHERE id='$id' LIMIT 1";
           $b=mysqli_query($koneksi,$a);
        }
        else { die("Jenis gambar yang anda kirim salah. Harus .jpg .gif .png"); }
    } //end if cek file upload

    //proses upload photo rumah jika ada
    if (!empty($_FILES["photo_rumah"]["tmp_name"]))
    {
        $namafolder="photo/rumah/"; //tempat menyimpan file
        $jenis_gambar=$_FILES['photo_rumah']['type'];
        if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")
        {          
            $photo_rumah = $namafolder . basename($_FILES['photo_rumah']['name']);      
            if (!move_uploaded_file($_FILES['photo_rumah']['tmp_name'], $photo_rumah))
            {
               die("Gambar gagal dikirim");
            }
            //Hapus photo yang lama jika ada
                   
            $res = "select photo_rumah from mhsasia where id='$id' LIMIT 1";
            
            @$d=mysqli_fetch_object($koneksi,$res);
            if (strlen(@$d->photo_rumah)>3)
            {
                if (file_exists($d->photo_rumah)) unlink($d->photo_rumah);
            }                   
            //update photo dengan yang baru
            

            
            
           $a= "UPDATE mhsasia SET photo_rumah='$photo_rumah' WHERE id='$id' LIMIT 1";
           $b=mysqli_query($koneksi,$a);
        }
        else { die("Jenis gambar yang anda kirim salah. Harus .jpg .gif .png"); }
    } //end if cek file upload
    $myqry="UPDATE mhsasia SET nik='$nik',nama='$nama',alamat='$alamat',".
            "no_kk='$no_kk',email='$email',no_telpon='$no_telpon' WHERE id='$id' LIMIT 1";
        
    $b1=mysqli_query($koneksi,$myqry) or die(mysqli_error());
    echo "<script>alert('Data Telah Di Edit');document.location='index.php'</script>";
    exit;

}     
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form action=" " method="post" enctype="multipart/form-data" name="FKoreksi">
  <table width="950" height="281" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
    
    <tr>
      <td width="452"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
          
          <tr>
            <td bordercolor="#999999">ID</td>
            <td bordercolor="#999999"><input name="id" type="text" id="id" size="8" value="<?php echo $data->id?>" /></td>
            <td width="163" rowspan="8" align="center" valign="top"><img src="<?php echo  $data->photo?>" alt="<?php echo  $data->nama?>" width="100" border="1"/></td>
            <td width="163" rowspan="8" align="center" valign="top"><img src="<?php echo  $data->photo_rumah?>" alt="<?php echo  $data->nama?>" width="100" border="1"/></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >NIK</td>
            <td bordercolor="#999999" ><input name="nik" type="text" value="<?php echo $data->nik?>" size="10" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >Nama</td>
            <td bordercolor="#999999" ><input name="nama" type="text" value="<?php echo $data->nama?>" size="20" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >Alamat</td>
            <td bordercolor="#999999" ><input type="text" name="alamat" value="<?php echo $data->alamat?>" size="30" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >No. KK</td>
            <td bordercolor="#999999" ><input name="no_kk" type="text" value="<?php echo $data->no_kk?>" size="10" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >Email</td>
            <td bordercolor="#999999" ><input name="email" type="text" value="<?php echo $data->email?>" size="28" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >No. telpon</td>
            <td bordercolor="#999999" ><input name="no_telpon" type="text" value="<?php echo $data->no_telpon?>" size="18" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >Photo</td>
            <td bordercolor="#999999" ><input type="file" name="photo" id="photo" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >Photo Rumah</td>
            <td bordercolor="#999999" ><input type="file" name="photo_rumah" id="photo_rumah" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" ><input name="tblIsi" type="submit" id="tblIsi" value="Simpan" /></td>
            <td bordercolor="#999999" ><input type="reset" name="reset" value="Reset" /></td>
          </tr>
          
          
          
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
