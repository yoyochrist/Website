<?php 
	include("html_head.php");

	if (isset($_GET['title']))
	{
		$title = $_GET['title'];
		$judul = str_replace("-", " ", $title);
		print_header(ucwords($judul));
	}
	else
	{
		print_header("Universitas Kristen Krida Wacana");
	}
?>
<body style="margin-left:20px;">
	<?php
		echo "<div style='
			position:relative;
			background:#f0f0f0;
			top:-10px;
			left:-20px;
			width:110%;
			padding: 0 0 0 20;
			text-align:center;
			height:100px;
			font-family:calibri;
			font-size:25px;
			color:#000000;
			text-shadow: 1px 1px #ffffff;
			box-shadow: 0px 0px 15px #555555;'>";
		echo "<table width=80% border=0 class=tablelogo>";
		$img = $img_dir."logout.png";
		echo "<tr><td align=left width=200><img src='../img/ukrida.png'></td><td><h2>Skill Lab</h2></td></tr>";
		echo "</table></div>";
	?>
	<div class="col-md-12 main-table">
		<div class="col-md-6 device">
			<!-- Modal -->
			<div class="modal fade" id="dataConfirmAddDeviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h3 class="modal-title" id="dataConfirmAddDeviceLabel">Add Device</h3>
						</div>
						<div class="modal-body">
							<form class="formAddDevice" method="" action="">
								<label>Device Name</label>
								<input class="form-control" type="text" class="addName" name="addName" />
								<label>IP Address</label>
								<input class="form-control" type="text" class="addIPAddress" name="addIPAddress" />
								<label>State</label>
								<input class="form-control" type="radio" class="addRadio" name="addRadio" /> On
								<input class="form-control" type="radio" class="addRadio" name="addRadio" /> Off
								<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-4">
										<button class="btn" data-dismiss="modal" aria-hidden="true">Back</button>
										<button class="btn btn-primary" type="submit" id="dataConfirmAddDeviceOK">Add</button>	
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<h4>
				Device
				<a class="btn btn-primary addDevice" data-toggle="modal" data-target="#dataConfirmAddDeviceModal">Add</a>
			</h4>
			<table id="txtDevice" class="table table-bordered">
				<tr>
					<th>
						Device Name
					</th>
					<th>
						IP Address
					</th>
					<th>
						State
					</th>
					<th>
						Action
					</th>
				</tr>
				<tr class="templateDevice hide">
					<td><a class="editDevice" data-toggle="modal" data-target=""></a></td>
					<td class="descIPAddress">
					</td>
					<td class="state">
					</td>
					<td>
						<a href="" class="btn btn-sm btn-primary deleteDevice" data-toggle="modal">
							<span class="glyphicon glyphicon-trash"></span>
						</a>

						<!-- Modal -->
						<div class="modal fade dataConfirmDeleteDeviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
										<h3 class="modal-title" id="dataConfirmDeleteDeviceLabel">Delete Device</h3>
									</div>
									<div class="modal-body">
										<form class="formDeleteDevice" method="" action="">
											<p class="message">Do you want to delete this device record?</p>
											<input class="form-control IPAddress" type="hidden" name="IPAddress" value="" />
											<button class="btn" data-dismiss="modal" aria-hidden="true">Back</button>
											<button class="btn btn-primary" type="submit" id="dataConfirmDeleteDeviceOK">Delete</a>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal -->
						<div class="modal fade dataConfirmEditDeviceModal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
									<h3 class="modal-title" id="dataConfirmEditDeviceLabel">Edit Device</h3>
									</div>
										<div class="modal-body">
										<form class="formEditDevice" method="" action="">
											<label>Device Name</label>
											<input type="text" class="form-control editName" name="editName" />
											<label>IP Address</label>
											<input type="hidden" class="form-control editIPAddress" name="editIPAddress" />
											<label>State</label>
											<input class="form-control" type="radio" class="editRadio" name="editRadio" /> On
											<input class="form-control" type="radio" class="editRadio" name="editRadio" /> Off
											<div class="row">
												<div class="col-md-8"></div>
												<div class="col-md-4">
													<button class="btn" data-dismiss="modal" aria-hidden="true">Back</button>
													<button class="btn btn-primary" type="submit" id="dataConfirmEditDeviceOK">Save</a>	
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-6 state">
			<div class="col-md-12">
				<h4>
					State
				</h4>
			</div>
				<table id="txtState" class="table table-bordered">
				<tr>
					<th>
						State
					</th>
					<th>
						URL
					</th>
				</tr>
				<tr class="templateState hide">
					<td><a href="" class="editState" data-toggle="modal" data-target=""></a></td>
					<td class="stateDesc">
						<!-- Modal -->
						<div class="modal fade dataConfirmEditStateModal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
										<h3 class="modal-title" id="dataConfirmEditStateLabel">Edit State</h3>
									</div>
									<div class="modal-body">
										<label>State</label>
										<p class="stateID"></p>
										<form class="formEditState" method="" action="">
											<label>URL</label>
											<input type="text" class="form-control editURL" name="url" />
											<input type="hidden" class="form-control editStateID" name="state" />
											<div class="row">
												<div class="col-md-8"></div>
												<div class="col-md-4">
													<button class="btn" data-dismiss="modal" aria-hidden="true">Back</button>
													<button class="btn btn-primary" type="submit" id="dataConfirmEditStateOK">Save</a>	
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
