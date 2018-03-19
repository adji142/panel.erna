<?php
  require_once(APPPATH."views/back/part/header.php");
  require_once(APPPATH."views/back/part/sidebar.php");
  $date_now = date("Y-m-d");
  $this->m_dash->go_update_post($date_now);
?>

<div class="content-wrapper">
  <section class="content-header">
      <h1>
        Dashboard
        <small>Portal Admin Towo.com</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Dashboard</li>
      </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php
            $active = $this->db->query("select * from app_post where id_reg = $id_reg and status = 'running'");
          ?>
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $active->num_rows();?></h3>

              <p>Active Promo</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('back/dashboard/ongoing')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php
            $active = $this->db->query("select * from app_post where id_reg = $id_reg");
          ?>
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $active->num_rows();?></h3>

              <p>All Promo</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-infinite"></i>
            </div>
            <a href="<?php echo base_url('back/dashboard/ongoing')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- <div class="col-lg-3 col-xs-6"> -->
          <!-- small box -->
          <!-- <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Store Rating</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div> -->
        <!-- </div> -->
        <!-- <div class="col-lg-3 col-xs-6"> -->
          <!-- small box -->
          <!-- <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>Followers</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div> -->
        <!-- </div> -->
        <!-- <div class="col-lg-3 col-xs-6"> -->
          <!-- small box -->
          <!-- <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Visitors per day</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div> -->
        <!-- </div> -->
    </div>
    
    <!-- <div class="row">
      <div class="col-lg-12 connectedSortable">
        <div class="nav-tabs-custom">
            <div class="tab-content no-padding"> -->
              <!-- Morris chart - Sales -->
              <!-- <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
          </div>
      </div>
    </div> -->
  </section>
</div>
<?php
  require_once(APPPATH."views/back/part/footer.php");
?>