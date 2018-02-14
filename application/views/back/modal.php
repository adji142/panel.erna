<?php
	require_once(APPPATH."views/back/part/header.php");
	require_once(APPPATH."views/back/part/sidebar.php");
?>
<title><?php echo $title;?></title>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
window.onload = function () {
    var fileUpload = document.getElementById("fileupload");
    fileUpload.onchange = function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = document.getElementById("dvPreview");
            dvPreview.innerHTML = "";
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            for (var i = 0; i < fileUpload.files.length; i++) {
                var file = fileUpload.files[i];
                if (regex.test(file.name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = document.createElement("IMG");
                        img.height = "100";
                        img.width = "100";
                        img.src = e.target.result;
                        dvPreview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                } else {
                    alert(file.name + " is not a valid image file.");
                    dvPreview.innerHTML = "";
                    return false;
                }
            }
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    }
};
</script>
<?php
$token = $this->session->userdata('have_token');
$id_post = $this->session->userdata('id_post');
if($token !=''){
	echo "
	<script type='text/javascript'>
  		$(window).on('load',function(){
    	$('#modal-change').modal('show');
  		});
	</script>
	";
}
else{
	echo "
		<script>
			window.location=history.go(-1);
		</script>
	";
}
//get location
$get_token = $this->m_edit->get_token($id_post,$id_reg)->result();
$have_token = array();
foreach ($get_token as $key) {
  $have_token[]=$key->token;
}
$possition = array_search($token, $have_token);
$fix_poss = 1+$possition;

//get pic

$photo='';
$get_foto = $this->m_edit->get_foto($id_reg,$id_post,$token)->result();
foreach ($get_foto as $key) {
	$photo = $key->nama_foto;
}
?>
        <div class="modal fade" id="modal-change">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  </button>
                <h4 class="modal-title">Change your pictre</h4><?php echo $fix_poss;?>
              </div>
              <div class="modal-body">
              	<form method="post" enctype="multipart/form-data" action="<?php echo base_url('back/edit/change_pic')?>">
              		<div class="form-group">
                    <div id="dvPreview" class="img-circle"></div><br>
              		<input type="file" name="gambar" id="fileupload">
              		</div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" onclick="history.go(-1);">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<?php
require_once(APPPATH."views/back/part/footer.php");
?>