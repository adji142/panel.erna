<?php
  require_once(APPPATH."views/front/part/header_front.php");
  require_once(APPPATH."views/front/part/categories.php");
  echo base_url();
?>
<div class="container">
<?php 
require_once(APPPATH."views/front/part/tranding.php");
require_once(APPPATH."views/front/part/futured.php");	
?>
</div>
<?php
require_once(APPPATH."views/front/part/footer.php");
?>