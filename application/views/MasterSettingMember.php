<?php
    require_once(APPPATH."views/part/Header.php");
    require_once(APPPATH."views/part/sidebar.php");
?>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> 
        <a href="<?php echo base_url();?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="tip-buttom"> Master</a>
        <a href="#" class="tip-buttom"> Setting Member</a>
    </div>
  </div>
<!--End-breadcrumbs-->
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>
        </div>
        <div class="widget-content nopadding">
            <table class="table table-bordered data-table" >
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Member</th>
                      <th>User ID</th>
                      <th>Email</th>
                      <th>NoTlp</th>
                      <th>Member Since</th>
                      <th>Kelas Member</th>
                      <th>Status</th>
                    </tr>
              </thead>
              <tbody>
                    
                      <?php
                        $Recordset = $this->ModelsMember->ListingMember();
                        if($Recordset->num_rows() > 0){
                          foreach ($Recordset->result() as $key) {
                            echo "<tr class='gradeX'>";
                            echo "<td>#</td>";
                            echo "<td>".$key->namamember."</td>";
                            echo "<td>".$key->username."</td>";
                            echo "<td>".$key->email."</td>";
                            echo "<td>".$key->notlp."</td>";
                            echo "<td>".$key->membersince."</td>";
                            echo "<td>".$key->membergrade."</td>";
                            echo "<td>".$key->status."</td>";
                            echo "</tr>";
                          }
                        }
                        else{
                            echo "<tr class='gradeX'>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "</tr>";
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
<?php
    require_once(APPPATH."views/part/footer.php");
?>
<!-- <div class="row-fluid">
  <div id="footer" class="span12"> 2013 &copy; Matrix Admin. Brought to you by <a href="http://themedesigner.in">Themedesigner.in</a> </div>
</div>
<script src="<?php echo base_url();?>Assets/js/jquery.min.js"></script> 
<script src="<?php echo base_url();?>Assets/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url();?>Assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>Assets/js/jquery.uniform.js"></script> 
<script src="<?php echo base_url();?>Assets/js/select2.min.js"></script> 
<script src="<?php echo base_url();?>Assets/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url();?>Assets/js/matrix.js"></script> 
<script src="<?php echo base_url();?>Assets/js/matrix.tables.js"></script>
</body>
</html> -->

<!-- <script type="text/javascript">
    $('#example1').DataTable();
</script> -->