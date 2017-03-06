<script src="rpt_lecturer.js"></script>

<?php

require_once('content/dbcontroller.php');
include('content/fns.php');

$period=getActivePeriod();

?>

<div class="text-center">
    <h3 class="text-primary"><strong>LAPORAN PER PENGUJI</strong></h3>
	<h4 class="text-primary"><strong><?php print 'PERIODE '.strtoupper($period); ?></strong></h4>
    <div class="spacer"></div>

   <form name="form" class="form-inline">
   <div>
    	<input type="text" id="lecturer-id" style="display: none;" /> 
        <h4>Nama &nbsp;&nbsp;<input id="lecturer-name" class="form-control" size="32"></h4>
        <div class="spacer"></div>
        <h4>Pilih Sesi &nbsp;&nbsp;<select name="sesi" id="sesi" class="form-control"><option value="">-- Pilih Sesi --</option></select></h4>
	    <div class="spacer"></div>
        
        <button id="btnReport" class="btn btn-primary" name="submit" >Cetak</button>
        
    </div>
    </form>


</div>