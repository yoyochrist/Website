<script src="review.js"></script>

<?php

require_once('content/dbcontroller.php');
include('content/fns.php');

$conn = new DBController();

$session=getActiveSession();

$lecturer_id=$_SESSION['id'];

$qry=getTestDetails($lecturer_id, $session);
		
?>

<div>
	<div class="spacer"></div>

	<!--Rubrik Penilaian-->
	<div class="text-center">
		<h3 class="text-primary"><strong>REVIEW HASIL PENILAIAN</strong></h3>
        <h5>Sesi: <b><?php print strtoupper($qry['session_name']); ?></b> - Stasiun: <b><?php isset($qry['station_name']) ? print strtoupper($qry['station_name']) : print strtoupper($qry['station_id']); ?></b> - Subyek: <b><?php print strtoupper($qry['subject_name']); ?></b> - Penguji: <b><?php print strtoupper($qry['lecturer_name']); ?></b></h5>
        <div class="spacer"></div>

        <table class="figuretab">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <th class="text-center">NIM</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Nilai Akhir</th>
            <th class="text-center">Global Rating</th>
            <!--<th class="text-center">Aksi</th>-->
            <th class="text-center col-md-5">Komentar</th>
          </tr>
        </thead>    
        <tbody>
<?php


$sql="SELECT a.student_id,a.session_id,sum(a.score*a.weight)/sum(3*a.weight)*100 as nilai,a.global_scale,a.global_comment,d.name,d.photo,a.id 
			FROM grade a 
			LEFT JOIN session b ON a.session_id=b.id 
			LEFT JOIN student d ON a.student_id=d.id
			WHERE a.session_id='$session' and a.lecturer_id='$lecturer_id'
			GROUP BY a.student_id";

$result=$conn->runQueryO($sql);
$total=$result->num_rows;

$today = date('Y-m-d');
$i=1;
foreach($result as $qry){
	
	print '<tr>';
	print '<td align="center">'.$i.'.</td>';
	print '<td id="nim_'.$qry['student_id'].'">'.$qry['student_id'].'</td>';
	print '<td align="left"><b>&nbsp;'.strtoupper($qry['name']).'</b></td>';
	print '<td align="center">'.round($qry['nilai'],2).'</td>';
	print '<td align="center"><strong>'.$qry['global_scale'].' - '.getGlobalScaleName($qry['global_scale']).'</strong></td>';
	//print '<td align="center">';
	//if($date==$today)
	//	print '<button id='.$qry['student_id'].' class="btnEditAction" name="edit">Edit Nilai</button>';
	//print '</td>';
	print '<td align="left" style="font-size: 0.9em;">'.$qry['global_comment'].'</td>';
	print '</tr>';
	$i++;
	
	}

?>
        </tbody>
        </table>
        
    </div>
<?php    

$sql="SELECT final_comment FROM grade WHERE session_id='$session' AND lecturer_id='$lecturer_id' LIMIT 0, 1";
$qry=$conn->runQueryS($sql);

if($qry['final_comment']){
?>    
	<div class="spacer"></div>
    <div class="panel panel-default">
      <div class="panel-heading"><strong>KOMENTAR AKHIR</strong></div>
      <div class="panel-body">
        <p><?php print $qry['final_comment']; ?></p>
      </div>
	</div>
    
    
<?php } ?>    
    
    
    <div id="row">
        <div class="col-md-4 col-md-offset-4 text-center">
        	<button id="btnReport" class="btn btn-primary" name="submit" >Cetak Laporan</button> &nbsp;&nbsp;&nbsp;&nbsp;
            <button id="btnLogout" class="btn btn-primary" name="submit" >Log out</button>
        </div>
    </div>
    
    
</div>
<div class="spacer clear"></div>

