
<?php
 error_reporting(0);
 function get_geotag($tmp) {
  $data = exif_read_data($tmp, 0, true);

  if (isset($data['GPS']) and is_array($data['GPS'])) {
   $lat_ref = $data['GPS']['GPSLatitudeRef']; 
   $lat = $data['GPS']['GPSLatitude'];
   list($num, $dec) = explode('/', $lat[0]);
   $lat_s = $num / $dec;
   list($num, $dec) = explode('/', $lat[1]);
   $lat_m = $num / $dec;
   list($num, $dec) = explode('/', $lat[2]);
   $lat_v = $num / $dec;
   
   $lng_ref = $data['GPS']['GPSLongitudeRef'];
   $lng = $data['GPS']['GPSLongitude'];
   list($num, $dec) = explode('/', $lng[0]);
   $lng_s = $num / $dec;
   list($num, $dec) = explode('/', $lng[1]);
   $lng_m = $num / $dec;
   list($num, $dec) = explode('/', $lng[2]);
   $lng_v = $num / $dec;

   $lat_int = ($lat_s + $lat_m / 60.0 + $lat_v / 3600.0);
   $lat_int = ($lat_ref == 'S') ? '-'.$lat_int : $lat_int;

   $lng_int = ($lng_s + $lng_m / 60.0 + $lng_v / 3600.0);
   $lng_int = ($lng_ref == 'W') ? '-'.$lng_int : $lng_int;

   return array('lat'=>$lat_int, 'lng'=>$lng_int);
  } else {
   return array('lat'=>0, 'lng'=>0);
  }
 }

 if(isset($_POST['submit'])) {
  $tmp = $_FILES['foto']['tmp_name'];
  $nama = $_FILES['foto']['name'];

  $get = get_geotag($tmp);
  $lat = $get['lat'];
  $lng = $get['lng'];

  echo 'Nama : '.$nama.'< br />';
  echo 'Lat : '.$lat.'< br />';
  echo 'Lng : '.$lng;
 }
?>
