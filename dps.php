<ul id="myUL">
                
<?php

include_once 'koneksi.php';
					$a="SELECT * FROM  dps";
					$b=mysqli_query($koneksi,$a);
					while($data=mysqli_fetch_array($b)){
						@$nomor++;
						?>
						<li class="bbm-welcome__opportunity" id="1067526" style="">
                   <a href=""> 
                   	<div class="bbm-welcome__opportunity__details">
                        <h4><?PHP echo $data['nama']?></h4>
                        <p>[TPS <?PHP echo $data['tps']?>]</p>
                        <div class="bbm-welcome__opportunity__details__info">
                            <img src="img/icLocation.svg"><span>No. KK : <?PHP echo $data['no_kk']?></span>
                            <img src="img/icSalary.svg"><span>NIK : <?PHP echo $data['nik']?></span>
                            <!-- <img src="img/icPeriode.svg"><span>17 menit</span> -->
                        </div>
                    </div>
                    <div class="bbm-welcome__opportunity__logo">
                        <div class="bbm-welcome__opportunity__logo__frame">
                        <h4><?PHP echo $data['no']?></h4>
                        <!-- <img alt="Lowongan Kerja diPT Miura Indonesia" src="img/instansi-logo.png"> -->
                    </div>
                    </div>
                    </a>
                </li>
                <?php } ?>
            </ul>
