<script src="rpt_session.js"></script>

<?php

require_once('content/dbcontroller.php');
include('content/fns.php');

$period=getActivePeriod();

?>




<div class="text-center">
    <h3 class="text-primary"><strong>LAPORAN PER SESI</strong></h3>
	<h4 class="text-primary"><strong><?php print 'PERIODE '.strtoupper($period); ?></strong></h4>
    <div class="spacer"></div>

	<form name="form" class="form-inline">
    <div>
      <h4>Pilih Sesi &nbsp;&nbsp;<select name="sesi" id="sesi" class="form-control"><option value="">-- Pilih Sesi --</option></select> &nbsp;
      <button id="btnReport" class="btn btn-primary" name="submit" >Cetak</button>
      
      </h4>
    </div>
	</form>


</div>