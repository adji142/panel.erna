<?php
    $user_id = $this->session->userdata('userid');
    if($user_id != ''){
        echo "<script>location.replace('".base_url()."home');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Site Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo base_url();?>Assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>Assets/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>Assets/css/matrix-login.css" />
        <link href="<?php echo base_url();?>Assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <!-- Sweet alert -->
        <script src="<?php echo base_url();?>Assets/sweetalert2-8.8.0/package/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>Assets/sweetalert2-8.8.0/package/dist/sweetalert2.min.css">

    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" enctype='application/json'>
            	    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
				 <div class="control-group normal_text"> <h3>Login</h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="Username" id="username" required="" name="username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Password" id="password" required="" name="password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <!-- <a href="<?php base_url();?>id/home" class="flip-link btn btn-info" >Lost password?</a> -->
                    <!-- <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span> -->
                    <span class="pull-right"><button id="btn_login" class="btn btn-success" > Login</button></span>
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical" enctype='application/json'>
				<p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><button class="btn btn-info" id="btn_recover">Reecover</button></span>
                </div>
            </form>
        </div>
        
        <script src="<?php echo base_url();?>Assets/js/jquery.min.js"></script>  
        <script src="<?php echo base_url();?>Assets/js/matrix.login.js"></script> 
    </body>

</html>

<script type="text/javascript">
    $(function () {
        // Handle CSRF token
        $.ajaxSetup({
	        beforeSend:function(jqXHR, Obj){
	            var value = "; " + document.cookie;
	            var parts = value.split("; csrf_cookie_token=");
	            if(parts.length == 2)
	            Obj.data += '&csrf_token='+parts.pop().split(";").shift();
	        }
	    });
	    $(document).ready(function () {
	    	// body...
	    });
        // end Handle CSRF token
        $('#loginform').submit(function (e) {
            $('#btn_login').text('Tunggu Sebentar...');
            $('#btn_login').attr('disabled',true);

            e.preventDefault();
        	var me = $(this);
            // alert(me.serialize());
            $.ajax({
                type: "post",
                url: "<?=base_url()?>Auth/Auth_Login/Log_Pro",
                data: me.serialize(),
                dataType: "json",
                success:function (response) {
                    if(response.success == true){
                        location.replace("<?=base_url()?>home")
                    }
                    else{
                        if(response.message == 'L-01'){
                            Swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text: 'User dan password tidak sesuai dengan database!',
                              // footer: '<a href>Why do I have this issue?</a>'
                            });
                            $('#user').text('');
                            $('#password').text('');
                            $('#btn_submit').text('Login');
                            $('#btn_submit').attr('disabled',false);
                        }
                        else if(response.message == 'L-02'){
                            Swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text: 'User tidak di temukan!',
                              footer: '<a href>Why do I have this issue?</a>'
                            });
                            $('#user').text('');
                            $('#password').text('');
                            $('#btn_submit').text('Login');
                            $('#btn_submit').attr('disabled',false);
                        }
                        else{
                            Swal.fire({
                              type: 'error',
                              title: 'Oops...',
                              text: 'Undefine Error Contact your system administrator!',
                              footer: '<a href>Why do I have this issue?</a>'
                            });
                            $('#user').text('');
                            $('#password').text('');
                            $('#btn_submit').text('Login');
                            $('#btn_submit').attr('disabled',false);
                        }
                    }
                }
            });
        });
    });
</script>