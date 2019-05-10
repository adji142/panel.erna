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
        <div class="widget-title"> <span class="icon"><i class=""><a href="#" id="addBnr" class="btn btn-mini btn-info" data-toggle="tooltip" title="Tambah Stock Baru">Add</a></i></span>
            <h5>Master Stock</h5>
        </div>
        <div class="widget-content">
            <table class="table table-bordered data-table" >
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Hightlight</th>
                      <th>Title</th>
                      <th>Subtitle</th>
                    </tr>
              </thead>
              <tbody>
                    
                      <?php
                        $Recordset = $this->ModelsExecuteMaster->FindData(array('tglpasif' => NULL),'sitebanner');
                        if($Recordset->num_rows() > 0){
                          foreach ($Recordset->result() as $key) {
                            echo "<tr class='gradeX'>";
                            echo "<td width = '5%'>
                              <button href='#' class='btn btn-mini btn-danger set_passif' id = '".$key->id."'>
                                <i class='icon-trash' data-toggle='tooltip' title='Set Pasif'></i>
                              </button>
                            </td>";
                            echo "<td></td>";
                            echo "<td>".$key->hightlight."</td>";
                            echo "<td>".$key->title."</td>";
                            echo "<td>".$key->subtitle."</td>";
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
<div class="modal fade" id="ModalAddBanner" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" style="width: auto; height: auto; ">
    <div class="modal-content">  
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <p><h4>Add Site Banner</h4></p>
        <br>
        <form id="FrmAddBanner" enctype='application/json'>
          <div class="control-group">
            <img src="" id="profile-img-tag" width="200px" />
          </div>
          <div class="control-group">
            <label class="control-label">File upload input</label>
            <div class="controls">
              <input type="hidden" class="span5" placeholder="Group Name" id="idbanner" name="idbanner"/>
              <input type="file" id="bannerimage" name="bannerimage" />
              <span class="help-block">Recomended Resolution (1920 x 700)</span> 
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Highlight :</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Highlight" id="hl" name="hl" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Title :</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Title" id="title" name="title" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Subtitle :</label>
            <div class="controls">
              <input type="text" class="span5" placeholder="Subtitle" id="subtitle" name="subtitle" required="" />
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Tanggal Aktif</label>
            <div class="controls">
              <input type="date" data-date-format="dd-mm-yyyy" class="datepicker span5" id="bannerActDate" name="bannerActDate" required="">
              <span class="help-block">Date with Formate of  (dd-mm-yy)</span> 
            </div>
          </div>
          <textarea id="image" name="image" style="display: none;"></textarea>
          <button class="btn btn-primary" id="btn_SaveBan">Save</button>
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
    var GVimage = '';
    $.ajaxSetup({
        beforeSend:function(jqXHR, Obj){
            var value = "; " + document.cookie;
            var parts = value.split("; csrf_cookie_token=");
            if(parts.length == 2)   
            Obj.data += '&csrf_token='+parts.pop().split(";").shift();
        }
    });
    // $('#ModalAddBanner').on('show', function () {
    //    $(this).find('.modal-body').css({
    //           width:'auto', //probably not needed
    //           height:'auto', //probably not needed 
    //           'max-height':'200%'
    //    });
    // });
    $('#addBnr').click(function () {
      $('#ModalAddBanner').modal('show');
    });

    $("#bannerimage").change(function(){
        readURL(this);
        encodeImagetoBase64(this);
    });

    $('#FrmAddBanner').submit(function(e) {
      // alert(image);
      e.preventDefault();
      var image= $('#image').val();
      var hl=$('#hl').val();
      var title=$('#title').val();
      var subtitle=$('#subtitle').val();
      var bannerActDate=$('#bannerActDate').val();
    
      $('#btn_SaveBan').text('Tunggu Sebentar.....');
      $('#btn_SaveBan').attr('disabled',true);

        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/saveBanner',
          data    : {image:image,hl:hl,title:title,subtitle:subtitle,bannerActDate:bannerActDate},
          dataType: 'json',
          success : function (response) {
            if(response.success == true){
              $('#ModalAddBanner').modal('toggle');
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
              if(response.message == '500-01'){
                $('#ModalAddBanner').modal('toggle');
                Swal.fire({
                  type: 'error',
                  title: 'Woops...',
                  text: 'Data Gagal disimpan! Silahkan hubungi administrator',
                  // footer: '<a href>Why do I have this issue?</a>'
                });
                $('#ModalAddBanner').modal('show');
                $('#btn_SaveBan').text('Save');
                $('#btn_SaveBan').attr('disabled',false);
              }
              else if(response.message =='FullBanner'){
                $('#ModalAddBanner').modal('toggle');
                Swal.fire({
                  type: 'error',
                  title: 'Woops...',
                  text: 'Data Gagal disimpan! Banner hanya untuk 5 gambar',
                  // footer: '<a href>Why do I have this issue?</a>'
                });
                $('#ModalAddBanner').modal('show');
                $('#btn_SaveBan').text('Save');
                $('#btn_SaveBan').attr('disabled',false);
              }
              else{
                $('#ModalAddBanner').modal('toggle');
                Swal.fire({
                  type: 'error',
                  title: 'Woops...',
                  text: 'Undefined Error',
                  // footer: '<a href>Why do I have this issue?</a>'
                });
                $('#ModalAddBanner').modal('show');
                $('#btn_SaveBan').text('Save');
                $('#btn_SaveBan').attr('disabled',false);
              }
            }
          }
        });
    });
  });
  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function (e) {
              $('#profile-img-tag').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
  function encodeImagetoBase64(element) {

    var file = element.files[0];

    var reader = new FileReader();

    reader.onloadend = function() {

      // $(".link").attr("href",reader.result);

      // $(".link").text(reader.result);
      $('#image').val(reader.result);
    }

    reader.readAsDataURL(file);

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