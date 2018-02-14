<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/uniform.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-media.css" />
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet" type="text/css">
<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-th"></i>Tables</a>
  <ul>
  <?php
    $level = $this->session->userdata('level');
    $main = $this->db->get_where('level',array('kat_menu'=>0,'level'=>$level));
    foreach ($main->result() as $m) {
      $sub = $this->db->get_where('level',array('kat_menu'=>$m->id_menu));
      if($sub->num_rows()>0){
        echo '<li class="submenu">'.anchor($m->link,'<i class="'.$m->icon.'"></i> <span>'.$m->nama_menu.'</span>');
        echo '<ul>';
        foreach ($sub->result() as $s) {
          echo '<li>'.anchor($s->link,$s->nama_menu).'</li>';
        }
        echo '</ul>';
        echo '</li>';
      }
      else{
        echo '<li>'.anchor($m->link,'<i class="'.$m->icon.'"></i><span>'.$m->nama_menu.'</span></li>');
      }
    }
  ?>
    <!-- <li><a href="#"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li><a href="#"><i class="icon icon-plus"></i> <span>Input Data Jemaat</span></a> </li>
    <li><a href="#"><i class="icon icon-edit"></i> <span>Data Rumah Tangga</span></a> </li>
    <li><a href="#"><i class="icon icon-bar-chart"></i> <span>Statistik Jemaat</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Data Pendukung</span> <span class="label label-important">5</span></a>
      <ul>
        <li><a href="#">Input data Komisi</a></li>
        <li><a href="#">Input data Minat Bakat</a></li>
        <li><a href="#">Input data Pelayanan</a></li>
        <li><a href="#">Input data Pendeta</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-envelope"></i> <span>Surat Surat</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="#">Surat Babtis</a></li>
        <li><a href="#">Surat Penyerahan Anak</a></li>
        <li><a href="#">Surat Pemberkatan Nikah</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-briefcase"></i> <span>Mutasi Jemaat</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="#">Pindah Gereja</a></li>
        <li><a href="#">Meninggal Dunia</a></li>
      </ul>
    </li>
  <li class="submenu"> <a href="#"><i class="icon icon-external-link"></i> <span>Other</span> <span class="label label-important">2</span></a>
      <ul>
        <li><a href="#">Daftar Peserta Sepatu</a></li>
      </ul>
    </li> -->
  </ul>
</div>