<?php

require_once('dbcontroller.php');

function getSessionNumbers($id) {
  $conn = new dbcontroller();
  
  $sql = "SELECT count(id) as jml FROM session WHERE period_id='$id' ORDER BY id DESC LIMIT 0,1";
  $result = $conn->runQueryS($sql);

  return($result['jml']);
}

function getSubject($id) {
  $conn = new dbcontroller();
  
  $sql = "SELECT name FROM subject WHERE id='$id' ORDER BY id DESC LIMIT 0,1";
  $result = $conn->runQueryS($sql);

  return($result['name']);
}

function getActiveSession()  
{
  $conn = new DBController();
  
  $sql = "SELECT id FROM session WHERE time_start<=now() AND time_end>=now() ORDER BY id DESC LIMIT 0,1";
  $result = $conn->runQueryS($sql);

  return($result['id']);
  
}

function getActivePeriod() {
  $conn = new dbcontroller();
  
  $sql = "SELECT name FROM period WHERE active=1 LIMIT 0,1";
  $result = $conn->runQueryS($sql);

  return($result['name']);
}

function getActivePeriodID() {
  $conn = new dbcontroller();
  
  $sql = "SELECT id FROM period WHERE active=1 LIMIT 0,1";
  $result = $conn->runQueryS($sql);

  return($result['id']);
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
		LEFT JOIN period c ON c.id=a.period_id 
		LEFT JOIN station d ON d.id=a.station_id 
		LEFT JOIN lecturer e ON e.id=a.lecturer_id
	  	WHERE a.student_id='$student' AND c.active='1'
	  	LIMIT 0, 1";
  $result=$conn->runQueryS($sql);
  return($result);
  
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