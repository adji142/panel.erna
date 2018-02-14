<!DOCTYPE html>
<html lang="en">
<head>
<title>E-Church</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/uniform.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-media.css" />
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1></h1>
</div>
<!--close-Header-part-->

<!--top-Header-menu-->
<?php
  $this->load->view('page/menu_top');
?>
<!--sidebar-menu-->
<?php
  $this->load->view('page/menu_side');
?>

<div id="content">

  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Dashboard</a> </div>
    <h1>Dashboard</h1>

  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Induk</th>
                  <th>Nama</th>
                  <th>Komisi</th>
                  <th>Komsel</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                foreach ($jemaat as $row) {
              ?>
                <tr class='gradeX'>
                <td><?php echo $row->induk?></td>
                <td><?php echo $row->Nama?></td>
                <td><?php echo $row->komisi?></td>
                <td><?php echo $row->komsel?></td>
                <td></td>
                </tr>
              <?php
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
<!--Footer-part-->
<?php
  $this->load->view('page/footer');
?>
<!--end-Footer-part-->
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.ui.custom.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.uniform.js"></script>
<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/matrix.js"></script>
<script src="<?php echo base_url();?>assets/js/matrix.tables.js"></script>
</body>
</html>
