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
        <div class="widget-content nopadding">
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
                            echo "<td>#</td>";
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
              <input type="text" class="span5" placeholder="Group Name" id="kodestok" name="kodestok" required="" readonly="" />
              <input type="hidden" class="span5" placeholder="Group Name" id="idstok" name="idstok"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Status Stock</label>
            <div class="controls">
              <select >
                <option>Ready Stock</option>
                <option>Pre Order</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Nama Stock</label>
            <div class="controls">
              <div class="input-append">
                <input type="text" placeholder="Nama Stock" class="span5" id="nmstok" name="nmstok" required="">
                <span class="add-on">%</span> </div>
            </div>
          </div>
          

          <!-- <button class="btn btn-primary" id="btn_SaveGroup">Save</button> -->
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

    $('#addStk').click(function () {
      form_mode = 'add';
      $('#ModalAddStock').modal('show');
    });
    $('#ModalAddStock').draggable().on('shown', function() {
      $(document).off('focusin.modal');
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