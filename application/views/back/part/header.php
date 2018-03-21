<?php
  $id_reg = $this->session->userdata('id_reg');
  $user=$this->m_dash->user_info($id_reg)->result();
  $status='';
  $username='';
  $since='';
  $bidangusaha='';
  $photo='';
  $store_desc='';
  foreach ($user as $u) {
    $status = $u->condition;
    $username=$u->user;
    $since=date('F Y',strtotime(substr($u->datetime_reg, 0,7)));
    $bidangusaha=$u->bidangusaha;
    $photo=$u->photo;
    $store_desc=$u->store_desc;
  }
  
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <script language="javascript" type="text/javascript">
    function lanfTrans(lan)
      {
        switch(lan)
      {
        case 'en': document.getElementById('dlang').value='en';document.langForm.submit(); break;
        case 'fr': document.getElementById('dlang').value='fr'; document.langForm.submit(); break;
        case 'es': document.getElementById('dlang').value='es'; document.langForm.submit(); break;
        case 'id': document.getElementById('dlang').value='id'; document.langForm.submit(); break;
   }
 }
</script>
  <title><?php echo $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>back/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>back/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>back/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>back/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>back/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url();?>back/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>back/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>back/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>back/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url();?>back/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b> towo.com</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url()."/".$photo;?>" class="user-image" alt="User Image">
              <!-- 1 -->
              <span class="hidden-xs"><?php echo $username;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              
                <img src="<?php echo base_url()."/".$photo;?>" class="img-circle photo" alt="User Image" width='30%' height='30%'>
                <button type="button" class="btn btn-outline" data-toggle="modal" data-target="#modal-default">
                Change image
              </button>
                <!-- 2 -->
                <p>
                  <?php echo $username.' - '.$bidangusaha;?>
                  <small>Member since <?php echo $since;?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">trafic</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Rating</a>
                  </div>
                  
                </div>
                <li class="user-body">
                  <div class="col-xs-12 text-center">
                    <form action="#" method="post">
                      <div class="form-group">
                        <textarea class="form-control" rows="2" placeholder="Enter your store description" name="store_desc"><?php echo $store_desc;?></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary" name="post">Post</button>
                    </form>
                  </div>
                </li>
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
                  }
                ?>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url().'login/logout';?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
    <script src="../../bower_components/fastclick/lib/fastclick.js"></script>
  </header>
  <script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
  <script type="text/javascript"> /* script JQuery untuk load gambar pada bagian preview */
    $(function() {
      $("#file").change(function() {
        $("#message").empty(); // To remove the previous error message
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];

        if (!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
        {
          $('#previewing').attr('src','noimage.png');
          $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
          return false;
        }else {
          var reader = new FileReader();
          reader.onload = imageIsLoaded;
          reader.readAsDataURL(this.files[0]);
        }
      });
    });

    function imageIsLoaded(e) {
      $("#file").css("color","green");
      $('#image_preview').css("display", "block");
      $('#previewing').attr('src', e.target.result);
      $('#previewing').attr('width', '75px');
      $('#previewing').attr('height', '75px');
    }
  </script>
          <div class="modal fade" id="modal-default">
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
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
          