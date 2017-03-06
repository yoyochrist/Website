<script src="registrasi.js"></script>

<?php 

require_once('content/dbcontroller.php');
include('content/fns.php');

$db_handle = new DBController();

isset($_SESSION['no']) ? $no=$_SESSION['no'] : $no='1';


$session=getActiveSession();
$lecturer_id=$_SESSION['id'];


$participant=getNumParticipant($session,$lecturer_id);


if($no<=$participant){
	
	$qry=getTestDetails($lecturer_id, $session);
?>	
<div class="text-center">
	<h5>Sesi: <b><?php print strtoupper($qry['session_name']); ?></b> - Stasiun: <b><?php isset($qry['station_name']) ? print strtoupper($qry['station_name']) : print strtoupper($qry['station_id']); ?></b> - Subyek: <b><?php print strtoupper($qry['subject_name']); ?></b></h5>
</div>


<div class="spacer"></div>
<div class="login-panel">
	<div class="panel-body">
                <h4><strong>PESERTA KE-<?php print $no; ?> </strong></h4>
                <div class="text-muted"><small>Total Peserta <?php print $participant; ?></small></div>
                <div class="form-group">
                	<input id="student_id" type="text" size="25" class="form-control" placeholder="NIM Peserta" autofocus="autofocus" ></input>
                </div>
                <div class="checkbox">
                	<label><input type="checkbox" id="isFinish" > Sudah selesai penilaian</label>
                </div>
                <div class="buttons">
                	<button id="btnSubmit" class="btn btn-primary" name="submit" >Penilaian</button>
                </div>
				<div class="spacer"></div>

    </div>
</div>
<div class="spacer"></div>

<div id="doConfirm" title="Konfirmasi Peserta">
	<div id="body"></div>
</div>

<div id="doInfo" title="Konfirmasi Peserta">
	<div id="body2"></div>
</div>

<?php } 
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