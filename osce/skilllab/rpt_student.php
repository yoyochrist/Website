<script src="rpt_student.js"></script>

<?php

require_once('content/dbcontroller.php');
include('content/fns.php');

$period=getActivePeriod();

?>


<div class="text-center">
    <h3 class="text-primary"><strong>LAPORAN PER PESERTA</strong></h3>
	<h4 class="text-primary"><strong><?php print 'PERIODE '.strtoupper($period); ?></strong></h4>
    <div class="spacer"></div>

    


  <form name="form" class="form-inline">
  <div>
    <h4>NIM&nbsp;&nbsp;&nbsp;
        <input type="text" name="student" class="form-control" maxlength="9" /> &nbsp; 
         <!--s.d. &nbsp; 
       	 <input type="text" name="lid" class="form-control" /> &nbsp;&nbsp; -->
        <button id="btnReport" class="btn btn-primary" name="submit" >Cetak</button>
    </h4>
  </div>
</form>


</div>