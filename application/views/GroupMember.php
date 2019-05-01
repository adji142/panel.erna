<?php
    require_once(APPPATH."views/part/Header.php");
    require_once(APPPATH."views/part/sidebar.php");
?>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
        <a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="tip-buttom"> Master</a>
        <a href="#" class="tip-buttom"> Group Member</a>
    </div>
  </div>
<!--End-breadcrumbs-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class=""><a href="#" id="addGM" class="btn btn-mini btn-info" data-toggle="tooltip" title="Tambah Group Member">Add</a></i></span>
            <h5>Data table</h5>
        </div>
        <div class="widget-content">
            <table class="table table-bordered data-table" >
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Grade Member</th>
                      <th>Discount</th>
                      <th>Benefit 1</th>
                      <th>Benefit 2</th>
                      <th>Benefit 3</th>
                      <th>Tanggal Aktif</th>
                      <th>Tanggal Pasif</th>
                    </tr>
              </thead>
              <tbody>
                    
                      <?php
                        $Recordset = $this->ModelsMember->ListingGroupMember();
                        if($Recordset->num_rows() > 0){
                          foreach ($Recordset->result() as $key) {
                            echo "<tr class='gradeX'>";
                            echo "<td width = '7%'>
                              <button href='#' class='btn btn-mini btn-primary edit_data' id = '".$key->id."'>
                                <i class='icon-edit' data-toggle='tooltip' title='Edit Data'></i>
                              </button>
                              <button href='#' class='btn btn-mini btn-danger set_passif' id = '".$key->id."'>
                                <i class='icon-edit' data-toggle='tooltip' title='Set Passif'></i>
                              </button>
                            </td>";
                            echo "<td>".$key->namagrade."</td>";
                            echo "<td>".$key->benefitdiscount."</td>";
                            echo "<td>".$key->benefitlain1."</td>";
                            echo "<td>".$key->benefitlain2."</td>";
                            echo "<td>".$key->benefitlain3."</td>";
                            echo "<td>".$key->tglaktif."</td>";
                            echo "<td>".$key->tglpasif."</td>";
                            echo "</tr>";
                          }
                        }
                        else{
                            echo "<tr class='gradeX'>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "</tr>";
                        }
                      ?>
              </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
</div>
</div>

<!-- Modal -->

<div class="modal fade" id="ModalAddGM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>Add Member Group</h4></p>
        <br>
        <form id="FrmAddGroup" enctype='application/json'>
          <div class="control-group">
            <label class="control-label">Group Name :</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Group Name" id="GrName" name="GrName" required="" />
              <input type="hidden" class="span5" placeholder="Group Name" id="idGrp" name="idGrp"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Discount Member</label>
            <div class="controls">
              <div class="input-append">
                <input type="text" placeholder="Discount Member" class="span5" id="GrDisc" name="GrDisc" required="">
                <span class="add-on">%</span> </div>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Minimum Spend</label>
            <div class="controls">
                <input type="number" placeholder="Minimum Spend" class="span5" id="GrMinSpen" name="GrMinSpen" required="">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Quota</label>
            <div class="controls">
                <input type="number" placeholder="Quota" class="span5" id="GrQuota" name="GrQuota">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Other Benefit 1</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Other Benefit 1" id="GrOthr1" name="GrOthr1" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Other Benefit 2</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Other Benefit 2" id="GrOthr2" name="GrOthr2" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Other Benefit 3</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Other Benefit 3" id="GrOthr3" name="GrOthr3" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Tanggal Aktif</label>
            <div class="controls">
              <input type="date" data-date-format="dd-mm-yyyy" class="datepicker span5" id="GrActDate" name="GrActDate" required="">
              <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
          </div>
          <button class="btn btn-primary" id="btn_SaveGroup">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalSetPassif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>Set Passif Group Member</h4></p>
        <br>
        <form id="Frmsetpassif" enctype='application/json'>
          <div class="control-group">
            <label class="control-label">Tanggal Pasif</label>
            <div class="controls">
              <input type="hidden" class="span5" placeholder="Group Name" id="idGrppasif" name="idGrppasif"/>
              <input type="date" data-date-format="dd-mm-yyyy" class="datepicker span5" id="passifdate" name="passifdate" required="">
              <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
          </div>
          <button class="btn btn-primary" id="btn_setpassif">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->
<?php
    require_once(APPPATH."views/part/footer.php");
?>
<!-- scrit -->
<script type="text/javascript">
$(function () {
  var form_mode = '';
  $.ajaxSetup({
      beforeSend:function(jqXHR, Obj){
          var value = "; " + document.cookie;
          var parts = value.split("; csrf_cookie_token=");
          if(parts.length == 2)   
          Obj.data += '&csrf_token='+parts.pop().split(";").shift();
      }
  });
  $(document).ready(function () {
    //   Swal.fire({
    //         type: 'error',
    //         title: 'Woops...',
    //         text: 'Data Gagal disimpan! Silahkan hubungi administrator',
    //         // footer: '<a href>Why do I have this issue?</a>'
    //       });
      
    });
  // Add Member
  $('#addGM').click(function () {
    form_mode = 'add';
    $('#ModalAddGM').modal('show');
  });
  // $('#ModalAddGM').on('hidden.bs.modal', function () {
  //   location.reload();
  // });
  $('#FrmAddGroup').submit(function(e) {
    $('#btn_SaveGroup').text('Tunggu Sebentar.....');
    $('#btn_SaveGroup').attr('disabled',true);
    $('#btCancelGr').attr('disabled',true);

    e.preventDefault();
    var me = $(this);
    if(form_mode =='add'){
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>MemberController/AddGroupMmber',
        data    : me.serialize(),
        dataType: 'json',
        success : function (response) {
          if(response.success == true){
            $('#ModalAddGM').modal('toggle');
            Swal.fire({
              type: 'success',
              title: 'Horay..',
              text: 'Data Berhasil disimpan!',
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              location.reload();
            });
          }
          else{
            $('#ModalAddGM').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: 'Data Gagal disimpan! Silahkan hubungi administrator',
              // footer: '<a href>Why do I have this issue?</a>'
            });
            $('#ModalAddGM').modal('show');
            $('#btn_SaveGroup').text('Save');
            $('#btn_SaveGroup').attr('disabled',false);
            $('#btCancelGr').attr('disabled',false);
          }
        }
      });
    }
    else if(form_mode == 'edit'){
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>MemberController/EditGroupMmber',
        data    : me.serialize(),
        dataType: 'json',
        success : function (response) {
          if(response.success == true){
            $('#ModalAddGM').modal('toggle');
            Swal.fire({
              type: 'success',
              title: 'Horay..',
              text: 'Data Berhasil disimpan!',
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              location.reload();
            });
          }
          else{
            $('#ModalAddGM').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: 'Data Gagal disimpan! Silahkan hubungi administrator',
              // footer: '<a href>Why do I have this issue?</a>'
            });
            $('#ModalAddGM').modal('show');
            $('#btn_SaveGroup').text('Save');
            $('#btn_SaveGroup').attr('disabled',false);
            $('#btCancelGr').attr('disabled',false);
          }
        }
      });
    }
    else {
      Swal.fire({
        type: 'error',
        title: 'Woops...',
        text: 'Undefined Form Mode!!',
        // footer: '<a href>Why do I have this issue?</a>'
      });
    }
  });
  // End Add Member

  // Edit Member
  $('.edit_data').click(function () {
    form_mode = 'edit';
    var id = $(this).attr("id");
    // alert(id);
    $.ajax({
      type    :'post',
      url     : '<?=base_url()?>MemberController/FindGroupMember',
      data    : {id,id},
      dataType: 'json',
      success:function (response) {
        if(response.success == true){
          $.each(response.data,function (k,v) {
            $('#idGrp').val(v.id);
            $('#GrName').val(v.namagrade);
            $('#GrDisc').val(v.benefitdiscount);
            $('#GrMinSpen').val(v.minimumspend);
            $('#GrQuota').val(v.quota);
            $('#GrOthr1').val(v.benefitlain1);
            $('#GrOthr2').val(v.benefitlain2);
            $('#GrOthr3').val(v.benefitlain3);
            $('#GrActDate').val(v.tglaktif);
          });
          $('#GrActDate').attr('readonly',true);
          $('#ModalAddGM').modal('show');
        }
        else{
          if(response.message = '404-01'){
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: 'Data Tidak Ditemukan',
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              location.reload();
            });
          }
        }
      }
    });
  });
  // End Edit Member

  // Set pasif
  $('.set_passif').click(function () {
    var id = $(this).attr("id");
    // alert(id);
    $.ajax({
      type    :'post',
      url     : '<?=base_url()?>MemberController/FindGroupMember',
      data    : {id,id},
      dataType: 'json',
      success:function (response) {
        if(response.success == true){
          $.each(response.data,function (k,v) {
            $('#idGrppasif').val(v.id);
          });
          $('#GrActDate').attr('readonly',true);
          $('#ModalSetPassif').modal('show');
        }
        else{
          if(response.message = '404-01'){
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: 'Data Tidak Ditemukan',
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              location.reload();
            });
          }
        }
      }
    });
  });

  $('#Frmsetpassif').submit(function(e) {
    $('#btn_setpassif').text('Tunggu Sebentar.....');
    $('#btn_setpassif').attr('disabled',true);

    e.preventDefault();
    var me = $(this);

    $.ajax({
      type    :'post',
      url     : '<?=base_url()?>MemberController/SetPassifGroupMmber',
      data    : me.serialize(),
      dataType: 'json',
      success : function (response) {
        if(response.success == true){
          $('#ModalSetPassif').modal('toggle');
            Swal.fire({
              type: 'success',
              title: 'Horay..',
              text: 'Data Berhasil disimpan!',
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              location.reload();
          });
        }
        else{
          $('#ModalSetPassif').modal('toggle');
          Swal.fire({
            type: 'error',
            title: 'Woops...',
            text: 'Data Gagal disimpan! Silahkan hubungi administrator',
            // footer: '<a href>Why do I have this issue?</a>'
          });
          $('#ModalSetPassif').modal('show');
          $('#btn_setpassif').text('Save');
          $('#btn_setpassif').attr('disabled',false);
        }
      }
    });
  });
  // end Set pasif
});

</script>
<!-- <div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<script src="<?php echo base_url();?>Assets/js/jquery.min.js"></script> 
<script src="<?php echo base_url();?>Assets/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url();?>Assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>Assets/js/jquery.uniform.js"></script> 
<script src="<?php echo base_url();?>Assets/js/select2.min.js"></script> 
<script src="<?php echo base_url();?>Assets/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url();?>Assets/js/matrix.js"></script> 
<script src="<?php echo base_url();?>Assets/js/matrix.tables.js"></script>
</body>
</html> -->

<!-- <script type="text/javascript">
    $('#example1').DataTable();
</script> -->