<?php
$id_reg = $this->session->userdata('id_reg');
  $user=$this->m_dash->user_info($id_reg)->result();
$username='';
$status='';
$photo='';
  foreach ($user as $u) {
    $status = $u->condition;
    $username=$u->user;
    $photo=$u->photo;
  }
  ?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left Image">
          <img  src="<?php echo base_url()."/".$photo;?>" class="img-circle photo" alt="User Image" style = "width: 40px; height: 40px; object-fit: cover;">
        </div>
        <div class="pull-left info">
          <p><?php echo $username;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $status;?></a>
        </div>
      </div>

      <!-- search form -->
<!--       <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><p>Change Language</p>
          <div id="google_translate_element"></div><script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ar,en,id', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
            }
            </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
        </li>
        <?php
        $level = $this->session->userdata('level');
        $user=$this->m_dash->sidebar_mn($level)->result();
        foreach ($user as $lv) {
          echo '<li>';
          echo ''.anchor($lv->Link,'<i class="fa '.$lv->Logo.'"></i> <span>'.$lv->Name.'</span>');
          // echo '<i class="fa '.$lv->Logo.'"></i> <span>'.$lv->Name.'</span>';
          echo '<span class="pull-right-container">';
          echo '</span>';
          echo '</li>';
        }
        ?>
    </section>
    <!-- /.sidebar -->
  </aside>
