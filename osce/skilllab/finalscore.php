<?php

	include('../fpdf181/fpdf.php');
	include('crud.php');

	$crud = new crud();
	$pdf = new FPDF('L', 'mm', 'A4');
	$pdf->addPage();

	//$pdf->Image('../img/logo.jpg',10,8,15,15);

	$pdf->setFont('Times','B',12);
	$pdf->multicell(0, 5, 'LAPORAN NILAI AKHIR SKILL LAB', 0, 'C');	
	$pdf->multicell(0, 1, '---------------------------------------------------------------------', 0, 'C');	
	$pdf->setXY(10,42);

	$query="SELECT a.student_id,a.session_id,sum(a.score*a.weight)/sum(4*a.weight)*100 as nilai,d.name
		FROM grade a 
		LEFT JOIN session b ON a.session_id=b.id 
		LEFT JOIN student d ON a.student_id=d.id
		WHERE a.session_id=1 and a.period_id = 1
		GROUP BY a.student_id;";

	$items = $crud->select_query($query);
	//print_r($items);
	$result = json_decode($items);

	$y = 30;
	$row = 6;
	$pdf->setFont('Times','B',8);
	$pdf->setFillColor(222,222,222);
	$pdf->setXY(10,$y);
	$pdf->CELL(10,6,'NO.',1,0,'C',1);
	$pdf->CELL(30,6,'NIM',1,0,'C',1);
	$pdf->CELL(60,6,'NAMA',1,0,'C',1);
	$pdf->CELL(70,6,'TOTAL SKOR',1,0,'C',1);

	$pdf->setFont('Times','',8);
	$pdf->setFillColor(255,255,255);

	$no=1;
	$i=0;
	foreach($result as $qry){
		$y = $y + $row;
		$pdf->setXY(10,$y);
		$pdf->CELL(10,6,$no,1,0,'C',1);
		$pdf->CELL(30,6,$qry->student_id,1,0,'C',1);
		$pdf->CELL(60,6,strtoupper($qry->name),1,0,'L',1);
		$pdf->CELL(70,6,$qry->nilai,1,0,'L',1);
	
		$no++;
		$i++;
	}

	$pdf->setFont('Times','i',9);

	$y = $y + 12;
	$pdf->setXY(10,$y);

	$pdf->setX(180);

	$pdf->setFont('Times','',9);

	$tgl= format_tanggal_id(date("Y-m-d"));
	$pdf->multicell(0, 6, 'Jakarta, '.$tgl, 0, 'L');
	
	$pdf->output();
?>