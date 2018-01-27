<?php
include('../assets/koneksi.php');
if($_POST)
{
	$q=$_POST['search'];
	$sql_res=mysql_query("select id,nama,email,photo from data where nama like '%$q%' or email like '%$q%' order by id LIMIT 5");
	while($row=mysql_fetch_array($sql_res))
	{
		$id=$row['id'];
		$username=$row['nama'];
		$email=$row['email'];
		$photo=$row['photo'];

		$b_id='<strong>'.$q.'</strong>';
		$b_username='<strong>'.$q.'</strong>';
		$b_email='<strong>'.$q.'</strong>';
		$b_photo='<strong>'.$q.'</strong>';

		$final_id = str_ireplace($q, $b_id, $id);
		$final_username = str_ireplace($q, $b_username, $username);
		$final_email = str_ireplace($q, $b_email, $email);
		$final_photo = str_ireplace($q, $b_photo, $photo);
		?>
		<a href="index.php/a=<?php echo $final_id;?>">
		<div class="show" align="left">
			<img src="img/<?php echo $photo; ?>" style="width:50px; height:50px; float:left; margin-right:6px;" />
			<span class="name"><?php echo $final_username; ?></span>&nbsp;
			<br/><?php echo $final_email; ?><br/>
		</div>
		</a>
		<?php
	}
}
?>