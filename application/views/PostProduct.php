<?php
    require_once(APPPATH."views/part/Header.php");
    require_once(APPPATH."views/part/sidebar.php");
    $query = $this->ModelsExecuteMaster->FindData(array('tglpasif'=>null),'masterstok');
    $query_categories = $this->ModelsExecuteMaster->FindData(array('tglpasif'=>null,'parent' => 0),'categories');

    $this->ModelsExecuteMaster->ClearImage();

    $gatData = $this->SiteModels->GetProduct();
?>
<link href="<?php echo base_url()?>Assets/dropone/dropzone.min.css" rel="stylesheet">
<script src="<?php echo base_url()?>Assets/dropone/dropzone.min.js"></script>

<style type="text/css">
  .dropzone {
    margin-top: 20px;
    border: 2px dashed #0087F7;
  },
  .dz-hidden-input {
    display: none;
  }
</style>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
        <a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="tip-buttom"> Product</a>

    </div>
    <!-- <form id="search" enctype='application/json'> -->
    
  </div>
<!--End-breadcrumbs-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title">
            <h5>Tambah Product</h5>
        </div>
        <div class="widget-content">
          <div class="dropzone">
            <!-- <div class="dz-image">
              
            </div> -->
            <div class="dz-message">
             <h3>Click or drag and drop your image hire (Max. 5 photos)</h3>
            </div>
          </div>
          <br>
          <form id="FrmAddProduct" enctype='application/json'>
            <div class="control-group">
              <!-- <label class="control-label">Title</label> -->
              <div class="controls">
                <input type="text" placeholder="Title" id="title" name="title" required="" class="span12">
                <input type="hidden" id="idprod" name="idprod" class="span6">
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <textarea class="textarea_editor span11" rows="6" placeholder="Deskripsi Product" id="desc" name="desc"></textarea>
              </div>
            </div>
            <div class="control-group">
              <div class="controls controls-row">
                <select id="categori" name="categori" class="span6 m-wrap">
                  <option value="0" selected="">Pilih Kategori</option>
                  <?php
                    foreach ($query_categories->result() as $key) {
                      echo "<option value='".$key->id."'>".$key->category."</option>";
                    }
                  ?>
                </select>
                <select id="subcategori" name="subcategori" class="span6 m-wrap">
                  <option value="0" selected="">Pilih Sub Kategori</option>
                    
                </select>
              </div>
            </div>
            <div class="control-group">
              <div class="controls controls-row">
                <select id="stok" name="stok" class="span12 m-wrap">
                  <option value="0" selected="">Pilih Stock</option>
                  <?php
                    foreach ($query->result() as $key) {
                      echo "<option value='".$key->id."'>".$key->kodestok." | ".$key->namastok."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <div class="controls controls-row">
                <label class="control-label m-wrap">Qty Ready</label>
                <input type="text" placeholder="Qty Ready" id="qty" name="qty" required="" class="span6 m-wrap">
                <input type="hidden" id="realstock" name="realstock">
                <input type="text" placeholder="Harga Jual Perpcs" id="hpp" name="hpp" required="" class="span6 m-wrap">
              </div>
            </div>
            <div class="control-group">
              <div class="controls controls-row">
                <input type="checkbox" id="promomember" name="promomember" value="1" checked=""> Join Promo Member ?
              </div>
            </div>
            <!-- <div class="control-group">
              <div class="controls controls-row">
                <select id="promo" name="promo" class="span12 m-wrap">
                  <option value="0" selected="">Pilih Promo</option>
                  <?php
                    
                  ?>
                </select>
              </div>
            </div> -->
            <div class="control-group">
              <div id="btncancel">
                <button class="btn btn-primary" id="btn_Saveprod">Save</button>
                <button class="btn btn-default" id ="cancel" type="reset">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="widget-box">
        <div class="widget-title">
            <h5>List Product</h5>
        </div>
        <div class="widget-content">
          <table class="table table-bordered data-table" >
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Qty Jual</th>
                <th>Promo Member</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if($gatData->num_rows() > 0){
                  foreach ($gatData->result() as $key) {
                    echo "<tr>";
                    echo "<td width = '10%'>
                        <button href='#' class='btn btn-mini btn-primary edit_data' id = '".$key->id."'>
                          <i class='icon-edit' data-toggle='tooltip' title='Edit Data'></i>
                        </button>
                        <button href='#' class='btn btn-mini btn-danger set_passif' id = '".$key->id."'>
                          <i class='icon-trash' data-toggle='tooltip' title='Set Passif'></i>
                        </button>
                        </td>";
                    echo "<td>".$key->tittle."</td>";
                    echo "<td>".$key->category."</td>";
                    echo "<td>".number_format($key->qty)."</td>";
                    echo "<td>".$key->memberpromo."</td>";
                    echo "</tr>";
                  }
                }
                else{
                  echo "<tr>";
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

<div class="modal fade" id="ModalSetPassif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>Set Passif Post</h4></p>
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
<?php
    require_once(APPPATH."views/part/footer.php");
?>
<script type="text/javascript">
  Dropzone.autoDiscover = false;
  var base64 = '';
  var foto_upload= new Dropzone(".dropzone",{
    url: '<?=base_url()?>ProductController/fakeUrl',
    maxFiles:5,
    maxFilesize: 2,
    method:"post",
    acceptedFiles:"image/*",
    paramName:"userfile",
    dictInvalidFileType:"Type file ini tidak dizinkan",
    addRemoveLinks:true,
  });

  foto_upload.on("addedfile",function (file) {
    // alert('1');
    file.token = Math.random();
    var _this=this,
    reader = new FileReader();
    reader.onload = function(event) {
      base64 = event.target.result;
      PostImage(base64,file.token);
      // $('#dropzone--dropzoneThumbnail').val(base64);
      _this.processQueue();
    };
    // alert(_this);
    reader.readAsDataURL(file);
  });
  foto_upload.on("sending",function(a,b,c){
    // alert('2');
    var value = "; " + document.cookie;
    var parts = value.split("; csrf_cookie_token=");
    if(parts.length == 2){
      c.append("csrf_token",parts.pop().split(";").shift());
    }
  });
  foto_upload.on("removedfile",function (a) {
    var token = a.token;
    $.ajax({
      type    : 'post',
      url     : '<?=base_url()?>ProductController/DelImage',
      data    : {token:token},
      dataType: 'json',
      success:function (response) {
        if(response.success == true){
          console.log("deleted");
        }
        else{
          console.log("something wrong");
        }
      }
    });
  })
  function PostImage(file_image,image_token) {
    $.ajax({
      type    : 'post',
      url     : '<?=base_url()?>ProductController/PostImage',
      data    : {file_image:file_image,image_token:image_token},
      dataType: 'json',
      success:function (response) {
        if(response.success == true){
          console.log("updated");
        }
        else{
          console.log("something wrong");
        }
      }
    });
  }
  // foto_upload.on("success",function (file, response) {
  //   // $('#dropzone--dropzoneThumbnail').val('');
  //   console.log('success:', response);
  // });

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
    $('.textarea_editor').wysihtml5();

    $( document ).ready(function() {
      form_mode = 'add';
      $("#cancel").remove();
    });

    $('#categori').on('change',function () {
      var idcat = $('#categori').val();
        $.ajax({
          type    : 'post',
          url     : '<?=base_url()?>ProductController/Getsubcategori',
          data    : {idcat:idcat},
          dataType: 'json',
          success:function (response) {
            if(response.success == true){
              $('#subcategori').children('option:not(:first)').remove();
              $.each(response.data,function (i,v) {
                // $('.'+v.id+'').remove();
                $('#subcategori').append($('<option>',{
                  value   : v.id,
                  text    : v.category,
                  class   : v.id
                }));
              });

              // subcategori
              // console.log(html);
              // $('#subcat').html('html');
            }
            else{
              console.log("something wrong");
            }
          }
        });

    });

    $('#stok').on('change',function () {
      var idstok = $('#stok').val();
        $.ajax({
          type    : 'post',
          url     : '<?=base_url()?>ProductController/GetStock',
          data    : {idstok:idstok},
          dataType: 'json',
          success:function (response) {
            if(response.success == true){
              if(idstok == 0){
                $('#qty').val(0);
                $('#realstock').val(0);
              }
              else{
                $.each(response.data,function (i,v) {
                  $('#qty').focus();
                  $('#qty').val(v.saldo);
                  $('#realstock').val(v.saldo);
                });
              }
            }
            else{
              console.log("something wrong");
            }
          }
        });

    });

    $('#promomember').on('change',function () {
      if ($('#promomember').prop("checked") != true) {
        // $('#promo').prop('disabled', true);
        // fill promo combo box
      }
    });
    // Begin form action
    $('#FrmAddProduct').submit(function(e) {
      $('#btn_Saveprod').text('Tunggu Sebentar.....');
      $('#btn_Saveprod').attr('disabled',true);

      e.preventDefault();
      var me = $(this);
      if(form_mode == 'add'){
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>ProductController/AddProduct',
          data    : me.serialize(),
          dataType: 'json',
          success : function (response) {
            if(response.success == true){
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
              if(response.message == 'E-01'){
                Swal.fire({
                  type: 'error',
                  title: 'Woops...',
                  text: 'Stock Kurang',
                  // footer: '<a href>Why do I have this issue?</a>'
                }).then((result)=>{
                  $('#btn_Saveprod').text('Save');
                  $('#btn_Saveprod').attr('disabled',false);
                  $('#qty').focus();
                });
              }
              else{
                Swal.fire({
                  type: 'error',
                  title: 'Woops...',
                  text: 'Error While Saving, Please contact your system administrator',
                  // footer: '<a href>Why do I have this issue?</a>'
                }).then((result)=>{
                  location.reload();
                });
              }
            }
          }
        });
      }
    });

    $('.edit_data').click(function () {
      // console.log($('.dz-image').val());
      var id = $(this).attr("id");
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>ProductController/GetImage',
        data    : {id,id},
        dataType: 'json',
        success:function (response) {
          if(response.success == true){
            $.each(response.data,function (k,v) {
              var html = '';
              var i;
              for (i = 0; i < response.data.length; i++) {
                html += '<img src = "'+response.data[i].image+'">'
              }
              $('.dz-image').html(html);
            });
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

    $('.set_passif').click(function () {
    var id = $(this).attr("id");
    // alert(id);
    $.ajax({
        type    :'post',
        url     : '<?=base_url()?>ProductController/Findpost',
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

  });
  function resizeWithCanvas(img) {
      var MAX_WIDTH = 1200;
      var MAX_HEIGHT = 1200;
      var OUTPUT_QUALITY = .75;

      var canvas = document.createElement("canvas");
      var ctx = canvas.getContext("2d");
      var width = img.width;
      var height = img.height;

      ctx.drawImage(img, 0, 0);

      if (width > height) {
          if (width > MAX_WIDTH) {
              height *= MAX_WIDTH / width;
              width = MAX_WIDTH;
          }
      } else {
          if (height > MAX_HEIGHT) {
              width *= MAX_HEIGHT / height;
              height = MAX_HEIGHT;
          }
      }
      canvas.width = width;
      canvas.height = height;
      var ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0, width, height);

      if (navigator.userAgent.toLowerCase().indexOf('chrome') > -1) {
          return canvas.toDataURL("image/jpeg", OUTPUT_QUALITY);
      } else {
          return canvas.toDataURL("image/jpeg");
      }
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