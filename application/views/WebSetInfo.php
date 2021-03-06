<?php
    require_once(APPPATH."views/part/Header.php");
    require_once(APPPATH."views/part/sidebar.php");
?>
<?php
  $query = $this->ModelsExecuteMaster->FindData(array('parent'=>0),'faq');
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
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab1">FAQ</a></li>
              <li><a data-toggle="tab" href="#tab2">TERMS & AGREEMENTS</a></li>
              <li><a data-toggle="tab" href="#tab3">PRIVACY POLICY</a></li>
              <li><a data-toggle="tab" href="#tab4">SHIPPING POLICY</a></li>
              <li><a data-toggle="tab" href="#tab5">REFUND POLICY</a></li>
              <li><a data-toggle="tab" href="#tab6">RETURNS & EXCHANGE POLICY</a></li>
              <li><a data-toggle="tab" href="#tab7">AKUN REKENING</a></li>
            </ul>
        </div>
        <div class="widget-content tab-content">
          <div id="tab1" class="tab-pane active">
            <h4>FAQ (FREQUENTLY ASKED QUESTIONS) SETTING</h4>
            <div class="row-fluid">
              <div class="span6">
                <h4><font color="red"><center><div class="warning"></div></center></font></h4>
                <form id="FrmaddinfoFAQ" enctype='application/json'>
                  <div class="control-group">
                    <label class="control-label">Ask</label>
                    <div class="controls">
                      <div class="input-append">
                        <input type="text" placeholder="Ask" id="ask" name="ask" required="">
                        <input type="hidden" id="idfaq" name="idfaq">
                      </div>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Answer</label>
                    <div class="controls">
                      <textarea class="textarea_editor span11" rows="6" placeholder="Enter text ..." id="answ" name="answ"></textarea>
                    </div>
                  </div>
                  <div id="btncancel">
                    <button class="btn btn-primary" id="btn_SaveCat">Save</button>
                    <button class="btn btn-default" id ="cancel" type="reset">Cancel</button>
                  </div>
                </form>
              </div>
              <div class="span6">
                <table class="table table-bordered" id="cat">
                  <thead>
                      <tr>
                        <th>Ask</th>
                        <th>Answers</th>
                        <th>ID FAQ</th>
                      </tr>
                  </thead>
                  <tbody>
                        
                    <?php
                        foreach($query->result() as $rs){
                            echo "<tr class='gradeX btn-default'>";
                            echo "<td>".$rs->ask."</td>";
                            echo "<td>".$rs->answer."</td>";
                            echo "<td id = 'pid'>".$rs->id."</td>";
                            echo "</tr>";
                        }
                        
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div id="tab2" class="tab-pane">
            <h4>TERMS & AGREEMENTS SETTING</h4>
            <form id="FrmaddinfoTerm" enctype='application/json'>
              <input type="hidden" id="idterm" name="idterm">
              <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                  <textarea class="textarea_editor_term span11" rows="6" placeholder="Enter text ..." id="term" name="term"></textarea>
                </div>
              </div>
              <button class="btn btn-primary" id="btn_Saveterm">Save</button>
            </form>
          </div>
          <div id="tab3" class="tab-pane">
            <h4>PRIVACY POLICY SETTING</h4>
            <form id="Frmaddinfopolice" enctype='application/json'>
              <input type="hidden" id="idplc" name="idplc">
              <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                  <textarea class="textarea_editor_Police span11" rows="6" placeholder="Enter text ..." id="plc" name="plc"></textarea>
                </div>
              </div>
              <button class="btn btn-primary" id="btn_Saveplc">Save</button>
            </form>
          </div>
          <div id="tab4" class="tab-pane">
            <h4>SHIPPING POLICY SETTING</h4>
            <form id="Frmaddinfoshiping" enctype='application/json'>
              <input type="hidden" id="idship" name="idship">
              <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                  <textarea class="textarea_editor_shiping span11" rows="6" placeholder="Enter text ..." id="ship" name="ship"></textarea>
                </div>
              </div>
              <button class="btn btn-primary" id="btn_Saveship">Save</button>
            </form>
          </div>
          <div id="tab5" class="tab-pane">
            <h4>REFUND POLICY SETTING</h4>
            <form id="Frmaddinforefund" enctype='application/json'>
              <input type="hidden" id="idrfn" name="idrfn">
              <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                  <textarea class="textarea_editor_refund span11" rows="6" placeholder="Enter text ..." id="rfn" name="rfn"></textarea>
                </div>
              </div>
              <button class="btn btn-primary" id="btn_Saverfn">Save</button>
            </form>
          </div>
          <div id="tab6" class="tab-pane">
            <h4>RETURNS & EXCHANGE POLICY SETTING</h4>
            <form id="Frmaddinforetur" enctype='application/json'>
              <input type="hidden" id="idrtr" name="idrtr">
              <div class="control-group">
                <label class="control-label"></label>
                <div class="controls">
                  <textarea class="textarea_editor_retur span11" rows="6" placeholder="Enter text ..." id="rtr" name="rtr"></textarea>
                </div>
              </div>
              <button class="btn btn-primary" id="btn_Savertr">Save</button>
            </form>
            <p></p>
          </div>
          <div id="tab7" class="tab-pane">
            <h4>AKUN REKENING</h4>
            <div class="row-fluid">
              <div class="span6">
                <h4><font color="red"><center><div class="warning_2"></div></center></font></h4>
                <form id="frmrekening" enctype='application/json'>
                  <input type="hidden" id="idrek" name="idrek">
                  <div class="control-group">
                    <label class="control-label">Kode Bank</label>
                    <div class="controls">
                      <div class="input-append">
                        <input type="text" placeholder="Kode Bank" id="kdbank" name="kdbank" required="">
                      </div>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Nama Bank</label>
                    <div class="controls">
                      <div class="input-append">
                        <input type="text" placeholder="Nama Bank" id="nmbank" name="nmbank" required="">
                      </div>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Nomer Rekening</label>
                    <div class="controls">
                      <div class="input-append">
                        <input type="text" placeholder="Nomer Rekenng" id="norek" name="norek" required="">
                      </div>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Atas Nama</label>
                    <div class="controls">
                      <div class="input-append">
                        <input type="text" placeholder="Atas Nama" id="atasnama" name="atasnama" required="">
                      </div>
                    </div>
                  </div>
                  <div id="btncancelrek">
                    <button class="btn btn-primary" id="btn_Saverbank">Save</button>
                    <button class="btn btn-default" id ="cancel_rek" type="reset">Cancel</button>
                  </div>
                </form>
                <p></p>
              </div>
              <div class="span6">
                <table class="table table-bordered" id="rek">
                  <thead>
                      <tr>
                        <th>ID Bank</th>
                        <th>Kode Bank</th>
                        <th>No. Rekening</th>
                        <th>Atas Nama</th>
                      </tr>
                  </thead>
                  <tbody>
                        
                    <?php
                        $databank = $this->ModelsExecuteMaster->GetData('masterrekening');
                        foreach($databank->result() as $rek){
                            echo "<tr class='gradeX btn-default'>";
                            echo "<td id = 'pidrek'>".$rek->id."</td>";
                            echo "<td>".$rek->kdbank."</td>";
                            echo "<td>".$rek->norek."</td>";
                            echo "<td>".$rek->atasnama."</td>";
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
      form_mode = 'add';
      $("#cancel").remove();
      $("#cancel_rek").remove();
      $("#cat tr").css('cursor', 'pointer');
      $("#rek tr").css('cursor', 'pointer');
      $(".warning").text('Tambah FAQ');
      $('#passifdate').attr('readonly',true);
      LoadData();
    });

    $('.textarea_editor').wysihtml5();
    $('.textarea_editor_term').wysihtml5();
    $('.textarea_editor_Police').wysihtml5();
    $('.textarea_editor_shiping').wysihtml5();
    $('.textarea_editor_refund').wysihtml5();
    $('.textarea_editor_retur').wysihtml5();
    
    $('#cat').on('click','tr',function () {
      // var table = $('#cat').DataTable();
      form_mode = 'edit';
      $(".warning").text('Edit FAQ');
      $("#btn_SaveCat").text('Update FAQ');
      $('#passifdate').attr('readonly',false);
      $("#cancel").remove();

      var r= $('<button class="btn btn-default" id ="cancel" type="reset" onclick="Reset()">Cancel</button>');
      $("#btncancel").append(r);

      var id = $(this).find("#pid").text();
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>SiteSettingController/Viewfaq',
        data    : {id:id},
        dataType: 'json',
        success:function (response) {
          if(response.success == true){
            $.each(response.data,function (k,v) {
              $('#ask').val(v.ask).change();
              // $('#answ').val(v.answer);
              $('#answ').data('wysihtml5').editor.setValue(v.answer);
              $('#idfaq').val(v.id);
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

    $('#rek').on('click','tr',function () {
      // var table = $('#cat').DataTable();
      form_mode = 'edit';
      $(".warning_2").text('Edit Rekening');
      $("#btn_Saverbank").text('Update Rekening');
      $("#cancel_rek").remove();

      var r= $('<button class="btn btn-default" id ="cancel_rek" type="reset" onclick="Reset()">Cancel</button>');
      $("#btncancelrek").append(r);

      var id = $(this).find("#pidrek").text();
      $.ajax({
        type    :'post',
        url     : '<?=base_url()?>SiteSettingController/Viewrek',
        data    : {id:id},
        dataType: 'json',
        success:function (response) {
          if(response.success == true){
            $.each(response.data,function (k,v) {
              $('#kdbank').val(v.kdbank);
              // $('#answ').val(v.answer);
              $('#nmbank').val(v.namabank);
              $('#atasnama').val(v.atasnama);
              $('#norek').val(v.norek);
              $('#idrek').val(v.id);
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

    $('#FrmaddinfoFAQ').submit(function (e) {
      $('#btn_SaveCat').text('Tunggu Sebentar.....');
      $('#btn_SaveCat').attr('disabled',true);

      e.preventDefault();
      var me = $(this);
        if (form_mode == 'add') {
          $.ajax({
            type    :'post',
            url     : '<?=base_url()?>SiteSettingController/faqSave',
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
          $.ajax({
            type    :'post',
            url     : '<?=base_url()?>SiteSettingController/faqEdit',
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
    });

    $('#FrmaddinfoTerm').submit(function (e) {
      $('#btn_Saveterm').text('Tunggu Sebentar.....');
      $('#btn_Saveterm').attr('disabled',true);

      e.preventDefault();
      var me = $(this);
      var info = $('#term').val();
      var field = 'term';
      var id = $('#idterm').val();

      if( id == ''){
        // Add
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/InfSave',
          data    : {info:info,field:field},
          dataType: 'json',
          success:function (response) {
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
              $('#btn_Saveterm').text('Save');
              $('#btn_Saveterm').attr('disabled',false);
            }
          }
        });
      }
      else{
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/infEdit',
          data    : {info:info,field:field,id:id},
          dataType: 'json',
          success:function (response) {
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
              $('#btn_Saveterm').text('Save');
              $('#btn_Saveterm').attr('disabled',false);
            }
          }
        });
      }
    });

    $('#Frmaddinfopolice').submit(function (e) {
      $('#btn_Saveplc').text('Tunggu Sebentar.....');
      $('#btn_Saveplc').attr('disabled',true);

      e.preventDefault();
      var me = $(this);
      var info = $('#plc').val();
      var field = 'plc';
      var id = $('#idplc').val();

      if( id == ''){
        // Add
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/InfSave',
          data    : {info:info,field:field},
          dataType: 'json',
          success:function (response) {
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
              $('#btn_Saveplc').text('Save');
              $('#btn_Saveplc').attr('disabled',false);
            }
          }
        });
      }
      else{
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/infEdit',
          data    : {info:info,field:field,id:id},
          dataType: 'json',
          success:function (response) {
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
              $('#btn_Saveplc').text('Save');
              $('#btn_Saveplc').attr('disabled',false);
            }
          }
        });
      }
    });

    $('#Frmaddinfoshiping').submit(function (e) {
      $('#btn_Saveship').text('Tunggu Sebentar.....');
      $('#btn_Saveship').attr('disabled',true);

      e.preventDefault();
      var me = $(this);
      var info = $('#ship').val();
      var field = 'ship';
      var id = $('#idship').val();

      if( id == ''){
        // Add
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/InfSave',
          data    : {info:info,field:field},
          dataType: 'json',
          success:function (response) {
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
              $('#btn_Saveship').text('Save');
              $('#btn_Saveship').attr('disabled',false);
            }
          }
        });
      }
      else{
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/infEdit',
          data    : {info:info,field:field,id:id},
          dataType: 'json',
          success:function (response) {
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
              $('#btn_Saveship').text('Save');
              $('#btn_Saveship').attr('disabled',false);
            }
          }
        });
      }
    });

    $('#Frmaddinforefund').submit(function (e) {
      $('#btn_Saverfn').text('Tunggu Sebentar.....');
      $('#btn_Saverfn').attr('disabled',true);

      e.preventDefault();
      var me = $(this);
      var info = $('#rfn').val();
      var field = 'refund';
      var id = $('#idrfn').val();

      if( id == ''){
        // Add
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/InfSave',
          data    : {info:info,field:field},
          dataType: 'json',
          success:function (response) {
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
              $('#btn_Saverfn').text('Save');
              $('#btn_Saverfn').attr('disabled',false);
            }
          }
        });
      }
      else{
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/infEdit',
          data    : {info:info,field:field,id:id},
          dataType: 'json',
          success:function (response) {
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
              $('#btn_Saverfn').text('Save');
              $('#btn_Saverfn').attr('disabled',false);
            }
          }
        });
      }
    });
    
    $('#Frmaddinforetur').submit(function (e) {
      $('#btn_Savertr').text('Tunggu Sebentar.....');
      $('#btn_Savertr').attr('disabled',true);

      e.preventDefault();
      var me = $(this);
      var info = $('#rtr').val();
      var field = 'return';
      var id = $('#idrtr').val();

      if( id == ''){
        // Add
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/InfSave',
          data    : {info:info,field:field},
          dataType: 'json',
          success:function (response) {
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
              $('#btn_Savertr').text('Save');
              $('#btn_Savertr').attr('disabled',false);
            }
          }
        });
      }
      else{
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/infEdit',
          data    : {info:info,field:field,id:id},
          dataType: 'json',
          success:function (response) {
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
              $('#btn_Savertr').text('Save');
              $('#btn_Savertr').attr('disabled',false);
            }
          }
        });
      }
    });
// kene
    $('#frmrekening').submit(function (e) {
      $('#btn_Saverbank').text('Tunggu Sebentar.....');
      $('#btn_Saverbank').attr('disabled',true);

      e.preventDefault();
      var me = $(this);
      // var info = $('#rtr').val();
      // var field = 'return';
      var id = $('#idrek').val();
      if( id == ''){
        // Add
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/rekSave',
          data    : me.serialize(),
          dataType: 'json',
          success:function (response) {
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
              $('#btn_Saverbank').text('Save');
              $('#btn_Saverbank').attr('disabled',false);
            }
          }
        });
      }
      else{
        $.ajax({
          type    :'post',
          url     : '<?=base_url()?>SiteSettingController/rekEdit',
          data    : me.serialize(),
          dataType: 'json',
          success:function (response) {
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
              $('#btn_Saverbank').text('Save');
              $('#btn_Saverbank').attr('disabled',false);
            }
          }
        });
      }
    });

  });
  function Reset() {
    form_mode = 'add';
    $(".warning").text('Tambah FAQ');
    $("#cancel").remove();
    $("#cancel_rek").remove();
    $("#btn_Saverbank").text('Save');
    $("#btn_SaveCat").text('Save');
    $('#ask').val('');
    $('#answ').val('');

    // reset 2
    $('#kdbank').val('');
    $('#nmbank').val('');
    $('#norek').val('');
    $('#atasnama').val('');
  }
  function LoadData() {
    var id = 1;
    $.ajax({
        type    :'post',
        url     : '<?=base_url()?>SiteSettingController/ViewInf',
        data    : {id:id},
        dataType: 'json',
        success:function (response) {
          if(response.success == true){
            $.each(response.data,function (k,v) {
              $('#idplc').val(v.id);
              $('#idship').val(v.id);
              $('#idrfn').val(v.id);
              $('#idrtr').val(v.id);
              $('#idterm').val(v.id);
              // $('#answ').val(v.answer);
              $('#plc').data('wysihtml5').editor.setValue(v.plc);
              $('#ship').data('wysihtml5').editor.setValue(v.ship);
              $('#rfn').data('wysihtml5').editor.setValue(v.refund);
              $('#rtr').data('wysihtml5').editor.setValue(v.return);
              $('#term').data('wysihtml5').editor.setValue(v.term);
            });
          }
          else{
            $('#idplc').val('');
            $('#idship').val('');
            $('#idrfn').val('');
            $('#idrtr').val('');
            $('#idterm').val('');
            // $('#answ').val(v.answer);
            $('#plc').data('wysihtml5').editor.setValue('');
            $('#ship').data('wysihtml5').editor.setValue('');
            $('#rfn').data('wysihtml5').editor.setValue('');
            $('#rtr').data('wysihtml5').editor.setValue('');
            $('#term').data('wysihtml5').editor.setValue('');
          }
        }
      });
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