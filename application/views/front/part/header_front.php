<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
	$account = "";
	$post = "";
	$username = "asd";
	$id_reg = $this->session->userdata('id_reg');
	if($id_reg==""){
		$account = '
		<a href="'.base_url('login').'"><span class="active uls-trigger">Login</span></a>
		<a href="'.base_url('login/register').'"><span class="active uls-trigger">Register</span></a>
		';
		$post = "";
	}
	else{
		$account = '<a class="account" href="'.base_url('back/dashboard/profile').'">My Account '.$username.'</a><a href="'.base_url('login/logout').'"><span class="active uls-trigger">Logout</span></a>';
		$post = '<a href="'.base_url('back/dashboard/post').'">Post Free Ad</a>';
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Resale a Business Category Flat Bootstrap Responsive Website Template | Home :: w3layouts <?php echo $username;?></title>
<link rel="stylesheet" href="<?php echo base_url();?>front/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>front/css/bootstrap-select.css">
<link href="<?php echo base_url();?>front/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url();?>front/css/flexslider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo base_url();?>front/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>front/jquery/datatables.net-bs/css/dataTables.bootstrap.min.css" />
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resale Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<!--fonts-->
<link href='//fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--//fonts-->	
<!-- js -->
<script type="text/javascript" src="<?php echo base_url();?>front/js/jquery.min.js"></script>
<!-- js -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url();?>front/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>front/js/bootstrap-select.js"></script>
<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
<script type="text/javascript" src="<?php echo base_url();?>front/js/jquery.leanModal.min.js"></script>
<link href="<?php echo base_url();?>front/css/jquery.uls.css" rel="stylesheet"/>
<link href="<?php echo base_url();?>front/css/jquery.uls.grid.css" rel="stylesheet"/>
<link href="<?php echo base_url();?>front/css/jquery.uls.lcd.css" rel="stylesheet"/>
<!-- Source -->
<script src="<?php echo base_url();?>front/js/jquery.uls.data.js"></script>
<script src="<?php echo base_url();?>front/js/jquery.uls.data.utils.js"></script>
<script src="<?php echo base_url();?>front/js/jquery.uls.lcd.js"></script>
<script src="<?php echo base_url();?>front/js/jquery.uls.languagefilter.js"></script>
<script src="<?php echo base_url();?>front/js/jquery.uls.regionfilter.js"></script>
<script src="<?php echo base_url();?>front/js/jquery.uls.core.js"></script>
<script src="<?php echo base_url();?>front/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>front/jquery/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>front/jquery/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>front/jquery/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<!-- <script>
			$( document ).ready( function() {
				$( '.uls-trigger' ).uls( {
					onSelect : function( language ) {
						var languageName = $.uls.data.getAutonym( language );
						$( '.uls-trigger' ).text( languageName );
					},
					quickList: ['en', 'hi', 'he', 'ml', 'ta', 'fr'] //FIXME
				} );
			} );
		</script> -->
    <script src="<?php echo base_url();?>front/js/tabs.js"></script>
	
<script type="text/javascript">
$(document).ready(function () {    
var elem=$('#container ul');      
	$('#viewcontrols a').on('click',function(e) {
		if ($(this).hasClass('gridview')) {
			elem.fadeOut(1000, function () {
				$('#container ul').removeClass('list').addClass('grid');
				$('#viewcontrols').removeClass('view-controls-list').addClass('view-controls-grid');
				$('#viewcontrols .gridview').addClass('active');
				$('#viewcontrols .listview').removeClass('active');
				elem.fadeIn(1000);
			});						
		}
		else if($(this).hasClass('listview')) {
			elem.fadeOut(1000, function () {
				$('#container ul').removeClass('grid').addClass('list');
				$('#viewcontrols').removeClass('view-controls-grid').addClass('view-controls-list');
				$('#viewcontrols .gridview').removeClass('active');
				$('#viewcontrols .listview').addClass('active');
				elem.fadeIn(1000);
			});									
		}
	});
});
</script>
</head>
<body>
	<div class="header">
		<div class="container">
			<div class="logo">
				<a href="index.html"><span>Re</span>sale</a>
			</div>
			<div class="header-right">
			<?php echo $account;?>
	<!-- Large modal -->
		</div>
		</div>
	</div>
	<div class="main-banner banner text-center">
	  <div class="container">    
			<h1>Sell or Advertise   <span class="segment-heading">    anything online </span> with Resale</h1>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
			<?php echo $post;?>
	  </div>
	</div>