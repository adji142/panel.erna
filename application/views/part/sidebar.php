<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="index.html"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <?php
      $SidebarDynamic = $this->GlobalVar->GetSideBar($user_id);
      $menu = '';
      $cur_menu = '';
      foreach ($SidebarDynamic->result() as $dt) {

        if($dt->multilevel == 0){
          $menu .= '<li><a href="'.base_url($dt->link).'"><i class="icon '.$dt->ico.'"></i> <span>'.$dt->permissionname.'</span></a> </li>'; 
        }
        else{
          if($dt->menu == $dt->menusubmenu){
            $menu .= '<li class="submenu"> ';
            $menu .= '<a href="'.base_url($dt->link).'"><i class="icon '.$dt->ico.'"></i> <span>'.$dt->permissionname.'</span></a>';
          }
          else{
            $menu.= '
              <ul>
                <li><a href="'.base_url($dt->link).'">'.$dt->permissionname.'</a></li>
              </ul>
            ';
          }
        }
      }
      echo $menu;
      // var_dump($menu);

    ?>
    <!-- <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Forms</span> <span class="label label-important">3</span></a>
      <ul>
        <li><a href="form-common.html">Basic Form</a></li>
        <li><a href="form-validation.html">Form with Validation</a></li>
        <li><a href="form-wizard.html">Form with Wizard</a></li>
      </ul> -->
    
  </ul>
</div>