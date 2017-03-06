
	<script src="master.js"></script>

	<div class="col-md-3">
		
		<select class="form-control" id="pilihan">
			<option value="">Pilih Data Master</option>
			<option value="lokasi">Lokasi</option>
			<option value="station">Station</option>
			<option value="dosen">Dosen</option>
			<option value="mahasiswa">Mahasiswa</option>
			<option value="subjek">Subjek</option>
			<option value="kompetensi">Kompetensi</option>
		</select>
	</div>
	<div class="col-md-12 main-table">
		<div class="col-md-6 lokasi">
			<!-- Modal -->
			<div class="modal fade" id="dataConfirmAddLocationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h3 class="modal-title" id="dataConfirmAddLocationLabel">Tambah Lokasi</h3>
						</div>
						<div class="modal-body">
							<form class="formAddLocation" method="" action="">
								<label>Nama</label>
								<input class="form-control" type="text" class="nameClass" name="name" />
								<input class="form-control" type="hidden" class="idClass" name="id" />
								<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-4">
										<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
										<button class="btn btn-primary" type="submit" id="dataConfirmAddLocationOK">Tambah</a>	
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<h4>
				Lokasi
				<a class="btn btn-primary tambahLokasi" data-toggle="modal" data-target="#dataConfirmAddLocationModal">Tambah</a>
			</h4>
			<table id="txtLocation" class="table table-bordered">
				<tr>
					<th>
						Nomor
					</th>
					<th>
						Nama Lokasi
					</th>
					<th>
						Aksi
					</th>
				</tr>
				<tr class="templateLocation hide">
					<td><a class="editLokasi" data-toggle="modal" data-target=""></a></td>
					<td class="locationName">
					</td>
					<td>
						<a href="" class="btn btn-sm btn-primary hapusLokasi" data-toggle="modal">
							<span class="glyphicon glyphicon-trash"></span>
						</a>

						<!-- Modal -->
						<div class="modal fade dataConfirmDeleteLocationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
										<h3 class="modal-title" id="dataConfirmDeleteLocationLabel">Menghapus Data</h3>
									</div>
									<div class="modal-body">
										<form class="formDeleteLocation" method="" action="">
											<p class="message">Apakah Anda ingin menghapus lokasi ini?</p>
											<input class="form-control idDeleteClass" type="hidden" name="id" value="" />
											<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
											<button class="btn btn-primary" type="submit" id="dataConfirmDeleteLocationOK">Hapus</a>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal -->
						<div class="modal fade dataConfirmEditLocationModal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
									<h3 class="modal-title" id="dataConfirmEditLocationLabel">Ubah Lokasi</h3>
									</div>
										<div class="modal-body">
										<form class="formEditLocation" method="" action="">
											<label>Nama</label>
											<input type="text" class="form-control nameLocationClass" name="name" />
											<input type="hidden" class="form-control idLocationClass" name="id" />
											<div class="row">
												<div class="col-md-8"></div>
												<div class="col-md-4">
													<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
													<button class="btn btn-primary" type="submit" id="dataConfirmEditLocationOK">Simpan</a>	
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
		<div class="col-md-6 station">
			<!-- Modal -->
			<div class="modal fade dataConfirmAddStationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h3 class="modal-title" id="dataConfirmAddStationLabel">Tambah Station</h3>
						</div>
						<div class="modal-body">
							<form class="formAddStation" method="" action="">
								<label>Nama</label>
								<input class="form-control" type="text" class="nameClass" name="name" />
								<input class="form-control" type="hidden" class="idClass" name="id" />
								<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-4">
										<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
										<button class="btn btn-primary" type="submit" id="dataConfirmAddStationOK">Tambah</a>	
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<h4>
					Station
					<a class="btn btn-primary tambahStation" data-toggle="modal" data-target=".dataConfirmAddStationModal">Tambah</a>
				</h4>
			</div>
			<table id="txtStation" class="table table-bordered">
				<tr>
					<th>
						Nomor
					</th>
					<th>
						Nama Station
					</th>
					<th>
						Aksi
					</th>
				</tr>
				<tr class="templateStation hide">
					<td><a href="" class="editStation" data-toggle="modal" data-target=""></a></td>
					<td class="stationName"></td>
					<td>
						<a href="" class="btn btn-sm btn-primary hapusStation" data-toggle="modal" data-target="">
							<span class="glyphicon glyphicon-trash"></span>
						</a>

						<!-- Modal -->
						<div class="modal fade dataConfirmDeleteStationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
										<h3 class="modal-title" id="dataConfirmDeleteLabel">Menghapus Data</h3>
									</div>
									<div class="modal-body">
										<form class="formDeleteStation" method="" action="">
											<p class="message"></p>
											<input class="form-control idStationClass" type="hidden" name="id" value="" />
											<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
											<button class="btn btn-primary" type="submit" id="dataConfirmDeleteStationOK">Hapus</a>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal -->
						<div class="modal fade dataConfirmEditStationModal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
										<h3 class="modal-title" id="dataConfirmEditLabel">Ubah Station</h3>
									</div>
									<div class="modal-body">
										<form class="formEditStation" method="" action="">
											<label>Nama</label>
											<input type="text" class="form-control nameStationClass" name="name" />
											<input type="hidden" class="form-control idStationClass" name="id" />
											<div class="row">
												<div class="col-md-8"></div>
												<div class="col-md-4">
													<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
													<button class="btn btn-primary" type="submit" id="dataConfirmEditStationOK">Simpan</a>	
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

		<div class="col-md-6 dosen">
			<!-- Modal -->
			<div class="modal fade dataConfirmAddLecturerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h3 class="modal-title" id="dataConfirmAddLecturerLabel">Tambah Dosen</h3>
						</div>
						<div class="modal-body">
							<form class="formAddLecturer" method="" action="">
								<label>Nomor Induk</label>
								<input class="form-control" type="text" class="id" name="snid" />
								<label>Nama</label>
								<input class="form-control" type="text" class="nameClass" name="name" />
								<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-4">
										<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
										<button class="btn btn-primary" type="submit" id="dataConfirmAddLecturerOK">Simpan</a>	
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<h4>
				Dosen
				<a class="btn btn-primary tambahDosen"  data-toggle="modal" data-target=".dataConfirmAddLecturerModal">Tambah</a>
			</h4>
			<table id="txtDosen" class="table table-bordered">
				<tr>
					<th>
						Nomor Induk Dosen
					</th>
					<th>
						Nama Dosen
					</th>
					<th>
						Aksi
					</th>
				</tr>
				<tr class="templateDosen hide">
					<td><a class="editDosen" data-toggle="modal">Ubah</a></td>
					<td class="dosenName"></td>
					<td>
						<a href="" class="btn btn-sm btn-primary hapusDosen" data-toggle="modal">
							<span class="glyphicon glyphicon-trash"></span>
						</a>

						<!-- Modal -->
						<div class="modal fade dataConfirmDeleteLecturerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
										<h3 class="modal-title" id="dataConfirmDeleteLecturerLabel">Menghapus Data</h3>
									</div>
									<div class="modal-body">
										<form class="formDeleteLecturer" method="" action="">
											<p class="message"></p>
											<input class="form-control idLecturerClass" type="hidden" name="id" value="" />
											<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
											<button class="btn btn-primary" type="submit" id="dataConfirmDeleteLecturerOK">Hapus</a>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal -->
						<div class="modal fade dataConfirmEditLecturerModal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
										<h3 class="modal-title" id="dataConfirmEditLecturerLabel">Ubah Dosen</h3>
									</div>
									<div class="modal-body">
										<form class="formEditLecturer" method="" action="">
											<label>Nomor Induk</label>
												<input type="text" class="form-control idLecturerClass" name="snid" />
											<label>Nama</label>
											<input type="text" class="form-control nameLecturerClass" name="name" />
											<div class="row">
												<div class="col-md-8"></div>
												<div class="col-md-4">
													<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
													<button class="btn btn-primary" type="submit" id="dataConfirmEditLecturerOK">Simpan</a>	
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

		<div class="col-md-6 mahasiswa">
			<!-- Modal -->
			<div class="modal fade dataConfirmAddStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h3 class="modal-title" id="dataConfirmAddStudentLabel">Tambah Mahasiswa</h3>
						</div>
						<div class="modal-body">
							<form class="formAddStudent" method="" action="">
								<label>Nomor Induk</label>
								<input class="form-control" type="text" class="idClass" name="snid" />
								<label>Nama</label>
								<input class="form-control" type="text" class="nameClass" name="name" />
								<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-4">
										<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
										<button class="btn btn-primary" type="submit" id="dataConfirmAddStudentOK">Tambah</a>	
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<h4>
				Mahasiswa
				<a class="btn btn-primary tambahMahasiswa" data-toggle="modal" data-target=".dataConfirmAddStudentModal">Tambah</a>
			</h4>
			<table id="txtMahasiswa" class="table table-bordered">
				<tr>
					<th>
						Nomor Induk Mahasiswa
					</th>
					<th>
						Nama Mahasiswa
					</th>
					<th>
						Aksi
					</th>
				</tr>
				<tr class="templateMahasiswa hide">
					<td><a href="" class="editMahasiswa" data-toggle="modal" data-target=""></a></td>
					<td class="mahasiswaName"></td>
					<td>
						<a href="" class="btn btn-sm btn-primary hapusMahasiswa" data-toggle="modal">
							<span class="glyphicon glyphicon-trash"></span>
						</a>

						<!-- Modal -->
						<div class="modal fade dataConfirmDeleteStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
										<h3 class="modal-title" id="dataConfirmDeleteStudentLabel">Menghapus Data</h3>
									</div>
									<div class="modal-body">
										<form class="formDeleteStudent" method="" action="">
											<p class="message"></p>
											<input class="form-control idStudentClass" type="hidden" name="id" value="" />
											<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
											<button class="btn btn-primary" type="submit" id="dataConfirmDeleteStudentOK">Hapus</a>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal -->
						<div class="modal fade dataConfirmEditStudentModal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
											<h3 class="modal-title" id="dataConfirmEditLabel">Ubah Mahasiswa</h3>
									</div>
									<div class="modal-body">
										<form class="formEditStudent" method="" action="">
											<label>Nomor Induk</label>
											<input type="text" class="form-control idStudentClass" name="snid" />
											<label>Nama</label>
											<input type="text" class="form-control nameStudentClass" name="name" />
											<div class="row">
													<div class="col-md-8"></div>
												<div class="col-md-4">
													<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
													<button class="btn btn-primary" type="submit" id="dataConfirmEditStudentOK">Simpan</a>	
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

		<div class="col-md-6 kompetensi">
			<!-- Modal -->
			<div class="modal fade" id="dataConfirmAddCompetentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h3 class="modal-title" id="dataConfirmAddCompetentLabel">Tambah Kompetensi</h3>
						</div>
						<div class="modal-body">
							<form class="formAddCompetent" method="" action="">
								<label>Nama</label>
								<input class="form-control" type="text" class="nameClass" name="name" />
								<input class="form-control" type="hidden" class="idClass" name="id" />
								<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-4">
										<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
										<button class="btn btn-primary" type="submit" id="dataConfirmAddCompetentOK">Tambah</a>	
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<h4>
				Kompetensi
				<a class="btn btn-primary tambahKompetensi" data-toggle="modal" data-target="#dataConfirmAddCompetentModal">Tambah</a>
			</h4>
			<table id="txtKompetensi" class="table table-bordered">
				<tr>
					<th>
						Nomor
					</th>
					<th>
						Nama
					</th>
					<th>
						Aksi
					</th>
				</tr>
				<tr class="templateKompetensi hide">
					<td><a href="" class="editKompetensi" data-toggle="modal" data-target=""></a></td>
					<td class="kompetensiName"></td>
					<td>
						<a href="" class="btn btn-sm btn-primary hapusKompetensi" data-toggle="modal" data-target="">
							<span class="glyphicon glyphicon-trash"></span>
						</a>

						<!-- Modal -->
						<div class="modal fade dataConfirmDeleteCompetentModal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
										<h3 class="modal-title" id="dataConfirmDeleteCompetentLabel">Menghapus Data</h3>
									</div>
									<div class="modal-body">
										<form class="formDeleteCompetent" method="" action="">
											<p class="message"></p>
											<input class="form-control idCompetentDeleteClass" type="hidden" name="id" value="" />
											<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
											<button class="btn btn-primary" type="submit" id="dataConfirmDeleteCompetentOK">Hapus</a>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal -->
						<div class="modal fade dataConfirmEditCompetentModal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
										<h3 class="modal-title" id="dataConfirmEditCompetentLabel">Ubah Kompetensi</h3>
									</div>
									<div class="modal-body">
										<form class="formEditCompetent" method="" action="">
											<label>Nama</label>
											<input type="text" class="form-control nameCompetentClass" name="name" />
											<input type="hidden" class="form-control idCompetentClass" name="id" />
											<div class="row">
												<div class="col-md-8"></div>
												<div class="col-md-4">
														<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
													<button class="btn btn-primary" type="submit" id="dataConfirmEditCompetentOK">Simpan</a>	
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

		<div class="col-md-6 subjek">
			<!-- Modal -->
			<div class="modal fade dataConfirmAddSubjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
								<span aria-hidden="true">&times;</span>		
							</button>
							<h3 class="modal-title" id="dataConfirmAddSubjectLabel">Tambah Subjek</h3>
						</div>
						<div class="modal-body">
							<form class="formAddSubject" method="" action="">
								<label>Nama</label>
								<input class="form-control" type="text" class="nameClass" name="name" />
								<input class="form-control" type="hidden" class="idClass" name="id" />
								<div class="row">
									<div class="col-md-8"></div>
									<div class="col-md-4">
										<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
										<button class="btn btn-primary" type="submit" id="dataConfirmAddSubjectOK">Tambah</a>	
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<h4>
				Subjek
				<a class="btn btn-primary tambahSubjek" data-toggle="modal" data-target=".dataConfirmAddSubjectModal">Tambah</a>
			</h4>
			<table id="txtSubjek" class="table table-bordered">
				<tr>
					<th>
						Nomor
					</th>
					<th>
						Nama
					</th>
					<th>
						Aksi
					</th>
				</tr>
				<tr class="templateSubjek hide">
					<td><a href="" class="editSubjek" data-toggle="modal" data-target=""></a></td>
					<td class="subjekName"></td>
					<td>
						<a href="" class="btn btn-sm btn-primary hapusSubjek" data-toggle="modal" data-target="">
							<span class="glyphicon glyphicon-trash"></span>
						</a>

						<!-- Modal -->
						<div class="modal fade dataConfirmDeleteSubjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
										<h3 class="modal-title" id="dataConfirmDeleteSubjectLabel">Menghapus Data</h3>
									</div>
									<div class="modal-body">
										<form class="formDeleteSubject" method="" action="">
											<p class="message"></p>
											<input class="form-control idSubjectDeleteClass" type="hidden" name="id"/>
											<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
											<button class="btn btn-primary" type="submit" id="dataConfirmDeleteSubjectOK">Hapus</a>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal -->
						<div class="modal fade dataConfirmEditSubjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
											<span aria-hidden="true">&times;</span>		
										</button>
										<h3 class="modal-title" id="dataConfirmEditSubjectLabel">Ubah Subjek</h3>
									</div>
									<div class="modal-body">
										<form class="formEditSubject" method="" action="">
											<label>Nama</label>
											<input type="text" class="form-control nameSubjectClass" name="name" />
											<input type="hidden" class="form-control idSubjectClass" name="id" />
											<div class="row">
												<div class="col-md-8"></div>
												<div class="col-md-4">
													<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
													<button class="btn btn-primary" type="submit" id="dataConfirmEditSubjectOK">Simpan</a>	
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
	</div>

	<!-- Modal -->
	<div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="Close">
						<span aria-hidden="true">&times;</span>		
					</button>
					<h3 class="modal-title" id="dataConfirmLabel">Menghapus Data</h3>
				</div>
				<div class="modal-body">
					<form class="dataConfirmDelete" method="" action="">
						<p class="message"></p>
						<input class="form-control" id="idDeleteClass" type="hidden" name="id" value="" />
						<button class="btn" data-dismiss="modal" aria-hidden="true">Kembali</button>
						<button class="btn btn-primary" type="submit" id="dataConfirmOK">Hapus</a>	
					</form>
				</div>
			</div>
		</div>
	</div>

