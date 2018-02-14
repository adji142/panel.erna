<?php
  require_once(APPPATH."views/back/part/header.php");
  require_once(APPPATH."views/back/part/sidebar.php");
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

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
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
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Select2</h3>
  </div>
<div class="box-body">
<div class="row">
  <div class="col-md-12">
    <?php
      if(validation_errors() || $this->session->flashdata('result_error')){
        echo validation_errors();
        echo $this->session->flashdata('result_error');
      }
      $var = $this->session->flashdata('result_pass');
      if($var != ""){
        echo $this->session->flashdata('result_pass');
      }
    ?>
  </div>
</div>
<div class="dropzone">

  <div class="dz-message">
   <h3>Click or drag and drop your image hire (Max. 5 photos)</h3>
  </div>

</div>
<script type="text/javascript">

Dropzone.autoDiscover = false;

var foto_upload= new Dropzone(".dropzone",{
url: "<?php echo base_url('back/post/proses_upload') ?>",
maxFiles:5,
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
<br>
<form action="<?php echo base_url('back/post/post');?>" method="post" id="form" name="form">
  <?php 
    // echo base_url('back/post/post');
  ?>
    <div class="form-group">
      <label>Title</label>
      <input type="text" class="form-control" placeholder="Title"  name="title" required="">
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea class="form-control" rows="5" placeholder="Enter promo description, use #tag to make your post viral..." name="desc" required="" ></textarea>
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
        <input type="date" name ="start" class="form-control pull-right" required="">
      </div>
    </div>
    <div class="form-group">
      <label>End periode yyyy-mm-dd</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="date" name ="end" class="form-control pull-right" required="">

      </div>
    </div>
    <div class="form-group">
      <label>Share on social media account</label>
    </div>
    <div class="row">
      <div class="col-sm-4">
    <table class="table ">
      <tr>
        <td style="max-width:100%;white-space:nowrap;">
          <div class="form-group">
            <label class="switch">
              <input type="checkbox" name="chk_fb" value="1">
              <span class="slider round"></span>
            </label>
          </div>
        </td>
        <td>Share on Facebook</td>
      </tr>
      <!-- <tr>
        <td style="max-width:100%;white-space:nowrap;">
          <div class="form-group">
            <label class="switch">
              <input type="checkbox" name="chk_goo" value="1">
              <span class="slider round"></span>
            </label>
          </div>
        </td>
        <td>Share on Google+</td>
      </tr> -->
    </table>
    </div>
    </div>
    <div class="form-group">
      <center>
          <button type="submit" class="btn btn-app"><i class="fa fa-save"></i> Save</button>
          <button type="reset" class="btn btn-app"><i class="fa fa-repeat"></i> Reset</button>
      </center>
    </div>
  </form>
</div>
</div>
  </section>  

</div>
<div class="modal fade" id="modal-post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Change your display picture</h4>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('back/dashboard/upload')?>">
          <div class="form-group">
          <img id="previewing" src="<?php echo base_url()."/".$photo;?>" class="img-circle" width="75px" height="75px"/><br><br>
          <input type="file" name="gambar" id="file">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
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
</body>
</html>