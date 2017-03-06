<?php

include('../fpdf181/fpdf.php');
require_once('../content/dbcontroller.php');
include('../content/fns.php');


$conn = new DBController();

$session=getActiveSession();
session_start();
$lecturer_id=$_SESSION['id'];

$det=getTestDetails($lecturer_id, $session);

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->addPage();



$pdf->Image('../img/logo.jpg',10,8,15,15);

$pdf->setFont('Times','B',12);
$pdf->multicell(0, 5, 'LAPORAN PENILAIAN UJI KOMPETENSI OSCE ', 0, 'C');	
$pdf->multicell(0, 1, '---------------------------------------------------------------------', 0, 'C');	
$pdf->setFont('Times','B',9);
$pdf->multicell(0, 8, 'Sesi '.strtoupper($det['session_name']).' - Stasiun '.strtoupper($det['station_name']).' - Subyek '.strtoupper($det['subject_name']), 0, 'C');	
$pdf->setFont('Times','B',10);
$pdf->setXY(10,42);


$conn->runQueryO("DROP TABLE IF EXISTS temp_table");



$sql="CREATE TEMPORARY TABLE IF NOT EXISTS temp_table AS (
		SELECT a.student_id,d.name,a.session_id,a.global_scale,a.comment
		FROM grade a 
		LEFT JOIN session b ON a.session_id=b.id 
		LEFT JOIN student d ON a.student_id=d.id
		WHERE a.session_id='$session' and a.lecturer_id='$lecturer_id'
		GROUP BY a.student_id)";

$conn->runQueryO($sql);


$sql="SELECT competent_id FROM grade
	  WHERE lecturer_id='$lecturer_id' AND session_id='$session'
	  GROUP BY competent_id";

$result=$conn->runQueryO($sql);
$total = $result->num_rows;


$i=1;
while($i <= $total){
	$columnname='kolom'.$i;
	$conn->runQueryO("ALTER TABLE temp_table ADD $columnname int(1)");
	$i++;
}


$sql="SELECT * FROM temp_table";
$result=$conn->runQueryO($sql);

foreach($result as $qry){
	
	$num=1;
	while($num <= $total){
		
		$nilai=$conn->runQueryS("SELECT score FROM grade WHERE student_id='$qry[student_id]' AND competent_id='$num'");
		
		$columnname='kolom'.$num;
		$conn->runQueryO("UPDATE temp_table SET $columnname='$nilai[score]' WHERE student_id='$qry[student_id]'");
		$num++;
	}
}

$sql="SELECT * FROM temp_table";
$result=$conn->runQuery($sql);



$y = 30;
$row = 6;
$pdf->setFont('Times','B',8);
$pdf->setFillColor(222,222,222);
$pdf->setXY(10,$y);
$pdf->CELL(10,6,'NO.',1,0,'C',1);
$pdf->CELL(30,6,'NIM',1,0,'C',1);
$pdf->CELL(60,6,'NAMA',1,0,'C',1);



$num=1;
while($num <= $total){
$columnname='K-'.$num;
	$pdf->CELL(12,6,$columnname,1,0,'C',1);
	$num++;
}




$pdf->CELL(40,6,'GLOBAL RATING','LTR',0,'C',1);
$pdf->CELL(70,6,'KOMENTAR','LTR',0,'C',1);

$pdf->setFont('Times','',8);
$pdf->setFillColor(255,255,255);



$no=1;
$i=0;
foreach($result as $qry){
	
	$y = $y + $row;
	$pdf->setXY(10,$y);
	$pdf->CELL(10,6,$no,1,0,'C',1);
	$pdf->CELL(30,6,$qry['student_id'],1,0,'C',1);
	$pdf->CELL(60,6,strtoupper($qry['name']),1,0,'L',1);
	$num=1;
	while($num <= $total){
		$columnname='kolom'.$num;
		$pdf->CELL(12,6,$qry[$columnname],1,0,'C',1);
		$num++;
	}
	
	
	$pdf->CELL(40,6,strtoupper(getGlobalScaleName($qry['global_scale'])),1,0,'C',1);
	$pdf->CELL(70,6,$qry['comment'],1,0,'L',1);
	
	$no++;
	$i++;

	
}

$pdf->setFont('Times','i',9);

$y = $y + 12;
$pdf->setXY(10,$y);

$pdf->multicell(0, 14, 'Dengan menandatangani lembar penilaian ini, saya menyatakan bahwa penilaian UK OSCE ini saya berikan dengan menjunjung tinggi kode etik penguji.', 0, 'L');
$pdf->setX(180);

$pdf->setFont('Times','',9);

$tgl= format_tanggal_id(date("Y-m-d"));
$pdf->multicell(0, 6, 'Jakarta, '.$tgl, 0, 'L');

$pdf->setX(180);
$pdf->multicell(0, 6, 'Penguji,', 0, 'L');

$pdf->setFont('Times','B',9);

$pdf->setX(180);
$pdf->multicell(0, 28, $det['lecturer_name'], 0, 'L');	


$pdf->setFont('Times','i',9);
$pdf->multicell(0, 5, 'Keterangan:', 0, 'L');

$sql="SELECT competent_name  
	  FROM grade 
	  WHERE lecturer_id='$lecturer_id' AND session_id='$session'
	  GROUP BY  competent_id";
$result=$conn->runQuery($sql);

$pdf->setFont('Times','b',9);

$num=1;

foreach($result as $qry){
	$pdf->multicell(0, 5, '+ K-'.$num.' = '.$qry['competent_name'], 0, 'L');
	$num++;
}

	
$pdf->output();


?>