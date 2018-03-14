<?php
  require_once(APPPATH."views/back/part/header.php");
  require_once(APPPATH."views/back/part/sidebar.php");
  
  $id_reg = $this->session->userdata('id_reg');
  $btn = $this->input->post('search-btn');
  $search = $this->input->post('search');
  $post = $this->m_ongoing->get_post($id_reg)->result();
  $photo='';
  $title='';
  $desc = '';
  $start = '';
  $end = '';
  $days = array();
  foreach ($post as $val) {
    $d=(int)substr($val->end_period, 8);
    $m=(int)substr($val->end_period, 5,2);
    $y=(int)substr($val->end_period, 0,4);
    $target = mktime(0, 0, 0, $m, $d, $y) ;
    $today = time () ;
    $difference =($target-$today) ;
    $days[] =(int) ($difference/86400) ;
  }
  $have = "";
  if(!empty($show)){
    echo $show;
  }
  if(!empty($get_post)){
    $have = $get_post;
  }
  $start = "";
  $end = "";
  $det_post = $this->m_ongoing->get_det_post($id_reg,$have)->result();
  foreach ($det_post as $gotit) {
    $start = $gotit->start_period;
    $end = $gotit->end_period;
  }
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
      <button type="button" class="btn btn-normal" value="<?php echo $this->session->userdata('id_reg');?>" id="exp">Expired</button>
      <button type="button" class="btn btn-normal" value="<?php echo $this->session->userdata('id_reg');?>" id="run">Running</button>
      <button type="button" class="btn btn-normal" value="most_like" id="most_like">Most liked</button>
      <button type="button" class="btn btn-normal" value="6765" id="best_rating">Best Ratting</button>

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
                url: "<?php echo base_url(); ?>back/ongoing/asc/",
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
                url: "<?php echo base_url(); ?>back/ongoing/desc/",
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

      <!-- expired -->
      <script type="text/javascript">
        var btn = $('#exp').val();
        $(document).ready(function(){
          $('#exp').click(function(){
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
                url: "<?php echo base_url(); ?>back/ongoing/exp/",
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

      <!-- Runing -->

      <script type="text/javascript">
        var btn = $('#run').val();
        $(document).ready(function(){
          $('#run').click(function(){
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
                url: "<?php echo base_url(); ?>back/ongoing/run/",
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
    <!-- this is place for alert -->

    <?php
      if(validation_errors() || $this->session->flashdata('result_renew')){
        echo validation_errors();
        echo $this->session->flashdata('result_renew');
      }
    ?>
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
                        url: "<?php echo base_url(); ?>back/ongoing/autocomplete/",
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
  $expired = "";
    foreach ($post as $key) {
      $param = $key->id_post;
      // $this->session->set_flashdata('param',$param);
      if($key->status=="expired"){
          $expired='<font color = "red">This post is expired.</font> <a data-toggle="modal" href="'.base_url("back/ongoing/show_modal/".$param."").'">Re-new it</a>';
      }
      else{
          $expired='';
      }
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
        '.$expired.'
        <p>
          Available on days only
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
<!-- modal -->
<div class="modal fade" id="modal_renew">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Re-new your promo periode</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('back/ongoing/re_new');?>">
          <div class="form-group">
            <label>Start periode yyyy-mm-dd</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="hidden" name="hide" value="<?php echo $have;?>">
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
<!-- /modal -->
<!-- /row -->
  </section>
<script src="<?php echo base_url()?>back/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>back/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</div>
<?php
  require_once(APPPATH."views/back/part/footer.php");
?>