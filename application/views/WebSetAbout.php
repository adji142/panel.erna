<?php
    require_once(APPPATH."views/part/Header.php");
    require_once(APPPATH."views/part/sidebar.php");
?>
<?php
  $query = $this->ModelsExecuteMaster->FindData(array('parent'=>0,'tglpasif'=>null),'categories');
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
        <div class="widget-title">
            <h5>About Store</h5>
        </div>
        <div class="widget-content">
          <h4><font color="red"><center><div class="warning"></div></center></font></h4>
            <form id="FrmAbout" enctype='application/json'>
              <div class="control-group">
                <label class="control-label">Nama Toko</label>
                <div class="controls">
                    <input type="hidden" class="span11" id="stid" name="stid">
                    <input type="text" placeholder="Nama Toko" class="span11" id="stname" name="stname" required="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Alamat Toko</label>
                <div class="controls">
                    <input type="text" placeholder="Alamat Toko" class="span11" id="staddr" name="staddr" required="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Telepon Toko</label>
                <div class="controls">
                    <input type="text" placeholder="Telepon Toko" class="span11" id="statlp" name="statlp" required="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Tentang Toko</label>
                <div class="controls">
                  <textarea class="textarea_editor span11" rows="6" placeholder="Enter text ..." id="stabout" name="stabout"></textarea>
                </div>
              </div>
                <button class="btn btn-primary" id="btn_SaveAbout">Save</button>
            </form>
        </div>
    </div>
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
        var id = '';
        id = $('#stid').val();
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/ShowAbout',
          data    : {id,id},
          dataType: 'json',
          success:function (response) {
            if(response.success == true){
              $.each(response.data,function (k,v) {
                $('#stid').val(v.id);
                $('#stname').val(v.storename);
                $('#staddr').val(v.storeaddress);
                $('#statlp').val(v.storephone);
                // $('#rowabout').append($('<i>asd</i>'));
                // $('#stabout').val('asd');
                $('#stabout').data('wysihtml5').editor.setValue(v.storeabout);
                // alert(v.storeabout);
                $('#btn_SaveAbout').text('Update');
                form_mode = 'edit';
              });
            }
            else{
              if(response.message = '404-01'){
                $('#btn_SaveAbout').text('Save');
                form_mode = 'add';
                // Swal.fire({
                //   type: 'error',
                //   title: 'Woops...',
                //   text: 'Data Tidak Ditemukan',
                //   // footer: '<a href>Why do I have this issue?</a>'
                // }).then((result)=>{
                //   location.reload();
                // });
              }
            }
          }
        });
    });

    $('.textarea_editor').wysihtml5();
    
    $('#FrmAbout').submit(function(e) {
      $('#btn_SaveAbout').text('Tunggu Sebentar.....');
      $('#btn_SaveAbout').attr('disabled',true);

      e.preventDefault();
      var me = $(this);
      // if(form_mode =='add'){
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/Aboutadd',
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
              Swal.fire({
                type: 'error',
                title: 'Woops...',
                text: 'Data Gagal disimpan! Silahkan hubungi administrator',
                // footer: '<a href>Why do I have this issue?</a>'
              });
              $('#btn_SaveAbout').text('Save');
              $('#btn_SaveAbout').attr('disabled',false);
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