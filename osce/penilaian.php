<script src="penilaian.js"></script>

<?php

require_once('content/dbcontroller.php');
include('content/fns.php');

$conn = new DBController();

$session=getActiveSession();


if(isset($_POST['Submit'])){
	
	
	$id = $_POST['id'];
	$path = $_POST['path'];
	$comment = $_POST['comment'];
	
	$student_id=$_SESSION['student_id'];
	$lecturer_id=$_SESSION['id'];
	
	//$result = mysql_query("UPDATE grade set comment='".$comment."', editlog=now(), userlog='".$_SESSION[id]."' WHERE id='".$id."' AND session_id='".$session."'");
	$sql = "UPDATE grade set global_comment='$comment', editlog=now(), userlog='$_SESSION[id]' WHERE session_id='$session' AND student_id='$student_id' AND lecturer_id='$lecturer_id'";
	
	if ($conn->runQueryO($sql) === TRUE) {
		$_SESSION['no'] = $_SESSION['no'] + 1;
		unset($_SESSION['student_id']);
		header('Location: '.$path);
	//} else print 'Something error with db...!!';
	} else print mysqli_error();

	
}

elseif(isset($_POST['isAbsent']) && $_POST['isAbsent']){
		
		$student_id=$_SESSION['student_id'];
		$lecturer_id=$_SESSION['id'];
		
		$sql = "UPDATE grade set absent=true, editlog=now(), userlog='$_SESSION[id]' WHERE session_id='$session' AND student_id='$student_id' AND lecturer_id='$lecturer_id'";
		
		if ($conn->runQueryO($sql) === TRUE) {
			$_SESSION['no'] = $_SESSION['no'] + 1;
			unset($_SESSION['student_id']);
			$path='index.php?mod=reg';
			header('Location: '.$path);
		//} else print 'Something error with db...!!';
		} else print mysqli_error();
		
	}

elseif(isset($_POST['isFinish']) && $_POST['isFinish']){
		
		$lecturer_id=$_SESSION['id'];
		$comment=$_POST['isFinish'];
		
		$sql = "UPDATE grade set final_comment='$comment' WHERE session_id='$session' AND lecturer_id='$lecturer_id'";
		
		if ($conn->runQueryO($sql) === TRUE) {
			$_SESSION['no'] = $_SESSION['no'] + 1;
			$path='index.php?mod=reg';
			header('Location: '.$path);
		//} else print 'Something error with db...!!';
		} else print mysqli_error();
		
	}

else{
	
	
	if(isset($_POST['student_id'])){
		$student_id=$_POST['student_id'];	
		$path='index.php?mod=rev';	
		
	} 
	else {
		$student_id=$_SESSION['student_id'];
		$path='index.php?mod=reg';
	}
	$lecturer_id=$_SESSION['id'];
	$d=getStudent($student_id);
	
?>

<div>

	<!--Identitas Peserta-->
	<div class="panel">
    	<div class="panel-heading"><strong>IDENTITAS PESERTA</strong></div>
    	<div class="panel-body">
            <figure class="featured-thumbnail">
                <?php $d['photo'] ? print '<img src="/img/mhs/'.$d['photo'].'.jpg" width="90px" />' : print '<img src="img/mhs/user.png" width="90px" />'; ?>
            </figure>
            
            <h4><strong><?php print $student_id; ?></strong></h4>
			<h3><strong><?php print $d['name']; ?></strong></h3>
			<div>No. Urut: <?php print $_SESSION['no']; ?></div>
        </div>
    </div>
    
	
    <div class="spacer"></div>

	<!--Rubrik Penilaian-->
	<div>
		<h4><strong>I. Rubrik Penilaian</strong></h4>
        
        <table class="figuretab">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <th class="text-center col-md-3">Kompetensi yang Dinilai</th>
            <th class="text-center">Bobot</td>
            <th class="text-center">Nilai Anda</th>
            <th id="commentdetail" class="text-center col-md-5 hide">Komentar</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>    
        <tbody>
<?php


$sql="SELECT id,student_id, competent_name, weight, score, comment, global_scale, global_comment 
	  FROM grade 
	  WHERE student_id='$student_id' AND lecturer_id='$lecturer_id' AND session_id='$session'";


$result=$conn->runQueryO($sql);
$total=$result->num_rows;

$result=$conn->runQuery($sql);

$i=1;
foreach($result as $qry){

	print '<tr>';
	print '<td align="center">'.$i.'</td>';
	print '<td id="questdetail_'.$qry['id'].'">'.$qry['competent_name'].'</td>';
	print '<td align="center">'.$qry['weight'].'</td>';
	print '<td align="center" class="grade-box" id="gradedetail_'.$qry['id'].'">';
		print '<div class="grade-content">';
		//if(isset($qry['question_score'])) print $qry['question_score'];
		print '</div>';
	print '</td>';
	print '<td style="font-size: 0.9em;" id="commentdetail_'.$qry['id'].'" class="hide">'.$qry['comment'].'</td>';
	print '<td align="center">';
	print '<button id='.$qry['id'].' class="btnEditAction" name="edit" >Beri Nilai</button>';
	print '</td></tr>';
	$global_id=$qry['id'];
	$i++;
	
	}

?>
        </tbody>
        </table>
        
    </div>
    
    <div class="spacer"><?php print $grade_id;?></div>
    
    <!--Global Rating-->
	<div>
    	<h4><strong>II. Global Rating</strong></h4>
		
        <table class="figuretab">
        <thead>
        	<tr>
                <th class="text-center col-md-8">Nilai</th>
                <th class="text-center col-md-4">Aksi</th>
            </tr>
        </thead>    
        <tbody>
        	<tr>
                <td id="global-content" align="center"><?php if(isset($qry['global_scale'])) print getGlobalScaleName($qry['global_scale']); ?></td>
                <td align="center">
                	<button id="<?php print $global_id; ?>" class="btnGlobalAction" name="global" >Beri Nilai</button>
                 </td>
            </tr>
        </tbody>
        </table>
        
    </div>
    
    <div class="spacer"></div>
    
    <!--Komentar-->
	<form id="form1" name="form1" method="post" action="">
    <input type="hidden" name="id" value="<?php print $global_id;?>" />
    <input type="hidden" name="path" value="<?php print $path;?>" />
    <div>
    	<h4><strong>III. Komentar</strong></h4>
		<div>
        	<textarea class="figuretab" name="comment" id="styled" onfocus="this.value=\'\'; setbg(\'#e5fff3\');" onblur="setbg(\'white\')"><?php if(isset($qry['comment'])) print $qry['comment']; ?></textarea>
        </div>
    </div>
	
    <div class="spacer"></div>
    
	<div class="buttons">
    	<input type="submit" name="Submit" class="btn btn-primary" value="B e r i k u t n y a  > >" maxlength="9" />
    </div>
    </form>
    <div class="spacer"></div>
    <div id="frmGrade" title="Rubrik Penilaian" style="text-align: center; vertical-align:middle; padding: 20px;">
    	<div style="margin-bottom: 10px;"><b>Nilai *</b></div>
        <div id="question" style="margin-bottom: 10px;">bla bla bla bla</div> 
    	<div>
        	<span style="padding-right: 12px;"><input type="radio" name="radiograde" value="0" checked> 0</span>
  			<span style="padding-right: 12px;"><input type="radio" name="radiograde" value="1"> 1</span>
 			<span style="padding-right: 12px;"><input type="radio" name="radiograde" value="2"> 2</span>
    		<span style="padding-right: 12px;"><input type="radio" name="radiograde" value="3"> 3</span>
        </div>
        <div style="margin-top: 25px; margin-bottom: 10px;"><b>Komentar *</b></div>
        <div>
        	<textarea class="figuretab" style="height: 80px;" name="qcomment" id="styled" onfocus="this.value=\'\'; setbg(\'#e5fff3\');" onblur="setbg(\'white\')"></textarea>
        </div>
    </div>
    
    <div id="frmGlobal" title="Global Rating" style="text-align: center; vertical-align:middle; padding: 20px;">
    	<div style="margin-bottom: 10px;"><b>Global Rating *</b></div>
        <div>
        	<span style="padding-right: 12px;"><input type="radio" name="radioglobal" value="0" checked> Tidak Lulus</span>
  			<span style="padding-right: 12px;"><input type="radio" name="radioglobal" value="1"> Border Line</span>
 			<span style="padding-right: 12px;"><input type="radio" name="radioglobal" value="2"> Lulus</span>
    		<span style="padding-right: 12px;"><input type="radio" name="radioglobal" value="3"> Superior</span>
        </div>
    </div>
    
    
</div>
<div class="spacer"></div>

<?php } ?>