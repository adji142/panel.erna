<?php
    require_once(APPPATH."views/part/Header.php");
    require_once(APPPATH."views/part/sidebar.php");
?>
<?php
  $query = $this->ModelsOrder->GetOrder();
?>
<style type="text/css">
  th, td {
      white-space: nowrap;
  }
</style>
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
      <br><br>
    <div class="widget-box">
        <div class="widget-title">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab1">Pemesanan</a></li>
              <li><a data-toggle="tab" href="#tab2">Pembayaran</a></li>
              <li><a data-toggle="tab" href="#tab3">Pengiriman</a></li>
              <li><a data-toggle="tab" href="#tab4">Pesanan Selesai</a></li>
            </ul>
        </div>
        <div class="widget-content tab-content">
          <div id="tab1" class="tab-pane active">
            <h4>Pemesanan</h4>
            <div class="row-fluid">
              <div class="span12">
                <table class="table table-bordered data-table">
                  <thead>
                      <tr>
                        <th>No. Order</th>
                        <th>Tanggal Order</th>
                        <th>Total Qty</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                        
                    <?php
                        $header = $this->ModelsExecuteMaster->GetData('deliveryorder');

                        foreach ($header->result() as $head) {
                          $SUMARY = $this->ModelsOrder->SumOrder($head->id)->row();
                          $Status= '';
                          if ($head->statusorder == 0) {
                            $Status = 'Menunggu Pembayaran';
                          }
                          elseif ($head->statusorder == 1) {
                            $Status = 'Menunggu Pembayaran di konfirmasi';
                          }
                          elseif ($head->statusorder == 2) {
                            $Status = 'Pembayaran di konfirmasi';
                          }
                          elseif ($head->statusorder == 3) {
                            $Status = 'Pesanan Di Proses';
                          }
                          elseif ($head->statusorder == 4) {
                            $Status = 'Pesanan Di Kirim';
                          }
                          elseif ($head->statusorder == 5) {
                            $Status = 'Pesanan Selesai';
                          }
                          else{
                            $Status = 'Status Tidak Di ketahui';
                          }
                          echo "<tr>
                                  <td>".$head->nomerorder."</td>
                                  <td>".date_format(date_create($head->tglorder),'d-m-Y')."</td>
                                  <td>".number_format($SUMARY->Qty)."</td>
                                  <td>".number_format($SUMARY->TOTAL)."</td>
                                  <td>".$Status."</td>
                                  <td><button class = 'btn btn-mini btn-info cetak' id ='".$head->id."'>Cetak</button></td>
                                </tr>
                              ";
                        }
                        
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div id="tab2" class="tab-pane">
            <h4>Pembayaran</h4>
            <div class="row-fluid">
              <div class="span12">
                <table class="table table-bordered data-table">
                  <thead>
                      <tr>
                        <th>No. Order</th>
                        <th>No. Bukti</th>
                        <th>Tanggal Bukti</th>
                        <th>Rekening Pembayaran</th>
                        <th>Bukti Transfer</th>
                        <th>Jumlah Transfer</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                        
                    <?php
                        foreach($query->result() as $rs){
                          $disabled= '';
                          if ($rs->confirmed == '1') {
                            $disabled = 'disabled';
                          }
                            echo "<tr class='gradeX btn-default'>";
                            echo "<td>".$rs->nomerorder."</td>";
                            echo "<td>".$rs->nopembayaran."</td>";
                            echo "<td>".$rs->tglpembayaran."</td>";
                            echo "<td>".$rs->namabank."</td>";
                            echo "<td><button class = 'btn-primary btn-mini _Vimage' id = '".$rs->id."'>Lihat</button></td>";
                            echo "<td>".number_format($rs->jumlah)."</td>";
                            echo "<td>".$rs->StatusBayar."</td>";
                            echo "<td><button class = 'btn-danger btn-mini _konfirm' id = '".$rs->id."' ".$disabled.">Konfirmasi</button></td>";
                            echo "</tr>";
                        }
                        
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div id="tab3" class="tab-pane">
            <h4>Pemesanan</h4>
            <div class="row-fluid">
              <div class="span12">
                <table class="table table-bordered data-table" id="tablex">
                  <thead>
                      <tr>
                        <th width="20%">No. Order</th>
                        <th>Tanggal Order</th>
                        <th>No Pengiriman</th>
                        <th>Ekspedisi</th>
                        <th>Service</th>
                        <th>Resi</th>
                        <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                        
                    <?php
                        // $header = $this->ModelsExecuteMaster->FindData(array('statusorder'),'deliveryorder');
                        $query = "
                          SELECT 
                            b.nomerorder,
                            b.tglorder,
                            c.nopengiriman,
                            c.tglpengiriman,
                            c.nomerresi,
                            b.xpdc,
                            b.service,
                            b.id doid
                          FROM deliveryorderdetail a
                          LEFT JOIN deliveryorder b on a.headerid = b.id
                          LEFT JOIN pengiriman c on c.doid = b.id
                          WHERE b.statusorder >=3
                        ";
                        $getquery = $this->db->query($query);
                        foreach ($getquery->result() as $rs) {
                          $btn = '';
                          if ($rs->nomerresi == '') {
                            $btn = "<button class = 'btn btn-mini btn-danger _isiresi' id ='".$rs->doid."'>Isi Resi</button>";
                          }
                          echo "<tr>
                                  <td>".$rs->nomerorder."</td>
                                  <td>".date_format(date_create($rs->tglorder),'d-m-Y')."</td>
                                  <td>".$rs->nopengiriman."</td>
                                  <td>".$rs->xpdc."</td>
                                  <td>".$rs->service."</td>
                                  <td>".$rs->nomerresi."</td>
                                  <td>
                                    ".$btn."
                                  </td>
                                </tr>
                              ";
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
</div>
</div>
</div>

<div class="modal fade" id="ModalViewImage" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" style="width: auto; height: auto; ">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <center>
          <img src="" id="ViewImageTransfer">
        </center>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="load" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" style="width: auto; height: auto; ">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <center>
          <img src="https://i.stack.imgur.com/FhHRx.gif">
        </center>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="resiinput" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" style="width: auto; height: auto; ">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <center><p><h4>Tambahkan Resi</h4></p></center>
        <form id="AddResi" enctype='application/json'>
          <div class="control-group">
            <label class="control-label">Pengirim :</label>
            <div class="controls">
              <input type="hidden" class="span5" id="doid" name="doid"/>
              <input type="text" class="span5" placeholder="Pengirim" id="sendder" name="sendder" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Outlet Expedisi :</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Outlet Expedisi" id="Outlet" name="Outlet" value="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Nomer Resi :</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Nomer Resi" id="resi" name="resi" required="" />
            </div>
          </div>
          <button class="btn btn-primary" id="btn_SaveResi">Save</button>
        </form>
      </div>
    </div>
  </div>
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
    // $('#btn_setpassif').text('Tunggu Sebentar.....');
    // $('#btn_setpassif').attr('disabled',true);
    $(document).ready(function () {
      
    });

    $('._Vimage').click(function () {
      var id = $(this).attr("id");
      
      $('#load').modal('show');
        $.ajax({
        type    :'post',
        url     : '<?=base_url()?>OrderController/GetBuktiTransfer',
        data    : {id:id},
        dataType: 'json',
        success:function (response) {
          if(response.success == true){
            $('#load').modal('toggle');
            $.each(response.data,function (k,v) {
              $('#ViewImageTransfer').attr('src', v.image);
            });
            $('#ModalViewImage').modal('show').draggable({ handle: ".modal-header" });;
          }
          else{
            if(response.message = '404-01'){
              $('#load').modal('toggle');
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

    $('._konfirm').click(function () {
      var id = $(this).attr("id");
      Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Anda Akan Mengkonfirmasi Pembayaran Pemesanan Ini ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Konfirmasi!'
      }).then((result) => {
        if (result.value) {
          // Swal.fire(
          //   'Deleted!',
          //   'Your file has been deleted.',
          //   'success'
          // )
          $.ajax({
            type    :'post',
            url     : '<?=base_url()?>OrderController/Konfirmasi',
            data    : {id:id},
            dataType: 'json',
            success:function (response) {
              if(response.success == true){
                Swal.fire({
                  type: 'success',
                  title: 'Horay...',
                  text: 'Pembayaran Terkonfirmasi',
                  // footer: '<a href>Why do I have this issue?</a>'
                }).then((result)=>{
                  location.reload();
                });
              }
              else{
                Swal.fire({
                  type: 'error',
                  title: 'Woops...',
                  text: result.message,
                  // footer: '<a href>Why do I have this issue?</a>'
                }).then((result)=>{
                  location.reload();
                });
              }
            }
          });
        }
      })
    });

    $('._isiresi').click(function () {
      var id = $(this).attr("id");
      $('#doid').val(id);
      $('#resiinput').modal('show');
    });

    $('#AddResi').submit(function (e) {
      $('#btn_SaveResi').text('Tunggu Sebentar.....');
      $('#btn_SaveResi').attr('disabled',true);

      e.preventDefault();
      var me = $(this);

      $.ajax({
          type    :'post',
          url     : '<?=base_url()?>OrderController/Kirim',
          data    : me.serialize(),
          dataType: 'json',
          success : function (response) {
            if(response.success == true){
              $('#resiinput').modal('toggle');
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
              Swal.fire({
                type: 'error',
                title: 'Woops...',
                text: response.message,
                // footer: '<a href>Why do I have this issue?</a>'
              });
            }
          }
        });
      });
    $('.cetak').click(function () {
      var id = $(this).attr("id");
      
      $.ajax({
          type    :'post',
          url     : '<?=base_url()?>OrderController/CekInvoice',
          data    : {id:id},
          dataType: 'json',
          success : function (response) {
            if(response.success == true){
              window.open('<?php echo base_url(); ?>Invoice.php?id='+id,'_blank');
            }
            else{
              Swal.fire({
                type: 'error',
                title: 'Woops...',
                text: response.message,
                // footer: '<a href>Why do I have this issue?</a>'
              });
              $('#btn_SaveResi').text('Save');
              $('#btn_SaveResi').attr('disabled',false);
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