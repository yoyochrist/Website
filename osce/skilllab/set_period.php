<script src="set_period.js"></script>

<div class="text-center">
    <h3 class="text-primary"><strong>PILIH PERIODE</strong></h3>
    
    <div class="text-left clear">
        <a class="btn btn-primary tambahPeriode"><span class="glyphicon glyphicon-plus"></span> &nbsp;Periode</a>
    </div>

	<!-- Modal Tambah Periode-->
	<div class="modal fade text-left" id="addPeriod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">TAMBAH PERIODE</h4>
				</div>
                <form id="formAddPeriod" method="" action="">
				<div class="modal-body">
                	<dl>
                    	<dt>Nama Periode</dt>
                        <dd><input class="form-control addPeriodName" type="text" name="name"/></dd>
                        <dt>Tanggal Mulai</dt>
                        <dd><input class="form-control addDateStart" type="date" name="date_start" value="<?php echo date('Y-m-d');?>"/></dd>
                        <dt>Tanggal Berakhir</dt>
                        <dd><input class="form-control addDateEnd" type="date" name="date_end" value="<?php echo date('Y-m-d');?>"/></dd>
                        <dt>Subjek</dt>
                        <dd><select class="form-control subjectList" name="subjekTambah">
                        		<option value="0">Pilih Subjek</option>
                            </select>
                        </dd>
                    </dl>
				</div>
                <div class="modal-footer">
                	<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary" id="btnAddPeriod">Tambah</button>	
                </div>
                </form>
			</div>
		</div>
	</div>
    
    <div class="spacer"></div>            
    <div>
            <div class="voffset2">
            
            <table id="myTable" class="display">
                <thead>
                <tr>
                    <th width="5%"><b>No.</b></th>
                    <th width="25%"><b>Periode (ID)</b></th>
                    <th width="10%"><b>Jml Sesi</b></th>
                    <th width="20%"><b>Jenis Exam</b></th>
                    <th width="20%"><b>Subyek</b></th>
                    <th width="20%"><b>Action</b></th>
                </tr>
                </thead>
		<tr class="templatePeriod hide">
			<td align="center"><p class="count"></p></td>
			<td align="left"><p class="periodName"></p></td>
			<td align="left"><a class="btn btn-sm btn-primary editSesi"><p class="sessionCount"></p></a></td>
			<td align="left"><p class="examType"></p></td>
			<td align="left"><p class="subjectName"></p></td>
			<td align="left">
				<b>
					<a class="btn btn-sm btn-primary editPeriod"><span class="glyphicon glyphicon-edit"></span> &nbsp;Edit</a>&nbsp;
					<a class="btn btn-sm btn-primary hapusPeriod"><span class="glyphicon glyphicon-trash"></span> </a>

					<!-- Modal Hapus Period-->
					<div class="modal fade text-left dataConfirmDeletePeriodModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
										<span aria-hidden="true">&times;</span>		
									</button>
									<h4 class="modal-title" id="dataConfirmDeletePeriodLabel">KONFIRMASI</h4>
								</div>
								<form class="formDeletePeriod" method="" action="">
								<div class="modal-body">
									<p>Apakah Anda ingin menghapus periode ini?</p>
									<input class="form-control idDeleteClass" type="hidden" name="id" value="" />
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
									<button class="btn btn-primary" type="submit" id="dataConfirmDeletePeriodOK">Hapus</a>
								</div>
                                </form>
							</div>
						</div>
					</div>

					<!-- Modal Edit Periode -->
					<div class="modal fade text-left dataConfirmEditPeriodModal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
										<span aria-hidden="true">&times;</span>		
									</button>
									<h4 class="modal-title" id="dataConfirmEditPeriodLabel">EDIT PERIODE</h4>
								</div>
								<form class="formEditPeriod" method="" action="">
								<div class="modal-body">
									<dl>
                                    	<dt>Nama</dt>
										<dd><input type="text" class="form-control namePeriodClass" name="name" /></dd>
										<dt>Tanggal Mulai</dt>
										<dd><input type="date" class="form-control date_start" name="date_start" /></dd>
										<dt>Tanggal Selesai</dt>
										<dd><input type="date" class="form-control date_end" name="date_end" /></dd>
										<dt>Subjek</dt>
										<dd><select class="form-control subjectList" name="subjekEdit">
											<option value="0">Pilih Subjek</option>
										</select></dd>
										<dt>Aktif</dt>
										<dd><select class="form-control activeList" name="active">
											<option value="0">Tidak</option>
											<option value="1">Aktif</option>
										</select></dd>
										<input type="hidden" class="form-control idPeriodClass" name="id" />
                                   </dl>
								</div>
								<div class="modal-footer">
										<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
										<button class="btn btn-primary" type="submit" id="dataConfirmEditPeriodOK">Simpan</a>	
									</form>
								</div>
							</div>
						</div>
					</div>
				</b>
			</td>
		</tr>
</table>    
    </div>
    
            
    </div>	

    
    
    
    
    
</div>