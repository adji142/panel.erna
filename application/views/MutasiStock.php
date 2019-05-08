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
        <a href="#" class="tip-buttom"> Mutasi Stock</a>

    </div>
    <!-- <form id="search" enctype='application/json'> -->
    
  </div>
<!--End-breadcrumbs-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class=""><a href="#" id="addMts" class="btn btn-mini btn-info" data-toggle="tooltip" title="Tambah Mutasi Baru">Add</a></i></span>
            <h5>Mutasi Stock</h5>

        </div>
        <div class="widget-content">
          <div class="controls controls-row">
            <label class="span6 m-wrap"></label>
            <label class="span2 m-wrap"></label>
            <!-- <input type="date" data-date-format="dd-mm-yyyy" class="m-wrap span2" id="fromdate" name="fromdate" required="" /> -->
            <input type="date" data-date-format="dd-mm-yyyy" class="m-wrap span2" id="fromdate" name="fromdate" required="" />
            <input type="date" data-date-format="dd-mm-yyyy" class="m-wrap span2" id="todate" name="todate" required="" />
            <!-- <button class="btn btn-mini btn-info m-wrap span1 icon-filter" data-toggle="tooltip" title="search" id="search"></button> -->
            <!-- <input type="text" placeholder="" class="span2 m-wrap" >
            <input type="text" placeholder="" class="span2 m-wrap"> -->
          </div>
          <!-- </form> -->
            <table class="table table-bordered table-striped" >
                <thead>
                    <tr>
                      <th>#</th>
                      <th>No Transaksi</th>
                      <th>Tanggal Transaksi</th>
                      <th>Sumber Stock</th>
                      <th>Di buat oleh</th>
                    </tr>
              </thead>
              <tbody id="load_data"> 

              </tbody>
            </table>
        </div>


    </div>
  </div>
</div>
</div>
</div>
<!-- sparator -->
<div class="modal fade" id="ModalDetailMutasi" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>Add Mutasi Detail</h4></p>
        <br>
        <form id="FrmAddMutDet" enctype='application/json'>
          <div class="control-group">
            <label class="control-label">Stock :</label>
              <div class="controls">
                <select id="kodestk" name="kodestk">
                  <?php
                    $exec = $this->ModelsExecuteMaster->FindData(array('tglpasif'=>null),'masterstok');
                    if($exec->num_rows()){
                      foreach ($exec->result() as $key) {
                        echo '<option value="'.$key->id.'">'.$key->kodestok.' | '.$key->namastok.'</option>';
                      }
                    }
                  ?>
                </select>
              </div>
              <input type="hidden" class="span5" placeholder="Group Name" id="mutasiid" name="mutasiid"/>
              <input type="hidden" class="span5" placeholder="userid" id="useriddetail" name="useriddetail" value="<?php echo $user_id;?>" />
          </div>
          <div class="control-group">
            <label class="control-label">Qty :</label>
            <div class="controls">
              <input type="Number" class="span5" placeholder="Qty" id="qty" name="qty" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Harga /pcs :</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Harga Per PCS" id="hrgperpcs" name="hrgperpcs" required="" />
            </div>
          </div>

          <button class="btn btn-primary" id="btn_SaveMutDet">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- models -->
<div class="modal fade" id="ModalHeaderMutasi" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>Add Mutasi Header</h4></p>
        <br>
        <form id="FrmAddMut" enctype='application/json'>
          <div class="control-group">
            <label class="control-label">Nomer transaksi :</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Nomer Transaksi" id="notrx" name="notrx" required="" />
              <input type="hidden" class="span5" placeholder="Group Name" id="idmut" name="idmut"/>
              <input type="text" class="span5" placeholder="userid" id="userid" name="userid" value="<?php echo $user_id;?>" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Tanggal Transaksi</label>
            <div class="controls">
              <!-- <input type="hidden" class="span5" placeholder="Group Name" id="tgltrx" name="tgltrx"/> -->
              <input type="date" data-date-format="dd-mm-yyyy" class="datepicker span5" id="tgltrx" name="tgltrx" required="">
              <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
          </div>
          <div class="control-group">
            <label class="control-label">Sumber Stock</label>
            <div class="controls">
              <select id="sumberstk" name="sumberstk">
                <option value="1">Produksi</option>
                <option value="2">Pembelian</option>
                <option value="3">Retur</option>
              </select>
            </div>
          </div>

          <button class="btn btn-primary" id="btn_SaveMut">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- End models -->
<?php
    require_once(APPPATH."views/part/footer.php");
?>
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
    $('#hrgperpcs').keyup(function(event) {

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
    $( document ).ready(function() {
        var datetime = new Date();
        var month;
        var day;
        if(datetime.getDate() > 9){
          day = datetime.getDate();
        }
        else{
          day = '0'.concat(datetime.getDate());
        }
        if(datetime.getMonth()+1 > 9){
          month = datetime.getMonth() + 1; //month: 0-11
        }
        else{
          month = ''.concat('0',datetime.getMonth() + 1); //month: 0-11
        }
        var year = datetime.getFullYear();
        // alert(year);
        $('#fromdate').val(''.concat(year,'-',month,'-01'));
        $('#todate').val(''.concat(year,'-',month,'-',day));

        GetMutasi(''.concat(year,'-',month,'-01'),''.concat(year,'-',month,'-',day));
        // $('.modal').remove();
        // $('.modal-backdrop').remove();
        // $('body').removeClass( "modal-open" );
        // $('#ModalAddStock').data('modal', null);
        // $(".modal-body").empty();
    });
    $('#ModalDetailMutasi').on('hidden.bs.modal', function () {
      // location.reload();
      var fromdate = $('#fromdate').val();
      var todate = $('#todate').val();
      GetMutasi(fromdate,todate);
    });
    $('#addMts').click(function () {
      form_mode = 'add';
      $('#notrx').val('');
      $('#idstok').val('');
      $('#userid').val('');
      $('#tgltrx').val('');
      // $('#ModalHeaderMutasi').modal('show');
      // $('#ModalHeaderMutasi').modal('toggle');

      $('#ModalHeaderMutasi').modal('show');
    });

    $('#FrmAddMutDet').submit(function (e) {
      $('#btn_SaveMutDet').text('Tunggu Sebentar.....');
      $('#btn_SaveMutDet').attr('disabled',true);

      e.preventDefault();
      var me = $(this);

      $.ajax({
          type    :'post',
          url     : '<?=base_url()?>MutasiStockController/AddDetail',
          data    : me.serialize(),
          dataType: 'json',
          success : function (response) {
            if(response.success == true){
              $('#ModalDetailMutasi').modal('toggle');
              Swal.fire({
                type: 'success',
                title: 'Horay..',
                text: 'Data Berhasil disimpan!',
                // footer: '<a href>Why do I have this issue?</a>'
              }).then((result)=>{
                form_mode = 'repeat';
                // location.reload();
                $('#ModalDetailMutasi').modal('show');
                $('#kodestk').focus();
                $('#qty').val(0);
                $('#hrgperpcs').val(0);
                $('#btn_SaveMutDet').text('Save');
                $('#btn_SaveMutDet').attr('disabled',false);
              });
            }
            else{
              $('#ModalDetailMutasi').modal('toggle');
              Swal.fire({
                type: 'error',
                title: 'Woops...',
                text: 'Data Gagal disimpan! Silahkan hubungi administrator',
                // footer: '<a href>Why do I have this issue?</a>'
              });
              $('#ModalDetailMutasi').modal('show');
              $('#btn_SaveMut').text('Save');
              $('#btn_SaveMut').attr('disabled',false);
            }
          }
        });
    });

    $('#FrmAddMut').submit(function(e) {
      // alert(form_mode);
      $('#btn_SaveMut').text('Tunggu Sebentar.....');
      $('#btn_SaveMut').attr('disabled',true);

      e.preventDefault();
      var me = $(this);
      if(form_mode =='add'){
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>MutasiStockController/AddHeader',
          data    : me.serialize(),
          dataType: 'json',
          success : function (response) {
            if(response.success == true){
              $('#ModalHeaderMutasi').modal('toggle');
              Swal.fire({
                type: 'success',
                title: 'Horay..',
                text: 'Data Berhasil disimpan!',
                // footer: '<a href>Why do I have this issue?</a>'
              }).then((result)=>{
                location.reload();
                // $('#ModalDetailMutasi').modal('show');
              });
            }
            else{
              $('#ModalHeaderMutasi').modal('toggle');
              Swal.fire({
                type: 'error',
                title: 'Woops...',
                text: 'Data Gagal disimpan! Silahkan hubungi administrator',
                // footer: '<a href>Why do I have this issue?</a>'
              });
              $('#ModalHeaderMutasi').modal('show');
              $('#btn_SaveMut').text('Save');
              $('#btn_SaveMut').attr('disabled',false);
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

    $('#todate').change(function () {
      var fromdate = $('#fromdate').val();
      var todate = $('#todate').val();
      GetMutasi(fromdate,todate);
    });

    
  });
  function GetMutasi(fromdate,todate) {
    $.ajax({
      type    :'post',
      url     : '<?=base_url()?>MutasiStockController/GetMutasiStockHeader',
      data    : {fromdate:fromdate,todate:todate},
      dataType: 'json',
      success : function (response) {
        var html = '';
        var i;
        for (i = 0; i < response.data.length; i++) {
          html += '<tr>' +
                  '<td width = "20%"> '+
                  '<button class="btn btn-mini btn-success" id ="" onClick = "AddDetail('+ response.data[i].id + ')"><i class="icon-plus-sign" data-toggle="tooltip" title="Add Detail Mutasi"></i></button>' +
                  '<button class="btn btn-mini btn-warning" id ="" onClick = "SeeDetail('+ response.data[i].id + ')"><i class="icon-eye-open" data-toggle="tooltip" title="Lihat Detail '+response.data[i].jmlitem+' - Items"> '+response.data[i].jmlitem+' - items</i></button>' +
                  '<button class="btn btn-mini btn-danger" id ="" onClick = "cancel('+ response.data[i].id + ')"><i class="icon-trash" data-toggle="tooltip" title="Cancel Mutasi"></i></button></td>' +
                  '<td>' + response.data[i].notransaksi + '</td>' +
                  '<td>' + response.data[i].tgltransaksi + '</td>' +
                  '<td>' + response.data[i].whsname + '</td>' +
                  '<td>' + response.data[i].username + '</td>' +
                  '</tr>';
        }
        // alert(html);
        $('#load_data').html(html);
      }
    });
  }
  function AddDetail(id) {
    // alert(id);
    $('#ModalHeaderMutasi').modal('show');
    $('#ModalHeaderMutasi').modal('toggle');

    $('#mutasiid').val(id);
    $('#ModalDetailMutasi').modal('show');
    $('#kodestk').focus();
    $('#qty').val(0);
    $('#hrgperpcs').val(0);
  }
  function SeeDetail(id) {
    // body...
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