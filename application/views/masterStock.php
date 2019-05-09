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
        <a href="#" class="tip-buttom"> Stock</a>
    </div>
  </div>
<!--End-breadcrumbs-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class=""><a href="#" id="addStk" class="btn btn-mini btn-info" data-toggle="tooltip" title="Tambah Stock Baru">Add</a></i></span>
            <h5>Master Stock</h5>
        </div>
        <div class="widget-content">
            <table class="table table-bordered data-table" >
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Kode Stock</th>
                      <th>Nama Stock</th>
                      <th>Satuan</th>
                      <th>Berat Per Pcs</th>
                      <th>Status Stock</th>
                      <th>Qty Ready</th>
                      <th>Tanggal Aktif</th>
                    </tr>
              </thead>
              <tbody>
                    
                      <?php
                        $Recordset = $this->ModelsStock->GetStokSaldo();
                        if($Recordset->num_rows() > 0){
                          foreach ($Recordset->result() as $key) {
                            echo "<tr class='gradeX'>";
                            echo "<td width = '5%'>
                              <button href='#' class='btn btn-mini btn-danger set_passif' id = '".$key->id."'>
                                <i class='icon-trash' data-toggle='tooltip' title='Set Pasif'></i>
                              </button>
                            </td>";
                            echo "<td>".$key->kodestok."</td>";
                            echo "<td>".$key->namastok."</td>";
                            echo "<td>".$key->satuan."</td>";
                            echo "<td>".$key->beratperpcs."</td>";
                            echo "<td>".$key->statusstok."</td>";
                            echo "<td>".$key->QtyReady."</td>";
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
<!-- models -->
<div class="modal fade" id="ModalAddStock" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" style="width: auto; height: auto; ">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>Add Member Group</h4></p>
        <br>
        <form id="FrmAddStock" enctype='application/json'>
          <div class="control-group">
            <label class="control-label">Kode Stock :</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Kode Stock" id="kodestok" name="kodestok" required="" readonly="" />
              <input type="hidden" class="span5" placeholder="Group Name" id="idstok" name="idstok"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Nama Stock</label>
            <div class="controls">
              <div class="input-append">
                <input type="text" placeholder="Nama Stock" class="span5" id="nmstok" name="nmstok" required="">
              </div>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Status Stock</label>
            <div class="controls">
              <select id="statusstok" name="statusstok">
                <option value="Ready">Ready Stock</option>
                <option value="PO">Pre Order</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Satuan</label>
            <div class="controls">
              <div class="input-append">
                <input type="text" placeholder="Satuan" class="span5" id="sat" name="sat" required="" maxlength="3">
              </div>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Berat Bruto Per Pcs</label>
            <div class="controls">
                <input type="number" placeholder="Berat Bruto Per Pcs" class="span5" id="berat" name="berat" required="" >
                <span class="help-block">Satuan berat (gr/Gram)</span> 
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Tanggal Aktif</label>
            <div class="controls">
              <input type="date" data-date-format="dd-mm-yyyy" class="datepicker span5" id="stkcActDate" name="stkcActDate" required="">
              <span class="help-block">Date with Formate of  (dd-mm-yy)</span> 
            </div>
          </div>

          <button class="btn btn-primary" id="btn_SaveStk">Save</button>
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
        <p><h4>Set Passif Stock</h4></p>
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

<!-- End models -->
</div>
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
    
    $('#addStk').click(function () {
      form_mode = 'add';
      $('#ModalAddStock').modal('show');
      var datetime = new Date();
      var day = datetime.getDate();
      var month = datetime.getMonth() + 1; //month: 0-11
      var year = datetime.getFullYear();
      var random1 = Math.floor(Math.random() * 500);
      var random2 = Math.floor(Math.random() * 250);
      $('#kodestok').val('STK-'.concat(day,month,year,random1,random2));
      $('#idstok').val('');
      $('#nmstok').val('');
      $('#sat').val('');
      $('#berat').val('');
      $('#stkcActDate').val('');
    });

    $('#FrmAddStock').submit(function (e) {
      $('#btn_SaveStk').text('Tunggu Sebentar.....');
      $('#btn_SaveStk').attr('disabled',true);

      e.preventDefault();
      var me = $(this);

      if(form_mode == 'add' ){
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>StockController/InsertStock',
          data    : me.serialize(),
          dataType: 'json',
          success : function (response) {
            if(response.success == true){
              $('#ModalAddStock').modal('toggle');
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
              $('#ModalAddStock').modal('toggle');
              Swal.fire({
                type: 'error',
                title: 'Woops...',
                text: 'Data Gagal disimpan! Silahkan hubungi administrator',
                // footer: '<a href>Why do I have this issue?</a>'
              });
              $('#ModalAddStock').modal('show');
              $('#btn_SaveStk').text('Save');
              $('#btn_SaveStk').attr('disabled',false);
            }
          }
        });
      }

    });

    $('.set_passif').click(function () {
      var id = $(this).attr("id");
      // alert(id);
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>StockController/FindStock',
        data    : {id,id},
        dataType: 'json',
        success:function (response) {
          if(response.success == true){
            $.each(response.data,function (k,v) {
              $('#idGrppasif').val(v.id);
            });
            $('#ModalSetPassif').modal('show');
          }
          else{
            if(response.message = '404-01'){
              Swal.fire({
                type: 'error',
                title: 'Woops...',
                text: 'Data Stock Tidak Valid',
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
        url     : '<?=base_url()?>StockController/SetPasifStock',
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