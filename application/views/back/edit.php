<?php
  require_once(APPPATH."views/back/part/header.php");
  require_once(APPPATH."views/back/part/sidebar.php");
  $sess_data['id_post']=$id_post;
  $this->session->set_userdata($sess_data);
  $data = $this->m_edit->get_count_pic($id_post,$id_reg);
  $count_pic = $data->num_rows();
?>
<link rel="stylesheet" href="<?php echo base_url()?>back/plugins/iCheck/all.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/basic.min.css">

<link rel="stylesheet" href="<?php echo base_url()?>back/bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>back/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url()?>back/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url()?>back/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>back/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url()?>back/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>back/bower_components/select2/dist/css/select2.min.css">
<!-- drop zone -->
<!-- <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css"> -->
  <link href="<?php echo base_url()?>assets/dropzone.min.css" rel="stylesheet">
  <script src="<?php echo base_url()?>assets/dropzone.min.js"></script>
<style type="text/css">
body{
  background-color: #E8E9EC;
}

.dropzone {
  margin-top: 20px;
  border: 2px dashed #0087F7;
}
</style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> 
        Advanced Form Elements <a href="<?php echo base_url('back/edit/get_foto')?>">cek</a>
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
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Select2</h3>
  </div>
<div class="box-body">
  <div class="row">
  <!-- contain box -->
  <?php
  $data = $this->m_edit->get_photo($id_post,$id_reg)->result();
  $pic = array();
    foreach ($data as $key) {
      if($key->pic1 != "img_post/".$id_reg."/empty"){
        array_push($pic, $key->pic1);
      }
      if($key->pic2 != "img_post/".$id_reg."/empty"){
        array_push($pic, $key->pic2);
      }
      if($key->pic3 != "img_post/".$id_reg."/empty"){
        array_push($pic, $key->pic3);
      }
      if($key->pic4 != "img_post/".$id_reg."/empty"){
        array_push($pic, $key->pic4);
      }
      if($key->pic5 != "img_post/781066894/empty"){
        array_push($pic, $key->pic5);
      }
    }
    // print_r($pic);
    $get_token = $this->m_edit->get_token($id_post,$id_reg)->result();
    $have_token = array();
    foreach ($get_token as $key) {
      $have_token[]=$key->token;
    }
    $count_tkn = count($have_token);
    $count_arr = count($pic);
    for ($i=0; $i < $count_arr or $i < $count_tkn; $i++) {
      echo '      
          <div class="col-md-3" style = "width:20%;height=30%;word-wrap: break-word;">
            <div class="box-body">
              <img width = 100% src="'.base_url()."/".$pic[$i].'" height=30%>
            </div>
            <div class"box-footer>
            
            <a class="btn btn-block btn-info" href ="'.base_url("back/edit/token/".$have_token[$i]."").'" data-toggle="modal" > change
            </a>
            
            </div>
          </div>

      ';
    }
    // next result to get and edit parameter foto in foto table and app_post
    
    // $count_token = count($have_token);
    // for ($j=0; $j <$have_token ; $j++) { 
    //   echo '
    //     <div class = "box-footer">
    //       hai
    //     </div>
    //   ';
    // }
    $blank_pic = 5 - $count_pic;
    $width = 20 * $blank_pic;
    for ($i=0; $i < $blank_pic; $i++) { 
      echo '
      <div class="col-md-3" style = "width:'.$width.'%;height=30%;word-wrap: break-word;">
        <div class="dropzone">
          <div class="dz-message">
          <h3>Click or drag and drop your image hire (Max. '.$blank_pic.' photos)</h3>
          </div>
        </div>
      </div>
      
      ';
      break;
    }
  ?>
  <script type="text/javascript">

Dropzone.autoDiscover = false;
var count = <?php echo $blank_pic;?>;
var foto_upload= new Dropzone(".dropzone",{
url: "<?php echo base_url('back/post/proses_upload') ?>",
maxFiles:count,
maxFilesize: 2,
method:"post",
acceptedFiles:"image/*",
paramName:"userfile",
dictInvalidFileType:"Type file ini tidak dizinkan",
addRemoveLinks:true,
});


//Event ketika Memulai mengupload
foto_upload.on("sending",function(a,b,c){
  a.token=Math.random();
  c.append("token_foto",a.token); //Menmpersiapkan token untuk masing masing foto
});


//Event ketika foto dihapus
foto_upload.on("removedfile",function(a){
  var token=a.token;
  $.ajax({
    type:"post",
    data:{token:token},
    url:"<?php echo base_url('back/post/remove_foto') ?>",
    cache:false,
    dataType: 'json',
    success: function(){
      console.log("Foto terhapus");
    },
    error: function(){
      console.log("Error");

    }
  });
});


</script>
</div>
<br>
<?php
  $get_post = $this->m_edit->get_post($id_reg,$id_post)->result();
  $tit = '';
  $desc = '';
  $start = '';
  $end = '';
  foreach ($get_post as $get) {
    $tit = $get->promo_title;
    $desc = $get->description;
    $start = $get->start_period;
    $end= $get->end_period;
  }
?>
<div class="row">
  <div class="col-md-12">
<!-- input -->
<form action="<?php echo base_url('back/edit/update_post');?>" method="post" id="form" name="form">
  <?php 
    // echo base_url('back/post/post');
  ?>
    <div class="form-group">
      <label>Title</label>
      <input type="text" class="form-control" placeholder="Title"  name="title" required="" value="<?php echo $tit;?>">
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea class="form-control" rows="5" placeholder="Enter promo description, use #tag to make your post viral..." name="desc" required="" ><?php echo $desc;?></textarea>
    </div>
<!--     <div class="form-group">
      <label>Tag</label>
      <select class="form-control" id="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" name="tag[]">
        <option value="Alabama,">Alabama</option>
        <option value="Alaska,">Alaska</option>
        <option value="California,">California</option>
        <option value="Delaware,">Delaware</option>
        <option value="Tennessee,">Tennessee</option>
        <option value="Texas,">Texas</option>
        <option value="Washington,">Washington</option>
      </select>
    </div> -->
    <div class="form-group">
      <label>Start periode yyyy-mm-dd</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="date" name ="start" class="form-control pull-right" required="" value="<?php echo $start;?>">
      </div>
    </div>
    <div class="form-group">
      <label>End periode yyyy-mm-dd</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="date" name ="end" class="form-control pull-right" required="" value="<?php echo $end;?>">

      </div>
    </div>
    <div class="form-group">
      <center>
          <button type="submit" class="btn btn-app"><i class="fa fa-save"></i> Update</button>
          <a href="<?php echo base_url('back/dashboard/ongoing')?>" class="btn btn-app"><i class="fa fa-repeat"></i> Cancel</a>
      </center>
    </div>
  </form>
</div>
  </div>
</div>
</div>
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
<script src="<?php echo base_url()?>back/dist/js/demo.js"></script>
<!-- <script>
  $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Please Select"
                });
            });
</script> -->
<script type="text/javascript">
    function gethashtags($text){
    //Match the hashtags
    preg_match_all('/(^|[^a-z0-9_])#([a-z0-9_]+)/i', $text, $matchedHashtags);
    $hashtag = '';
    // For each hashtag, strip all characters but alpha numeric
    if(!empty($matchedHashtags[0])){
      foreach($matchedHashtags[0] as $match){
        $hashtag .= preg_replace("/[^a-z0-9]+/i", "", $match).',';
      }
    }
    //to remove last comma in a string
    return rtrim($hashtag, ',');
  }
  $text = "w3lessons.info - #php programming blog, #facebook wall script";
  echo gethashtags($text); //output - php,facebook
  function convert_clickable_links($message){
    $parsedMessage = preg_replace(array('/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))/', '/(^|[^a-z0-9_])@([a-z0-9_]+)/i', '/(^|[^a-z0-9_])#([a-z0-9_]+)/i'), array('<a href="$1" target="_blank">$1</a>', '$1<a href="">@$2</a>', '$1<a href="index.php?hashtag=$2">#$2</a>'), $message);
    return $parsedMessage;
  }
</script>
<script>
  function updatedata() {
        //preloader
        // $('#post-loader').show();
        var msg = $("#message").val();
        if(msg != '') {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('back/post/post') ?>",
            data: 'msg='+msg,
            cache: false,
            success: function(html) {
                $('#updates').prepend(html);
                $('#post-loader').hide();
                $("#message").val('');
            },
            error: function() {
                $('#post-loader').hide();
            }
        });
        return false;
        } else {
            alert("Message cannot be empty!");
            return false;
        }
  }
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('#select2').select2()

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

<!-- modal -->
</body>
</html>