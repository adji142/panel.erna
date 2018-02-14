<?php
  require_once(APPPATH."views/back/part/header.php");
  require_once(APPPATH."views/back/part/sidebar.php");
  $id_reg = $this->session->userdata('id_reg');
  $profile = $this->m_profile->get_prof($id_reg)->result();
  $id_profile ='';
  $first='';
  $last='';
  $email ='';
  $store_type='';
  $store_name='';
  $since='';
  $store_addr='';
  $phone='';
  $home='';
  $img='';
  $store_desc = '';
  $user = '';
  foreach ($profile as $p) {
    $id_profile = $p->id_profile;
    $first=$p->firstname;
    $last=$p->lastname;
    $email = $p->email;
    $store_type=$p->bidangusaha;
    $store_name=$p->company_name;
    $since=$p->since;
    $store_addr=$p->address;
    $phone = $p->phone;
    $home=$p->phone2;
    $img=$p->photo;
    $store_desc=$p->store_desc;
    $user = $p->user;
  }
?>
<style type="text/css">
  .go {
    width: 384px;
    height: 384px;
    object-fit: cover;
  }
</style>
<link rel="stylesheet" href="<?php base_url()?>/back/bower_components/select2/dist/css/select2.min.css">
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
  <!-- content -->
  <div class="row">
   <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username"><?php echo $user;?></h3>
              <h5 class="widget-user-desc"><?php echo $store_type;?></h5>
              <h5 class="widget-user-desc"></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?php echo base_url()."/".$img;?>" style = "width: 90px; height: 90px; object-fit: cover;" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">3,200</h5>
                    <span class="description-text">FOLLOWERS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">13,000</h5>
                    <span class="description-text">TRAFFIC</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">35</h5>
                    <span class="description-text">RATING</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-12">
                  <div class="description-block">
                    <h5 class="description-header">Store Description</h5>
                    <span class="description-text">
                      <form action="#" method="post">
                      <div class="form-group">
                        <textarea class="form-control" rows="2" placeholder="Enter your store description" name="store_desc"><?php echo $store_desc;?></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary" name="post">Post</button>
                    </form>
                    <?php
                      $set = $this->input->post('post');
                        if(isset($set)){
                          $status = $this->input->post('store_desc');
                          $update=array(
                          'store_desc'=>$status
                        );
                          $where = array(
                          'id_reg'=>$id_reg
                        );
                          $this->m_profile->userprofie($update,$where,'app_profile');
                          redirect($this->uri->uri_string());
                        }
                ?>
                    </span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <?php
              $get_c_exp = $this->db->query("select * from app_post where id_reg=$id_reg and status = 'expired'");
              $get_c_post = $this->db->query("select * from app_post where id_reg=$id_reg");
            ?>
            <div class="box-footer">
              <table class="table table-striped">
              <tr>
                <td>Visit store</td>
                <td align="right">store</td>
              </tr>
              <tr>
                <td>Ongoing Promo</td>
                <td align="right"><?php echo $get_c_post->num_rows();?></td>
              </tr>
              <tr>
                <td>Expired Promo</td>
                <td align="right"><?php echo $get_c_exp->num_rows();?></td>
              </tr>
              </table>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
<!-- start to form -->
<div class="row">
  <div class="col-md-7">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Profile - Towo.com</h3>
      </div>
      <form action="<?php echo base_url('back/profile/userprofie');?>" method="post">
        <div class="box-body">
          <div class="form-group">
            <label>Your Username</label>
            <input type="text" readonly="" class="form-control" placeholder="Username"  name="username" value="<?php echo $email; ?>">
          </div>
          <div class="form-group">
            <label>Store Type</label>
            <select class="form-control" name="store_type" required="">
              <?php
                  $a=$store_type;
                  $sttype=$this->m_profile->storetype()->result();
                  if($a==''){
                    }
                    else{
                      echo "<option value='".$store_type."'><font type ='arial black>'<b>".$store_type." (Selected)</b></font></option>";
                    }
                  foreach ($sttype as $type) {
                    echo "<option value='".$type->storetype."'>".$type->storetype."</option>";
                  }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Store Name</label>
            <input type="text" required="" class="form-control" placeholder="Store name"  name="store_name" value="<?php echo $store_name; ?>">
          </div>
          <div class="form-group">
            <label>Since</label>
            <input type="text" class="form-control" placeholder="Since"  name="since" maxlength="4" value="<?php echo $since; ?>" required="">
          </div>
          <div class="form-group">
          <label>Store Address</label>
            <textarea id= "pac-input" class="form-control" rows="3" placeholder="Enter address..." name="store_address" required=""><?php echo $store_addr; ?></textarea>
            <br>
            <center>
            <button type="submit" class="btn btn-primary" name="b">Save</button>
            </center>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  function initAutocomplete() {
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
     map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7WL5r3aYw4WtwPUwQ7ybUvTxUgcWvQ2c&libraries=places&callback=initAutocomplete"
         async defer></script>
</div>
<!-- /row -->
  </section>

</div>
<?php
	require_once(APPPATH."views/back/part/footer.php");
?>
<script src="<?php echo base_url()?>back/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url()?>back/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url()?>back/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url()?>back/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
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