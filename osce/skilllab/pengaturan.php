<?php

include('content/fns.php');

$period=getActivePeriod();
$periodID=getActivePeriodID();

?>

<script src="pengaturan.js"></script>

<div class="text-center">
	<h3 class="text-primary"><strong><?php print 'PERIODE '.strtoupper($period); ?></strong></h3>
    <div class="spacer"></div>
	
    <div class="row">
        <div class="col-sm-6 text-left">
            <button type="button" class="btn btn-primary tambahSesi" data-toggle="modal" data-target="#addSession"><span class="glyphicon glyphicon-plus"></span> &nbsp;Sesi</button>
        </div>
         <div class="col-sm-6 text-right">
            <button type="button" class="btn btn-primary tambahKompetensi" data-toggle="modal" data-target="#addCompetent"><span class="glyphicon glyphicon-plus"></span>  &nbsp;Kompetensi</button>
        </div>
	</div>
     

    <div class="spacer"></div>

	<div class="rowhead">
		<div class="col-md-1"><b>Kode</b></div>
		<div class="col-md-4"><b>Sesi (ID)</b></div>
		<div class="col-md-5"><b>Waktu Ujian</b></div>
		<div class="col-md-2"><b>Aksi</b></div>
	</div>
    
	<div id="txtData">
	</div>

	<!-- Template for Session -->
	<div class="rowbody col-md-12 hidden template">
		<div class="">
			<a href="#" class="location" id=""><div class="col-md-1 location sessionid"></div></a>
			<div class="col-md-4"><p class="sessionName"></p></div>
			<div class="col-md-5 time"></div>
			<div class="col-md-2">
            	<a class="btn btn-sm btn-primary editSession" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> &nbsp;Edit</a>&nbsp; 
				<a class="btn btn-sm btn-primary hapusSession" data-toggle="modal" data-target="">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</div>
		</div>
		

		<div class="col-md-3 kompetensiTemplate"></div>
		<div class="col-md-12 locationTemplate" id="" ></div>
        
		<!-- Modal Edit Sesi-->
		<div class="modal fade editSessionForm text-left" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">EDIT SESI</h4>
					</div>
					<div class="modal-body">
						<ul class="nav nav-tabs" id="tabContent">
							<li role="presentation" class="active"><a class="editSesi" href="" aria-controls="editSesi" role="tab" data-toggle="tab"><b>Sesi</b></a></li>
							<li role="presentation"><a class="editKompetensi" href="" aria-controls="editKompetensi" role="tab" data-toggle="tab"><b>Kompetensi</b></a></li>
						</ul>
			  
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active editSesiTab">
								<form class="formEditSession" id="" action="" method="">
									<input class="form-control editSessionId" type="hidden" name="id" value=""/>
									<dl>
										<dt>&nbsp;</dt>
                                        <dt>NAMA</dt>
										<dd><input class="form-control editSessionNameField" type="text" name="name" value=""/></dd>
										<dt>WAKTU MULAI</dt>
										<dd><input class="form-control editTimeStartField" type="datetime-local" name="date_start" value=""></dd>
										<dt>WAKTU SELESAI</dt>
										<dd><input class="form-control editTimeEndField" type="datetime-local" name="date_end" value=""/></dd>
									</dl>
									<button type="submit" class="btn btn-primary">Simpan</button>&nbsp;
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                    
								</form>
							</div>
							
							<div role="tabpanel" class="tab-pane editKompetensiTab">
								<form class="formAddCompetent">
									<input class="form-control editSessionId" type="hidden" name="id" value=""/>
                                    <dl>
										<dt>&nbsp;</dt>
                                    	<dt>Pilih Kompetensi</dt>
                                        <dd class="col-md-8">
                                            
                                            <select class="form-control competentList" name="competentID">
                                                <option>Pilih Kompetensi</option>
                                            </select>
                                        </dd>
                                        <dd class="col-md-3">
                                            <input class="form-control" type="number" name="weight" placeholder="Bobot" />
                                        </dd>
                                        <dd class="col-md-1">
                                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></button>&nbsp;
                                        </dd>
                                    </dl>
								</form>
								<form class="formEditCompetent"><input class="form-control editSessionId" type="hidden" name="id" value=""/></form>
								<dd class="competentTemplate"></dd>
								<button type="submit" class="btn btn-primary saveCompetent">Simpan</button>&nbsp;
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
							</div> 
						</div>
					</div>
                   
				</div>
			</div>
		</div>

		<!-- Modal Hapus Sesi-->
		<div class="modal fade deleteSessionForm text-left" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
							<span aria-hidden="true">&times;</span>		
						</button>
						<h4 class="modal-title" id="dataConfirmLabel">KONFIRMASI</h4>
					</div>
					<form class="formDeleteSession">
					<div class="modal-body">
						<p>Anda yakin ingin menghapus sesi ini?</p>
						<input class="form-control idSessionClass" type="hidden" name="id" value=""/>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" type="submit" id="btnDeleteSession">Hapus</button>&nbsp;
						<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal Tambah Sesi-->
	<div class="modal fade text-left" id="addSession" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">TAMBAH SESI</h4>
				</div>
                <form id="formAddSession" action="" method="">
				<div class="modal-body">
          		          <dl>
          				      <dt>KODE-NAMA PERIODE</dt>
						<p><?php echo $periodID.' - '.$period;?></p>
						<input class="form-control periodID" type="hidden" name="id" value="<?php echo $periodID;?>"/>
                     				   <dt>NAMA SESI</dt>
						<dd><input class="form-control" type="text" name="name" /></dd>
						<dt>WAKTU MULAI</dt>
						<dd><input class="form-control" type="datetime-local" name="date_start" value="<?php echo date('Y-m-d\TH:i');?>" /></dd>
						<dt>WAKTU SELESAI</dt>
						<dd><input class="form-control" type="datetime-local" name="date_end" value="<?php echo date('Y-m-d\TH:i');?>" /></dd>
						<dt>JUMLAH LOKASI</dt>
						<dd><input class="form-control" type="number" max="3" name="location" /></dd>
						<dt>JUMLAH STASIUN PER LOKASI</dt>
						<dd><input class="form-control" type="number" max="14" name="station" /></dd>
					</dl>								
				</div>
                <div class="modal-footer">
                 	<button type="submit" class="btn btn-primary" id="addButtonSession">Tambah</button>&nbsp;
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                </form>
			</div>
		</div>
	</div>

	<!-- Modal Tambah Kompetensi-->
	<div class="modal fade text-left" id="addCompetent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">TAMBAH KOMPETENSI</h4>
				</div>
				<form id="formAddBatchCompetent">
					<div class="modal-body">
						<input class="form-control periodID" type="hidden" name="id" value="<?php echo $periodID;?>"/>
						<dl>
							<dt class="competentAddTemplate"></dt>
						</dl>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="addButtonCompetent">Tambah</button>&nbsp;
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Template for Add Competent -->
	<div class="hidden" id="competentAddTemplate">
		<div class="col-md-12 hidden txtCompetent">
			<dd class="col-md-1">
				<input class="competentCheckbox" type="checkbox" name="competentID[]" />
			</dd>
			<dd class="col-md-7">
				<label class="competentName"></label>
			</dd>
			<dd class="col-md-4">
				<input class="form-control competentTextbox" type="number" name="weight[]" placeholder="Bobot" />
			</dd>
		</div>
	</div>

	<!-- Template for Edit Competent -->
	<div class="hidden" id="competentTemplate">
		<div class="col-md-12 hidden txtCompetent">
			<dd class="col-md-1">
				<input class="competentCheckbox" type="checkbox" name="competentID[]" />
			</dd>
			<dd class="col-md-4">
				<label class="competentName"></label>
			</dd>
			<dd class="col-md-6">
				<input class="form-control competentTextbox" type="number" name="weight[]" />
			</dd>
			<dd class="col-md-1">
				<form class="formDeleteCompetent">
					<input class="form-control sessionID" type="hidden" name="id"/>
					<input class="form-control competentHidden" type="hidden" name="competentDeleteID" />
					<button class="btn btn-primary hapusKompetensi" type="submit">
						<span class="glyphicon glyphicon-trash"></span>
					</button>&nbsp;
				</form>
			</dd>
		</div>
		</div>
	</div>

	<!-- Template for Location -->
	<div class="hidden" id="locationTemplate">
		<div class="rowbodychild col-md-12 hidden txtLocation" id="">
			<div class="col-md-1"></div>
			<div class="col-md-1 locationname"></div>
			<div class="col-md-2">
				<a class="btn btn-sm btn-primary hapusLokasi" data-toggle="modal" data-target="">
					<span class="glyphicon glyphicon-trash"></span>
				</a>&nbsp;
				<button type="button" class="btn btn-sm btn-primary tambahStation" data-toggle="modal">
					Tambah Stasiun
				</button>
			</div>
		        <div class="col-md-12 stationTemplate"></div>
            
		
			<!-- Modal Tambah Stasiun-->
			<div class="modal fade addStation text-left" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">TAMBAH STASIUN</h4>
						</div>
                        <form class="formAddStation">
						<div class="modal-body">
								<div><b class="textLocationPeriod"></b></div>
								<div><b class="textLocationSession"></b></div>
								<div><b class="textLocationLocation"></b></div>
								<input class="form-control location_period_id" type="hidden" name="period_id" />
								<input class="form-control location_session_id" type="hidden" name="session_id" />
								<input class="form-control location_location_id" type="hidden" name="location_id" />
								<dt>NAMA STASIUN</dt>
								<dd><input class="form-control" type="number" max="14" name="station_id" /></dd>
						</div>
                        <div class="modal-footer">
							<button type="submit" class="btn btn-primary">Tambah</button>&nbsp;
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                        </form>
					</div>
				</div>
			</div>

			<!-- Modal Hapus Lokasi-->
			<div class="modal fade deleteLocationForm text-left" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h4 class="modal-title" id="dataConfirmLabel">KONFIRMASI</h4>
						</div>
                        <form class="formDeleteLocation">
						<div class="modal-body">
							<p>Anda yakin ingin menghapus lokasi ini?</p>
							<input class="form-control idLocationClass" type="hidden" name="id" value="" />
						</div>
                        <div class="modal-footer">
							<button class="btn btn-primary" type="submit" id="btnDeleteLocation">Hapus</button>&nbsp;
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>	
                        </div>
                        </form>
					</div>
				</div>
			</div>
		</div>
        <hr/>
	</div>

	<!-- Template for Stasiun -->
	<div class="hidden" id="stationTemplate">
		<div class="rowbodychild col-md-12 hidden txtStation" id="">
			<div class="col-md-2"></div>
			<div class="col-md-2 stationname"></div>
			<div class="col-md-4 lecturername"><p class="penguji"><p></div>
			<div class="col-md-2">
               	<a class="btn btn-sm btn-primary jadwalPenguji" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> &nbsp;Penguji</a>&nbsp; 
                <a class="btn btn-sm btn-primary lihatMahasiswa" data-toggle="modal" data-target=""><span class="glyphicon glyphicon-search"></span> &nbsp;Peserta</a>&nbsp;
               	<a class="btn btn-sm btn-primary hapusStation" data-toggle="modal" data-target=""><span class="glyphicon glyphicon-trash"></span></a>
                
			</div>

			<div class="modal fade pesertaModal text-left" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel"><div class="station"></div></h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<table id="templatePeserta" class="col-md-11 table table-condensed" border="1">
							                <thead>
										<tr>
											<th width="40%" align="center"><b>NIM</b></th>
											<th width="60%" align="center"><b>Nama</b></th>
										</tr>
									</thead>
									<tbody>
										<tr class="templatePeserta hide">
											<td width="40%" align="center"><p class="nim"></p></td>
											<td width="60%" align="center"><p class="nama"></p></td>
										</tr>
									</tbody>
								</table>
							</div>
							<!--<div class="col-md-12 templatePeserta"></div>-->
						</div>
                        <div class="modal-footer">
                        	<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        </div>
					</div>
				</div>
			</div>

			<!-- Modal Hapus Stasiun-->
			<div class="modal fade deleteStationForm text-left" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h4 class="modal-title" id="dataConfirmLabel">KONFIRMASI</h4>
						</div>
                        <form class="formDeleteStation">
						<div class="modal-body">
								<p>Anda yakin ingin menghapus station ini?</p>
								<input class="form-control idStationClass" type="hidden" name="id" value="" />
						</div>
                        <div class="modal-footer">
                        	<button class="btn btn-primary" type="submit" id="btnDeleteStation">Hapus</a>&nbsp;
                        	<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
                        </div>
                        </form>
					</div>
				</div>
			</div>
		
			<!-- Modal Set Penguji-->
			<div class="modal fade jadwalPengujiModal text-left" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title" id="myModalLabel">ATUR PENGUJI</h4>
						</div>
                        <form class="formAssignLecturer" id="" action="" method="">
						<div class="modal-body">
							<dl>
                            	<input class="form-control text_transact_id" type="hidden" name="transact_id" />
                                <dt>NOMOR INDUK DOSEN</dt>
                                <dd><input class="form-control lecturer_id" type="text" name="lecturer_id" /></dd>
                            </dl>
						</div>
                        <div class="modal-footer">
                        	<button type="submit" class="btn btn-primary">Simpan</button>&nbsp;
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Template for Peserta Ujian
	<div class="hidden" id="templatePeserta">
		<div class="col-md-12 hidden txtPeserta" id="">
			<div class="col-md-2 nim"></div>
			<div class="col-md-10 nama"></div>
		</div>
	</div>-->
</div>
