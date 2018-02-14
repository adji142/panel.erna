<?php
  require_once(APPPATH."views/back/part/header.php");
  require_once(APPPATH."views/back/part/sidebar.php");
  $id_reg = $this->session->userdata('id_reg');
  $profile = $this->m_profile->get_prof($id_reg)->result();
  $id_profile ='';
  $email ='';
  $phone='';
  $home='';
  $gender='';
  $birtday='';
  $selected='';
  $male = '';
  $female = '';
  foreach ($profile as $p) {
    $id_profile = $p->id_profile;
    $email = $p->email;
    $phone = $p->phone;
    $home=$p->phone2;
    $gender =$p->Gender;
    $birtday = $p->birtday;
  }

  if($birtday=="Male"){
    $male = 'selected';
  }
  elseif($birtday=="Female"){
    $female='selected';
  }
  $where = array(
    'id_reg' => $id_reg
  );
  // info IG
  $status_ig = "";
  $disable_ig = "";
  $Disconect_ig = '';
  // get facebook info
  $provider = "facebook";
  $status_fb = "";
  $name_fb = $this->session->userdata('name');
  $disable_fb = "";
  $Disconect_fb = '';
  if($name_fb == ""){
    $status_fb = "Not Connected";
  }
  else{
    $cek_fb_1st = $this->m_account->check_already($id_reg,$provider);
    if($cek_fb_1st->num_rows()==0){
      $status_fb = "Not Connected";
      $disable_fb = "";
      $Disconect_fb = '';
    }
    else{
    $status_fb = "Connected as ".$name_fb;
    $disable_fb = 'onclick="return false"';
    $Disconect_fb = '<td><a href="#" title="Disconect"><i class="fa fa-trash"></i></a></td>';
    }
  }
  // goo_auth
  $provider_goo = "Google+";
  $status_goo = "";
  $disable_goo = "";
  $Disconect_goo= "";
  $authUrl=$this->session->userdata('authUrl');
  $userData = $this->session->userdata('userData');
  if($userData==""){
    $status_goo = "Not Connected";
  }
  else{
    $cek = $this->m_account->check_first($id_reg,$provider_goo);
    $cek_2nd_step = $this->m_account->check_already_goo($id_reg,$provider_goo);
    if($cek->num_rows()==0){
      $sess_data = array(
        'id_reg'=>$id_reg,
        'oauth_provider '=>$provider_goo,
        'oauth_uid'=>$userData['id'],
        'name'=>$userData->given_name,
        'picture_url'=>$userData['picture'],
        'profile_url'=>$userData['link'],
        'loggedin'=>TRUE
      );
      $this->m_account->insert_soc($sess_data,'social_user');
    }
    elseif($cek_2nd_step->num_rows()==0){
      $status_goo = "Not Connected";
      $disable_goo = "";
      $Disconect_goo = "";  
    }
    else{
    $status_goo = "Connected as ".$userData->given_name;
    $disable_goo = 'onclick="return false"';
    $Disconect_goo = '<td><a href="#" title="Disconect"><i class="fa fa-trash"></i></a></td>';
  }
  }
  // get user soc from DB
  $provider = 'facebook';
  $cek_fb = $this->m_account->check_already($id_reg,$provider)->result();
  foreach ($cek_fb as $key_fb) {
    $status_fb = "Connected as ".$key_fb->name;
    $disable_fb = 'onclick="return false"';
    $Disconect_fb = '<td><a href="#" title="Disconect"><i class="fa fa-trash"></i></a></td>';
  }
  $provider_goo = 'Google+';
  $cek_goo = $this->m_account->check_already_goo($id_reg,$provider_goo)->result();
  foreach ($cek_goo as $key_goo) {
    $status_goo = "Connected as ".$key_goo->name;
    $disable_goo = 'onclick="return false"';
    $Disconect_goo = '<td><a href="#" title="Disconect"><i class="fa fa-trash"></i></a></td>';
  }
  if($this->session->userdata('id_ig')==""){
    $status_ig = "";
  }
  else{
  $cek_ig = $this->m_account->cek_id_wo_logedin($id_reg)->result();
  foreach ($cek_ig as $key_ig) {
    $status_ig = "Connected as ".$key_ig->name;
    $disable_ig = 'onclick="return false"';
    $Disconect_ig = '<td><a href="#" title="Disconect"><i class="fa fa-trash"></i></a></td>';
  }
  }
?>
<link rel="stylesheet" href="<?php base_url()?>/back/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?php base_url()?>/back/plugins/iCheck/all.css">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Advanced Form Elements
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol>
    </section>
    <!-- basic -->
	<section class="content">
  <!-- User Profile -->
  <form action="#" method="post">
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">User Profile 
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
            <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" placeholder="" readonly="" name="prof_id" value="<?php echo $email?>">
                </div>
              <div class="form-group">
              <label>Gender</label><br>
                <label>
                  <input type="radio" name="gender" checked value="Male" <?php echo $male;?>>
                  Male
                </label>
                <label>
                  <input type="radio" name="gender" value="Female" <?php echo $female;?>>
                  Female
                </label>
              </div>
              <div class="form-group">
                <label>Birthday yyyy-mm-dd</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" name ="lahir" class="form-control pull-right" value="<?php echo $birtday;?>">
                </div>
                <!-- /.input group -->
              </div>
              <button type="submit" class="btn btn-primary" name="step_one">Save</button>
              <!-- </form> -->
            </div>
            <!-- /.box-body -->
          </div>
<!-- telepon -->
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Telephone
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <label>Handphone / whatsapp number:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-whatsapp"></i>
                  </div>
                  <input type="text" name="store_hp" class="form-control" data-inputmask='"mask": "(+62) 999-9999-9999"' data-mask value="<?php echo $phone;?>">
                </div>
              </div>
              <div class="form-group">
                <label>Store number:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="store_number" class="form-control" data-inputmask='"mask": "(9999) 999-9999"' data-mask value="<?php echo $home;?>">
                </div>
                <!-- /.input group -->
              </div>
              <button type="submit" class="btn btn-primary" name="step_two">Save</button>
              <!-- </form> -->
            </div>
            <!-- /.box-body -->
          </div>
<!-- Sosmed -->
          <div class="box box-default collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Bind your account
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-sm-4">
                  <?php echo "isinya: ".$this->session->userdata('id_ig');?>
              <table class="table table-striped">
              <tr>
                <td>
                  <a class="btn btn-block btn-social btn-google" <?php echo $disable_goo;?> href="<?php echo $authUrl; ?>">
                <i class="fa fa-google-plus"></i> Bind with Google
              </a>
                </td>
                <td align="right" style="max-width:100%;white-space:nowrap;"><?php echo $status_goo;?></td>
                <?php echo $Disconect_goo;?>
              </tr>
              <tr>
                <td>
                  <a href="<?php echo $this->session->userdata('login');?>" class="btn btn-block btn-social btn-facebook" <?php echo $disable_fb;?>>
                <i class="fa fa-facebook"></i> Bind with Facebook
              </a>
                </td>
                <td align="right" style="max-width:100%;white-space:nowrap;" ><?php echo $status_fb;?></td>
                <?php echo $Disconect_fb;?>
              </tr>
              <!-- <tr>
                <td><a href="https://api.instagram.com/oauth/authorize/?client_id=dfc8fc0e5a984ebe82be5612d5ac8cfe&redirect_uri=http://localhost/promo/back/account/test/&response_type=code&public_content" class="btn btn-block btn-social btn-instagram" ><i class="fa fa-instagram"></i> Bind with Instagram</a></td>
                <td align="right" style="max-width:100%;white-space:nowrap;"><?php echo $Disconect_ig;?></td>
              </tr> -->
              </table>
            </div>
            </div>
            </div>
          </div> 
</form>
<?php
  $step_one = $this->input->post('step_one');
  $step_two = $this->input->post('step_two');
  if(isset($step_one)){
    $gender = $this->input->post('gender');
    $biday = $this->input->post('lahir');
    $update = array(
      'Gender'=>$gender,
      'birtday'=>$biday
    );
    $this->m_profile->userprofie($update,$where,'app_profile');
    redirect($this->uri->uri_string());
  }
  elseif(isset($step_two)){
    $hp = $this->input->post('store_hp');
    $tlp = $this->input->post('store_number');
    $update=array(
      'phone'=>$hp,
      'phone2'=>$tlp
    );
    $this->m_profile->userprofie($update,$where,'app_profile');
    redirect($this->uri->uri_string());
  }
?>
</section>

</div>
<?php
	require_once(APPPATH."views/back/part/footer.php");
?>
<script src="<?php echo base_url()?>back/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url()?>back/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url()?>back/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url()?>back/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="<?php echo base_url()?>back/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>