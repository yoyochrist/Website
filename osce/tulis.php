<?php

include('content/fns.php');

$conn = db_connect();




if(isset($_GET['nim'])){

	$nim = $GET['nim'];
	
	print 'Siap dinilai cui';
		
}

?>




<div class="spacer"></div>
<div class="login-panel">
	<div class="panel-body">
            <form id="form1" name="form1" method="post" action="#">
		      <fieldset>
                <h1 class="panel-title">Peserta ke-1</h1>
                <div class="form-group">
                	<input name="nim" type="text" size="25" class="form-control" placeholder="NIM Peserta" autofocus="autofocus" ></input>
                </div>
                
                <div class="buttons">
                	<input type="submit" name="Submit" class="btn btn-sm btn-success" value="Penilaian" maxlength="9" />
                </div>
            </fieldset>
		</form>
            
    </div>
</div>
<div class="spacer"></div>

