<?php
	include('../fpdf/fpdf.php');
	$link = mysqli_connect("localhost", "root", "password1234", "osce");
	
	if($link === false)
	{
		die("ERROR: Could not connect. ".mysqli_connect_error());
	}
	
	$sql = 'SELECT grade.student_id AS "studentID", grade.lecturer_id AS "lecturerID", grade.station_id  AS "stationID", grade.global_scale  AS "globalScale", grade.date_exam  AS "dateExam", subject.name AS "subjectName", grade.session_id AS "sessionID" FROM grade JOIN grade_detail ON grade.id = grade_detail.grade_id JOIN subject ON grade.subject_id = subject.id LIMIT 1';

	if($result = mysqli_query($link, $sql))	
	{
		if(mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$pdf = new FPDF();
				$pdf->addPage();
				$pdf->SetFont('Arial','B',16);
				$pdf->Cell(40,10,$row['studentID'].' '.$row['lecturerID']);
				$pdf->Output();
			}
		}
	}
?>
