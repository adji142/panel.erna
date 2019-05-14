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
    <div class="span6">
    <div class="widget-box">
        <div class="widget-title">
            <h5>Kategori</h5>
        </div>
        <div class="widget-content">
          <h4><font color="red"><center><div class="warning"></div></center></font></h4>
            <form id="FrmAddCategorymenu" enctype='application/json'>
              <div class="control-group">
                <label class="control-label">Parent Category</label>
                <div class="controls">
                  <select id="parent" name="parent">
                    <option value="0">Parent</option>
                    <?php
                      foreach ($query->result() as $key) {
                        echo "<option value='".$key->id."'>".$key->category."</option>";
                      }
                    ?>
                  </select>
                  <input type="hidden" placeholder="Child Category" id="idcat" name="idcat">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Child Category</label>
                <div class="controls">
                  <div class="input-append">
                    <input type="text" placeholder="Child Category" id="child" name="child" required="">
                  </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Tanggal Pasif</label>
                <div class="controls">
                  <input type="hidden" class="span5" placeholder="Group Name" id="idGrppasif" name="idGrppasif"/>
                  <input type="date" data-date-format="dd-mm-yyyy" class="datepicker span5" id="passifdate" name="passifdate">
                  <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
              </div>
              <div id="btncancel">
                <button class="btn btn-primary" id="btn_SaveCat">Save</button>
                <button class="btn btn-default" id ="cancel" type="reset">Cancel</button>
              </div>  
            </form>
        </div>
    </div>
  </div>
    <div class="span6">
    <div class="widget-box">
        <div class="widget-title">
            <h5>View Kategori</h5>
        </div>
        <div class="widget-content">
            <table class="table table-bordered" id="cat">
                <thead>
                    <tr>
                      <th>Parent Category</th>
                      <th>Child Category</th>
                      <th>ID Category</th>
                    </tr>
              </thead>
              <tbody>
                    
                <?php
                    foreach($query->result() as $rs){
                      // echo $rs->id;
                      echo "<tr class='btn-primary'>";
                      echo "<td>".$rs->category."</td>";
                      echo "<td>Parent Category</td>";
                      echo "<td id = 'pid'>".$rs->id."</td>";
                      echo "</tr>";
                      $Recordset = $this->ModelsExecuteMaster->FindData(array('parent'=>$rs->id,'tglpasif'=>null),'categories');
                      foreach ($Recordset->result() as $key) {
                        // echo $key->id;
                        echo "<tr class='gradeX btn-default'>";
                        echo "<td>".$key->category."</td>";
                        echo "<td>".$rs->category."</td>";
                        echo "<td id = 'pid'>".$key->id."</td>";
                        echo "</tr>";
                      }
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
    $(document).ready(function () {
      form_mode = 'add';
      $("#cancel").remove();
        $("#cat tr").css('cursor', 'pointer');
        $(".warning").text('Tambah Category');
        $('#passifdate').attr('readonly',true);
        // if($('#passifdate').val()==null){
        //   alert();
        // }
        // else{
        //   alert($('#passifdate').val());
        // }
    });

    $('#cat ').on('click','tr',function () {
      // var table = $('#cat').DataTable();
      form_mode = 'edit';
      $(".warning").text('Edit Category');
      $("#btn_SaveCat").text('Update Category');
      $('#passifdate').attr('readonly',false);
      $("#cancel").remove();

      var r= $('<button class="btn btn-default" id ="cancel" type="reset" onclick="Reset()">Cancel</button>');
      $("#btncancel").append(r);

      var id = $(this).find("#pid").text();
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>SiteSettingController/ViewCat',
        data    : {id:id},
        dataType: 'json',
        success:function (response) {
          if(response.success == true){
            $.each(response.data,function (k,v) {
              $('#parent').val(v.parent).change();
              $('#child').val(v.category);
              $('#idcat').val(v.id);
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

    $('#FrmAddCategorymenu').submit(function (e) {
      $('#btn_SaveCat').text('Tunggu Sebentar.....');
      $('#btn_SaveCat').attr('disabled',true);

      e.preventDefault();
      var me = $(this);
        if (form_mode == 'add') {
          $.ajax({
            type    :'post',
            url     : '<?=base_url()?>SiteSettingController/CatSave',
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
                $('#btn_SaveCat').text('Save');
                $('#btn_SaveCat').attr('disabled',false);
              }
            }
          });
        }
        else if(form_mode == 'edit'){
          if($('#passifdate').val() != ""){
            Swal.fire({
              title: 'Are you sure?',
              text: "Kamu akan mempasifkan Kategori ini ?!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                  $.ajax({
                  type    :'post',
                  url     : '<?=base_url()?>SiteSettingController/CatEdit',
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
                      $('#btn_SaveCat').text('Save');
                      $('#btn_SaveCat').attr('disabled',false);
                    }
                  }
                });
              }
              else{
                $('#btn_SaveCat').text('Save');
                $('#btn_SaveCat').attr('disabled',false);
              }
            });
          }
          else {
            $.ajax({
              type    :'post',
              url     : '<?=base_url()?>SiteSettingController/CatEdit',
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
                  $('#btn_SaveCat').text('Save');
                  $('#btn_SaveCat').attr('disabled',false);
                }
              }
            });
          }
        }
    });
  });
  function Reset() {
    form_mode = 'add';
    $('#passifdate').attr('readonly',true);
    $(".warning").text('Tambah Category');
    $("#cancel").remove();
    $("#btn_SaveCat").text('Save');
    $('#parent').val('0').change();
    $('#child').val('');
    $('#idcat').val('');
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