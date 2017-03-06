<?php

require_once('content/dbcontroller.php');

function getStudent($id)
{
  $conn = new DBController();
  $sql = "SELECT * FROM student WHERE id='$id'";
  
  $result = $conn->runQueryS($sql);
  return($result);
}

function getActiveSession()  
{
  $conn = new DBController();
  
  $sql = "SELECT id FROM session WHERE time_start<=now() AND time_end>=now() ORDER BY id DESC LIMIT 0,1";
  $result = $conn->runQueryS($sql);

  return($result['id']);
  
}


function getNumParticipant($session,$lecturer)  
{
  $conn = new DBController();
	
  $sql="SELECT distinct a.student_id FROM grade a LEFT JOIN session b ON b.id=a.session_id
	    WHERE a.session_id='$session' AND lecturer_id='$lecturer' AND (b.time_start<=now() AND b.time_end>=now()) AND !a.absent AND (isnull(a.global_scale) or a.global_scale='')";
  $result=$conn->runQueryO($sql);
  
  return $result->num_rows;
}



function getGlobalScaleName($point)  
{
  $name="";
  switch($point) {
	case "0":
		$name="Tidak Lulus";
		break;
						
	case "1":
		$name="Border Line";
		break;
						
	case "2":
		$name="Lulus";
		break;
					
	case "3":
		$name="Superior";
		break;
	}
  return($name);
}


function getTestDetails($lecturer, $session)
{
  $conn = new DBController();
  $sql = "SELECT a.session_id,b.name as session_name,a.subject_id,a.subject_name,a.station_id, d.name as station_name,e.name as lecturer_name 
  		FROM grade a 
  		LEFT JOIN session b ON b.id=a.session_id 
		LEFT JOIN station d ON d.id=a.station_id 
		LEFT JOIN lecturer e ON e.id=a.lecturer_id
	  	WHERE a.lecturer_id='$lecturer' AND a.session_id='$session'
	  	LIMIT 0, 1";
  $result=$conn->runQueryS($sql);
  return($result);
  
}


function getTestDetailsByStudent($student, $session)
{
  $conn = new DBController();
  $sql = "SELECT a.session_id,b.name as session_name,a.subject_id,a.subject_name,a.station_id, d.name as station_name,a.lecturer_id,e.name as lecturer_name,a.student_name 
  		FROM grade a 
  		LEFT JOIN session b ON b.id=a.session_id 
		LEFT JOIN station d ON d.station_id=a.station_id 
		LEFT JOIN lecturer e ON e.id=a.lecturer_id
	  	WHERE a.student_id='$student' AND a.session_id='$session'
	  	LIMIT 0, 1";
  $result=$conn->runQueryS($sql);
  return($result);
  
}



function format_tanggal_en($tgl)
{
	$t = implode("-", array_reverse(explode("-", $tgl)));
	return $t;
}

function format_tanggal_id($tgl)
{
	$t = implode("-", array_reverse(explode("-", $tgl)));
	return $t;
}





?>