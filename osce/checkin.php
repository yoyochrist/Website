<script src="checkin.js"></script>
<?php
	require_once('content/dbcontroller.php');
	include('content/fns.php');

	$conn = new DBController();

	isset($_SESSION['no']) ? $no=$_SESSION['no'] : $no='1';
	if(!isset($_SESSION['no'])) $_SESSION['no'] = 1;  //server_id

	$lecturer_id=$_SESSION['id'];
	$session=getActiveSession();

	if(!isset($_SESSION['participant']))
		$_SESSION['participant'] = getNumParticipant($session,$lecturer_id);
	$participant=$_SESSION['participant'];
echo $lecturer_id;
if($participant == 0)
{
	$name=$_SESSION['id'];
?>
	<div class="col-md-6 col-md-offset-3 panel text-center">	
                <div class="panel-heading"><h4><strong></h4><small class="text-muted">PILIH RUANGAN</small></div>
                <div class="panel-body text-left">
					<form id="form1" name="form1" method="post" action="index.php?mod=che">
						<label>Lokasi</label><br/>
						<label class="radio-inline"><input type="radio" name="location" value="1">A</label>
						<label class="radio-inline"><input type="radio" name="location" value="2">B</label>
						<label class="radio-inline"><input type="radio" name="location" value="3">C</label>
						<!--<select class="form-control room"  name="location">
						</select>--><br/>
						<label>Station</label><br/>
						<label class="radio-inline"><input type="radio" name="station" value="1">1</label>
						<label class="radio-inline"><input type="radio" name="station" value="2">2</label>
						<label class="radio-inline"><input type="radio" name="station" value="3">3</label>
						<label class="radio-inline"><input type="radio" name="station" value="4">4</label>
						<label class="radio-inline"><input type="radio" name="station" value="5">5</label>
						<label class="radio-inline"><input type="radio" name="station" value="6">6</label><br/>
						<label class="radio-inline"><input type="radio" name="station" value="7">7</label>
						<label class="radio-inline"><input type="radio" name="station" value="8">8</label>
						<label class="radio-inline"><input type="radio" name="station" value="9">9</label>
						<label class="radio-inline"><input type="radio" name="station" value="10">10</label>
						<label class="radio-inline"><input type="radio" name="station" value="11">11</label>
						<label class="radio-inline"><input type="radio" name="station" value="12">12</label>
						<!--<select class="form-control station" name="station">
						</select>-->
						<div class="buttons"><button id="btnSubmit" class="btn btn-primary" name="submit" >Masuk</button></div>
					</form>
				</div>        
        </div>
<?php
	if(isset($_POST['submit']))
	{
		$room = $_POST['location'];
		$station = $_POST['station'];

		$sql_update = "UPDATE `grade` set `lecturer_id`='".$lecturer_id."', `lecturer_name` ='".$name."' WHERE `location_id`='".$room."' AND `station_id`='".$station."' AND `session_id` = '".$session."'";
		echo $sql_update;

		if($conn->runQueryO($sql_update) == true)
		{	
			header('location: http://192.168.14.229/osce/index.php?mod=reg');
		}
	}
}
else
{
	header('location: http://192.168.14.229/osce/index.php?mod=reg');
}
?>