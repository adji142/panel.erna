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
        <div class="widget-title"> <span class="icon"><i class=""><a href="#" id="addStk" class="btn btn-mini btn-info" data-toggle="tooltip" title="Tambah Stock Baru">Add</a></i></span>
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
                      <th>Kode Stock</th>
                      <th>Nama Stock</th>
                      <th>Sumber Stock</th>
                      <th>Detail Stock</th>
                    </tr>
              </thead>
              <tbody>
                    
                      <?php
                        // $Recordset = $this->ModelsStock->GetStokSaldo();
                        // if($Recordset->num_rows() > 0){
                        //   foreach ($Recordset->result() as $key) {
                        //     echo "<tr class='gradeX'>";
                        //     echo "<td width = '5%'>
                        //       <button href='#' class='btn btn-mini btn-info print' id = '".$key->id."'>
                        //         <i class='icon-print' data-toggle='tooltip' title='Set Pasif'></i>
                        //       </button>
                        //     ";
                        //     if($user_id = 1){
                        //       echo "
                        //         <button href='#' class='btn btn-mini btn-warnig Revisi' id = '".$key->id."'>
                        //           <i class='icon-share' data-toggle='tooltip' title='Set Pasif'></i>
                        //         </button>
                        //       ";
                        //     }
                        //     echo "</td>";
                        //     echo "<td>".$key->kodestok."</td>";
                        //     echo "<td>".$key->namastok."</td>";
                        //     echo "<td>".$key->satuan."</td>";
                        //     echo "<td>".$key->beratperpcs."</td>";
                        //     echo "<td>".$key->statusstok."</td>";
                        //     echo "<td>".$key->QtyReady."</td>";
                        //     echo "<td>".$key->tglaktif."</td>";
                        //     echo "</tr>";
                        //   }
                        // }
                        // else{
                        //     echo "<tr class='gradeX'>";
                        //     echo "<td></td>";
                        //     echo "<td></td>";
                        //     echo "<td></td>";
                        //     echo "<td></td>";
                        //     echo "<td></td>";
                        //     echo "<td></td>";
                        //     echo "<td></td>";
                        //     echo "<td></td>";
                        //     echo "</tr>";
                        // }
                      ?>
              </tbody>
            </table>
        </div>


    </div>
  </div>
</div>
</div>
</div>

<!-- models -->
<div class="modal fade" id="ModalAddStock" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog">
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
        // $('.modal').remove();
        // $('.modal-backdrop').remove();
        // $('body').removeClass( "modal-open" );
        // $('#ModalAddStock').data('modal', null);
        // $(".modal-body").empty();
    });

    $('#todate').change(function () {
      // alert('');
    });

    
  });
  function GetMutasi(fromdate,todate) {
    $.ajax({
      type    :'post',
      url     : '<?=base_url()?>StockController/SetPasifStock',
      data    : {fromdate:fromdate,todate:todate},
      dataType: 'json',
      success : function (response) {
        
      }

    })
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