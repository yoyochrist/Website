<?php

include('../../fpdf181/fpdf.php');
require_once('../content/dbcontroller.php');
include('../content/fns.php');


$conn = new DBController();

$session=getActiveSession();
session_start();


if(isset($_GET['id'])){
$student=$_GET['id'];


$det=getTestDetailsByStudent($student, $session);

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->addPage();



$pdf->Image('../../img/logo.jpg',10,8,15,15);

$pdf->setFont('Times','B',12);
$pdf->multicell(0, 5, 'LAPORAN PENILAIAN UJI KOMPETENSI OSCE ', 0, 'C');	
$pdf->setFont('Times','B',8);
$pdf->multicell(0, 6, 'Sesi '.strtoupper($det['session_name']).' - Stasiun '.strtoupper($det['station_name']).' - Subyek '.strtoupper($det['subject_name']), 0, 'C');
$pdf->multicell(0, 1, 'Penguji '.strtoupper($det['lecturer_name']), 0, 'C');		
$pdf->setFont('Times','B',10);

$pdf->Ln(4);
$pdf->multicell(0, 2, $student.' - '.strtoupper($det['student_name']), 0, 'L');	





$y = 34;
$row = 6;
$pdf->setFont('Times','B',8);
$pdf->setFillColor(222,222,222);
$pdf->setXY(10,$y);
$pdf->CELL(10,6,'NO.',1,0,'C',1);
$pdf->CELL(58,6,'KOMPETENSI',1,0,'C',1);
$pdf->CELL(15,6,'BOBOT',1,0,'C',1);
$pdf->CELL(17,6,'SKOR','1',0,'C',1);
$pdf->CELL(90,6,'KOMENTAR','1',0,'C',1);

$pdf->setFont('Times','',8);
$pdf->setFillColor(255,255,255);


$sql="SELECT a.competent_name,a.weight,a.score,a.comment FROM grade a JOIN period b ON a.period_id=b.id WHERE b.active=1 AND a.student_id='$student'";
$result=$conn->runQuery($sql);


$no=1;
foreach($result as $qry){
	
	$y = $y + $row;
	$pdf->setXY(10,$y);
	$pdf->CELL(10,6,$no.'.',1,0,'C',1);
	$pdf->CELL(58,6,' '.$qry['competent_name'],1,0,'L',1);
	$pdf->CELL(15,6,$qry['weight'],1,0,'C',1);
	$pdf->CELL(17,6,$qry['score'],1,0,'C',1);
	$pdf->CELL(90,6,' '.$qry['comment'],1,0,'L',1);
	$no++;
	
}



$sql="SELECT sum(score*weight)/sum(3*weight)*100 as nilai,global_scale,global_comment FROM grade a JOIN period b ON a.period_id=b.id WHERE b.active=1 AND student_id='$student' LIMIT 0, 1";
$qry=$conn->runQueryS($sql);


$pdf->setFont('Times','b',9);
$y = $y + $row;
$pdf->setXY(10,$y);
$pdf->CELL(83,6,'','T',0,'C',1);
$pdf->CELL(17,6,round($qry['nilai'],2),1,0,'C',1);
$pdf->CELL(90,6,'','T',0,'L',1);





$y = $y + 12;
$pdf->setXY(10,$y);
$pdf->setFont('Times','b',8);
$pdf->multicell(0, 4, 'SKALA GLOBAL', 0, 'L');
$y = $y + 12;
$pdf->setFont('Times','',10);
$pdf->multicell(0, 4, strtoupper(getGlobalScaleName($qry['global_scale'])), 0, 'L');

if($qry['global_comment']){
	$pdf->setXY(10,$y);
	$pdf->setFont('Times','b',8);
	$pdf->multicell(0, 4, 'KOMENTAR GLOBAL' , 0, 'L');
	$y = $y + 12;
	$pdf->setFont('Times','',9);
	$pdf->multicell(0, 4, $qry['global_comment'] , 0, 'L');
}

$pdf->setFont('Times','i',9);


$pdf->setX(130);
$pdf->setFont('Times','',9);

$tgl= format_tanggal_id(date("Y-m-d"));
$pdf->multicell(0, 6, 'Jakarta, '.$tgl, 0, 'L');

$pdf->setX(130);
$pdf->multicell(0, 6, 'Penguji,', 0, 'L');

$pdf->setFont('Times','B',9);

$pdf->setX(130);
$pdf->multicell(0, 28, $det['lecturer_name'], 0, 'L');	




	
$pdf->output();
}
else print 'Tak da';


?>