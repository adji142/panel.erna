<?php
		require_once(APPPATH."views/Parts/header.php");
?>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div id="page-wrapper" class="gray-bg dashbard-1">
	<div class="content-main">
		<div class="banner">
			<h2>
				<a href="<?php echo base_url();?>">Home</a>
				<i class="fa fa-angle-right"></i>
				<span>Master Anak</span>
			</h2>
		</div>
		<div class="blank">
			<div class="blank-page">
				<!-- Code Hire -->
				<button type='button' class='btn btn-danger' id="AddAnak" name="">Tambah</button>
				<table id="example1" class="table table-bordered table-hover">
					<thead>
						<th>#</th>
						<th>No. SG</th>
						<th>Nama</th>
						<th>Kelas Usia</th>
						<th>Email</th>
						<th>No. Telepon</th>
					</thead>
					<!-- <tbody> -->
						<?php
							foreach ($have_post as $key) {
								echo "
									<td>
										<div class='btn-group'>
											<button type='button' class='btn btn-danger' disable>Pilih Action
											<span class='fa fa-pencil'></span>
											</button>
											<button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown'>
											<span class='fa fa-filter'></span>
                    						<span class='sr-only'>Toggle Dropdown</span>
                    						</button>
                    						<ul class='dropdown-menu' role='menu'>
							                    <li><a href='#' id = 'Detail' name = '".$key->id."'>Lihat Detail</a></li>
							                    <li><a href='#' id = 'Naik' name = '".$key->id."'>Naik Kelas</a></li>
							                    <li><a href='#' id = 'status' name = '".$key->id."'>Status Aktif Pasif Anak</a></li>
							                </ul>
										</div>
									</td>
									<td>".$key->NoSG."</td>
									<td>".$key->NamaAnak."</td>
									<td>".$key->KelasUsia."</td>
									<td></td>
									<td>".$key->NoTlp."</td>
								";
							}
						?>
					<!-- </tbody> -->
				</table>
			</div>
		</div>
			<div class="copy">
				<p> &copy; 2016 Minimal. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
			</div>
		</div>
		</div>
		<div class="clearfix"> </div>
       </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalAktifPasif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">  
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<p><h4>Aktif Pasif Anak</h4></p>
				<br>
				<div class="form-group has-feedback">
					<label for="">Nomer SG :</label>
					<input type="text" name = "naikSG" id = "naikSG" class="form-control" readonly="">
				</div>

				<div class="form-group has-feedback">
					<label for="">Nama Anak :</label>
					<input type="text" name = "naikNama" id = "naikNama" class="form-control" readonly="">
				</div>
				<form id="GoSaveKet" enctype='application/json'>
					<input type="hidden" name="id" id="id">
					<div class="form-group has-feedback">
						<label for="">Aktif / Pasif :</label>
						<br>
						<label class="switch">
						  <input type="checkbox" class="form-control" id="checked">
						  <span class="slider round"></span>
						</label>
					</div>
					<div class="form-group has-feedback">
						<label for="">Keterangan :</label>
						<select class="form-control select2" style="width: 100%;" id="ket" name="ket">
							<option selected="selected">None</option>
							<?php
								$Keterangan = $this->DataModels->GetKeteranganStatus();
								foreach ($Keterangan->result() as $rsKet) {
									echo "<option value = ".$rsKet->id.">".$rsKet->KeteranganStatus."</option>";
								}
							?>
						</select>
					</div>
					<button class="btn btn-general" id="btn_SaveKet">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ModalNaik" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">  
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<p><h4>Naik Kelas Usia</h4></p>
				<br>
				<div class="form-group has-feedback">
					<label for="">Nomer SG :</label>
					<input type="text" name = "naikSG" id = "naikSG" class="form-control" readonly="">
				</div>

				<div class="form-group has-feedback">
					<label for="">Nama Anak :</label>
					<input type="text" name = "naikNama" id = "naikNama" class="form-control" readonly="">
				</div>

				<div class="form-group has-feedback">
					<label for="">Kelas Usia Sekarang :</label>
					<input type="text" name = "kunow" id = "kunow" class="form-control" readonly="">
				</div>
				<form id="GoSaveKU" enctype='application/json'>
					<input type="hidden" name="id" id="id">
					<div class="form-group has-feedback">
						<label for="">Naik Ke Kelas Usia :</label>
						<select class="form-control select2" style="width: 100%;" id="KelasUsiaID" name="KelasUsiaID">
							<option selected="selected">None</option>
							<?php
								$KelasUsia = $this->DataModels->GetDataKelasUsia();
								foreach ($KelasUsia->result() as $rsKU) {
									echo "<option value = ".$rsKU->id.">".$rsKU->kelasusia."</option>";
								}
							?>
						</select>
					</div>
					<button class="btn btn-general" id="btn_SaveKU">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>Detail Anak</h4></p>
        <br>
        <div class="nav-tabs-custom">
        	<ul class="nav nav-tabs">
        		<li class="active"><a href="#tab_1" data-toggle="tab">Informasi Anak</a></li>
        		<li><a href="#tab_2" data-toggle="tab">Informasi Sponsor</a></li>
        		<li><a href="#tab_3" data-toggle="tab">Informasi Mentor</a></li>
        		<li><a href="#tab_4" data-toggle="tab">Informasi Orang Tua</a></li>
        	</ul>
        	<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
	                <b>Informasi Anak</b>
	                  <div class="form-group has-feedback">
			            <label for="">No SG</label>
			            <input type="text" name = "nosg" id = "nosg" class="form-control" readonly="">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Nama Anak</label>
			            <input type="text" name = "namaanak" id = "namaanak" class="form-control" readonly="">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Tempat, Tanggal Lahir</label>
			            <input type="text" name = "ttl" id = "ttl" class="form-control" readonly="">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Email</label>
			            <input type="text" name = "email" id = "email" class="form-control" readonly="">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Nomor Telepon / HP</label>
			            <input type="text" name = "tlp" id = "tlp" class="form-control" readonly="">
			          </div>
              	</div>
              	<div class="tab-pane" id="tab_2">
	                <b>Informasi Sponsor</b>
	          	 	  <div class="form-group has-feedback">
			            <label for="">Nama Sponsor</label>
			            <input type="text" name = "sponsor" id = "sponsor" class="form-control" readonly="">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Asal Sponsor</label>
			            <input type="text" name = "asalsponsor" id = "asalsponsor" class="form-control" readonly="">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Di Sponsori Sejak</label>
			            <input type="text" name = "startdate" id = "startdate" class="form-control" readonly="">
			          </div>      
              	</div>
              	<div class="tab-pane" id="tab_3">
              		<b>Informasi Mentor</b>
					  <div class="form-group has-feedback">
		            	<label for="">Kelas Usia</label>
		            	<input type="text" name = "KU" id = "KU" class="form-control" readonly="">
		          	  </div>

		          	  <div class="form-group has-feedback">
		            	<label for="">Mentor Pengampu</label>
		            	<input type="text" name = "mentor" id = "mentor" class="form-control" readonly="">
		          	  </div>
		          	  <div class="form-group has-feedback">
		            	<label for="">Nomer Telepon / HP Mentor</label>
		            	<input type="text" name = "nomentor" id = "nomentor" class="form-control" readonly="">
		          	  </div>
              	</div>
              	<div class="tab-pane" id="tab_4">
					  <div class="form-group has-feedback">
			            <label for="">Nama Orang Tua (Ayah)</label>
			            <input type="text" name = "ayah" id = "ayah" class="form-control" readonly="">
			          </div>
			          <div class="form-group has-feedback">
			            <label for="">Nomer Telepon / HP Ayah</label>
			            <input type="text" name = "noayah" id = "noayah" class="form-control" readonly="">
			          </div>
			          <div class="form-group has-feedback">
			            <label for="">Pendidikan Ayah</label>
			            <input type="text" name = "pendAyah" id = "pendAyah" class="form-control" readonly="">
			          </div>
			          <div class="form-group has-feedback">
			            <label for="">Pekerjaan Ayah</label>
			            <input type="text" name = "pekerjaanayah" id = "pekerjaanayah" class="form-control" readonly="">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Nama Orang Tua (Ibu)</label>
			            <input type="text" name = "ibu" id = "ibu" class="form-control" readonly="">
			          </div>
			          <div class="form-group has-feedback">
			            <label for="">Nomer Telepon / HP Ibu</label>
			            <input type="text" name = "noibu" id = "noibu" class="form-control" readonly="">
			          </div>
			          <div class="form-group has-feedback">
			            <label for="">Pendidikan Ibu</label>
			            <input type="text" name = "pendIbu" id = "pendIbu" class="form-control" readonly="">
			          </div>
			          <div class="form-group has-feedback">
			            <label for="">Pekerjaan Ibu</label>
			            <input type="text" name = "pekerjaanibu" id = "pekerjaanibu" class="form-control" readonly="">
			          </div>
              	</div>
        	</div>
        </div>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

<div class="modal fade" id="ModalAddAnak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>Detail Anak</h4></p>
        <br>
        <div class="nav-tabs-custom">
        	<ul class="nav nav-tabs">
        		<li class="active"><a href="#tab_1a" data-toggle="tab">Informasi Anak</a></li>
        		<li><a href="#tab_2a" data-toggle="tab">Informasi Sponsor</a></li>
        		<li><a href="#tab_3a" data-toggle="tab">Informasi Mentor</a></li>
        		<li><a href="#tab_4a" data-toggle="tab">Informasi Orang Tua</a></li>
        	</ul>
        	<form id="SaveAnak" enctype='application/json'>
        	<input type="hidden" name="id" id="RecordOnerid" value="<?php echo $RecordOnerid?>" >
        	<input type="hidden" name="$IO_PPA" id="IOPPA" value="<?php echo $IO_PPA?>" >
        	<div class="tab-content">
				<div class="tab-pane active" id="tab_1a">
	                <b>Informasi Anak</b>
	                  <div class="form-group has-feedback">
			            <label for="">No SG</label>
			            <input type="text" name = "nosg" id = "nosg_a" class="form-control" maxlength="4">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Nama Anak</label>
			            <input type="text" name = "namaanak" id = "namaanak_a" class="form-control">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Tempat Lahir</label>
			            <input type="text" name = "TempatLahir" id = "TempatLahir_a" class="form-control">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Tanggal Lahir</label>
			            <input type="date" name = "TanggalLahir" id = "TanggalLahir_a" class="form-control">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Email</label>
			            <input type="email" name = "email" id = "email_a" class="form-control">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Nomor Telepon / HP</label>
			            <input type="text" name = "tlp" id = "tlp_a" class="form-control">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Alamat Anak</label>
			            <input type="text" name = "alamat_anak" id = "alamat_anak" class="form-control">
			          </div>
              	</div>
              	<div class="tab-pane" id="tab_2a">
	                <b>Informasi Sponsor</b>
	          	 	  <div class="form-group has-feedback">
			            <label for="">Kode Sponsor</label>
			            <input type="hidden" name = "idsponsor" id = "idsponsor" class="form-control">
			            <input type="text" name = "kdsponsor" id = "kdsponsor_a" class="form-control">
			          </div>

	          	 	  <div class="form-group has-feedback">
			            <label for="">Nama Sponsor</label>
			            <input type="text" name = "sponsor" id = "sponsor_a" class="form-control">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Asal Sponsor</label>
			            <input type="text" name = "asalsponsor" id = "asalsponsor_a" class="form-control">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Di Sponsori Sejak</label>
			            <input type="date" name = "startdate" id = "startdate_a" class="form-control">
			          </div>      
              	</div>
              	<div class="tab-pane" id="tab_3a">
              		<b>Informasi Mentor</b>
              		  <div class="form-group has-feedback">
		            	<label for="">Nama Mentor Pengampu</label>
		            	<input type="hidden" name = "idmentor" id = "idmentor" class="form-control">
		            	<input type="text" name = "mentor" id = "mentor_a" class="form-control">
		          	  </div>

					  <div class="form-group has-feedback">
		            	<label for="">Kelas Usia</label>
		            	<input type="text" name = "KU" id = "KU_a" class="form-control">
		          	  </div>

		          	  <div class="form-group has-feedback">
		            	<label for="">Nomer Telepon / HP Mentor</label>
		            	<input type="text" name = "nomentor" id = "nomentor_a" class="form-control">
		          	  </div>
              	</div>
              	<div class="tab-pane" id="tab_4a">
					  <div class="form-group has-feedback">
			            <label for="">Nama Orang Tua (Ayah)</label>
			            <input type="hidden" name = "idortu" id = "idortu" class="form-control">
			            <input type="text" name = "ayah" id = "ayah_a" class="form-control">
			          </div>
			          <div class="form-group has-feedback">
			            <label for="">Nomer Telepon / HP Ayah</label>
			            <input type="text" name = "noayah" id = "noayah_a" class="form-control">
			          </div>
			          <div class="form-group has-feedback">
			            <label for="">Pendidikan Ayah</label>
			            <input type="text" name = "pendAyah" id = "pendAyah_a" class="form-control" >
			          </div>
			          <div class="form-group has-feedback">
			            <label for="">Pekerjaan Ayah</label>
			            <input type="text" name = "pekerjaanayah" id = "pekerjaanayah_a" class="form-control">
			          </div>

			          <div class="form-group has-feedback">
			            <label for="">Nama Orang Tua (Ibu)</label>
			            <input type="text" name = "ibu" id = "ibu_a" class="form-control">
			          </div>
			          <div class="form-group has-feedback">
			            <label for="">Nomer Telepon / HP Ibu</label>
			            <input type="text" name = "noibu" id = "noibu_a" class="form-control">
			          </div>
			          <div class="form-group has-feedback">
			            <label for="">Pendidikan Ibu</label>
			            <input type="text" name = "pendIbu" id = "pendIbu_a" class="form-control">
			          </div>
			          <div class="form-group has-feedback">
			            <label for="">Pekerjaan Ibu</label>
			            <input type="text" name = "pekerjaanibu" id = "pekerjaanibu_a" class="form-control">
			          </div>
			        </form>
			        <button class="btn btn-general" id="btn_SaveAnak">Simpan</button>
              	</div>
        	</div>
        </div>
        </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
<script src="<?php echo base_url();?>Assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url();?>Assets/js/scripts.js"></script>
</body>
</html>

<script type="text/javascript">
  $(function () {
  	var form_mode = '';
  	var saved = 0;
    $('#example1').DataTable();
    $('.select2').select2();
		$.ajaxSetup({
        beforeSend:function(jqXHR, Obj){
            var value = "; " + document.cookie;
            var parts = value.split("; csrf_cookie_token=");
            if(parts.length == 2)   
            Obj.data += '&csrf_token='+parts.pop().split(";").shift();
        }
    });
	// Action button
	$("#Detail").click(function () {
		// alert($('#RecordOnerid').val())
		var id = $(this).prop("name");
		$.ajax({
			type: "post",
			url: "<?=base_url()?>DataController/GetDataAnak",
			data: {id:id},
			dataType: "json",
			success: function (response) {
				if(response.success==true){
					$.each(response.data,function (k,v) {
						$('#nosg').val(v.NoSG);
						$('#namaanak').val(v.NamaAnak);
						$('#ttl').val(v.TempatLahir+', '+v.TanggalLahir);
						$('#email').val(v.email);
						$('#tlp').val(v.NoTlp);
						$('#sponsor').val(v.NamaSponsor);
						$('#asalsponsor').val(v.AsalSponsor);
						$('#startdate').val(v.StartSponsoring);
						$('#KU').val(v.KelasUsia);
						$('#mentor').val(v.namaMentor);
						$('#nomentor').val(v.notlpmentor);
						$('#ayah').val(v.NamaAyah);
						$('#noayah').val(v.NoTlpAyah);
						$('#pendAyah').val(v.PendidikanAyah);
						$('#pekerjaanayah').val(v.PekerjaanAyah);
						$('#ibu').val(v.NamaIbu);
						$('#noibu').val(v.NoTlpIbu);
						$('#pendIbu').val(v.PendidikanIbu);
						$('#pekerjaanibu').val(v.PekerjaanIbu);
					});
					$('#ModalDetail').modal('show');
				}
				else{
					if(response.message=="404-02"){
						Swal.fire({
						  type: 'error',
						  title: 'Oops...',
						  text: 'User tidak di temukan!'
						});
					}
					else{
						Swal.fire({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Unidentified error!',
						  footer: '<a href>Why do I have this issue?</a>'
						});
					}
				}
			}
		});
		// $('#ModalDetail').modal('show');
	});
	// Naik Kelas
	$('#Naik').click(function () {
		var id = $(this).prop("name");
		$.ajax({
			type: "post",
			url: "<?=base_url()?>DataController/GetDataAnak",
			data: {id:id},
			dataType: "json",
			success: function (response) {
				if(response.success==true){
					$.each(response.data,function (k,v) {
						$('#id').val(v.id);
						$('#naikSG').val(v.NoSG);
						$('#naikNama').val(v.NamaAnak);
						$('#kunow').val(v.KelasUsia);
					});
				}
			}
		});
		$('#ModalNaik').modal('show');
	});
	$('#status').click(function() {
		var id = $(this).prop("name");
		$.ajax({
			type: "post",
			url: "<?=base_url()?>DataController/GetDataAnak",
			data: {id:id},
			dataType: "json",
			success: function (response) {
				if(response.success==true){
					$.each(response.data,function (k,v) {
						$('#id').val(v.id);
						$('#naikSG').val(v.NoSG);
						$('#naikNama').val(v.NamaAnak);
						// $('#kunow').val(v.KelasUsia);
						if(v.Status == 1){
							$('#checked').attr('checked','checked');
						}
						else{
							$('#checked').attr('readonly',true);
							$('#ket').attr('readonly',true);
						}
					});
				}
			}
		});
		$('#ModalAktifPasif').modal('show');
	});
	$('#AddAnak').click(function () {
		$('#ModalAddAnak').modal('show');
		$('$nosg_a').focus();
	});
	// Function Update Kelas USia
	$("#GoSaveKU").submit(function (e) {
		$('#btn_SaveKU').text('Tunggu Sebentar...');
        $('#btn_SaveKU').attr('disabled',true);
		e.preventDefault();
        var me = $(this);
		$.ajax({
			type: "post",
			url: "<?=base_url()?>ExecuteMaster/SaveUpdateKU",
			data: me.serialize(),
			dataType: "json",
			success: function (response) {
				if(response.success == true){
					Swal.fire({
					  type: 'success',
					  title: 'Horay..',
					  text: 'Data Berhasil disimpan!',
					  // footer: '<a href>Why do I have this issue?</a>'
					}).then((result)=>{
						location.reload();
					});
					$('#btn_SaveKU').text('Simpan');
        			$('#btn_SaveKU').attr('disabled',false);
				}
				else{
					if(response.message == '500-02'){
						Swal.fire({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Kesalahan Server, Data gagal disimpan!',
						  // footer: '<a href>Why do I have this issue?</a>'
						});
						$('#btn_SaveKU').text('Simpan');
	        			$('#btn_SaveKU').attr('disabled',false);
					}
					else{
						Swal.fire({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Unidentified Error !',
						  // footer: '<a href>Why do I have this issue?</a>'
						});
						$('#btn_SaveKU').text('Simpan');
	        			$('#btn_SaveKU').attr('disabled',false);
					}
				}
			}
		});
	});
	// Function Update Status
	$("#GoSaveKet").submit(function (e) {
		$('#btn_SaveKet').text('Tunggu Sebentar...');
        $('#btn_SaveKet').attr('disabled',true);
		e.preventDefault();
        var me = $(this);
		$.ajax({
			type: "post",
			url: "<?=base_url()?>ExecuteMaster/SaveUpdateKet",
			data: me.serialize(),
			dataType: "json",
			success: function (response) {
				if(response.success == true){
					Swal.fire({
					  type: 'success',
					  title: 'Horay..',
					  text: 'Data Berhasil disimpan!',
					  // footer: '<a href>Why do I have this issue?</a>'
					}).then((result)=>{
						location.reload();
					});
					$('#btn_SaveKet').text('Simpan');
        			$('#btn_SaveKet').attr('disabled',false);
				}
				else{
					if(response.message == '500-02'){
						Swal.fire({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Kesalahan Server, Data gagal disimpan!',
						  // footer: '<a href>Why do I have this issue?</a>'
						});
						$('#btn_SaveKet').text('Simpan');
	        			$('#btn_SaveKet').attr('disabled',false);
					}
					else{
						Swal.fire({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Unidentified Error !',
						  // footer: '<a href>Why do I have this issue?</a>'
						});
						$('#btn_SaveKet').text('Simpan');
	        			$('#btn_SaveKet').attr('disabled',false);
					}
				}
			}
		});
	});
	$('#ModalAddAnak').on('hidden.bs.modal', function () {
	  location.reload();
	})
// Saving data anak
	$('#nosg_a').focusout(function () {
		saved = 0;
		var rs_anak = '';
		var nosg = $('#IOPPA').val()+'-'+$('#nosg_a').val();
		$.ajax({
			type: "post",
			url: "<?=base_url()?>ExecuteMaster/GetanakFilterbySG",
			data: {nosg,nosg},
			dataType: "json",
			success: function (response) {
				if(response.success == true){
					$.each(response.data,function (k,v) {
						$('#nosg_a').val(v.NoSG);
						$('#namaanak_a').val(v.NamaAnak);
						$('#TempatLahir_a').val(v.TempatLahir);
						$('#TanggalLahir_a').val(v.TanggalLahir)
						$('#email_a').val(v.email);
						$('#tlp_a').val(v.NoTlp);
						$('#alamat_anak').val('Alamat');
						$('#nosg_a').attr('disabled',true);

						form_mode = 'edit';
					});
				}
				else{
					form_mode = 'add';
					Swal.fire({
					  type: 'success',
					  title: 'Peringatan....',
					  text: 'Data ini akan di catat sebagai data baru !',
					  // footer: '<a href>Why do I have this issue?</a>'
					});
					// $('#nosg_a').val('');
					$('#namaanak_a').val('');
					$('#TempatLahir_a').val('');
					$('#TanggalLahir_a').val('')
					$('#email_a').val('');
					$('#tlp_a').val('');
					$('#alamat_anak').val('');
					$('#nosg_a').attr('disabled',false);
				}
			}
		});
	});

	$('#kdsponsor_a').focusout(function () {
		saved = 0;
		var kd_sponsor = $('#kdsponsor_a').val();
		$.ajax({
			type: "post",
			url: "<?=base_url()?>ExecuteMaster/GetSposor",
			data: {kd_sponsor,kd_sponsor},
			dataType: "json",
			success: function (response) {
				if(response.success == true){
					$.each(response.data,function (k,v) {
						$('#sponsor_a').val(v.NamaSponsor);
						$('#asalsponsor_a').val(v.AsalSponsor);
						$('#startdate_a').val(v.StartSponsoring);
						$('#startdate_a').val(v.StartSponsoring);
						$('#idsponsor').val(v.id);
						form_mode = 'edit';
					});
				}
				else{
					Swal.fire({
					  type: 'error',
					  title: 'Peringatan....',
					  text: 'Kode Sponsor tidak ditemukan, silahkan lakukan pengecekan di Master Sponsor !',
					  // footer: '<a href>Why do I have this issue?</a>'
					});
					// $('#nosg_a').val('');
					$('#sponsor_a').val('');
					$('#asalsponsor_a').val('');
					$('#startdate_a').val('');
					$('#idsponsor').val('');
				}
			}
		});
	});

	$('#mentor_a').focusout(function () {
			saved = 0;
			var namaMentor = $('#mentor_a').val();
			$.ajax({
				type: "post",
				url: "<?=base_url()?>ExecuteMaster/GetMentor",
				data: {namaMentor,namaMentor},
				dataType: "json",
				success: function (response) {
					if(response.success == true){
						$.each(response.data,function (k,v) {
							$('#KU_a').val(v.KelasUsia);
							$('#mentor_a').val(v.namaMentor);
							$('#nomentor_a').val(v.notlpmentor);
							$('#idmentor').val(v.KelasUsiaID);
							form_mode = 'edit';
						});
					}
					else{
						Swal.fire({
						  type: 'error',
						  title: 'Peringatan....',
						  text: 'Nama Mentor tidak ditemukan, silahkan lakukan pengecekan di Master Mentor !',
						  // footer: '<a href>Why do I have this issue?</a>'
						});
						// $('#nosg_a').val('');
						// $('#KU_a').val('');
						$('#mentor_a').val('');
						$('#nomentor_a').val('');
						$('#idmentor').val('');
					}
				}
			});
		});

	$('#ayah_a').focusout(function () {
			saved = 0;
			var NamaAyah = $('#ayah_a').val();
			$.ajax({
				type: "post",
				url: "<?=base_url()?>ExecuteMaster/GetDataOrtu",
				data: {NamaAyah,NamaAyah},
				dataType: "json",
				success: function (response) {
					if(response.success == true){
						$.each(response.data,function (k,v) {
							$('#KU_a').val(v.KelasUsia);
							$('#mentor_a').val(v.namaMentor);
							$('#nomentor_a').val(v.notlpmentor);
							$('#idortu').val(v.id);
							form_mode = 'edit';
						});
					}
					else{
						Swal.fire({
						  type: 'error',
						  title: 'Peringatan....',
						  text: 'Data Orang Tua tidak ditemukan, silahkan lakukan pengecekan di Master Orang Tua !',
						  // footer: '<a href>Why do I have this issue?</a>'
						});
						// $('#nosg_a').val('');
						// $('#KU_a').val('');
						$('#mentor_a').val('');
						$('#nomentor_a').val('');
						$('#idortu').val('');
					}
				}
			});
		});

	// Validating and action
	$("#SaveAnak").submit(function (e){
		$('#btn_SaveAnak').text('Tunggu Sebentar...');
        $('#btn_SaveAnak').attr('disabled',true);
        e.preventDefault();
        var me = $(this);

        // tambahdata
        if(form_mode == 'add'){
        	$.ajax({
        		type 	:'post',
        		url 	:'<?=base_url()?>ExecuteMaster/GetDataOrtu',
        		data 	:me.serialize(),
        		dataType:'json',
        		success:function (response) {
        			if(success.response == true){
        				Swal.fire({
						  type: 'success',
						  title: 'Sukses....',
						  text: 'Data Berhasil di tambahkan ke database anak !',
						  // footer: '<a href>Why do I have this issue?</a>'
						});
        				saved = 1;
        			}
        			else{
        				Swal.fire({
						  type: 'error',
						  title: 'Peringatan....',
						  text: 'Data gagal di tambahkan ke database anak !, silahkan hubungi administrator',
						  // footer: '<a href>Why do I have this issue?</a>'
						});
						saved = 0;
        			}
        		}
        	});
        }
        else if(form_mode == 'edit'){
        	$.ajax({
        		type 	:'post',
        		url 	:'<?=base_url()?>ExecuteMaster/GetDataOrtu',
        		data 	:me.serialize(),
        		dataType:'json',
        		success:function (response) {
        			if(success.response == true){
        				Swal.fire({
						  type: 'success',
						  title: 'Sukses....',
						  text: 'Data Berhasil di Rubah !',
						  // footer: '<a href>Why do I have this issue?</a>'
						});
        				saved = 1;
        			}
        			else{
        				Swal.fire({
						  type: 'error',
						  title: 'Peringatan....',
						  text: 'Data gagal di Rubah !, silahkan hubungi administrator',
						  // footer: '<a href>Why do I have this issue?</a>'
						});
						saved = 0;
        			}
        		}
        	});

        }
	});

  });

</script>