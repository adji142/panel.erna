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
        <a href="#" class="tip-buttom"> Expedisi</a>
    </div>
  </div>
<!--End-breadcrumbs-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class=""><a href="#" id="addXPDC" class="btn btn-mini btn-info" data-toggle="tooltip" title="Tambah Group Member">Add</a></i></span>
            <h5>Data table</h5>
        </div>
        <div class="widget-content">
            <table class="table table-bordered data-table" >
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Kode XPDC</th>
                      <th>Nama XPDC</th>
                      <th>CS Email</th>
                      <th>CS Phone</th>
                      <th>Official Website</th>
                      <th>Tracing Website</th>
                      <th>Jumlah Service</th>
                      <th>Tanggal Aktif</th>
                    </tr>
                </thead>
              <tbody>
                    
                      <?php
                        $Recordset = $this->ModelsXPDC->GetXPDCList();
                        if($Recordset->num_rows() > 0){
                          foreach ($Recordset->result() as $key) {
                            echo "<tr class='gradeX'>";
                            echo "<td width = '10%'>
                              <button href='#' class='btn btn-mini btn-success add_detail' id = '".$key->id."'>
                                <i class='icon-plus-sign' data-toggle='tooltip' title='Add XPDC Services'></i>
                              </button>
                              <button href='#' class='btn btn-mini btn-primary edit_data' id = '".$key->id."'>
                                <i class='icon-edit' data-toggle='tooltip' title='Edit Data'></i>
                              </button>
                              <button href='#' class='btn btn-mini btn-danger set_passif' id = '".$key->id."'>
                                <i class='icon-trash' data-toggle='tooltip' title='Set Passif'></i>
                              </button>
                            </td>";
                            echo "<td>".$key->xpdccode."</td>";
                            echo "<td>".$key->xpdcname."</td>";
                            echo "<td><a href='mailto:".$key->email."' target = '_blank'>".$key->email."</a></td>";
                            echo "<td>".$key->notlphq."</td>";
                            echo "<td><a href='".$key->website."' target = '_blank'>".$key->website."</a></td>";
                            echo "<td><a href='".$key->webtracking."' target = '_blank'>".$key->webtracking."</a></td>";
                            echo "<td><button href='#' class='btn btn-mini btn-success see_services' id = '".$key->id."' data-toggle='tooltip' title='Lihat Detail'>".$key->jmlservice." - Services</button></td>";
                            echo "<td>".$key->tglaktif."</td>";
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

<div class="modal fade" id="ModalAddXPDC" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>Add XPDC</h4></p>
        <br>
        <form id="FrmAddXPDC" enctype='application/json'>
          <div class="control-group">
            <label class="control-label">XPDC Code :</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="XPDC Code" id="xpdccode" name="xpdccode" required="" />
              <input type="hidden" class="span5" placeholder="Group Name" id="idxpdc" name="idxpdc"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">XPDC Name :</label>
            <div class="controls">
              <input type="text" placeholder="XPDC Name" class="span5" id="xpdcname" name="xpdcname" required="">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">HQ Address</label>
            <div class="controls">
                <input type="text" placeholder="HQ Address" class="span5" id="hqaddress" name="hqaddress" required="">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Customer Service Email</label>
            <div class="controls">
                <input type="email" placeholder="HQ Phone" class="span5" id="csemail" name="csemail" required="">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Customer Service Call</label>
            <div class="controls">
                <input type="text" placeholder="HQ Phone" class="span5" id="hqphone" name="hqphone" required="">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Official Website</label>
            <div class="controls">
                <input type="text" placeholder="Official Website" class="span5" id="website" name="website" >
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Tracking Official Website</label>
            <div class="controls">
                <input type="text" placeholder="Tracking Official Website" class="span5" id="trackingwebsite" name="trackingwebsite">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Tanggal Aktif</label>
            <div class="controls">
              <input type="date" data-date-format="dd-mm-yyyy" class="datepicker span5" id="xpdcActDate" name="xpdcActDate" required="">
              <span class="help-block">Date with Formate of  (dd-mm-yy)</span> 
            </div>
          </div>
          <button class="btn btn-primary" id="btn_Saveheader">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalAddXPDCDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>Add XPDC Services</h4></p>
        <br>
        <form id="FrmAddXPDCDetail" enctype='application/json'>
          <div class="control-group">
            <label class="control-label">Service Name :</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Service Name" id="servisesname" name="servisesname" required="" />
              <input type="hidden" class="span5" placeholder="Group Name" id="headerid" name="headerid"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Service Description :</label>
            <div class="controls">
              <input type="text" placeholder="Service Description" class="span5" id="servicedesc" name="servicedesc" required="">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Cost Per KG</label>
            <div class="controls">
                <input type="text" placeholder="Cost Per KG" class="span5" id="costperkg" name="costperkg" required="">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Remarks</label>
            <div class="controls">
                <input type="text" placeholder="Remarks" class="span5" id="remaks" name="remaks" required="">
            </div>
          </div>
          <button class="btn btn-primary" id="btn_SaveDetail">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalsShowServices" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>List Service</h4></p>
        <br>
          <table class="table table-bordered data-table" >
            <thead>
              <tr>
                <th>#</th>
                <th>Service Name</th>
                <th>Service Desc</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody id="load_data">
              
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalSetPassif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>Set Passif XPDC</h4></p>
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
  $('#costperkg').keyup(function(event) {

      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40) return;

      // format number
      $(this).val(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
      });
    });
  // Add Member
  $('#addXPDC').click(function () {
    form_mode = 'add';
    $('#idxpdc').val('');
    $('#xpdccode').val('');
    $('#xpdcname').val('');
    $('#hqaddress').val('');
    $('#csemail').val('');
    $('#hqphone').val('');
    $('#website').val('');
    $('#trackingwebsite').val('');
    $('#xpdcActDate').val('');
    $('#ModalAddXPDCDetail').modal('show');
    $('#ModalAddXPDCDetail').modal('toggle');
    $('#ModalAddXPDC').modal('show');
  });
  // $('#ModalAddXPDC').on('hidden.bs.modal', function () {
  //   location.reload();
  // });
  $('#FrmAddXPDC').submit(function(e) {
    $('#btn_Saveheader').text('Tunggu Sebentar.....');
    $('#btn_Saveheader').attr('disabled',true);

    e.preventDefault();
    var me = $(this);
    if(form_mode =='add'){
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>XPDCController/AddXPDC',
        data    : me.serialize(),
        dataType: 'json',
        success : function (response) {
          if(response.success == true){
            $('#ModalAddXPDC').modal('toggle');
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
            $('#ModalAddXPDC').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: 'Data Gagal disimpan! Silahkan hubungi administrator',
              // footer: '<a href>Why do I have this issue?</a>'
            });
            $('#ModalAddXPDC').modal('show');
            $('#btn_Saveheader').text('Save');
            $('#btn_Saveheader').attr('disabled',false);
          }
        }
      });
    }
    else if(form_mode == 'edit'){
      $('#btn_Saveheader').text('Tunggu Sebentar.....');
      $('#btn_Saveheader').attr('disabled',true);
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>XPDCController/UpdateXPDC',
        data    : me.serialize(),
        dataType: 'json',
        success : function (response) {
          if(response.success == true){
            $('#ModalAddXPDC').modal('toggle');
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
            $('#ModalAddXPDC').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: 'Data Gagal disimpan! Silahkan hubungi administrator',
              // footer: '<a href>Why do I have this issue?</a>'
            });
            $('#ModalAddXPDC').modal('show');
            $('#btn_Saveheader').text('Save');
            $('#btn_Saveheader').attr('disabled',false);
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
      url     : '<?=base_url()?>XPDCController/FindXPDC',
      data    : {id,id},
      dataType: 'json',
      success:function (response) {
        if(response.success == true){
          $.each(response.data,function (k,v) {
            $('#idxpdc').val(v.id);
            $('#xpdccode').val(v.xpdccode);
            $('#xpdcname').val(v.xpdcname);
            $('#hqaddress').val(v.alamathq);
            $('#csemail').val(v.email);
            $('#hqphone').val(v.notlphq);
            $('#website').val(v.website);
            $('#trackingwebsite').val(v.webtracking);
            $('#xpdcActDate').val(v.tglaktif);
          });
          $('#xpdcActDate').attr('readonly',true);
          $('#ModalAddXPDCDetail').modal('show');
          $('#ModalAddXPDCDetail').modal('toggle');
          $('#ModalAddXPDC').modal('show');
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
      url     : '<?=base_url()?>XPDCController/FindXPDC',
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
              text: 'Data XPDC Tidak Valid',
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
      url     : '<?=base_url()?>XPDCController/SetPasifXPDC',
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

  // Add Detai XPDC
  $('.add_detail').click(function () {
    form_mode = 'add';
    var id = $(this).attr("id");
    
    $('#headerid').val(id);
    $('#ModalAddXPDCDetail').modal('show');
  });

  $('#FrmAddXPDCDetail').submit(function(e) {
    $('#btn_SaveDetail').text('Tunggu Sebentar.....');
    $('#btn_SaveDetail').attr('disabled',true);

    e.preventDefault();
    var me = $(this);
    // if(form_mode =='add'){
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>XPDCController/AddXPDCDetail',
        data    : me.serialize(),
        dataType: 'json',
        success : function (response) {
          if(response.success == true){
            $('#ModalAddXPDCDetail').modal('toggle');
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
            $('#ModalAddXPDCDetail').modal('toggle');
            Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: 'Data Gagal disimpan! Silahkan hubungi administrator',
              // footer: '<a href>Why do I have this issue?</a>'
            });
            $('#ModalAddXPDCDetail').modal('show');
            $('#btn_SaveDetail').text('Save');
            $('#btn_SaveDetail').attr('disabled',false);
          }
        }
      });
    // }
    // else if(form_mode == 'edit'){
    //   $.ajax({
    //     type    :'post',
    //     url     : '<?=base_url()?>MemberController/EditGroupMmber',
    //     data    : me.serialize(),
    //     dataType: 'json',
    //     success : function (response) {
    //       if(response.success == true){
    //         $('#ModalAddXPDC').modal('toggle');
    //         Swal.fire({
    //           type: 'success',
    //           title: 'Horay..',
    //           text: 'Data Berhasil disimpan!',
    //           // footer: '<a href>Why do I have this issue?</a>'
    //         }).then((result)=>{
    //           location.reload();
    //         });
    //       }
    //       else{
    //         $('#ModalAddXPDC').modal('toggle');
    //         Swal.fire({
    //           type: 'error',
    //           title: 'Woops...',
    //           text: 'Data Gagal disimpan! Silahkan hubungi administrator',
    //           // footer: '<a href>Why do I have this issue?</a>'
    //         });
    //         $('#ModalAddXPDC').modal('show');
    //         $('#btn_SaveDetail').text('Save');
    //         $('#btn_SaveDetail').attr('disabled',false);
    //       }
    //     }
    //   });
    // }
    // else {
    //   Swal.fire({
    //     type: 'error',
    //     title: 'Woops...',
    //     text: 'Undefined Form Mode!!',
    //     // footer: '<a href>Why do I have this issue?</a>'
    //   });
    // }
  });
  // end add detail

  // Show Detail
  $('.see_services').click(function () {
    var id = $(this).attr("id");

    $.ajax({
      type    :'post',
      url     : '<?=base_url()?>XPDCController/FindXPDDetail',
      data    : {id,id},
      dataType: 'json',
      success : function (response) {
        var html = '';
        var i;
        for (i = 0; i < response.data.length; i++) {
          html += '<tr>' +
                  '<td>' + response.data[i].id+'</td>' +
                  '<td>' + response.data[i].service + '</td>' +
                  '<td>' + response.data[i].servicedesc + '</td>' +
                  '<td>' + formatNumber(response.data[i].costperkg) + '</td>' +
                  '<tr>';
        }
        $('#load_data').html(html);
      }
    });
    $('#ModalsShowServices').modal('show');
  });
  // end show detail

});
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}
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