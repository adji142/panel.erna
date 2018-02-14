  <select onchange="javascript:window.location.href='<?php echo base_url(); ?>LanguageSwitcher/switchLang/'+this.value;">
   <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
   <option value="indonesia" <?php if($this->session->userdata('site_lang') == 'indonesia') echo 'selected="selected"'; ?>>Indonesia</option>
  </select>
<p><?php echo $this->lang->line('menu_lang'); $this->session->userdata('site_lang')?></p>