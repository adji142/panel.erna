<?php
  require_once(APPPATH."views/back/part/header.php");
  require_once(APPPATH."views/back/part/sidebar.php");
  $id_reg = $this->session->userdata('id_reg');
  $btn = $this->input->post('search-btn');
  $search = $this->input->post('search');
  $post = $this->m_expired->get_post($id_reg)->result();
  $days = (int)"";
  foreach ($post as $get) {
    $d=(int)substr($get->end_period, 8);
    $m=(int)substr($get->end_period, 5,2);
    $y=(int)substr($get->end_period, 0,4);
    $target = mktime(0, 0, 0, $m, $d, $y) ;
    $today = time () ;
    $difference =($target-$today) ;
    $days =(int) ($difference/86400) ;
  }
  $photo='';
  $title='';
  $desc = '';
  $start = '';
  $end = '';
?>
<style type="text/css">
	.center{
		bottom: 0; left: 0; top: 0; right: 0;
		margin: auto;
		position: absolute;
		width: 75px;
		height: 75px;
	}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Advanced Form Elements <?php 
        $target = mktime(0, 0, 0, 10, 27, 2017) ;

        $today = time () ;

        $difference =($target-$today) ;

        $days =(int) ($difference/86400) ;

        print "Our event will occur in $days days";
        ?>
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
  <!-- ajax -->
<!-- /ajax -->
<div class="row">
  <div class="col-md-12">
    <?php
      $var = $this->session->flashdata('result_pass');
      if($var != ""){
        echo $this->session->flashdata('result_pass');
      }
    ?>
  </div>
</div>
  <div class="row">
   <div class="col-md-12">
    <div class="box">
      <div class="box header" style="height: 10%;">
   	    <div class="sidebar-form">
          <div class="input-group">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search..." onkeyup="ajaxSearch();">
              <span class="input-group-btn">
                <button type="button"class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
          </div>
        </div>
    </div>
    <div class="box-body">
      <p>Filter on:</p>
      <button type="button" class="btn btn-normal" value="<?php echo $this->session->userdata('id_reg');?>" id="new" onclick="asc();" >Newest</button>
      <button type="button" class="btn btn-normal" value="<?php echo $this->session->userdata('id_reg');?>" id="old">Oldest</button>
      <button type="button" class="btn btn-normal" value="most_like" id="most_like">Most liked</button>
      <button type="button" class="btn btn-normal" value="best_rating" id="best_rating">Best Ratting</button>
      <script type="text/javascript">
        var btn = $('#new').val();
        $(document).ready(function(){
          $('#new').click(function(){
            if(btn.length === 0){
              alert("Something wrong to sort your data , data length "+btn.length);
            }
            else{
              var get_asc = {
                  'new': btn,
                  '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
              };
              $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>back/expired/asc/",
                data: get_asc,
                success: function (data) {
                  if (data.length > 0) {
                      $('#suggestions').show();
                      $('#autoSuggestionsList').addClass('auto_list');
                      $('#autoSuggestionsList').html(data);
                  }
                }
              });
            }
          });
        });
      </script>
      <!-- descending -->
      <script type="text/javascript">
        var btn = $('#old').val();
        $(document).ready(function(){
          $('#old').click(function(){
            if(btn.length === 0){
              alert("Something wrong to sort your data , data length "+btn.length);
            }
            else{
              var get_desc = {
                  'old': btn,
                  '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
              };
              $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>back/expired/desc/",
                data: get_desc,
                success: function (data) {
                  if (data.length > 0) {
                      $('#suggestions').show();
                      $('#autoSuggestionsList').addClass('auto_list');
                      $('#autoSuggestionsList').html(data);
                  }
                }
              });
            }
          });
        });
      </script>
      <!-- most liked -->

      <!-- best ratting -->
    </div>
    </div>
   </div>
</div>

<div class="row">
	<div class="col-md-3" >
	<div class="box" style="border: 2px dashed #0087F7; height: 70%;">
		<center>
		<a href="<?php echo base_url('back/dashboard/post');?>"><img class="center" src="<?php echo base_url();?>back/dist/img/add.png"></a>
     </div>
	</div>
<script type="text/javascript">
            function ajaxSearch()
            {
                var input_data = $('#search').val();

                if (input_data.length === 0)
                {
                    input_data = $('#search').val(" ");
                    $('#suggestions').show();
                }
                else
                {

                    var post_data = {
                        'search': input_data,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    };

                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>back/expired/autocomplete/",
                        data: post_data,
                        success: function (data) {
                            // return success
                            if (data.length > 0) {
                                $('#suggestions').show();
                                $('#autoSuggestionsList').addClass('auto_list');
                                $('#autoSuggestionsList').html(data);
                            }
                        }
                    });

                }
            }
        </script>
<!-- place -->
<div id="suggestions">
<div id="autoSuggestionsList">
  <?php
  $day2 = substr(date('Y-m-d'), 8);
  
    foreach ($post as $key) {
      $param = $key->id_post;
      $day1 = substr($key->end_period, 8);
      $avail = $day2-$day1;
      
      echo '
        <div class="col-md-3">
        <div class="box" style="height: 70%;">
        <div class="box-header with-border">
        <a href="'.base_url("back/edit/show/".$param."").'"><h3 class="box-title"><font color = "#0087F7">'.$key->promo_title.'</font></h3></a>
        <div class="box-tools pull-right">
        </div>
        </div>
        <div class="box-body">
        <p>
        <img width="100%" src="'.base_url().'/'.$key->pic1.'"  alt="User Image" height="50%" class="img-circle">
        </p>
        <p>
        <?php echo $desc;?>
        </p>
        <p>
        Periode : '.$key->start_period.' until '.$key->end_period.'
        </p>
        <p>
          Available on '.$days.' days only
        </>
        </div>
        <div class="box-footer">
          <p><i class="fa fa-eye"> Viewer</i></p>
          <p><i class="fa fa-heart-o"> Like</i></p>
        </div>
        </div>
        </div>
        ';
    }
  ?>
</div>
</div>
</div>
<!-- /row -->
  </section>
<script src="<?php echo base_url()?>back/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>back/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</div>
<?php
  require_once(APPPATH."views/back/part/footer.php");
?>