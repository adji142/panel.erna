<?php
    require_once(APPPATH."views/part/Header.php");
    require_once(APPPATH."views/part/sidebar.php");
    $query = $this->ModelsExecuteMaster->FindData(array('tglpasif'=>null),'masterstok');
    $query_categories = $this->ModelsExecuteMaster->FindData(array('tglpasif'=>null,'parent' => 0),'categories');
?>
<link href="<?php echo base_url()?>Assets/dropone/dropzone.min.css" rel="stylesheet">
<script src="<?php echo base_url()?>Assets/dropone/dropzone.min.js"></script>

<style type="text/css">
  .dropzone {
    margin-top: 20px;
    border: 2px dashed #0087F7;
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
                <input type="text" placeholder="Harga Jual Perpcs" id="hpp" name="hpp" required="" class="span6 m-wrap">
              </div>
            </div>
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
                <th>No Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Sumber Stock</th>
                <th>Di buat oleh</th>
              </tr>
            </thead>
            <tbody>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tbody>
          </table>
        </div>
      </div>
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