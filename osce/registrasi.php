<script src="registrasi.js"></script>

<?php 

require_once('content/dbcontroller.php');
include('content/fns.php');

$conn = new DBController();

isset($_SESSION['no']) ? $no=$_SESSION['no'] : $no='1';

if(!isset($_SESSION['no'])) $_SESSION['no'] = 1;  //server_id

$session=getActiveSession();
$lecturer_id=$_SESSION['id'];

if(!isset($_SESSION['participant']))
	$_SESSION['participant'] = getNumParticipant($session,$lecturer_id);
$participant=$_SESSION['participant'];

if($no<=$participant){
	
	$qry=getTestDetails($lecturer_id, $session);
?>
<div class="spacer"></div>	
<div class="text-center">
	<h5>Sesi: <b><?php print strtoupper($qry['session_name']); ?></b> - Stasiun: <b><?php isset($qry['station_name']) ? print strtoupper($qry['station_name']) : print strtoupper($qry['station_id']); ?></b> - Subyek: <b><?php print strtoupper($qry['subject_name']); ?></b></h5>
</div>

<div class="spacer"></div>


<?php

	$session=getActiveSession();

	$sql = "SELECT a.student_id,a.student_name,a.session_id,b.time_start,b.time_end,a.global_scale,a.absent,d.photo 
			FROM grade a 
			LEFT JOIN session b ON a.session_id=b.id 
			LEFT JOIN student d ON a.student_id=d.id
			WHERE a.session_id='$session' AND a.lecturer_id='$lecturer_id' AND !a.absent AND (isnull(a.global_scale) or a.global_scale='') ORDER BY a.id LIMIT 0,1";
	$qry=$conn->runQueryS($sql);
	
	$_SESSION['student_id'] = $qry['student_id'];
	
?>


    	<div class="col-md-6 col-md-offset-3 panel text-center">
                <div class="panel-heading"><h4><strong>PESERTA KE-<?php print $no; ?></strong></h4><small class="text-muted">Total Peserta <?php print $participant; ?></small></div>
                <div class="panel-body text-left">
                    <?php
					print '<div>';
					print '<figure class="featured-thumbnail">';
					$qry['photo'] ? print '<img src="'.substr($qry['photo'], 3).'" width="130px" />' : print '<img src="img/mhs/user.png" width="130px" />'; 
					print '</figure>';
					print '<h3><strong>';
					print $qry['student_name'];
					print '</strong></h3>';
					print '<p><strong>'.$qry['student_id'].'</strong></p>';
					print '</div>';
					
					
					?>
				
                </div>
                <form id="form1" name="form1" method="post" action="index.php?mod=nla">
                <div class="checkbox">
                        <label><input type="checkbox" id="isAbsent" name="isAbsent"> Peserta Tidak Hadir</label>
                    </div>
                <div class="panel-body">
           		<div class="buttons"><button id="btnLogin" class="btn btn-primary" name="submit" >Beri Penilaian</button></div>
           		</form>
                </div>
            
        
        </div>



<div id="doConfirm" title="Konfirmasi Peserta">
	<div id="body"></div>
</div>

<div id="doInfo" title="Konfirmasi Peserta">
	<div id="body2"></div>
</div>

<?php }

else if($no==$participant+1 && $participant!==0) { //semua peserta sudah dinilai, berikan komentar final
	
	
?>
	<div class="spacer"></div>
    <div class="col-md-6 col-md-offset-3 panel text-center">
        	
		<div class="panel-heading"><h4><strong>KOMENTAR AKHIR</strong></h4></div>
        <div class="panel-body text-left">
        	<h5>Berikan komentar akhir untuk keseluruhan jalannya penyelenggaraan tes.</h5>
           
            <form id="form1" name="form1" method="post" action="index.php?mod=nla">
            <textarea class="figuretab" name="isFinish" id="styled" onfocus="this.value=\'\'; setbg(\'#e5fff3\');" onblur="setbg(\'white\')"></textarea>
            <div class="spacer"></div>
            <div class="buttons">
            	<button id="btnLogin" class="btn btn-primary" name="submit" >B e r i k u t n y a  > ></button>
            </div>
           	</form>
        
        </div>
   </div>
    
<?php
}
else {
	if($participant==0) {
		?>
        <div class="spacer"></div>
		<div id="row">
        <div class="col-md-4 col-md-offset-4 text-center alert alert-warning">
            <h4><strong>PERHATIAN!</strong></h4>
            <div><img src="img/alert.png" width="100px" /></div>
            <h5>Sesi penilaian tidak tersedia saat ini!</h5>
            <div class="spacer"></div>
            <form id="form1" name="form1" method="post" action="logout.php">
            <div class="buttons">
            	<button id="btnLogin" class="btn btn-primary" name="submit" >Logout</button>
            </div>
           	</form>
        </div>
        </div>
        <?php
		
		
		print "";
		
	
	}
	else {
	?>
		
        <div class="spacer"></div>
		<div id="row">
        <div class="col-md-4 col-md-offset-4 text-center alert alert-warning">
            <h4><strong>INFORMASI</strong></h4>
            <div><img src="img/info.png" width="100px" /></div>
            <h5>Sesi penilaian sudah selesai</h5>
            <h5>Terima Kasih</h5>
            <div class="spacer"></div>
            <form id="form2" name="form2" method="post" action="index.php?mod=rev">
            <div class="buttons">
            	<button id="btnReview" class="btn btn-primary" name="submit" >Review Nilai Ujian</button>
            </div>
            </form>
        </div>
        </div>
		
	<?php
	}
?>

<?php } ?>